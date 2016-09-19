<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;


class PdfController extends Controller
{
    public function usuarioLopd($id){
    	
    	$pdf = app('dompdf.wrapper');
    	$usuario =  DB::table('usuarios')->where('id',$id)->first();
    	$socio = DB::table('socios')->where('id',$usuario->socio_id)->first();
  		$pdf->loadView('vista',compact('usuario','socio'));
  		return $pdf->download('archivo.pdf');
    }
}
