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

class ContactoController extends Controller
{
    public function create(){
    	return view('contactos.create');
    }

    public function store(ContactoRequest $request){ 

    	$contacto = new Contacto;
        $contacto->nombre = ucwords(Input::get('nombre'));
        $contacto->apellido1 = ucwords(Input::get('apellido1'));
        $contacto->apellido2 = ucwords(Input::get('apellido2'));
        $contacto->dni = Input::get('dni');
        $contacto->fecha_nac = Input::get('fecha_nac');
        $contacto->lugar_nac = ucwords(Input::get('lugar_nac'));
        $contacto->direccion = ucwords(Input::get('direccion'));
        $contacto->localidad = ucwords(Input::get('localidad'));
        $contacto->codigo_pos = Input::get('codigo_pos');
        $contacto->provincia = ucwords(Input::get('provincia'));
        $contacto->parentesco = Input::get('parentesco');
        $contacto->fijo = Input::get('fijo');
        $contacto->movil = Input::get('movil');
        $contacto->email = Input::get('email');
        $contacto->tipo_comunicacion = Input::get('tipo_comunicacion');

        $dni = ['nif' => $contacto->dni];
        $rules = ['nif' => 'nif'];
        $validator = Validator::make($dni, $rules);
        if($validator->errors()->first()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $contacto->save();

        $nombre_usuario = ucwords(Input::get('nombre_usuario'));
        $apellido1_usuario = ucwords(Input::get('apellido1_usuario'));
        $apellido2_usuario = ucwords(Input::get('apellido2_usuario'));
        $usuario_id =  DB::table('usuarios')->where([['nombre', $nombre_usuario],['apellido1', $apellido1_usuario],['apellido2', $apellido2_usuario]])->value('id');
        DB::table('contacto_usuario')->insert(['contacto_id' => $contacto->id, 'usuario_id' => $usuario_id]);
        \Session::flash('message','Contacto creado correctamente.');
		return Redirect::route('contactos.index');
    }
    

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $contactos = DB::table('contactos')->where('nombre','LIKE',$query)
            ->orWhere('apellido1','LIKE',$query)
            ->orWhere('apellido2','LIKE',$query)
            ->orWhere('dni','LIKE',$query)
            ->paginate(7);
            return view('contactos.index', ["contactos"=>$contactos,"searchText"=>$query]);
        }
    }


    public function edit($id)
    {
        $contacto = Contacto::find($id);
        if (is_null($contacto))
        {
            return Redirect::route('contactos.index');
        }
        return View::make('contactos.edit', compact('contacto'));
    }

    public function update($id, ContactoRequest $request){
        $input = Input::all();
        $contacto = Contacto::find($id);
        $contacto->update($input);
        return Redirect::route('contactos.index');
        \Session::flash('message','Contacto editado correctamente.');
    }

    public function show($id){
        return View::make('contactos.show', compact('contacto'));
    }

    
}
