<?php
namespace App\Repositories;

use App\Models\Paiement;
use Illuminate\Support\Facades\DB;

class PaiementRepository extends RessourceRepository{

    public function __construct(Paiement $paiement)
    {
        $this->model = $paiement;
    }
     public function sumPaiementBySalle($salle)
    {
        return DB::table("paiements")
        ->join("souscriptions","paiements.souscription_id","=","souscriptions.id")
        ->join("clients","souscriptions.client_id","=","clients.id")

        ->where('clients.salle_id',$salle)
        ->whereDay('paiements.created_at', now()->day)
        ->whereYear('paiements.created_at', now()->year)
        ->sum("paiements.montant");
    }
}
