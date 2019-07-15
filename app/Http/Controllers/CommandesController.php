<?php

namespace App\Http\Controllers;
use App\Metiers\CommandesServices;
use App\Commande;
use Illuminate\Http\Request;

class CommandesController extends Controller
{
    protected $commandesServices;

    function __construct(CommandesServices $commandesServices){
        $this->commandesServices = $commandesServices;
    }
    
    
    public function acheter(Request $request){
        $commande=$this->commandesServices->add($request);
        return response()->json($commande);
    }
}
