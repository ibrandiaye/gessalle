<?php
namespace App\Repositories;

use App\Models\Depense;
use Illuminate\Support\Facades\DB;

class DepenseRepository extends RessourceRepository{

    public function __construct(Depense $depense)
    {
        $this->model = $depense;
    }

    public function sumDepenseBySalle($salle)
    {
        return DB::table("depenses")
        ->where('salle_id',$salle)
         ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum("depenses.montant");
    }
    public function getDepenseBySalle($salle)
    {
        return Depense::with(["employe"])
        ->where("salle_id",$salle)
        ->get();
    }
public function getDepenseBySalleAndDate($salle,$date_debut,$date_fin)
    {
        return Depense::with(["employe"])
        ->where("salle_id",$salle)
        ->whereBetween("created_at",[$date_debut,$date_fin])
        ->get();
    }

}
