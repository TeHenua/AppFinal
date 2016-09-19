@extends('layouts.app')

@section('contentheader_title')
 	<h1>Socios</h1>
@endsection

@section('main-content')

	@if(Session::has('message'))
		<div class="alert alert-success">{{ Session::get('message') }}</div>
	@endif
	@if(Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
	@endif
	<?php 
		$nav_socio_index = 'active'; 
		$abierto_socio = '';
	?>

	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Listado de socios</h3>
			<div class="box-tools">
				{!! Form::open(array('url'=>'socios','method' => 'GET', 'role' => 'search')) !!}
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
                	@foreach ($socios as $soc)
	                	<tr>
	                  		<td>{{ $soc->dni }}</td>
	                  		<td>{{ $soc->nombre }}</td>
	                  		<td>{{ $soc->apellido1 }}</td>
	                  		<td>{{ $soc->apellido2 }}</td>
	                  		<td>	
	                  			{{ link_to_route('socios.show', 'Ver', array($soc->id), array('class' => 'btn btn-info')) }}
	                  			{{ link_to_route('socios.edit', 'Editar', array($soc->id), array('class' => 'btn btn-warning')) }}
	                  			{{ Form::open(array('route' => array('socios.destroy', $soc->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()' ,'style="display: inline;"')) }}
	                  			<button type="submit" class="btn btn-danger" >Borrar</button>
	                  			{{ Form::close() }}
	                  		</td>
	                  	</tr>
	                @endforeach  	
                </tbody>
            </table>
    	</div>
    	{{ $socios->render() }}
	</div>
@endsection            