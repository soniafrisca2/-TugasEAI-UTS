<?php

use App\Http\Controllers\API\MovieinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('moviein', [MovieinController::class ,'index']);
Route::post('moviein/store', [MovieinController::class ,'store']);
Route::get('moviein/show/{id}', [MovieinController::class ,'show']);
Route::put('moviein/update/{id}', [MovieinController::class ,'update']);
Route::get('moviein/top_rated', [MovieinController::class, 'topRated']);
Route::put('/moviein/watched/{id}', [MovieinController::class, 'watched']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
