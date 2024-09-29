<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type',
        'practical_tips',
        'shelf_life',
        'state',
        'creation_date',
        'status',
    ];
}
