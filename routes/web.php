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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('/guest/home');
});

Route::get('/single', function () {
    return view('/guest/singleApartment');
});

Route::get('/search', function () {
    return view('/guest/search');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

/*ROTTE SEZIONE ADMIN
------------------------------------------------------
------------------------------------------------------*/

Route::prefix('admin')
->namespace('Admin')
->middleware('auth')
->group(function () {
    Route::get('/', 'HomeController@index')->name('admin_homepage');
    Route::get('/profile', 'HomeController@profile')->name('admin_profile');
    Route::post('/profile/generate-token', 'HomeController@generateToken')->name('admin_generate_token');
    Route::resource('/apartments','ApartmentsController');
});
