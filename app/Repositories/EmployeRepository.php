<?php
namespace App\Repositories;

use App\Models\Employe;

class EmployeRepository extends RessourceRepository{

    public function __construct(Employe $employe)
    {


        $this->model = $employe;
    }
      public function getEmployeBySalle($salle)
    {
        return Employe::where("salle_id",$salle)
        ->get();
    }
}
