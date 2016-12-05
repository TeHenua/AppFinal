<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App;

class PdfController extends Controller
{
    public function usuarioLopd($id){
    	
    	$pdf = app('dompdf.wrapper');
    	$usuario =  DB::table('usuarios')->where('id',$id)->first();
    	$socio = DB::table('socios')->where('id',$usuario->socio_id)->first();
  		$pdf->loadView('vista',compact('usuario','socio'));
  		return $pdf->download('archivo.pdf');
    }

    public function actualizacionLopd($id_socio){
    	$pdf = app('dompdf.wrapper');
    	$socio = DB::table('socios')->where('id',$id_socio)->first();
    	$usuarios = DB::table('usuarios')->where('socio_id',$id_socio)->get();
  		$pdf->loadView('pdfs/actualizacion',compact('usuarios','socio'));
  		return $pdf->stream('archivo.pdf');
  		
    }
}
