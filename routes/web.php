<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*ROTTE PER GUEST
---------------------------------------------------------------
---------------------------------------------------------------*/

// qui arrivano tutti i guest non loggati
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/index', function () {
//     return view('/guest/home');
// });

Route::get('/', function () {
    return view('/guest/home');
})->name('guest-home');

Route::get('/single', function () {
    return view('/guest/singleApartment');
});
Route::post('/single', 'Admin\MessageController@store')->name('saveMessage');

Route::get('/search', function () {
    return view('/guest/search');
})->name('search');

Route::get('/home', 'HomeController@index')->name('home');
// questa è la view per chi si è logato con successo. in realtà dobbiamo spostarla e farla diventare direttamente dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Auth::routes();

/*ROTTE SEZIONE ADMIN
------------------------------------------------------
------------------------------------------------------*/

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('admin_homepage');
        Route::resource('/messages', 'MessageController');
        Route::resource('/apartments','ApartmentController');
        Route::resource('/statistics','StatisticController');
    });
