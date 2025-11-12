<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_commande',
        'user_id',
        'nom_client',
        'email_client',
        'telephone',
        'adresse_livraison',
        'date_commande',
        'montant_total',
        'etat',
        'mode_paiement',
        'note',
    ];

    // Automatically generate numero_commande
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($commande) {
            $year = now()->year;
            $count = self::whereYear('created_at', $year)->count() + 1;
            $commande->numero_commande = sprintf('CMD_%s_%03d', $year, $count);
        });
    }
}

