<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** controladores**/

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('test-connection', function () {
    return ['Hello World'];
});

/** login **/
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

/** users **/
Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/store', [UserController::class, 'store']);
});


//Route::group(['prefix' => 'eletro'], function () {
//    Route::get('/listing', [EletroController::class, 'listing']);
//    Route::post('/store', [EletroController::class, 'store']);
//    Route::get('/show/{id}', [EletroController::class, 'show']);
//    Route::put('/update/{id}', [EletroController::class, 'update']);
//    Route::delete('/delete/{id}', [EletroController::class, 'delete']);
//});
//
//Route::group(['prefix' => 'marca'], function () {
//    Route::get('/listing', [MarcaController::class, 'listing']);
//});
