<?php
namespace App\Repositories;

use App\Models\Plan;
use Illuminate\Support\Facades\DB;

class PlanRepository extends RessourceRepository{

    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }

    public function getByIntitule($intitule)
    {
        return DB::table("plans")->where("intitule",$intitule)->first();
    }

    public function updatePlanByEtat($id,$statut)
    {
        return DB::table("plans")
        ->where("id",$id)
        ->update(["statut"=>$statut]);
    }
    
    public function  allPlan(){
        return DB::table('plans')->where('statut',true)->count();
    }
}
