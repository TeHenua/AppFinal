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

    public function create(){
       
        $evento = new Calendario;
        $titulo =  $_POST['titulo'];
        $evento->titulo = $titulo[0];
        $fechaIni =  $_POST['fechaIni'];
        $evento->fechaIni = $fechaIni[0];
        $fechaFin = $_POST['fechaFin'];
        $evento->fechaFin = $fechaFin[0];
        /****************************************************************************/
       $trabajadorSeleccionado[] = $_POST['trabajador'];
       //si es null es que no se a seleccionado ninguno
       if($trabajadorSeleccionado == ""){
           $evento->user_id = Auth::user()->id;//entonces que guarde el id para guardar los eventos del usuario logeado
       }
       else{//si no es null que guarde el id para guardar el usuario seleccionado en el desplegable
           $evento->user_id = DB::table('users')->where('name','=',$trabajadorSeleccionado)->value('id');
       }
       /***************************************************************************/
        $nombreUsuario = $_POST['usuarioCalendario'];
        if($nombreUsuario!=null){
            $evento->usuario_id = intval(preg_replace('/[^0-9]+/', '', $nombreUsuario), 10);  
        }
        $tipoCita = $_POST['tipo_evento'];
        switch ($tipoCita) {
            case 'Usuario':
                $evento->color = "#00BFFF";
                break;
            case 'Externa':
                $evento->color = "#ffa64d";
                break;
            case 'Coordinación':
                $evento->color = "#66cc66";
                break;
            case 'Otro':
                $evento->color = "#b366ff";
                break;
            default:
                # code...
                break;
        }

        $evento->save();
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
