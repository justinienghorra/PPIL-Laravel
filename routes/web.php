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

// Vues de la partie modélisation du projet

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/conception/', function() {
   return view('mesUE');
});

Route::get('/conception/mesEnseignements', function() {
    return view('mesEnseignements');
});

Route::get('/conception/mesFormations/L1Informatique', function() {
    return view('L1Informatique');
});

Route::get('/conception/recapEnseignants', function() {
    return view('recapEnseignants');
});


Route::get('/conception/journal', function() {
    return view('journal');
});


Route::get('/conception/annuaire', function() {
    return view('annuaire');
});

Route::get('/conception/connexion', function() {
    return view('connexion');
});

Route::get('/conception/inscription', function() {
    return view('inscription');
});

Route::get('/conception/reset', function() {
    return view('reinitPassword');
});

// ------------------------------------------------

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


/*************************
 * Route pour le Profil  *
 *************************/

Route::get('/profil', 'ProfilController@show');
Route::post('/profil/email', 'ProfilController@postEmail');
Route::post('/profil/password', 'ProfilController@postPassword');
Route::post('/profil/image', 'ProfilController@postImage');

/*********************************
 * Routes pour le Responsable UE *
 *********************************/
Route::get('/respoue/mesUE', 'ResponsableUE\MesUEController@show');



Route::get('/di/annuaire', 'ResponsableDI\AnnuaireController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/annuaire.json', 'ResponsableDI\AnnuaireController@getAnnuaireJSON')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/annuaire.csv', 'ResponsableDI\AnnuaireController@getAnnuaireCSV')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/annuaire/importCSV', 'ResponsableDI\AnnuaireController@importCSV')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::get('/di/journal', 'ResponsableDI\JournalController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/journal/accept', 'ResponsableDI\JournalController@accept')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/journal/deny', 'ResponsableDI\JournalController@deny')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::get('/di/formations', 'ResponsableDI\FormationsController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/formations/add', 'ResponsableDI\FormationsController@add')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::get('/en_attente', function () {
    return view('auth.en_attente');
});

//Route::get('/formation/{nom_formation}', 'FormationController@show');