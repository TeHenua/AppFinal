@extends('layouts.app')

@section('contentheader_title')
 	<h1>Usuarios</h1>
@endsection

@section('main-content')

	


	@if(Session::has('message'))
		<div class="alert alert-success">{{ Session::get('message') }}</div>
	@endif

	<?php 
		$nav_usuario_index = 'active';
		$nav_usuario = 'active';
	?>

	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Listado de usuarios</h3>
			<div class="box-tools">
				{!! Form::open(array('url'=>'usuarios','method' => 'GET', 'role' => 'search')) !!}
					<div class="input-group input-group-sm" style="width: 150px;">
                  		<input type="text" name="searchText" value='{{ $searchText }}' class="form-control pull-right" placeholder="Buscar">
                  		<div class="input-group-btn">
                    		<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  		</div>
                	</div>
                {!! Form::close() !!}	
			</div>
		</div>
		<div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered">
                <tbody>
                	<tr>
	                  	<th>Dni</th>
	                  	<th>Nombre</th>
	                  	<th>Primer apellido</th>
	                  	<th>Segundo apellido</th>
	                  	<th>Opciones</th>
                	</tr>
                	@foreach ($usuarios as $usu)
	                	<tr>
	                  		<td>{{ $usu->dni }}</td>
	                  		<td>{{ $usu->nombre }}</td>
	                  		<td>{{ $usu->apellido1 }}</td>
	                  		<td>{{ $usu->apellido2 }}</td>
	                  		<td>	
	                  			{{ link_to_route('usuarios.show', 'Ver', array($usu->id), array('class' => 'btn btn-info')) }}
	                  			{{ link_to_route('usuarios.edit', 'Editar', array($usu->id), array('class' => 'btn btn-warning')) }}
	                  			{{ Form::open(array('route' => array('usuarios.destroy', $usu->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()' ,'style="display: inline;"')) }}
	                  			<button type="submit" class="btn btn-danger" >Borrar</button>
	                  			{{ Form::close() }}
	                  			{{ link_to_route('lopd', 'Generar Lopd', array($usu->id) ,array('class' => 'btn btn-success')) }}
	                  		</td>
	                  	</tr>
	                @endforeach  	
                </tbody>
            </table>
    	</div>
    	{{ $usuarios->render() }}
	</div>
@endsection            