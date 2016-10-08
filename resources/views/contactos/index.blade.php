@extends('layouts.app')

@section('contentheader_title')
 	<h1>Contactos</h1>
@endsection

@section('main-content')

	


	@if(session('message'))
		<div class="alert alert-success"></div>
	@endif


	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Listado de contactos</h3>
			<div class="box-tools">
				{!! Form::open(array('url'=>'contactos','method' => 'GET', 'role' => 'search')) !!}
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
                	@foreach ($contactos as $con)
	                	<tr>
	                  		<td>{{ $con->dni }}</td>
	                  		<td>{{ $con->nombre }}</td>
	                  		<td>{{ $con->apellido1 }}</td>
	                  		<td>{{ $con->apellido2 }}</td>
	                  		<td>	
	                  			{{ link_to_route('contactos.edit', 'Editar', array($con->id), array('class' => 'btn btn-warning')) }}
	                  		</td>
	                  	</tr>
	                @endforeach  	
                </tbody>
            </table>
    	</div>
    	{{ $contactos->render() }}
	</div>
@endsection            