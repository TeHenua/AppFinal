@extends('layouts.app')

@section('contentheader_title')
    <h1>Nuevo socio</h1>
@endsection

@section('main-content')
	
	<?php $nav_socio_create = 'active';
	$nav_socio = 'active'; ?>

	@include('messages')

	<div class="content">
        {!! Form::model(new App\Socio, ['route' => ['socios.store'], 'role' => 'form']) !!}
        	@include('socios.form')
        {!! Form::close() !!}
    </div>
@endsection

