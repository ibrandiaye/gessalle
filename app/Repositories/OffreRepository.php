<?php
namespace App\Repositories;

use App\Models\Offre;

class OffreRepository extends RessourceRepository{

    public function __construct(Offre $offre)
    {
        $this->model = $offre;
    }
}
