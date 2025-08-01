<?php

use App\Http\Controllers\LicenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/valider/paiement', [LicenceController::class, 'validatePaiement']);
