<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Souscription extends Model
{

      protected $fillable = [
        'date_debut',
        'date_fin','commentaire',
        'etat','client_id','offre_id'
    ];
}
