@extends('layouts.app')

@section('contentheader_title')
    <h1>Registro llamadas</h1>
@endsection

@section('main-content')
	<section class="content">
		<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Listado de usuarios</h3>
		</div>
		<div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered">
                <tbody>
                	<tr>
	                  	<th>Motivo</th>
	                  	<th>Nombre</th>
	                  	<th>Teléfono</th>
	                  	<th>Otros</th>
	                  	<th>Opciones</th>
                	</tr>
                	@foreach ($llamadas as $lla)
	                	<tr>
	                  		<td>{{ $lla->motivo }}</td>
	                  		<td>{{ $lla->nombre }}</td>
	                  		<td>{{ $lla->telefono }}</td>
	                  		<td>{{ $lla->otros }}</td>
	                  		<td>	
	                  			 {{ Form::open(array('route' => array('borrarLlamadas', $lla->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()' ,'style="display: inline;"')) }}
                                <button type="submit" class="btn btn-danger" >Borrar</button>
                        {{ Form::close() }}
	                  		</td>
	                  	</tr>
	                @endforeach  	
                </tbody>
            </table>
    	</div>
    	{{ $llamadas->render() }}
	</div>
	</section>
@endsection	