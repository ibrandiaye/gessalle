<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\LicenceController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\SouscriptionController;
use App\Repositories\SalleRepository;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/client', ClientController::class)->middleware('auth');
Route::resource('/depense', DepenseController::class)->middleware('auth');
Route::resource('/employe', EmployeController::class)->middleware('auth');
Route::resource('/licence', LicenceController::class)->middleware('auth');
Route::resource('/offre', OffreController::class)->middleware('auth');
Route::resource('/paiement', PaiementController::class)->middleware('auth');
Route::resource('/salle', SalleRepository::class)->middleware('auth');
Route::resource('/souscription', SouscriptionController::class)->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
