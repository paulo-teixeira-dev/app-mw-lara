<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EletroController;
use App\Http\Controllers\MarcaController;

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

Route::post('test-connection', function (){
    return ['Hello World'];
});

Route::group(['prefix' => 'eletro'], function () {
    Route::get('/listing', [EletroController::class, 'listing']);
    Route::post('/store', [EletroController::class, 'store']);
    Route::get('/show/{id}', [EletroController::class, 'show']);
    Route::put('/update/{id}', [EletroController::class, 'update']);
    Route::delete('/delete/{id}', [EletroController::class, 'delete']);
});

Route::group(['prefix' => 'marca'], function () {
    Route::get('/listing', [MarcaController::class, 'listing']);
});
