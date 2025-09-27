<?php
namespace App\Repositories;

use App\Models\Salle;
use Illuminate\Support\Facades\DB;

class SalleRepository extends RessourceRepository{

    public function __construct(Salle $salle)
    {
        $this->model = $salle;
    }

    public function editEtat($id,$etat)
    {
        return DB::table("salles")->where('id',$id)->update(["etat"=>$etat]);
    }
    public function nbSalleByEtat($etat)
    {
        return DB::table("salles")->where('etat',$etat)->count();
    }
    public function getSalleById($id)
    {
        return DB::table("salles")->where("id",$id)->first();
    }

    public function updateQuantiteMessage($id,$nb)
    {
        return DB::table("salles")->where("id",$id)->update(["ct_sms"=>$nb]);

    }
     public function nbrSalle()
    {
        return DB::table("salles")->where('etat',true)->count();
    }
}
