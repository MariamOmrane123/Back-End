<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metiers\ProduitsServices;
use App\Produit;

class ProduitsController extends Controller
{

    protected $produitsServices;

    function __construct(ProduitsServices $produitsServices){
        $this->produitsServices = $produitsServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits= $this->produitsServices->getAll();
        return response()->json($produits);
        //return view('produits.index')->with('produits',$produits);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produit=$this->produitsServices->add($request);
        return response()->json($produit);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produit= $this->produitsServices->getOne($id);
        return response()->json($produit);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $produit=$this->produitsServices->update($id,$request);
        return response()->json([$produit]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit=$this->produitsServices->dropOne($id);
        return response()->json($produit);
    }
}
