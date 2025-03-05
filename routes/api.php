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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(["prefix" => "mobile"], function(){
	Route::post("/login", "UserController@api_login");
	Route::group(["prefix" => "penjualan"], function(){
		Route::post("/", "PenjualanController@list_penjualan");
		Route::post("/checker/input", "PenjualanController@checker_input");
	});
});

Route::get('/user/{id}', "UserController@getUserById")->middleware("auth:api");