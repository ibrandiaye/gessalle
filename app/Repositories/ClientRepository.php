<?php
namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientRepository extends RessourceRepository{

    public function __construct(Client $client)
    {
        $this->model = $client;
    }

    public function getClientById($client)
    {
        return DB::table("clients")->where("id",$client)->first();
    }
     public function nbClientBySalle($salle)
    {
        return DB::table("clients")->where('salle_id',$salle)->count();
    }

    public function getClientBySalle($salle)
    {
        return Client::where("salle_id",$salle)->get();
    }
    public function getClientBySalleAndTel($salle,$tel)
    {
        return Client::where("salle_id",$salle)->where("tel",$tel)->first();
    }
     public function getClientBySalleAndName($salle,$nom)
    {
        return Client::where("salle_id",$salle)->where("nom",$nom)->first();
    }
}
