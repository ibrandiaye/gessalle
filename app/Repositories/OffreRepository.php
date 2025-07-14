<?php
namespace App\Repositories;

use App\Models\Offre;
use Illuminate\Support\Facades\DB;

class OffreRepository extends RessourceRepository{

    public function __construct(Offre $offre)
    {
        $this->model = $offre;
    }

    public function nbOffreBySalle($salle)
    {

        return DB::table("offres")->where('salle_id',$salle)->count();
    }
    public function updateOffreByEtatAndSalle($id,$etat)
    {
        return DB::table("offres")
        ->where("id",$id)
        ->update(["etat"=>$etat]);
    }
      public function getOffreBySalle($salle)
    {
        return Offre::where("salle_id",$salle)
        ->get();
    }
    public function OffreBySalleAndFirst($salle)
    {

        return DB::table("offres")->where('salle_id',$salle)->first();
    }

}
