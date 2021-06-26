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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Tentativi di chiamate API a DB

Route::get('/apartments','Api\ApartmentController@index');
Route::post('/apartments/search','Api\ApartmentController@search');

Route::get('/location','Api\ApartmentController@location');

Route::get('/services','Api\ApartmentController@services');


// - lista apt filtrati per user
Route::get('/getAptUserList','Api\ApartmentController@getAptUserList');

// - appartamenti utente filtrati per sponsorizzazione
Route::get('/getUserSponsoredAptList','Api\ApartmentController@getUserSponsoredAptList');