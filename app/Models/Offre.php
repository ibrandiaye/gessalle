<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{

      protected $fillable = [
        'nom',
        'description',
        'duree','prix',
        'description','salle_id'
    ];
}
