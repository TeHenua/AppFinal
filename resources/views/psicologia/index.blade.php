@extends('layouts.app')

@section('contentheader_title')
 	<h1>Usuarios de clínica</h1>
@endsection

@section('main-content')
	@if(Session::has('message'))
		<div class="alert alert-success">{{ Session::get('message') }}</div>
	@endif



	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Listado de usuarios</h3>

			<div class="box-tools">
				{!! Form::open(array('url'=>'psicologia/index','method' => 'GET', 'role' => 'search')) !!}
					<div class="input-group input-group-sm" style="width: 170px;">
                  		<input type="text" name="searchText" value='{{ $searchText }}' class="form-control pull-right" placeholder="Buscar por apellido">
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
	                  	<th>Num. clínica</th>
	                  	<th>Nombre</th>
	                  	<th>Primer apellido</th>
	                  	<th>Segundo apellido</th>
	                  	<th>Opciones</th>
                	</tr>
                	@foreach ($usuarios as $usu)
	                	<tr>
	                  		<td>{{ $usu->num_clinica }}</td>
	                  		<td>{{ $usu->nombre }}</td>
	                  		<td>{{ $usu->apellido1 }}</td>
	                  		<td>{{ $usu->apellido2 }}</td>
	                  		<td>	
	                  			{{ link_to_route('psicologia.show', 'Ver', array($usu->id), array('class' => 'btn btn-info')) }}
	                  		</td>
	                  	</tr>
	                @endforeach  	
                </tbody>
            </table>
    	</div>
    	{{ $usuarios->render() }}
	</div>
@endsection            