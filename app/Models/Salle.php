<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
     protected $fillable = [
        'nom',
        'adresse',
        'logo',
        'telephone','admin_user_id'
    ];
}
