<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** controladores**/

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdutoController;

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

/** produtos **/
Route::group(['prefix' => 'produto','middleware' => 'auth:sanctum'], function () {
    Route::get('/listing', [ProdutoController::class, 'listing']);
    Route::post('/store', [ProdutoController::class, 'store']);
    Route::get('/show/{id}', [ProdutoController::class, 'show']);
    Route::put('/update/{id}', [ProdutoController::class, 'update']);
    Route::delete('/delete/{id}', [ProdutoController::class, 'delete']);
});
//
//Route::group(['prefix' => 'marca'], function () {
//    Route::get('/listing', [MarcaController::class, 'listing']);
//});
