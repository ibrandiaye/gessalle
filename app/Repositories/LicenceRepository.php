<?php
namespace App\Repositories;

use App\Models\Licence;
use Illuminate\Support\Facades\DB;

class LicenceRepository extends RessourceRepository{

    public function __construct(Licence $licence)
    {
        $this->model = $licence;
    }
    public function nbLicenceByEtat($etat)
    {
        return DB::table("licences")->where('statut',$etat)->count();
    }
     public function chiffreAffaire()
    {
        return DB::table("licences")
        ->join('plans',"licences.plan_id","=","plans.id")
        ->sum("plans.montant");
    }
    public function getLicenceByEtatAndSalle($salle_id,$etat)
    {
        return DB::table("licences")->where(['statut'=>$etat,'salle_id'=>$salle_id])->get();
    }
    public function updateLicenceByEtatAndSallet($id,$etat)
    {
        return DB::table("licences")
        ->where("id",$id)
        ->update(["statut"=>$etat]);
    }

     public function getLicenceBySalle($salle_id)
    {
        return DB::table("licences")->where(['salle_id'=>$salle_id])
        ->orderBy("id","desc")
        ->get();
    }
    public function  chiffreAffaireParClient(){

        return   DB::table('licences')
        ->join('salles',"licences.salle_id","=","salles.id")
        ->select('salles.nom' ,DB::raw('sum(licences.montant) as montant'))
        ->groupBy('salles.nom')
        ->get();

    }
    public function getLicenceOneBySalle($salle_id)
    {
        return DB::table("licences")->where(['salle_id'=>$salle_id])
        ->orderBy("id","desc")
        ->first();
    }
    public function verifLicenceByEtat($salle_id,$etat)
    {
        return DB::table("licences")
        ->where("salle_id",$salle_id)
        ->where('statut',$etat)
        ->first();
    }

}
