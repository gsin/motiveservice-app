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


Route::post('/api/v1/vrni-jamstva', 'ApiAktivacijaJamstvaController@getJamstva')->name('ApiAktivacija');
Route::post('/api/v1/oddaj-jamstvo', 'ApiAktivacijaJamstvaController@store')->name('ApiAktivacija');
Route::post('/api/v1/jamstvo-pdf', 'ApiAktivacijaJamstvaController@getJamstvoPDF')->name('ApiAktivacija');
Route::post('/api/v1/oddaj-jamstvo-aktiviraj', 'ApiAktivacijaJamstvaController@storeActivate')->name('ApiAktivacija');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// application routes
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/aktivacija-jamstva', 'AktivacijaJamstvaController@index')->name('aktivacija.index');
Route::get('/aktivacija-jamstva/{kartica}', 'AktivacijaJamstvaController@show')->name('aktivacija.show');

Route::get('/aktivacija-jamstva-all', 'AktivacijaJamstvaController@show_all')->name('aktivacija.all');


Route::post('/aktivacija-jamstva', 'AktivacijaJamstvaController@store')->name('aktivacija.store');
Route::post('/aktivacija-nova', 'AktivacijaJamstvaController@store')->name('aktivacija.shrani');
Route::post('/aktivacija-store-override', 'AktivacijaJamstvaController@storeWithOverride')->name('aktivacija.store-override');
Route::post('/aktivacija-save-override', 'AktivacijaJamstvaController@saveWithOverride')->name('aktivacija.save-override');

Route::get('/aktivacija-nova', 'AktivacijaJamstvaController@create')->name('aktivacija.create');
//Route::get('/aktivacija-nova', 'AktivacijaJamstvaController@create')->name('aktivacija.create');
Route::get('/aktivacija-nova/{paket}', 'AktivacijaJamstvaController@createPaket')->name('aktivacija.paket.nova');
Route::get('/aktivacija-uredi/{id}', 'AktivacijaJamstvaController@edit')->name('aktivacija.uredi');
Route::post('/aktivacija-uredi/{id}', 'AktivacijaJamstvaController@save')->name('aktivacija.save');
Route::get('/aktivacija/oddaj/{id}', 'AktivacijaJamstvaController@oddaj')->name('aktivacija.oddaj');
Route::get('/aktivacija-brisi/{id}', 'AktivacijaJamstvaController@delete')->name('aktivacija.brisi');



Route::post('/aktivacija-paket-nova/', 'AktivacijaJamstvaPaketController@createPaketOznaka')->name('aktivacija-paket');
Route::post('/aktivacija-paket/', 'AktivacijaJamstvaPaketController@store')->name('aktivacija-paket-shrani');
Route::get('/aktivacija-paket-nova', 'AktivacijaJamstvaPaketController@createPaketOznaka')->name('aktivacija-paket-nova');

Route::get('/move-pogodbe', 'MovePogodbeController@index')->name('move-pogodbe');
Route::post('/move-pogodbe/iskanje', 'MovePogodbeController@search')->name('move-pogodbe');

Route::get('/move-pogodbe-statistika', 'MovePogodbeStatistikaController@index')->name('move-pogodbe');
Route::post('/move-pogodbe-statistika/iskanje', 'MovePogodbeStatistikaController@search')->name('move-pogodbe');

Route::get('/move-stranke-paketi-statistika', 'MoveStrankePaketiStatistikaController@index')->name('move-pogodbe');
Route::post('/move-stranke-paketi-statistika/iskanje', 'MoveStrankePaketiStatistikaController@search')->name('move-pogodbe');

Route::get('/move-stranke-rentabilnost', 'MoveStrankeRentabilnostController@index')->name('move-pogodbe');
Route::post('/move-stranke-rentabilnost/iskanje', 'MoveStrankeRentabilnostController@search')->name('move-pogodbe');

Route::get('/move-izdane-fakture', 'MoveIzdaneFaktureController@index')->name('move-fakture');
Route::post('/move-izdane-fakture/iskanje', 'MoveIzdaneFaktureController@search')->name('move-fakture');

Route::get('/move-popusti', 'MovePopustiController@index')->name('move-popusti');
Route::post('/move-popusti/iskanje', 'MovePopustiController@search')->name('move-popusti'); 

Route::get('/aktivacija/izpis/{id}', 'PDFIzpisController@index')->name('aktivacija-izpis');

Route::get('/mailing/{id}', 'MailingController@index')->name('mail-poslji');

Route::get('/briefd-integracija', 'BriefdIntegracijaController@index')->name('briefd-integracija');
Route::post('/briefd-integracija/prenesi', 'BriefdIntegracijaController@post')->name('briefd-integracija');

Route::get('/amzs-izvoz', 'AmzsIzvozController@index')->name('amzs-izvoz');
Route::post('/amzs-izvoz/iskanje', 'AmzsIzvozController@search')->name('amzs-izvoz');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Aktivacija jamstva routes
Route::get('/aktivacija-confirm-override', 'AktivacijaJamstvaController@confirmOverride')->name('aktivacija.confirm-override');
Route::post('/aktivacija-override-save', 'AktivacijaJamstvaController@overrideSave')->name('aktivacija.override-save');
