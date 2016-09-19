@extends('layouts.app')

@section('contentheader_title')
    <h1>Nuevo usuario</h1>
@endsection

@section('main-content')
	
	<?php $nav_usuario_create = 'active';
	$nav_usuario = 'active'; ?>

	@include('messages')
	@if(Session::has('error'))
		<div class="alert alert-success">{{ Session::get('error') }}</div>
	@endif
	<div class="content">
        {!! Form::model(new App\Usuario, ['route' => ['usuarios.store'], 'role' => 'form', 'files' => 'true']) !!}
            @include('usuarios.form')
        {!! Form::close() !!}
    </div>
@endsection