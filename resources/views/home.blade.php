@extends('layouts.app')

@section('contentheader_title')
    <h1>Inicio</h1>
@endsection

@section('main-content')
	@if(Session::has('message'))
		<div class="alert alert-success">{{ Session::get('message') }}</div>
	@endif
	<div class="col-md-6">
		<div class="box box-primary">
	        <div class="box-header ui-sortable-handle">
	            <i class="fa fa-phone"></i>
	            <h3 class="box-title">Registrar llamada</h3>
				<div class="box-tools pull-right">
	                
	            </div>
	        </div>
	        <div class="box-body">
	        	{!! Form::model(new App\Llamada, ['route' => 'guardaLlamadas', 'role' => 'form'])!!}
	        		{{ Form::token() }}
	        		<div class="form-group col-md-12">
            			{!! Form::label('motivo','Motivo llamada',['style' => 'font-size:small']) !!}
            			{!! Form::text('motivo', null, ['class' => 'form-control input-sm']) !!}
        			</div>
        			<div class="form-group col-md-6">
            			{!! Form::label('nombre','Nombre',['style' => 'font-size:small']) !!}
            			{!! Form::text('nombre', null, ['class' => 'form-control input-sm']) !!}
        			</div>
        			<div class="form-group  col-md-6">
            			{!! Form::label('telefono','Teléfono',['style' => 'font-size:small']) !!}
            			{!! Form::text('telefono', null, ['class' => 'form-control input-sm']) !!}
        			</div>
        			<div class="form-group col-md-12">
            			{!! Form::label('trabajador','Trabajador',['style' => 'font-size:small']) !!}
            			<select name="trabajador" class="form-control">
          					<option selected="selected">Seleccione</option>
				            <!--aqui se genera la lista de trabajadores en la vista-->
				            @foreach($trabajadores as $tra)
				              	<option value="{{ $tra }}">{{ $tra }}</option>
				            @endforeach
				              <!--***************************************************-->
					    </select>
        			</div>
        			<div class="form-group col-md-12">
            			{!! Form::label('otros','Otros',['style' => 'font-size:small']) !!}
            			{!! Form::textarea('otros', null, ['class' => 'form-control input-sm','size' => '3x5']) !!}
        			</div>
	        	
			</div>
			<div class="box-footer">
				{!! Form::submit('Guardar',['class' => 'btn btn-default pull-right']) !!}
				{{ Form::close() }}	
				<a href="verLlamadas" class="btn btn-default pull-left" role="button">Ver registro</a>
			</div>
		</div>	
	</div>
	<div class="col-md-6">
		<div class="box box-primary">
	        <div class="box-header ui-sortable-handle">
	            <i class="ion ion-clipboard"></i>
	            <h3 class="box-title">Tareas pendientes</h3>
				<div class="box-tools pull-right">
	                
	            </div>
	        </div>
	        <div class="box-body" >
	        	<!-- Aqui se abre la lista de las tareas-->
	        	
	            <ul class="todo-list ui-sortable">
	            	@foreach($tareas as $tarea)
		                <li>
		                  	<!-- drag handle -->
		                    <span class="handle ui-sortable-handle">
		                        <i class="fa fa-ellipsis-v"></i>
		                        <i class="fa fa-ellipsis-v"></i>
		                    </span>
		                  	<!-- todo text -->
		                  	<span class="text">{{ $tarea->titulo }}</span>
		                  	<div class="tools">
		                  		
		                    	{{ Form::open(array('route' => array('borraTareas', $tarea->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()' ,'style="display: inline;"','id' => 'celsius')) }}
									<button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash"></i></button>
	                        	{{ Form::close() }}

		                  	</div>
		                </li>
		            @endforeach
	            </ul>
	            <!-- Aqui se termina la lista de las tareas-->
	        </div>
	        <!-- /.box-body -->
		    <div class="box-footer">
		    	<div class="form-inline pull-right">
		    		{!! Form::model(new App\Tarea, ['route' => 'guardaTareas', 'role' => 'form']) !!}
		    			{{ Form::token() }}
		    			<input type="text" name="nuevaTarea" id="nuevaTarea" class="form-control">
		    			{!! Form::submit('Añadir',['class' => 'btn btn-default pull-right']) !!}
		    		{{ Form::close() }}
		    	</div>

		    	{{ $tareas->render() }}
		        
		    </div>
		</div>   
	</div>    
			
@endsection

