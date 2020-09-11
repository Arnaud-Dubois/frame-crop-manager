<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\MediasController;

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

// Medias
Route::get('medias', [MediasController::class, 'index']);
Route::get('medias/{id}', [MediasController::class, 'show']);
Route::post('medias', [MediasController::class, 'store']);
Route::put('medias', [MediasController::class, 'store']);
Route::delete('medias/{id}', [MediasController::class, 'destroy']);