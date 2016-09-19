@extends('layouts.app')

@section('contentheader_title')
    <h1>Editar contacto</h1>
@endsection

@section('main-content')

	<div class="content">
        <div class="row">
            <div class="col-md-12">
                
                {{ Form::model($contacto, array('method' => 'PATCH', 'route' => array('contactos.update', $contacto->id))) }}
                    @include('contactos.form');   
                {!! Form::close() !!}
            </div>
        </div>
    </div>
           
@endsection