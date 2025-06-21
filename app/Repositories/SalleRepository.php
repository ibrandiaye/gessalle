<?php
namespace App\Repositories;

use App\Models\Salle;

class SalleRepository extends RessourceRepository{

    public function __construct(Salle $salle)
    {
        $this->model = $salle;
    }
}
