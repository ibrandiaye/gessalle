<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
     protected $fillable = [
        'nom',
        'adresse',
        'logo',
        'telephone','admin_user_id','etat','essai','ct_sms'
    ];

    public function licences()
    {
        return $this->hasMany(Licence::class);
    }
    public function hasActiveLicence()
    {
        return $this->licences()->where('statut', 'active')->exists();
    }

}
