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
	$data =  App\Models\Cote::getFicheCote(7,5);
	dd($data->get());																										
    return $data;
});

Route::get('/home', 'HomeController@index')->name('home');

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
		Route::post('/send_fiche','Profs\DashboardController@sendFiche')->name('send_fiche');




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
		// Cours
		Route::get('/getCoursAuditoire/{auditoire}', 'Section\DashboardController@getCoursByAuditoire')->name('getCoursByAuditoire');
		Route::resource('/gestion_cours', 'Gestions\CoursController')->only(['store']);


	});
});

Auth::routes();

