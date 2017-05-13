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


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function() {
   return view('mesUE');
});

Route::get('/mesUE', function() {
    return view('mesUE');
});


Route::get('/mesEnseignements', function() {
    return view('mesEnseignements');
});

Route::get('mesFormations/L1Informatique', function() {
    return view('L1Informatique');
});

Route::get('recapEnseignants', function() {
    return view('recapEnseignants');
});


Route::get('journal', function() {
    return view('journal');
});


Route::get('annuaire', function() {
    return view('annuaire');
});

Route::get('connexion', function() {
    return view('connexion');
});

Route::get('inscription', function() {
    return view('inscription');
});

Route::get('reset', function() {
    return view('reinitPassword');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/profil', 'ProfilController@show');

Route::get('/di/annuaire', 'ResponsableDI\AnnuaireController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);