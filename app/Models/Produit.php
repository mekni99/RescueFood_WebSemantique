<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $fillable = ['association_name', 'product_requested', 'quantity'];

    // Relation avec l'association
    public function association()
    {
        return $this->belongsTo(Association::class);
    }

}

