<?php
namespace App\Repositories;

use App\Models\Souscription;

class SouscriptionRepository extends RessourceRepository{

    public function __construct(Souscription $souscription)
    {
        $this->model = $souscription;
    }
}
