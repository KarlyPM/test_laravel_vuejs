<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;


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
Route::post('user', [PersonaController::class, 'store']);
Route::get('users', [PersonaController::class, 'index'])->middleware('auth:api');
Route::put('user/{id}', [PersonaController::class, 'update']);
Route::get('user/{id}', [PersonaController::class, 'show']);
Route::delete('user/{id}', [PersonaController::class, 'destroy']);

