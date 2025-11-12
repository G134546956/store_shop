<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    //
    public function store(Request $request)
    {
        // ✅ Validation des champs
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email_client' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse_livraison' => 'required|string|max:500',
            'montant_total' => 'required|numeric|min:0',
            'mode_paiement' => 'required|in:en_ligne,à_la_livraison',
            'note' => 'nullable|string|max:500',
        ]);

        // ✅ Création de la commande
        $commande = new Commande();
        $commande->user_id = Auth::check() ? Auth::id() : null; // client connecté ou invité
        $commande->nom_client = $request->nom_client;
        $commande->email_client = $request->email_client;
        $commande->telephone = $request->telephone;
        $commande->adresse_livraison = $request->adresse_livraison;
        $commande->montant_total = $request->montant_total;
        $commande->mode_paiement = $request->mode_paiement;
        $commande->note = $request->note;

        // ⚙️ Génération automatique du numéro de commande (format : CMD_2025_001)
        $year = now()->year;
        $count = Commande::whereYear('created_at', $year)->count() + 1;
        $commande->numero_commande = sprintf('CMD_%s_%03d', $year, $count);

        $commande->save();

        // ✅ Message de confirmation
        return redirect()->route('lignecommande')->with('success', 
            "Votre commande a été enregistrée avec succès ! 
             Votre numéro de commande est : {$commande->numero_commande}"
        );
    }
}
