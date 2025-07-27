<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
      protected $fillable = [
        'salle_id',
        'type',
        'date_debut',
        'date_fin','statut','plan_id','montant','type_paiement'
    ];

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
