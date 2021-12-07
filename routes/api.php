<?php

use App\Http\Controllers\PeliculaControlador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/peliculas', [PeliculaControlador::class, 'index']);
Route::get('/peliculas/{id}', [PeliculaControlador::class, 'edit']);
Route::post('/peliculas', [PeliculaControlador::class, 'store']);
Route::put('/peliculas/{id}', [PeliculaControlador::class, 'update']);
Route::delete('/peliculas/{id}', [PeliculaControlador::class, 'destroy']);
