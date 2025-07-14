<?php
namespace App\Repositories;

use App\Models\Sms;
use Illuminate\Support\Facades\DB;

class SmsRepository extends RessourceRepository{

    public function __construct(Sms $sms)
    {
        $this->model = $sms;
    }

    public function getSmsBySalle($salle_id)
    {
        return DB::table("sms")->where("salle_id",$salle_id)->get();
    }
}
