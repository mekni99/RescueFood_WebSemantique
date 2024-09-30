<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationRequest extends Model
{
    use HasFactory;
    protected $fillable = ['association_name', 'association_email', 'product_requested', 'quantity', 'status'];

}
