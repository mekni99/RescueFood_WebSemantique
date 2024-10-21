<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Destinataire extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'contact', 'address', 'specific_needs', 'request_id'];

    /**
     * La relation avec le modèle AssociationRequest.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function associationRequest(): BelongsTo
    {
        return $this->belongsTo(AssociationRequest::class, 'request_id');
    }
}
