<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App;
use Carbon\Carbon;
use Response;

class PdfController extends Controller
{

  public function actualizacionLopd($id_socio){
  	$pdf = app('dompdf.wrapper');
  	$socio = DB::table('socios')->where('id',$id_socio)->first();
  	$usuarios = DB::table('usuarios')->where('socio_id',$id_socio)->get();
		$pdf->loadView('pdfs/actualizacion',compact('usuarios','socio','fecha'));
    $pdf->output();
    $dom_pdf = $pdf->getDomPDF();
    $canvas = $dom_pdf->get_canvas();
    $canvas->page_text(500, 745, "Pág. {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
		return $pdf->stream('archivo.pdf');	
  }

  public function informe(Request $request){
    $pdf = app('dompdf.wrapper');
    $consulta = DB::table('consultas')->where('id','=',$request->id)->first();
    $usuario = DB::table('usuarios')->where('id','=', $consulta->usuario_id)->get();
    $pdf->loadView('pdfs/detalle_consulta',compact('consulta','usuario'));
    $pdf->output();
    $dom_pdf = $pdf->getDomPDF();
    $canvas = $dom_pdf->get_canvas();
    $canvas->page_text(500, 745, "Pág. {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
    return $pdf->stream('archivo.pdf'); 
  }

  public function descargarArchivo(Request $request){
    return Response::make(file_get_contents('C:/nombreprograma/'.$request->tipo.'/'.$request->id.'.pdf'), 200,['Content-Type'=>'application/pdf', 'Content-Disposition'=>'inline;filename="'.$request->id.'.pdf"']);
  }

}
