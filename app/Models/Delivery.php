<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    // Les attributs qui peuvent être assignés en masse
    protected $fillable = [
        'start_address',
        'delivery_address',
        'recipient_name',
        'status',
        'transport_id', // Ajout de transport_id
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Relation avec Transport (Many-to-One)
    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }
}
