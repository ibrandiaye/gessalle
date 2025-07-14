<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
      protected $fillable = [
        'libelle',
        'montant',
        'date_depense',
       /* 'description',*/'salle_id','employe_id'
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
