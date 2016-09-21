<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'auth'], function () {
  Route::auth();
  Route::get('/', ['as' => 'inicio', 'uses' => 'HomeController@index']);
  Route::resource('usuarios', 'UsuarioController');
  Route::resource('contactos', 'ContactoController');
  Route::resource('socios', 'SocioController');
 	Route::post('guardaEventos', array('as' => 'guardaEventos','uses' => 'CalendarController@create'));
 	Route::get('cargaEventos{id?}','CalendarController@index');
 	Route::post('actualizaEventos','CalendarController@update');
 	Route::post('eliminarEvento','CalendarController@delete');
 	Route::get('calendario', function(){
 		return view('calendario');
 	});
  Route::get('lopd/{id}', ['as' => 'lopd', 'uses' => 'PdfController@usuarioLopd']);
  // Route::get('search', array('as' => 'search', 'uses' => 'SearchController@index'));
  // Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'SearchController@autocomplete'));
});

