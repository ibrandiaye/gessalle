<?php
namespace App\Repositories;

use App\Models\Plan;

class PlanRepository extends RessourceRepository{

    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }
}
