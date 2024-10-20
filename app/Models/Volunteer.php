<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'availability',
        'telephone_number', 
        'association_id',
    ];

    public function association()
    {
        return $this->belongsTo(User::class, 'association_id'); // Link to User model
    }
}
