<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use Input;
use App\Usuario;
use App\Socio;
use App\Contacto;
use Illuminate\Support\Facades\Redirect;
use DB;
use View;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioEditRequest;
use Illuminate\Support\Facades\Validator;



class PsicologiaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('psicologo');
    }

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $usuarios = DB::table('usuarios')
            ->where('usuario','=',1)
            ->where('apellido1','LIKE','%'.$query.'%')
           	->paginate(10);
            return view('psicologia.index', ["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

}