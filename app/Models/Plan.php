<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
     protected $fillable = [
        'intitule',
        'nb_jour',
        'montant',
        "photo",
        "statut",
        "type"

    ];


}
