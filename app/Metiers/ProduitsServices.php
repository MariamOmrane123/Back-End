<?php

namespace App\Metiers;
use Illuminate\Http\Request;
use App\Produit;


class ProduitsServices
{

    function getAll(){
        return Produit::all();
    }

    function getOne($id){
        $produit=Produit::find($id);
        if(!$produit){
            return null;
        }
        else
            return $produit;
    }

    function add(Request $request){
        $produit=new Produit();
        $produit->label=$request->input('label');
        $produit->quantite=$request->input('quantite');
        $produit->prix=$request->input('prix');
        $produit->save();
        return $produit;
    }

    function dropOne($id){
        $produit=$this->getOne($id);
        if($produit!=null)
        {
            $produit->delete();
            return $produit;
        }
        else
            return response()->json(['error'=>1,'message'=>'Unable to find Produit with ID '. $id]);
    }

    function update($id,Request $request){
        $produit=Produit::find($id);
        $produit->update($request->all());
        return $produit;
    }
}
