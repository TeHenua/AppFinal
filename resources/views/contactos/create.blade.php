@extends('layouts.app')

@section('contentheader_title')
    <h1>Nuevo contacto</h1>
@endsection

@section('main-content')
    
	<?php $nav_cont_create = 'active';
	$nav_usuario = 'active'; ?>

	@include('messages')
	
    <div class="content">
        {!! Form::model(new App\Contacto, ['route' => ['contactos.store'], 'role' => 'form']) !!}
            @include('contactos.form')
        {!! Form::close() !!}
    </div>
@endsection