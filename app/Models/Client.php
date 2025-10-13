<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

      protected $fillable = [
        'nom',
        'prenom',
        'tel',
        'email','sexe','salle_id','date_naiss'
    ];

     protected $casts = [
        'date_naiss' => 'datetime',

    ];
}
