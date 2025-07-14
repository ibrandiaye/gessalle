<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
      protected $fillable = [

        'tel',
        'salle_id',
        'message'
    ];

}
