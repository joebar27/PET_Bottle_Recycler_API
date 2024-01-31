<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Routes pour les utilisateurs:
Route::get("/users", "App\Http\Controllers\UserController@index");
Route::get("/users/{user}", "App\Http\Controllers\UserController@show");
Route::post("/users", "App\Http\Controllers\UserController@store");
Route::put("/users/{user}", "App\Http\Controllers\UserController@update");
Route::delete("/users/{user}", "App\Http\Controllers\UserController@destroy");

//Routes pour les bouteilles:
Route::get("/bottles", "App\Http\Controllers\BottleController@index");
Route::get("/bottles/{bottle}", "App\Http\Controllers\BottleController@show");
Route::post("/bottles", "App\Http\Controllers\BottleController@store");
Route::put("/bottles/{bottle}", "App\Http\Controllers\BottleController@update");
Route::delete("/bottles/{bottle}", "App\Http\Controllers\BottleController@destroy");
