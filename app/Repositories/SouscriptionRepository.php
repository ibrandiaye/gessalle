<?php
namespace App\Repositories;

use App\Models\Souscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SouscriptionRepository extends RessourceRepository{

    public function __construct(Souscription $souscription)
    {
        $this->model = $souscription;
    }

    public function getSouscriptionByClient($client)
    {
        return DB::table("souscriptions")
        ->join("paiements","souscriptions.id","=","paiements.souscription_id")
        ->join("offres","souscriptions.offre_id","=","offres.id")
        ->select("souscriptions.*","paiements.montant","paiements.type_paiement","paiements.date_paiement",
        "offres.nom as offre")
        ->where("souscriptions.client_id",$client)
        ->orderBy("souscriptions.id","desc")
        ->get();
    }
    public function getSouscriptionBySalle($salle)
    {
        return DB::table("souscriptions")
       ->join("clients","souscriptions.client_id","=","clients.id")
        ->join("offres","souscriptions.offre_id","=","offres.id")
        ->select("souscriptions.*","clients.nom","clients.prenom","clients.email",
        "offres.nom as offre","clients.tel","clients.sexe","offres.prix as montant")
        ->where("clients.salle_id",$salle)
        ->orderBy("souscriptions.id","desc")
        ->get();
    }
    public function getOneSouscriptionById($id)
    {
        return DB::table("souscriptions")
       ->join("clients","souscriptions.client_id","=","clients.id")
        ->join("offres","souscriptions.offre_id","=","offres.id")
        ->select("souscriptions.*","clients.nom","clients.prenom","clients.email",
        "offres.nom as offre","clients.tel","clients.sexe","offres.salle_id","offres.prix")
        ->where("souscriptions.id",$id)
        ->first();
    }
    public function getSouscriptionBySalleAnddate($salle,$debut,$fin)
    {
         $start = Carbon::parse($debut)->startOfDay();
        $end = Carbon::parse($fin)->endOfDay();
        return DB::table("souscriptions")
       ->join("clients","souscriptions.client_id","=","clients.id")
        ->join("offres","souscriptions.offre_id","=","offres.id")
        ->select("souscriptions.*","clients.nom","clients.prenom","clients.email",
        "offres.nom as offre","clients.tel","clients.sexe","offres.prix")
        ->where("clients.salle_id",$salle)
        ->whereBetween("souscriptions.created_at",[$start,$end])
        ->orderBy("souscriptions.id","desc")
        ->get();
    }
}
