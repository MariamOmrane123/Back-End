<?php

namespace App\Http\Controllers;
use App\Metiers\UtilisateursServices;
use App\Utilisateur;
use Illuminate\Http\Request;

class UtilisateursController extends Controller
{
    protected $utilisateursServices;

    function __construct(UtilisateursServices $utilisateursServices){
        $this->utilisateursServices = $utilisateursServices;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $utilisateurs= $this->utilisateursServices->getAll();
        return response()->json($utilisateurs);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $utilisateur=$this->utilisateursServices->dropOne($id);
        return response()->json($utilisateur);
    }

    public function register(Request $request)
    {
        return $this->utilisateursServices->register($request);
    }

    public function login(Request $request)
    {
        return $this->utilisateursServices->login($request);
    }
}
