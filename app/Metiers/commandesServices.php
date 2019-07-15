<?php

namespace App\Metiers;
use Illuminate\Http\Request;
use App\Commande;
use App\Produit;
use App\Utilisateur;
use JWTAuth;

class CommandesServices{

    function add(Request $request){
        $id=$request->input('produit_id');
        $quantite=$request->input('quantite');
        $produit= Produit::find($id);
        if($produit->quantite==0){
        return response()->json(['error'=>1,'message'=>'finished stock']);
        }
        else if($produit->quantite < $quantite){
            return response()->json(['error'=>2,'message'=>'insufficient stock']);
        }
        else{

            $quantiteFinal=$produit->quantite - $quantite;
            $produit->update(['quantite'=>$quantiteFinal]);
            $commande=new Commande();
            $utilisateur=  JWTAuth::parseToken()->toUser();
            $commande->produit_id=$request->input('produit_id');
            $commande->utilisateur_id=$utilisateur->id;
            $commande->quantite=$request->input('quantite');
            $commande->save();
            return $commande;
        } 
    }
}