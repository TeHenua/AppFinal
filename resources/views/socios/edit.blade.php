@extends('layouts.app')

@section('contentheader_title')
    <h1>Editar socios</h1>
@endsection

@section('main-content')

    <?php $nav_socio = 'active'; ?>
    @include('messages')
	<div class="content">
        <div class="row">
            <div class="col-md-12">
                
                {{ Form::model($socio, array('method' => 'PATCH', 'files' => 'true', 'route' => array('socios.update', $socio->id))) }}
                    @include('socios.form');   
                {!! Form::close() !!}
            </div>
        </div>
    </div>
           
@endsection