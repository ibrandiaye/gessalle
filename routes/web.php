<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SouscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsFirstConnected;
use App\Http\Middleware\IsSuperAdmin;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('home');
})->middleware(['auth',IsFirstConnected::class]); */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth',IsFirstConnected::class]);

Route::resource('/client', ClientController::class)->middleware('auth');
Route::resource('/depense', DepenseController::class)->middleware('auth');
Route::resource('/employe', EmployeController::class)->middleware('auth');
Route::resource('/licence', LicenceController::class)->middleware('auth');
Route::resource('/offre', OffreController::class)->middleware('auth');
Route::resource('/paiement', PaiementController::class)->middleware('auth');
Route::resource('/salle', SalleController::class)->middleware('auth');
Route::resource('/souscription', SouscriptionController::class)->middleware('auth');
Route::resource('/user', UserController::class)/*->middleware('auth')*/;
Route::resource('/plan', PlanController::class)->middleware(['auth',IsSuperAdmin::class]);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth',IsFirstConnected::class]);

Route::get('/modifier/mot-de-passe', function () {
    return view('user.modifier_password');
})->name("modifier")->middleware("auth");
Route::post('/update/password',[UserController::class,'updatePassword'])->name("user.password.update")->middleware(["auth"]);

Route::get('/edit/etat/salle/{id}/{etat}', [SalleController::class, 'editEtat'])->name('edit.etat')->middleware(['auth',IsSuperAdmin::class]);
