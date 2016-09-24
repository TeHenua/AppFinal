<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Calendario;
use Input;
use Illuminate\Support\Facades\Redirect;
use App\Usuario;


class CalendarController extends Controller
{
    //si eres usuario normal se pasa tu id
    //si eres administrador se pasa el id del trabajador

	public function index(Request $request){   

        
        // if($nombreTrabajador==null){
        //     $nombreTrabajador = Auth::user()->name;
        // }
        // $userIdLog = DB::table('users')->where('name','=',$nombreTrabajador)->value('id');

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
        
        //hacemos un ciclo para anidar los valores obtenidos a nuestro array principal $data 
        $j=0;
        for($i=0;$i<$count;$i++){
            // if($userId[$i]==$userIdLog){
                $data[$j] = array(
                    "title"=>$titulo[$i], //obligatoriamente "title", "start" y "url" son campos requeridos
                    "start"=>$fechaIni[$i], //por el plugin asi que asignamos a cada uno el valor correspondiente
                    "end"=>$fechaFin[$i],
                    "allDay"=>$allDay[$i],
                    "backgroundColor"=>$background[$i],
                    "id"=>$id[$i]
                );  
                $j++;
            //}
                  
        }
        json_encode($data); //convertimos el array principal $data a un objeto Json 
        return $data;    //para luego retornarlo y estar listo para consumirlo
    }


    public function create(){
       
        $evento = new Calendario;

        $evento->titulo = Input::get('titulo');
        $evento->fechaIni = Input::get('fechaIni');
        $evento->fechaFin = Input::get('fechaFin');
        $evento->user_id = Auth::user()->id;
        $nombreUsuario = Input::get('usuario');
        $tipoCita = Input::get('tipo_evento');
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
        $evento->usuario_id = intval(preg_replace('/[^0-9]+/', '', $nombreUsuario), 10);  
        $evento->save();
        return view('calendario');
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

   // public function select(Request $request){ 
   //      $nombresUsers=DB::table('users')->select('name')->get();
   //      $idUser = $request->idUser;
   //      return view('calendario',['nombresUsers'=>$nombresUsers, 'idUser'=>$idUser]);
   //  }
 
   //  public function postSelect(Request $request){
   //      $nombreUser = $request->select;
   //      $nombresUsers=DB::table('users')->select('name')->get();
   //      $idUser = DB::table('users')->where('name',$nombreUser)->value('id');
   //      return view('calendario',['idUser'=>$idUser, 'nombresUsers'=>$nombresUsers]);
   //  }

}
