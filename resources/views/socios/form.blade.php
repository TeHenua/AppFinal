{{ Form::token() }}

<div class="box box-primary">  
    <div class="box-header with-border"><h4>Datos personales</h4></div>
    <div class="box-body">  
    	<div class="form-group col-md-2">
            {!! Form::label('num_socio','Número socio',['style' => 'font-size:small']) !!}
            {!! Form::text('num_socio', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('dni','NIF/NIE',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('dni', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-4">
	        {!! Form::label('tipo_socio','Tipo de socio',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
	        {!! Form::select('tipo_socio', array(
	        	'Ordinario' => 'Ordinario',
	        	'Honorario' => 'Honorario',
	        	'Protector' => 'Protector',
	        	'Colaborador' => 'Colaborador/Voluntario'
	        	), null, ['placeholder' => 'Seleccione', 'class' => 'form-control input-sm']); !!}
	    </div>
	    <div class="form-group col-md-12"></div>
        <div class="form-group col-md-4">
            {!! Form::label('nombre','Nombre',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('nombre', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('apellido1','Primer apellido',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('apellido1', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('apellido2','Segundo apellido',['style' => 'font-size:small']) !!}
            {!! Form::text('apellido2', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('fecha_nac','Fecha de nacimiento',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {{ Form::text('fecha_nac', null, array('id' => 'dpSocio', 'class' => 'form-control input-sm', 'placeholder' => 'AAAA-MM-DD')) }}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('lugar_nac','Lugar de nacimiento',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('lugar_nac', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('ocupacion','Ocupación',['style' => 'font-size:small']) !!}
            {!! Form::text('ocupacion', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('num_cuenta','IBAN',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('num_cuenta', null, ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="box-header with-border"><h4>Domicilio</h4></div>
    <div class="box-body">        
        <div class="form-group col-md-6">
            {!! Form::label('direccion','Dirección',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('direccion', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('localidad','Localidad',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('localidad', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-1">
            {!! Form::label('codigo_pos','C.P.',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('codigo_pos', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('provincia','Provincia',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('provincia', null, ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="box-header with-border"><h4>Contacto</h4></div>
    <div class="box-body">        
        <div class="form-group col-md-3">
            {!! Form::label('fijo','Teléfono fijo',['style' => 'font-size:small']) !!}
            {!! Form::text('fijo', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('movil','Teléfono móvil',['style' => 'font-size:small']) !!}
            {!! Form::text('movil', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('email','Email',['style' => 'font-size:small']) !!}
            {!! Form::text('email', null, ['class' => 'form-control input-sm']) !!}
        </div>
      	<div class="form-group col-md-3">
	        {!! Form::label('tipo_comunicacion','Tipo de contacto',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
	        {!! Form::select('tipo_comunicacion', array(
	        	'Email' => 'Email',
	        	'Carta' => 'Carta',
	        	'Carta sin remite' => 'Carta sin remite'
	        	), null, ['placeholder' => 'Seleccione', 'class' => 'form-control input-sm']); !!}
	    </div>
        <i class="fa fa-asterisk ob"></i>
        {{ Form::label('obligatorio','Es obligatorio insertar un teléfono',['style' => 'font-size:small']) }}
    </div>
    <div class="box-header with-border"><h4>Archivos</h4></div>
    <div class="box-body">
        <div class="form-group col-md-4">
            {!! Form::label('comunicacion','Comunicación',['style' => 'font-size:small']) !!}
            <input type="file" id="file1" name="comunicacion">
            
        </div> 
        <div class="form-group col-md-4">
            {!! Form::label('lopd','LOPD',['style' => 'font-size:small']) !!}
            <input type="file" id="file2" name="lopd">

        </div>
        <div class="form-group col-md-4">
            {!! Form::label('dni','DNI',['style' => 'font-size:small']) !!}
            <input type="file" id="file" name="dni">
                   
        </div> 
    </div>
    <div class="box-footer">    
        <div class="form-group col-md-12">
            <button class="btn btn-warning pull-left" type="reset" >Limpiar</button>
            {!! Form::submit('Guardar',['class' => 'btn btn-primary pull-right']) !!}
        </div>
    </div>
</div>    



