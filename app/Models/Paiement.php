<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{

      protected $fillable = [
        'type_paiement',
        'montant',
        'date_paiement',
        'reference','souscription_id'
    ];
}
