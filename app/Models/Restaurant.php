<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    // Attributs que vous pouvez remplir via le modèle
    protected $fillable = [
        'name',
        'address',
        'city',
        'postal_code',
        'contact_name',
        'contact_phone',
        'contact_email',
        'food_type',
        'total_food_collected',
        'last_collection_date',
        'collection_zone',
        'storage_location',
        'banque_alimentaire_id',
        'status',
    ];

    // Définir la relation avec la Banque Alimentaire
    public function banqueAlimentaire()
    {
        return $this->belongsTo(BanqueAlimentaire::class);
    }
    public function dons()
    {
        return $this->hasMany(Don::class);
    }
    
    // Vous pouvez également ajouter d'autres relations ici, comme pour les collectes, si nécessaire
}
