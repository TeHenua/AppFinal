<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Input;
use App\Socio;
use Illuminate\Support\Facades\Redirect;
use DB;
use View;
use App\Http\Requests\SocioRequest;
use App\Http\Requests\SocioEditRequest;
use Illuminate\Support\Facades\Validator;

class SocioController extends Controller
{
    public function create(){
        return view('socios.create');
    }

    public function destroy($id){
        $query = DB::table('usuarios')->where('socio_id','=',$id)->value('nombre');
        if($query){
            \Session::flash('error','No se ha podido borrar este socio porque tiene un usuario asignado: '.$query);
            return Redirect::route('socios.index');
        }
        

        DB::table('socios')->where('id', '=', $id)->delete();
        \Session::flash('message','Socio borrado correctamente.');
        return Redirect::route('socios.index');
    }

    public function store(SocioRequest $request){
        $socio = new Socio ;
        $socio->nombre = ucwords(Input::get('nombre'));
        $socio->apellido1 = ucwords(Input::get('apellido1'));
        $socio->apellido2 = ucwords(Input::get('apellido2'));
        $socio->dni = Input::get('dni');
        $socio->fecha_nac = Input::get('fecha_nac');
        $socio->lugar_nac = ucwords(Input::get('lugar_nac'));
        $socio->direccion = ucwords(Input::get('direccion'));
        $socio->localidad = ucwords(Input::get('localidad'));
        $socio->provincia = ucwords(Input::get('provincia'));
        $socio->codigo_pos = Input::get('codigo_pos');
        $socio->ocupacion = ucwords(Input::get('ocupacion'));
        $socio->num_socio = Input::get('num_socio');
        $socio->tipo_socio = Input::get('tipo_socio');
        $socio->num_cuenta = Input::get('num_cuenta');
        $socio->fijo = Input::get('fijo');
        $socio->movil = Input::get('movil');
        $socio->email = Input::get('email');
        $socio->tipo_comunicacion = Input::get('tipo_comunicacion');
        $dni = ['nif' => $socio->dni];
        $rules = ['nif' => 'nif'];
        $validator = Validator::make($dni, $rules);
        if($validator->errors()->first()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $iban = ['iban' => $socio->num_cuenta];
        $rules = ['iban' => 'iban'];
        $validator = Validator::make($iban, $rules);
        if($validator->errors()->first()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $socio->save();
        \Session::flash('message','Socio creado correctamente.');
        return Redirect::route('socios.index');
    }
    

    public function index(Request $request){
        if($request){
            $query=trim($request->get('searchText'));
            $socios = DB::table('socios')->where('nombre','LIKE','%'.$query.'%')
            ->orWhere('apellido1','LIKE','%'.$query.'%')
            ->orWhere('apellido2','LIKE','%'.$query.'%')
            ->orWhere('dni','LIKE','%'.$query.'%')
            ->paginate(10);
            return view('socios.index', ["socios"=>$socios,"searchText"=>$query]);
        }
    }


    public function edit($id)
    { 
        $socio = Socio::find($id);

        if (is_null($socio))
        {
            return Redirect::route('socios.index');
        }
        return View::make('socios.edit', compact('socio'));
    }

    public function update(SocioEditRequest $request,$id){
        $input = Input::all();
        $socio = Socio::find($id);
        $dni = ['nif' => $socio->dni];
        $rules = ['nif' => 'nif'];
        $validator = Validator::make($dni, $rules);
        if($validator->errors()->first()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $iban = ['iban' => $socio->num_cuenta];
        $rules = ['iban' => 'iban'];
        $validator = Validator::make($dni, $rules);
        if($validator->errors()->first()){
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        $socio->update($input);
        \Session::flash('message','Socio editado correctamente.');
        return Redirect::route('socios.index');

    }

    public function show($id){
        $socio = DB::table('socios')->where('id', $id)->first();
       return View::make('socios.show', compact('socio'));
    }

    
}