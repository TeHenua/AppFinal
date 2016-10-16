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


        /**************** aqui pongo  que si añade el contacto para guardar un usuario ******************/
        $nombreUsuario = Input::get('nombreUsuario');
        $usuario_id = intval(preg_replace('/[^0-9]+/', '', $nombreUsuario), 10);  
        if($usuario_id!=null){
            $usuarioBD = DB::table('usuarios')->where('id','=',$usuario_id)->value('id');
            if($usuarioBD!=$usuario_id){            
                return redirect()->back()->withInput()->withErrors("El usuario que has introducido no existe");
            }
        }
        /***************************************************************************************************/
        $contacto->save();
        if($usuario_id){
            DB::table('contacto_usuario')->insert(['contacto_id' => $contacto->id, 'usuario_id' => $usuario_id]);
        }
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
        $usuario_id = DB::table('contacto_usuario')->where('contacto_id','=',$id)->value('usuario_id');
        $data = DB::table('usuarios')->where('id','=',$usuario_id)->first();
        if($data!=null){
            $contacto->nombreUsuario = $data->id.' '.$data->nombre.' '.$data->apellido1.' '.$data->apellido2;
        }
        if (is_null($contacto))
        {
            return Redirect::route('contactos.index');
        }
        return View::make('contactos.edit', compact('contacto'));
    }

    public function update($id, ContactoRequest $request){
        $input = Input::except('usuario_id');
        $contacto = Contacto::find($id);
        $contacto->update($input);

        /**************** aqui pongo  que si actualiza el contacto para añadir un usuario ******************/
        $nombreUsuario = Input::get('nombreUsuario');
        $usuario_id = intval(preg_replace('/[^0-9]+/', '', $nombreUsuario), 10);  
        if($usuario_id!=null){
            $usuarioBD = DB::table('usuarios')->where('id','=',$usuario_id)->value('id');
            if($usuarioBD==$usuario_id){
                DB::table('contacto_usuario')->insert(['usuario_id' => $usuario_id, 'contacto_id' => $contacto->id]);
            }else{
                return redirect()->back()->withInput()->withErrors("El usuario que has introducido no existe");
            }
        }
        /***************************************************************************************************/


        \Session::flash('message','Contacto editado correctamente.');
        return Redirect::route('contactos.index');
    }

    public function show($id){
        return View::make('contactos.show', compact('contacto'));
    }

    
}
