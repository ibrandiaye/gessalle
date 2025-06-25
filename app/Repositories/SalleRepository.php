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
}
