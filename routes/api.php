<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('songs', [\App\Http\Controllers\SongController::class, 'index']);
Route::get('songs/{id}', [\App\Http\Controllers\SongController::class, 'show']);
Route::post('songs', [\App\Http\Controllers\SongController::class, 'store']);
Route::put('songs/{id}', [\App\Http\Controllers\SongController::class, 'update']);
Route::delete('songs/{id}', [\App\Http\Controllers\SongController::class, 'destroy']);
