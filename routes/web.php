<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SouscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsFirstConnected;
use App\Http\Middleware\IsSuperAdmin;
use App\Http\Middleware\VerifSalle;
use App\Models\Souscription;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('home');
})->middleware(['auth',IsFirstConnected::class]); */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth',IsFirstConnected::class]);

Route::resource('/client', ClientController::class)->middleware('auth');
Route::resource('/depense', DepenseController::class)->middleware('auth');
Route::resource('/employe', EmployeController::class)->middleware('auth');
Route::resource('/licence', LicenceController::class)->middleware(['auth',IsSuperAdmin::class]);
Route::resource('/offre', OffreController::class)->middleware('auth');
Route::resource('/paiement', PaiementController::class)->middleware('auth');
Route::resource('/salle', SalleController::class)->middleware(['auth',IsSuperAdmin::class]);
Route::resource('/souscription', SouscriptionController::class)->middleware('auth');
Route::resource('/user', UserController::class)->middleware(['auth',IsSuperAdmin::class]);
Route::resource('/plan', PlanController::class)->middleware(['auth',IsSuperAdmin::class]);
Route::resource('/configuration', ConfigurationController::class)->middleware(['auth',IsSuperAdmin::class]);
Route::resource('/sms', SmsController::class)->middleware(['auth']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth',IsFirstConnected::class,VerifSalle::class]);

Route::get('/modifier/mot-de-passe', [UserController::class,'modifierMotdePasse'])->name("modifier")->middleware("auth");
Route::post('/update/password',[UserController::class,'updatePassword'])->name("user.password.update")->middleware(["auth"]);

Route::get('/edit/etat/salle/{id}/{etat}', [SalleController::class, 'editEtat'])->name('edit.etat')->middleware(['auth',IsSuperAdmin::class]);
Route::get('/bloque', function () {
    return view('bloque');
})->middleware(['auth'])->name("bloque");


Route::post('/update/password/employe',[EmployeController::class,'updatePassword'])->name("user.password.update.employe")->middleware(["auth"]);

Route::get('/souscription/client/{client_id}', [SouscriptionController::class, 'createByClient'])->name('createByClient')->middleware(['auth',IsFirstConnected::class,VerifSalle::class]);
Route::post('/souscription/client', [SouscriptionController::class, 'storeByClient'])->name('storeByClient')->middleware(['auth',IsFirstConnected::class,VerifSalle::class]);

Route::get('/licence/salle/{salle_id}', [LicenceController::class, 'createBySalle'])->name('createBySalle')->middleware(['auth',IsFirstConnected::class]);
Route::post('/licence/salle', [LicenceController::class, 'storeBySalle'])->name('storeBySalle')->middleware(['auth',IsFirstConnected::class]);

Route::get('/souscriptions/by/client/{client}', [SouscriptionController::class, 'getSouscriptionByClient'])->name('getSouscriptionByClient')->middleware(['auth',IsFirstConnected::class,VerifSalle::class]);


Route::get('/edit/etat/offre/{id}/{etat}', [OffreController::class, 'updateOffreByEtatAndSalle'])->name('updateOffreByEtatAndSalle')->middleware(['auth']);
Route::get('/souscrire/plan', [PlanController::class, 'indexClient'])->name('indexClient')->middleware(['auth']);

Route::get('/licence/plan/salle/{plan_id}/{type}', [LicenceController::class, 'createBySalleAndPlan'])->name('createBySalleAndPlan')->middleware(['auth',IsFirstConnected::class]);



Route::get('/upadate/plan/by/etat/{id}/{statut}', [PlanController::class, 'updatePlanByEtat'])->name('updatePlanByEtat')->middleware(['auth'],IsSuperAdmin::class);

Route::get('/impression/souscription/{id}', [SouscriptionController::class, 'getOneSouscriptionById'])->name('getOneSouscriptionById');
Route::get('/store/ticker/rapide', [SouscriptionController::class, 'ticketRapide'])->name('ticketRapide');
Route::post( '/store/ticker/rapide', [SouscriptionController::class, 'storeRapide'])->name('souscription.store.rapide');


Route::get('/rapport', [HomeController::class, 'pageRapport'])->name('pageRapport')->middleware(['auth'],IsSuperAdmin::class);
Route::post('/rapport', [HomeController::class, 'rapport'])->name('rapport')->middleware(['auth']);
