<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
Route::post('user', [UserController::class, 'store']);
Route::get('users', [UserController::class, 'index']);
Route::put('user/{id}', [UserController::class, 'update']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

//Ejemplo de ruta protegida
Route::middleware('auth:api')->group( function () {
    Route::get('users-protected', [UserController::class, 'index']);
});
    
