<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// application routes
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/aktivacija-jamstva', 'AktivacijaJamstvaController@index')->name('aktivacija');
Route::get('/aktivacija-jamstva/{kartica}', 'AktivacijaJamstvaController@show')->name('aktivacija');

Route::post('/aktivacija-jamstva', 'AktivacijaJamstvaController@store')->name('aktivacija');
Route::get('/aktivacija-nova', 'AktivacijaJamstvaController@create')->name('aktivacija');
Route::get('/aktivacija-nova/{paket}', 'AktivacijaJamstvaController@createPaket')->name('aktivacija');



//Route::post('/aktivacija-jamstva', 'AktivacijaJamstvaController@post')->name('aktivacija');
//Route::put('/aktivacija-jamstva', 'AktivacijaJamstvaController@put')->name('aktivacija');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
