<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Usuario;

class SearchController extends Controller
{

	public function index(){
		return view('search');
	}

    public function autocomplete(Request $request){

	    $data = Usuario::select("nombre")->where("nombre","LIKE","%{$request->input('query')}%")->get();
	    dd($data);
		return response()->json($data);
	}
}
