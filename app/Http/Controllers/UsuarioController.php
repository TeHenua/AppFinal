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



class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        // $this->middleware('administrador');
    }

    public function create(){
        $usuario = new Usuario;
        return view('usuarios.create', compact('usuario'));
    }

    public function destroy($id){
        DB::table('usuarios')->where('id', '=', $id)->delete();
        \Session::flash('message','Usuario borrado correctamente.');
        return Redirect::route('usuarios.index');
    }

    private function cogerInputs(){
        
    }

    public function store(UsuarioRequest $request){ 
        $usuario = new Usuario;
        $usuario->dni = Input::get('dni');

        $dni = ['nif' => $usuario->dni];
        $rules = ['nif' => 'nif'];
        $validator = Validator::make($dni, $rules);
        if($validator->errors()->first()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $usuario->num_socio = Input::get('num_socio');
        $usuario->nombre = ucwords(Input::get('nombre'));
        $usuario->apellido1 = ucwords(Input::get('apellido1'));
        $usuario->apellido2 = ucwords(Input::get('apellido2'));
        $usuario->fecha_nac = Input::get('fecha_nac');
        $usuario->lugar_nac = ucwords(Input::get('lugar_nac'));
        $usuario->direccion = ucwords(Input::get('direccion'));
        $usuario->localidad = ucwords(Input::get('localidad'));
        $usuario->provincia = ucwords(Input::get('provincia'));
        $usuario->codigo_pos = Input::get('codigo_pos');
        $usuario->colegio = ucwords(Input::get('colegio'));
        $usuario->ocupacion = ucwords(Input::get('ocupacion'));
        $usuario->diagnostico = ucwords(Input::get('diagnostico'));
        $usuario->grado_discapacidad = Input::get('grado_discapacidad');
        $usuario->grado_dependencia = Input::get('grado_dependencia');
        $usuario->puntos_movilidad = Input::get('puntos_movilidad');
        $usuario->num_ss = Input::get('num_ss');
        $usuario->primera_entrevista = Input::get('primera_entrevista');
        $usuario->alerta_medica = Input::get('alerta_medica');
        $usuario->alerta_custodia = Input::get('alerta_custodia');
        $nombreSocio = Input::get('nombreSocio');

        $socio_id = intval(preg_replace('/[^0-9]+/', '', $nombreSocio), 10);  
        if($socio_id!=null){
            $socioBD = DB::table('socios')->where('id','=',$socio_id)->value('id');
            if($socioBD==$socio_id){
                $usuario->socio_id = $socio_id;
            }else{
                return redirect()->back()->withInput()->withErrors("El socio que has introducido no existe");
            }
        }

        $usuario->save();

        $this ->guardararchivos($request,$usuario ->id);
        //enviamos al usuario a ver la ficha creada
        return redirect()->route('usuarios.show', [$usuario->id]);

    }
    
    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $usuarios = DB::table('usuarios')->where('nombre','LIKE','%'.$query.'%')
            ->orWhere('apellido1','LIKE','%'.$query.'%')
            ->orWhere('apellido2','LIKE','%'.$query.'%')
            ->orWhere('dni','LIKE','%'.$query.'%')
            ->paginate(10);
            return view('usuarios.index', ["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }


    public function edit($id){
        $usuario = Usuario::find($id);
        $data = DB::table('socios')->where('id','=',$usuario->socio_id)->first();
   
        
        $nombreSocio= $data->id.' '.$data->nombre.' '.$data->apellido1.' '.$data->apellido2;

        $usuario->nombreSocio = $nombreSocio;
        dd($usuario);
        if (is_null($usuario))
        {
            return Redirect::route('usuarios.index');
        }
        return View::make('usuarios.edit', compact('usuario'));
    }

    public function update(UsuarioEditRequest $request, $id){
        $input = Input::except('dni_tutor');
        $usuario = Usuario::find($id);
        if(!isset($input['alerta_medica'])){
            $input['alerta_medica'] = 0; 
        }
        if(!isset($input['alerta_custodia'])){
            $input['alerta_custodia'] = 0; 
        }
        $dni = ['nif' => $usuario->dni];
        $rules = ['nif' => 'nif'];
        $validator = Validator::make($dni, $rules);
        if($validator->errors()->first()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        
        $nombreSocio = Input::get('nombreSocio');
        $socio_id = intval(preg_replace('/[^0-9]+/', '', $nombreSocio), 10);  
        if($socio_id!=null){
            $socioBD = DB::table('socios')->where('id','=',$socio_id)->value('id');
            if($socioBD==$socio_id){
                $usuario->socio_id = $socio_id;
            }else{
                return redirect()->back()->withInput()->withErrors("El socio que has introducido no existe");
            }
        }

        //*****  poner en mayusculas los campos para enviar a la base de datos ****//
        $usuario->nombre = ucwords($usuario->nombre);
        $usuario->apellido1 = ucwords($usuario->apellido1);
        $usuario->apellido2 = ucwords($usuario->apellido2);
        $usuario->lugar_nac = ucwords($usuario->lugar_nac);
        $usuario->direccion = ucwords($usuario->direccion);
        $usuario->localidad = ucwords($usuario->localidad);
        $usuario->provincia = ucwords($usuario->provincia);
        $usuario->colegio = ucwords($usuario->colegio);
        $usuario->ocupacion = ucwords($usuario->ocupacion);
        $usuario->diagnostico = ucwords($usuario->diagnostico);
        /***************************************************************************/

        $usuario->update($input);

        $this ->guardararchivos($request,$usuario ->id);

        \Session::flash('message','Usuario editado correctamente.');
        return redirect()->route('usuarios.show', [$usuario->id]);    
    }

    public function show($id){
        $usuario = DB::table('usuarios')->where('id', $id)->first();
        $socio_id = $usuario->socio_id;
        $socio = DB::table('socios')->where('id', $socio_id)->first();
        $contacto_ids = DB::table('contacto_usuario')->where('usuario_id',$usuario->id)->get();
        $contactos =  DB::select( DB::raw("SELECT * from contactos where id IN(SELECT contacto_id from contacto_usuario where usuario_id= ".$id.")") );
        return View::make('usuarios.show', compact('usuario','socio', 'contactos'));
    }

    public function guardararchivos($request, $id){
        /*************** aqui se guardan los archivos ***************/
        //obtenemos el archivo
        $fcustodia = $request -> file('custodia');
        $fmedica = $request -> file('medica');
        $flopd = $request -> file('lopd');

        if($fcustodia != null){
            //obtenemos el nombre del archivo custodia y lo guardamos si existe
            $ncustodia = $id.'.'.$fcustodia -> guessExtension();
            \Storage::disk('dcustodia')->put($ncustodia, \File::get($fcustodia));
        }
        
        if($fmedica != null){
            //obtenemos el nombre del archivo medica y lo guardamos si existe
            $nmedica = $id.'.'.$fmedica -> guessExtension();
            \Storage::disk('dmedica')->put($nmedica, \File::get($fmedica));
        }
        //obtenemos el nombre del archivo lopd y lo guardamos si existe
        if($flopd != null){
            $nlopd = $id.'.'.$flopd -> guessExtension();
            \Storage::disk('dlopd')->put($nlopd, \File::get($flopd));
        }
    }//termina la funcion de guardar archivos

    
}
