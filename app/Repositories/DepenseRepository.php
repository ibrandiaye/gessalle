<?php
namespace App\Repositories;

use App\Models\Depense;

class DepenseRepository extends RessourceRepository{

    public function __construct(Depense $depense)
    {
        $this->model = $depense;
    }
}
