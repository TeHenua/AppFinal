<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Calendario;
use Input;
use Illuminate\Support\Facades\Redirect;
use App\Usuario;
use Session;
use App\User;



class CalendarController extends Controller
{
    //si eres usuario normal se pasa tu id
    //si eres administrador se pasa el id del trabajador

	public function index(){   
        /**************************   LA LISTA DE TRABAJADORES    **************************/
        $trabajadores = array();
        $trabajadores = User::all()->lists('name');
        /**********************************************************************************/
        return view('calendario')->with('trabajadores',$trabajadores);
    }

    public function edit(Request $request){
        $evento = DB::table('calendarios')->where('id','=',$request->id);

    }

    public function create(){
       
        $evento = new Calendario;
        $titulo =  $_POST['titulo'][0];
        //$evento->titulo = $titulo[0];
        $fechaIni =  $_POST['fechaIni'];
        $evento->fechaIni = $fechaIni[0];
        $fechaFin = $_POST['fechaFin'];
        $evento->fechaFin = $fechaFin[0];
        /****************************************************************************/
        if(Auth::user()->rol=='administrativo'){
           $trabajadorSeleccionado[] = $_POST['trabajador'];
           //si es null es que no se a seleccionado ninguno
           if($trabajadorSeleccionado == ""){
               $evento->user_id = Auth::user()->id;//entonces que guarde el id para guardar los eventos del usuario logeado
           }
           else{//si no es null que guarde el id para guardar el usuario seleccionado en el desplegable
               $evento->user_id = DB::table('users')->where('name','=',$trabajadorSeleccionado)->value('id');
           }
        }else{
            $evento->user_id = Auth::user()->id;
        }
       /***************************************************************************/
        $nombreUsuario = $_POST['usuarioCalendario'];
        if($nombreUsuario!=null){
            $evento->usuario_id = intval(preg_replace('/[^0-9]+/', '', $nombreUsuario), 10);  
        }
        $tipoCita = $_POST['tipo_evento'][0];
        switch ($tipoCita) {
            case 'Usuario':
                $evento->color = "#00BFFF";
                break;
            case 'Interna':
                $evento->color = "#30912e";
                break;
            case 'Externa':
                $evento->color = "#ffa64d";
                break;
            case 'Coordinación interna':
                $evento->color = "#66cc66";
                break;
            case 'Coordinación externa':
                $evento->color = "#963048";
                break;
            case 'Grupo':
                $evento->color = "#b366ff";
                break;
            case 'Otro':
                break;
            default:
                # code...
                break;
        }
        $evento->grupo_id = $_POST['grupo'];
        $evento->titulo = $tipoCita." ".preg_replace('/[0-9]+/', '', $nombreUsuario).$evento->grupo_id;
       
        $evento->save();
    }

    public function updateEventos(Request $request){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $tipo_evento = $_POST['tipo_evento'];
        $usuario = $_POST['usuario'];
        $grupo = $_POST['grupo'];
        $evento=Calendario::find($id);
        if ($title=='') {
            $evento->titulo = $title." ".$tipo_evento." ".preg_replace('/[0-9]+/', '', $usuario.$grupo);

        }else{
            $evento->titulo = $title;
        }
        
        $evento->fechaIni = $start;
        $evento->fechaFin = $end;
        switch ($tipo_evento) {
            case 'Usuario':
                $evento->color = "#00BFFF";
                break;
            case 'Interna':
                $evento->color = "#30912e";
                break;
            case 'Externa':
                $evento->color = "#ffa64d";
                break;
            case 'Coordinación interna':
                $evento->color = "#66cc66";
                break;
            case 'Coordinación externa':
                $evento->color = "#963048";
                break;
            case 'Grupo':
                $evento->color = "#b366ff";
                break;
            case 'Otro':
                break;
            default:
                # code...
                break;
        }
        if ($usuario!=null) {
          $evento->usuario_id = intval(preg_replace('/[^0-9]+/', '', $usuario), 10); 
        }
        $evento->grupo_id = $grupo;
        //falta grupo
        $evento->update();
        
    }

    public function update(){
        //Valores recibidos via ajax
        $id = $_POST['id'];
        $title = $_POST['title'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $allDay = $_POST['allday'];
        $back = $_POST['background'];

        $evento=Calendario::find($id);
        if($end=='NULL'){
            $evento->fechaFin=NULL;
        }else{
            $evento->fechaFin=$end;
        }
        $evento->fechaIni=$start;
        $evento->todoeldia=$allDay;
        $evento->color=$back;
        $evento->titulo=$title;
        //$evento->fechaFin=$end;

        $evento->save();
   }

   public function delete(){
        //Valor id recibidos via ajax
        $id = $_POST['id'];

        Calendario::destroy($id);
   }

   //funcion que carga los eventos del calendario
   public function cargadorEventos(Request $request){
        //tooooooooodos los eventos del mes
        $data = array(); //declaramos un array principal que va contener los datos
        $id = Calendario::all()->lists('id'); //listamos todos los id de los eventos
        $titulo = Calendario::all()->lists('titulo'); //lo mismo para lugar y fecha
        $fechaIni = Calendario::all()->lists('fechaIni');
        $fechaFin = Calendario::all()->lists('fechaFin');
        $allDay = Calendario::all()->lists('todoeldia');
        $background = Calendario::all()->lists('color');
        $userId = Calendario::all()->lists('user_id');
        $usuario_id = Calendario::all()->lists('usuario_id');
        $count = count($id); //contamos los ids obtenidos para saber el numero exacto de eventos
        /**********************************/
        //dd($request->trabajador);
        //aqui cogemos el id del trabajador logeado
        $userIdLog = Auth::user()->id;
        
        if(Auth::user()->rol=='administrativo'){
            if($request->trabajador != null){
                $ntrabajador = $request->trabajador[0];
                $userIdLog = DB::table('users')->where('name','=',$ntrabajador)->value('id');
            }
        }
        $j=0;
        for($i=0;$i<$count;$i++){            
            if($userId[$i]==$userIdLog){
                $data[$j] = array(
                "title"=>$titulo[$i], 
                "start"=>$fechaIni[$i], 
                "end"=>$fechaFin[$i],
                "allDay"=>$allDay[$i],
                "backgroundColor"=>$background[$i],
                "id"=>$id[$i]
                );
                $j++;
            }
        }
        json_encode($data); //convertimos el array principal $data a un objeto Json 
        return $data;    //para luego retornarlo y estar listo para consumirlo
   }//aqui termina la funcion cargadordeeventos
}
