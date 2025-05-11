<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date_commande',
        'statut'
    ];

    protected $casts = [
        'date_commande' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')
            ->withPivot('quantite')
            ->withTimestamps();
    }
    
    // Helper method to calculate total amount of the order
    public function calculerMontantTotal()
    {
        $total = 0;
        foreach ($this->produits as $produit) {
            $total += $produit->prix_unitaire * $produit->pivot->quantite;
        }
        return $total;
    }

    public function getDateCommandeAttribute($value)
    {
        return Carbon::parse($value);
    }
}