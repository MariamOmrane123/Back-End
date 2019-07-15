<?php

namespace App\Metiers;
use Illuminate\Http\Request;
use App\Utilisateur;

use JWTFactory;
use JWTAuth;
use Validator;
use App\User;

class UtilisateursServices{
    function getAll(){
        return Utilisateur::all();
    }

    function getOne($id){
        $utilisateur=Utilisateur::find($id);
        if(!$utilisateur){
            return null;
        }
        else
            return $utilisateur;
    }

    function add(Request $request){
        $utilisateur=new Utilisateur();
        $utilisateur->nom=$request->input('nom');
        $utilisateur->prenom=$request->input('prenom');
        $utilisateur->email=$request->input('email');
        $utilisateur->password=$request->input('password');
        $utilisateur->save();
        return $utilisateur;
    }

    function dropOne($id){
        $utilisateur=$this->getOne($id);
        if($utilisateur!=null)
        {
            $utilisateur->delete();
            return $utilisateur;
        }
        else
            return response()->json(['error'=>1,'message'=>'Unable to find Produit with ID '. $id]);
    }

    function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'nom' => 'required',
            'prenom' => 'required',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user=Utilisateur::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $token = JWTAuth::fromUser($user);
        
        return Response::json(compact('token'));
    }

    function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
}