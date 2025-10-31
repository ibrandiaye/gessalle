<?php
namespace App\Repositories;

use App\Models\Depense;
use Illuminate\Support\Carbon;
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
         ->whereDay('created_at', now()->day)
        ->whereYear('created_at', now()->year)
        ->sum("depenses.montant");
    }
    public function getDepenseBySalle($salle)
    {
        return Depense::with(["employe"])
        ->where("salle_id",$salle)
        ->get();
    }
    public function getDepenseBySalleAndDate($salle, $date_debut, $date_fin)
    {
        // S'assurer que les dates sont au bon format
        $start = Carbon::parse($date_debut)->startOfDay();
        $end = Carbon::parse($date_fin)->endOfDay();

        return Depense::with(['employe'])
            ->where('salle_id', $salle)
            ->whereBetween('created_at', [$start, $end])
            ->get();
    }

}
