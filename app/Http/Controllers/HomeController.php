<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon;
use App\Tarea;
use Redirect;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(){
        $user_id= Auth::user()->id;
        $tareas = DB::table('tareas')->where('user_id','=',$user_id)->paginate(7);
        return view('home',['tareas'=>$tareas]);
    }

    public function store(Request $request){
        $tarea = new Tarea;
        $tarea->titulo = $request->input('nuevaTarea');
        $tarea->user_id = Auth::user()->id;
        $tarea->save();
        return Redirect::to('/');
    }


}