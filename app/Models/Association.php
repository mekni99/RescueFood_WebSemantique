<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_details',
        'specific_needs',
        'status',
    ];

    // Relations et autres méthodes du modèle
}
