<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name',
        'address',         // Add the address field
        'contact_number',  // Add the contact_number field
        'contact_person',  // Add the contact_person field
    ];
}
