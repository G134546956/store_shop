<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class produit extends Model
{
    //
    use HasFactory;
    protected $fillable= ['nom','prix','description','stock','categorie_id','image'];
    // app/Models/Produit.php

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    // public function ligneCommandes()
    // {
    //     return $this->hasMany(LigneCommande::class);
    // }
    // public function lignes()
    // {
    //     return $this->hasMany(LigneCommande::class);
    // }
}
