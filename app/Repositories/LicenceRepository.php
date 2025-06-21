<?php
namespace App\Repositories;

use App\Models\Licence;

class LicenceRepository extends RessourceRepository{

    public function __construct(Licence $licence)
    {
        $this->model = $licence;
    }
}
