<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{

      protected $fillable = [
        'pseudo','user_id','salle_id'
    ];
}
