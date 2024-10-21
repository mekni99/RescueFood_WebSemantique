<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationRequest extends Model
{
    use HasFactory;
    protected $fillable = ['association_name', 'association_email', 'product_requested', 'quantity', 'status'];

    // Relation avec l'association
 public function association()
 {
     return $this->belongsTo(Association::class);
 }

    /**
     * La relation avec le modèle Destinataire.
     * Une demande d'association peut avoir plusieurs destinataires.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function destinataires(): HasMany
    {
        return $this->hasMany(Destinataire::class, 'request_id');
    }
}
