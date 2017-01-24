<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon;
use App\Tarea;
use App\Llamada;
use App\User;
use Redirect;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(){
        $user_id= Auth::user()->id;
        $tareas = DB::table('tareas')->where('user_id','=',$user_id)->paginate(7);
        $trabajadores = User::all()->lists('name');
        return view('home',['tareas'=>$tareas, 'trabajadores' => $trabajadores]);
    }

    public function store(Request $request){
        $tarea = new Tarea;
        $tarea->titulo = $request->input('nuevaTarea');
        $tarea->user_id = Auth::user()->id;
        $tarea->save();
        return Redirect::to('/');
    }

    public function destroy($id){
        DB::table('tareas')->where('id', '=', $id)->delete();
        \Session::flash('message','Tarea borrado correctamente.');
        return Redirect::route('inicio');
    }

    public function storeLlamada(Request $request){
        $llamada = new llamada;
        $llamada->motivo = $request->input('motivo');
        $llamada->nombre = $request->input('nombre');
        $llamada->telefono = $request->input('telefono');
        $trabajador = $request->input('trabajador');
        $llamada->user_id = DB::table('users')->where('name','=',$trabajador)->value('id');
        $llamada->otros = $request->input('otros');
        $llamada->save();
        return Redirect::to('/');
    }

    public function indexLlamadas(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            //falta buscar por trabajador
            $llamadas = DB::table('llamadas')->where('motivo','LIKE','%'.$query.'%')
            ->orWhere('nombre','LIKE','%'.$query.'%')
            ->orWhere('telefono','LIKE','%'.$query.'%')
            //->orWhere('user_id','=',)
            ->latest()
            ->paginate(10);
            return view('llamadas', ["llamadas"=>$llamadas]);
        }
    }

    public function destroyLlamadas(Request $request){
        DB::table('llamadas')->where('id', '=', $request->id)->delete();
        \Session::flash('message','Registro borrado correctamente.');
        return Redirect::route('verLlamadas');
    }

}