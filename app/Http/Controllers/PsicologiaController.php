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
use App\Consulta;
use Auth;


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

    public function show($id){
        $usuario = Usuario::find($id);
        if($usuario->socio_id!=null){
            $socio = Socio::find($usuario->socio_id);
        }
        return View::make('psicologia.show', compact('usuario', 'socio'));
    }

    public function store(Request $request){
        $consulta = new Consulta;
        $consulta->titulo = $request->input('titulo');
        $consulta->texto = $request->input('texto');
        $consulta->user_id = Auth::user()->id;
        $consulta->usuario_id = $request->input('usuarioId');
        $consulta->save();
        return redirect('psicologia/show');
    }

}