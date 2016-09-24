@extends('layouts.app')

@section('contentheader_title')
    <h1>Editar usuario</h1>
@endsection

@section('main-content')
    <?php $nav_usuario = 'active'; ?>
    @include('messages')
	<div class="content">
        <div class="row">
            <div class="col-md-12">
                
                {{ Form::model($usuario, array('method' => 'PATCH', 'files' => 'true', 'route' => array('usuarios.update', $usuario->id))) }}
                    @include('usuarios.form'); 
                {!! Form::close() !!}
            </div>
        </div>
    </div>
           
@endsection