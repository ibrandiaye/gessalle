<?php
namespace App\Repositories;

use App\Models\Configuration;

class ConfigurationRepository extends RessourceRepository{

    public function __construct(Configuration $configuration)
    {
        $this->model = $configuration;
    }
}
