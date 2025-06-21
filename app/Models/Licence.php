<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
      protected $fillable = [
        'salle_id',
        'type',
        'date_debut',
        'date_fin','montant','statut'
    ];
}
