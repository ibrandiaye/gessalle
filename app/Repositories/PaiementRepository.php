<?php
namespace App\Repositories;

use App\Models\Paiement;

class PaiementRepository extends RessourceRepository{

    public function __construct(Paiement $paiement)
    {
        $this->model = $paiement;
    }
}
