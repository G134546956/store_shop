<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ClientController extends Controller
{
    //
    
    public function index(){
        $produits = Produit::all();
        return view("Client.home",compact('produits'));
    }
    public function show($id){
        $produit = Produit::findOrFail($id);
        return view("Client.show",compact('produit'));
    }
}
