<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/inscription',[ConnexionController::class,'register']);
Route::post('/connexion',[ConnexionController::class,'authenticate']);
Route::get('/open',[DataController::class,'open']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/user',[ConnexionController::class,'getAuthenticatedUser']);
    Route::get('/close',[DataController::class,'close']);
});