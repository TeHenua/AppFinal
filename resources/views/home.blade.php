@extends('layouts.app')

@section('contentheader_title')
    <h1>Inicio</h1>
@endsection

@section('main-content')
<div class="col-md-6">
	<div class="box box-primary">
        <div class="box-header ui-sortable-handle">
            <i class="ion ion-clipboard"></i>
            <h3 class="box-title">Tareas pendientes</h3>
			<div class="box-tools pull-right">
                
            </div>
        </div>
        <div class="box-body" >
        	
        	<hr>
            	<ul class="todo-list ui-sortable">
            	@foreach($tareas as $t)
	                <li>
	                  	<!-- drag handle -->
	                    <span class="handle ui-sortable-handle">
	                        <i class="fa fa-ellipsis-v"></i>
	                        <i class="fa fa-ellipsis-v"></i>
	                    </span>
	                  	<!-- todo text -->
	                  	<span class="text">{{ $t->titulo }}</span>
	                  	<div class="tools">
	                    	<i class="fa fa-trash-o"></i>
	                  	</div>
	                </li>
	            @endforeach
            </ul>

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

