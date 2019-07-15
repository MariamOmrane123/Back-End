<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'produits'], function () {
    Route::get("/", "ProduitsController@index");
    Route::get("/{id}", "ProduitsController@show");
    Route::post("/", "ProduitsController@store");
    Route::put("/{id}", "ProduitsController@update");
    Route::delete("/{id}", "ProduitsController@destroy");
});



Route::group(['prefix' => 'utilisateurs'], function () {
    Route::post("/register", "UtilisateursController@register");
    Route::post("/login", "UtilisateursController@login");
    Route::get("/", "UtilisateursController@index");
    Route::delete("/{id}", "UtilisateursController@destroy");
});

Route::group(['prefix' => 'commandes'], function () {
    Route::post("/", "CommandesController@acheter");
});