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
    return redirect()->route('login');
});

Route::get('/test', function () {
	$data =  App\Models\Cote::getFicheComplete(13);
	dd($data->get());																										
    return $data;
});

Route::get('/home', function(){
	if (auth()->check()) {
            $role = auth()->user()->users_roles;
            return redirect()->route($role.'.index');
        }
        
      return abort();
});

Route::get('/titulaires-login', 'Auth\TitulairesLoginController@showLoginForm')->name('prof-login');
Route::post('/titulaires-login', ['as'=> 'titulaires-login','uses'=>'Auth\TitulairesLoginController@login']);

/*|||||||||||||||||||||||||||||||||||||
|
|  Routes pour le professeur
|
|||||||||||||||||||||||||||||||||||||*/
Route::prefix('professeur')->group(function(){
	Route::name('professeur.')->group(function () {
		Route::get('/', 'Profs\DashboardController@index' )->name('index');
		Route::post('/redirect_fiche', 'Profs\DashboardController@redirectFiche' )->name('redirect_fiche');
		Route::get('/get_fiche/cours/{idcours}/{idtype_cotes}','Profs\DashboardController@getFiche')->name('get_fiche');
		Route::post('/set_cote','Profs\DashboardController@setCote')->name('set_cote');
		// Route::post('/send_fiche','Profs\DashboardController@sendFiche')->name('send_fiche');
		Route::get('/send_fiche/{type_cotes}/{cours}','Profs\DashboardController@sendFiche')->name('send_fiche');




		// Déconnexion prof
		Route::post('/prof-logout',function(){
			auth()->logout();
			return redirect()->route('prof-login');
		})->name('logout');
	});





	
});

/*|||||||||||||||||||||||||||||||||||||
|
|  Routes pour la section
|
|||||||||||||||||||||||||||||||||||||*/
Route::prefix('section')->group(function(){
	Route::name('section.')->group(function () {
		Route::get('/', 'Section\DashboardController@getListAuditoires')->name('index');
		// Session Import
		
		Route::get('/importation_cotes', 'Section\DashboardController@importSession')->name('session_import');
		Route::get('/importation_cotes/{type_cote}', 'Section\DashboardController@getImportSession')->name('get_session_import');
		Route::get('/importation_cote/{type_cote}/{auditoire}', 'Section\DashboardController@getImportSession')->name('get_session_import_by_auditoire');
		Route::get('/importation_fiche_cote', 'Section\DashboardController@getFicheImport')->name('get_fiche');
		
		// Etudiants
		Route::get('/etudiants', 'Section\DashboardController@getListAuditoiresEtudiants')->name('get_etudiants');
		Route::get('/get_etudiants_auditoires/{auditoire}', 'Section\DashboardController@getListStudent')->name('get_etudiants_by_auditoire');
		Route::resource('/gestion_etudiant', 'Gestions\EtudiantController')->only(['store']);


		// Cours
		Route::get('/get_cours_auditoires', 'Section\DashboardController@getListAuditoires')->name('get_cours');
		Route::get('/getCoursAuditoire/{auditoire}', 'Section\DashboardController@getCoursByAuditoire')->name('getCoursByAuditoire');
		Route::resource('/gestion_cours', 'Gestions\CoursController')->only(['store']);
		
		// Professeurs
		Route::get('/professeurs', 'Section\DashboardController@getListProfeseurs')->name('get_prof');
		Route::resource('/gestion_prof', 'Gestions\ProfController')->only(['store']);


	});
});

/*|||||||||||||||||||||||||||||||||||||
|
|  Routes pour le jury
|
|||||||||||||||||||||||||||||||||||||*/
Route::prefix('jury')->group(function(){
	Route::name('jury.')->group(function () {
		Route::get('/', 'Jury\DashboardController@index')->name('index');
		// Importation cotes
		Route::get('/importation_cotes', 'Jury\DashboardController@importSession')->name('session_import');
		Route::get('/importation_cotes/{type_cote}', 'Jury\DashboardController@getImportSession')->name('get_session_import');
		Route::get('/importation_cote/{type_cote}/{auditoire}', 'Jury\DashboardController@getCoursImportByAuditoire')->name('get_session_import_by_auditoire');
		Route::get('/importation_fiche_cote/{fiches_envoye}', 'Jury\DashboardController@getFicheImport')->name('get_fiche');
		

	});
});

Auth::routes();

