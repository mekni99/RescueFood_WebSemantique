<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    protected $fillable = [
        'user_id',
        'category', // Catégorie sous forme de texte
        'quantity',
    ];

    // Relation avec le restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
