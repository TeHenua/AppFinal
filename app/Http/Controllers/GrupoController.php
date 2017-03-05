<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use App\Contacto;
use Illuminate\Support\Facades\Redirect;
use DB;
use View;
use App\Http\Requests\ContactoRequest;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller{
    
    public function index(Request $request){
        $grupos = DB::table('grupos')->paginate(5);
        foreach ($grupos as $g) {
        	$g->usuario1_nombre = DB::table('usuarios')->where('id','=',$g->usuario1)->value('nombre')." ".         		DB::table('usuarios')->where('id','=',$g->usuario1)->value('apellido1')." ".
        		DB::table('usuarios')->where('id','=',$g->usuario1)->value('apellido2');
        	$g->usuario2_nombre = DB::table('usuarios')->where('id','=',$g->usuario2)->value('nombre')." ".         		DB::table('usuarios')->where('id','=',$g->usuario2)->value('apellido1')." ".
        		DB::table('usuarios')->where('id','=',$g->usuario2)->value('apellido2');
    		$g->usuario3_nombre = DB::table('usuarios')->where('id','=',$g->usuario3)->value('nombre')." ".         		DB::table('usuarios')->where('id','=',$g->usuario3)->value('apellido1')." ".
    		DB::table('usuarios')->where('id','=',$g->usuario3)->value('apellido2');
    		$g->usuario4_nombre = DB::table('usuarios')->where('id','=',$g->usuario4)->value('nombre')." ".         		DB::table('usuarios')->where('id','=',$g->usuario4)->value('apellido1')." ".
    		DB::table('usuarios')->where('id','=',$g->usuario4)->value('apellido2');
    		$g->usuario5_nombre = DB::table('usuarios')->where('id','=',$g->usuario5)->value('nombre')." ".         		DB::table('usuarios')->where('id','=',$g->usuario5)->value('apellido1')." ".
    		DB::table('usuarios')->where('id','=',$g->usuario5)->value('apellido2');
        }
        return view('psicologia.grupos', ["grupos"=>$grupos]);
    }
    public function update(Request $request){
    	$grupo = DB::table('grupos')->where('numero','=',$request->numero);
    	$usuario1 = DB::table('usuarios')->where('id','=',intval(preg_replace('/[^0-9]+/', '', $request->usuario1_nombre), 10))->value('id');
    	$usuario2 = DB::table('usuarios')->where('id','=',intval(preg_replace('/[^0-9]+/', '', $request->usuario2_nombre), 10))->value('id');
    	$usuario3 = DB::table('usuarios')->where('id','=',intval(preg_replace('/[^0-9]+/', '', $request->usuario3_nombre), 10))->value('id');
    	$usuario4 = DB::table('usuarios')->where('id','=',intval(preg_replace('/[^0-9]+/', '', $request->usuario4_nombre), 10))->value('id');
    	$usuario5 = DB::table('usuarios')->where('id','=',intval(preg_replace('/[^0-9]+/', '', $request->usuario5_nombre), 10))->value('id');
    	DB::table('grupos')->where('numero','=',$request->numero)->update(['usuario1' => $usuario1, 'usuario2' => $usuario2, 'usuario3' => $usuario3,'usuario4' => $usuario4, 'usuario5' => $usuario5]);
    	return redirect()->action('GrupoController@index');
    }
    
}
