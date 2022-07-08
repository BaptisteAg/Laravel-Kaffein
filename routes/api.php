<?php

use App\Http\Controllers\API\CompaniesController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Api for autentification
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Api for companie
Route::group(['prefix' => 'companies','middleware' => 'auth:sanctum'], function() {
    Route::get('/', [CompaniesController::class,'index']);
    Route::get('details/{id}', [CompaniesController::class,'details']);
});