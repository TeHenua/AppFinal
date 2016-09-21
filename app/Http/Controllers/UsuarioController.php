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
        $dni_tutor = Input::get('dni_tutor');



        //cambiado
        if($usuario->socio_id!=null){
             $socio_id =  DB::table('socios')->where('dni',$dni_tutor)->value('id');

            if($socio_id){
                $usuario->socio_id = $socio_id;
            }else{
                return redirect()->back()->withInput()->withErrors("El socio que has introducido no existe");
            }
        }

        $usuario->save();


        /************ aqui se guardan los archivos ***********************/
        //obtenemos el archivo
        $fcustodia = $request->file('custodia');
        $fmedica = $request -> file('medica');
        $flopd = $request -> file('lopd');
        //obtenemos el nombre del archivo
        $ncustodia = $usuario->id.'.'.$fcustodia -> guessExtension();
        $nmedica = $usuario ->id.'.'.$fmedica -> guessExtension();
        $nlopd = $usuario ->id.'.'.$flopd -> guessExtension();
        //guardamos el archivo con su nuevo nombre en la carpeta correspondiente 
        \Storage::disk('dcustodia')->put($ncustodia, \File::get($fcustodia));
        \Storage::disk('dmedica')->put($nmedica, \File::get($fmedica));
        \Storage::disk('dlopd')->put($nlopd, \File::get($flopd));
        /************************************************************/

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


    public function edit($id)
    {

        $usuario = Usuario::find($id);
        $dni_tutor = DB::table('socios')->where('id','=',$usuario->socio_id)->value('dni');
        $usuario->dni_tutor = $dni_tutor;
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
        $dni_tutor =Input::get('dni_tutor');
        $socio_id =  DB::table('socios')->where('dni',$dni_tutor)->value('id'); 
        
        //cambiado
        
        if($socio_id){
            $usuario->socio_id = $socio_id;
        }else{
            return redirect()->back()->withInput()->withErrors("El socio que has introducido no existe");
        }

        //cambiado

        $usuario->socio_id = $socio_id;
        
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
        \Session::flash('message','Usuario editado correctamente.');
        return Redirect::route('usuarios.index');
    }

    public function show($id){
        $usuario = DB::table('usuarios')->where('id', $id)->first();
        $socio_id = $usuario->socio_id;
        $socio = DB::table('socios')->where('id', $socio_id)->first();
        $contacto_ids = DB::table('contacto_usuario')->where('usuario_id',$usuario->id)->get();
        $contactos =  DB::select( DB::raw("SELECT * from contactos where id IN(SELECT contacto_id from contacto_usuario where usuario_id= ".$id.")") );
        return View::make('usuarios.show', compact('usuario','socio', 'contactos'));
    }

    
}
