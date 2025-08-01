<?php

use App\Models\Licence;
use App\Models\Souscription;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use Carbon\Carbon;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
   $today = Carbon::today();
    $licences = Licence::where('statut', 'active')
        ->where("type","abonnement")
            ->whereDate('date_fin', '<', $today)
            ->get();
    foreach ($licences as $licence) {
            $licence->update(['statut' => 'expirée']);
           // $this->info("Licence ID {$licence->id} expirée.");
        }
        $souscriptions = Souscription::where('etat', 'active')
            ->whereDate('date_fin', '<', $today)
            ->get();
    foreach ($souscriptions as $souscription) {
            $souscription->update(['etat' => 'expirée']);
           // $this->info("Souscription ID {$souscription->id} expirée.");
        }
})->everyFourHours();
