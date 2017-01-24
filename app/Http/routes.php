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
use App\User;
use Illuminate\Http\Request;

Route::group(['middleware' => 'auth'], function () {
  Route::get('/', ['as' => 'inicio', 'uses' => 'HomeController@index']);
  Route::post('guardaTareas', ['as' => 'guardaTareas', 'uses' => 'HomeController@store']);
  Route::delete('borraTareas/{id}', ['as' => 'borraTareas', 'uses' => 'HomeController@destroy']);
  Route::post('guardaLlamadas', ['as' => 'guardaLlamadas', 'uses' => 'HomeController@storeLlamada']);
  Route::get('verLlamadas', ['as' => 'verLlamadas', 'uses' => 'HomeController@indexLlamadas']);
  Route::delete('borrarLlamadas/{id}', ['as' => 'borrarLlamadas', 'uses' => 'HomeController@destroyLlamadas']);
  Route::resource('usuarios', 'UsuarioController');
  Route::resource('contactos', 'ContactoController');
  Route::resource('socios', 'SocioController');
 	Route::post('guardaEventos', array('as' => 'guardaEventos','uses' => 'CalendarController@create'));
 	Route::any('cargaEventos',array('as'=>'cargaEventos','uses'=>'CalendarController@cargadorEventos'));
 	Route::post('actualizaEventos','CalendarController@update');
  Route::post('updateEventos', 'CalendarController@updateEventos');
 	Route::post('eliminarEvento','CalendarController@delete');
  Route::get('calendario','CalendarController@index');
  Route::get('psicologia/grupos', array('as' => 'psicologia/grupos', 'uses' => 'GrupoController@index'));
  Route::post('psicologia/grupos', array('as' => 'psicologia/grupos', 'uses' => 'GrupoController@update'));
  Route::get('actualizacion/{id}', ['as' => 'actuLopd', 'uses' => 'PdfController@actualizacionLopd']);
  Route::get('lopd/{id}', ['as' => 'nuevaLopd', 'uses' => 'PdfController@nuevaLopd']);

  Route::any('getdata', function(){
   $term = Input::get('term');
   
   // 4: check if any matches found in the database table 
    $data = DB::table('socios')->where('nombre','LIKE',$term.'%')
          ->orWhere('apellido1','LIKE', $term.'%')
          ->orWhere('apellido2','LIKE', $term.'%')
          ->groupBy('nombre','apellido1','apellido2')->take(10)->get();
    foreach ($data as $v) {
      $return_array[] = array('value' =>$v->id.' '.$v->nombre.' '.$v->apellido1.' '.$v->apellido2);
    }
    // if matches found it first create the array of the result and then convert it to json format so that 
    // it can be processed in the autocomplete script
    return Response::json($return_array);
  });
  Route::any('getUsuario', function(){
    $term = Input::get('term');
    $data = DB::table('usuarios')->where('nombre','LIKE',$term.'%')
          ->orWhere('apellido1','LIKE', $term.'%')
          ->orWhere('apellido2','LIKE', $term.'%')
          ->groupBy('nombre','apellido1','apellido2')->take(10)->get();
    foreach ($data as $v) {
      $return_array[] = array('value' =>$v->id.' '.$v->nombre.' '.$v->apellido1.' '.$v->apellido2);
    }
    return Response::json($return_array);
  });
  

});

