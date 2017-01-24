@extends('layouts.app')

@section('contentheader_title')
    <h1>Grupos de terapia</h1>
@endsection

@section('main-content')
	
	<!-- <?php $nav_usuario_create = 'active';
	$nav_usuario = 'active'; ?> -->
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Listado de grupos</h3>
		</div>
		<div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered">
                <tbody>
                	<tr>
	                  	<th>Nº</th>
	                  	<th colspan="5">Usuarios</th>
                	</tr>
                	@foreach ($grupos as $g)
	                	<tr>
	                  		<td>{{ $g->numero }}</td>
	                  		<td>{{ $g->usuario1_nombre }}</td>
	                  		<td>{{ $g->usuario2_nombre }}</td>
	                  		<td>{{ $g->usuario3_nombre }}</td>
	                  		<td>{{ $g->usuario4_nombre }}</td>
	                  		<td>{{ $g->usuario5_nombre }}</td>
	                  	</tr>
	                @endforeach  	
                </tbody>
            </table>
    	</div>
    	{{ $grupos->render() }}
	</div>
	<div class="box box-primary">
		<div class="box-header">
			<h3>Editar grupo</h3>
		</div>
		<div class="box-body">
			{{ Form::model(new App\Grupo, array('method' => 'POST', 'files' => 'true', 
				'route' => array('psicologia/grupos', ))) }}
  			{{ Form::token() }}
  			<div class="form-group col-md-2">
		        {!! Form::select('numero', array(
		        	'1' => '1',
		        	'2' => '2',
		        	'3' => '3',
		        	'4' => '4',
		        	'5' => '5'
		        	), null, ['placeholder' => 'Seleccione', 'class' => 'form-control input-sm', 'id' => 'selectGrupo']); !!}
	    	</div>
	    	<div class="form-group col-md-2">
            	{!! Form::text('usuario1_nombre', null, ['class' => 'form-control input-sm usuarioAuto autocomplete', 'id' => 'usuario1_nombre']) !!}
	    	</div>
	    	<div class="form-group col-md-2">
            	{!! Form::text('usuario2_nombre', null, ['class' => 'form-control input-sm usuarioAuto autocomplete', 'id' => 'usuario2_nombre']) !!}
	    	</div>
	    	<div class="form-group col-md-2">
            	{!! Form::text('usuario3_nombre', null, ['class' => 'form-control input-sm usuarioAuto autocomplete', 'id' => 'usuario3_nombre']) !!}
	    	</div>
	    	<div class="form-group col-md-2">
            	{!! Form::text('usuario4_nombre', null, ['class' => 'form-control input-sm usuarioAuto autocomplete', 'id' => 'usuario4_nombre']) !!}
	    	</div>
	    	<div class="form-group col-md-2">
            	{!! Form::text('usuario5_nombre', null, ['class' => 'form-control input-sm usuarioAuto autocomplete', 'id' => 'usuario5_nombre']) !!}
	    	</div>
		</div>	
		<div class="box-footer">
    		{!! Form::submit('Guardar',['class' => 'btn btn-primary pull-right']) !!}
    		{!! Form::close()!!}
  		</div>
	</div>
	
@endsection