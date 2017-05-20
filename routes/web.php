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

Route::get('/conception/mesUE', function() {
   return view('mesUE');
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

Route::get('/profil', 'Profil\ProfilController@show');
Route::post('/profil/updateInformations', 'Profil\ProfilController@postUpdateInformations');
Route::post('/profil/password', 'Profil\ProfilController@postPassword');
Route::post('/profil/image', 'Profil\ProfilController@postImage');


/***************************
 * Route pour les Respo UE *
 ***************************/
Route::get('/respoUE/mesUE', 'ResponsableUE\MesUEController@show')->middleware(\App\Http\Middleware\RespoUE::class);
Route::get('/respoUE/mesUE.csv', 'ResponsableUE\MesUEController@export')->middleware(\App\Http\Middleware\RespoUE::class);

Route::post('/respoUE/addEnseignant', 'ResponsableUE\MesUEController@addEnseignant')->middleware(\App\Http\Middleware\RespoUE::class);
Route::post('/respoUE/deleteEnseignant', 'ResponsableUE\MesUEController@deleteEnseignant')->middleware(\App\Http\Middleware\RespoUE::class);
Route::post('/respoUE/modifEnseignant', 'ResponsableUE\MesUEController@modifEnseignant')->middleware(\App\Http\Middleware\RespoUE::class);
Route::post('/respoUE/modifUE', 'ResponsableUE\MesUEController@modifUE')->middleware(\App\Http\Middleware\RespoUE::class);


/*******************************
 * Route pour les Enseignants  *
 *******************************/

Route::get('/mesEnseignements', 'Enseignant\EnseignantController@show');
Route::post('/mesEnseignements/modificationUE', 'Enseignant\EnseignantController@updateUE');
Route::post('/mesEnseignements/modificationUEExterne', 'Enseignant\EnseignantController@updateUEExterne');
Route::post('/mesEnseignements/ajoutUEExterne', 'Enseignant\EnseignantController@ajouterUEExterne');



Route::get('/di/annuaire', 'ResponsableDI\AnnuaireController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/annuaire.json', 'ResponsableDI\AnnuaireController@getAnnuaireJSON')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/annuaire.csv', 'ResponsableDI\AnnuaireController@getAnnuaireCSV')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/annuaire/importCSV', 'ResponsableDI\AnnuaireController@importCSV')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/annuaire/delete', 'ResponsableDI\AnnuaireController@delete')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/annuaire/delete', 'ResponsableDI\AnnuaireController@delete')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::get('/di/journal', 'ResponsableDI\JournalController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/journal/accept', 'ResponsableDI\JournalController@accept')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/journal/deny', 'ResponsableDI\JournalController@deny')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::get('/di/formations', 'ResponsableDI\FormationsController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/formations/add', 'ResponsableDI\FormationsController@add')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/formations/delete', 'ResponsableDI\FormationsController@delete')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/formations/delete', 'ResponsableDI\FormationsController@delete')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/formations.csv', 'ResponsableDI\FormationsController@getFormationsCSV')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::post('/di/formations/importCSV', 'ResponsableDI\FormationsController@importCSV')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::post('/di/formations/updateResponsable', 'ResponsableDI\FormationsController@updateResponsable')->middleware(\App\Http\Middleware\AdminMiddleware::class);
Route::get('/di/formations/updateResponsable', 'ResponsableDI\FormationsController@updateResponsable')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::get('/di/recapEnseignants', 'ResponsableDI\RecapEnseignantsController@show')->middleware(\App\Http\Middleware\AdminMiddleware::class);

Route::get('/en_attente', function () {
    return view('auth.en_attente');
});

/******************************************
 * ROUTES pour les RESPONSABLES FORMATION *
 ******************************************/

Route::get('/formation/{nom_formation}', 'ResponsableFormation\FormationController@show')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::get('/respoFormation/formation/{nom_formation}', 'ResponsableFormation\FormationController@show')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::post('/respoFormation/formation/{nom_formation}', 'ResponsableFormation\FormationController@show')->middleware(\App\Http\Middleware\RespoFormation::class);

Route::post('/respoFormation/formation/{nom_formation}/add', 'ResponsableFormation\FormationController@add')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::get('/respoFormation/formation/{nom_formation}/add', 'ResponsableFormation\FormationController@add')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::post('/respoFormation/formation/{nom_formation}/delete', 'ResponsableFormation\FormationController@delete')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::get('/respoFormation/formation/{nom_formation}/delete', 'ResponsableFormation\FormationController@delete')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::get('/respoFormation/formation/{nom_formation}/export', 'ResponsableFormation\FormationController@getFormationsCSV')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::post('/respoFormation/formation/{nom_formation}/export', 'ResponsableFormation\FormationController@getFormationsCSV')->middleware(\App\Http\Middleware\RespoFormation::class);
Route::post('/respoFormation/formation/{nom_formation}/import', 'ResponsableFormation\FormationController@importCSV')->middleware(\App\Http\Middleware\RespoFormation::class);

Route::post('/respoFormation/formation/{nom_formation}/updateResponsable', 'ResponsableFormation\FormationController@updateResponsable')->middleware(\App\Http\Middleware\RespoFormation::class);
