<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\ConnexionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inscription',[InscriptionController::class,'formulaire']);
Route::post('/inscription',[InscriptionController::class,'traitement']);

Route::get('/connexion',[ConnexionController::class,'formulaireConnexion']);
Route::post('/connexion',[ConnexionController::class,'traitementConnexion']);
Route::get('/deconnexion',[ConnexionController::class,'deconnexion']);