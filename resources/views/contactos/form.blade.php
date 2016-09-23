{{ Form::token() }}


<div class="box box-primary">  
    <div class="box-header with-border"><h4>Datos personales</h4></div>
    <div class="box-body">          
        <div class="form-group col-md-4">
            {!! Form::label('nombre','Nombre',['style' => 'font-size:small']) !!}
            {!! Form::text('nombre', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('apellido1','Primer apellido',['style' => 'font-size:small']) !!}
            {!! Form::text('apellido1', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('apellido2','Segundo apellido',['style' => 'font-size:small']) !!}
            {!! Form::text('apellido2', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('dni','NIF/NIE',['style' => 'font-size:small']) !!}
            {!! Form::text('dni', null, ['class' => 'form-control input-sm']) !!}
        </div>
         <div class="form-group col-md-3">
            {!! Form::label('fecha_nac','Fecha de nacimiento',['style' => 'font-size:small']) !!}
             <input type="date" name="fecha_nac" id="fecha_nac" placeholder="AAAA-MM-DD" class="form-control input-sm" >
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('lugar_nac','Lugar de nacimiento',['style' => 'font-size:small']) !!}
            {!! Form::text('lugar_nac', null, ['class' => 'form-control input-sm']) !!}
        </div>
    </div>    
    <div class="form-group col-md-12"></div>
    <div class="box-header with-border"><h4>Datos usuario</h4></div>
    <div class="box-body">
        <!--  aqui puse el boton de buscar usuarios -->
        <div class="form-group col-md-4">
            {!! Form::label('lcontacto','Usuario',['id'=> 'lcontacto', 'style' => 'font-size:small']) !!}
            <div class="input-group">
                <div class="input-group-btn"> 
                {!! Form::button('Buscar', array('class' => 'btn btn-info','id' => 'btnBuscar', 'data-toggle' => 'modal', 'data-target' => '#modalusuario')) !!}
                </div>
                <div>
                {!! Form::text('nombre_usuario', null, ['class' => 'form-control input-sm']) !!}
                </div>
            </div>
        </div>
        <!--****************************************-->
        <div class="form-group col-md-3">
            {!! Form::label('nombre_usuario','Nombre',['style' => 'font-size:small']) !!}
            {!! Form::text('nombre_usuario', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('apellido1_usuario','Primer apellido',['style' => 'font-size:small']) !!}
            {!! Form::text('apellido1_usuario', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('apellido2_usuario','Segundo apellido',['style' => 'font-size:small']) !!}
            {!! Form::text('apellido2_usuario', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('parentesco','Relacion',['style' => 'font-size:small']) !!}
            {!! Form::text('parentesco', null, ['class' => 'form-control input-sm']) !!}
        </div>
    </div>   
    <div class="box-header with-border"><h4>Domicilio</h4></div>
    <div class="box-body">        
        <div class="form-group col-md-6">
            {!! Form::label('direccion','Dirección',['style' => 'font-size:small']) !!}
            {!! Form::text('direccion', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('localidad','Localidad',['style' => 'font-size:small']) !!}
            {!! Form::text('localidad', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-1">
            {!! Form::label('codigo_pos','C.P.',['style' => 'font-size:small']) !!}
            {!! Form::text('codigo_pos', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('provincia','Provincia',['style' => 'font-size:small']) !!}
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
            {!! Form::select('tipo_comunicacion', array(
                'Email' => 'Email',
                'Carta' => 'Carta',
                'Carta sin remite' => 'Carta sin remite'
                ), null, ['placeholder' => 'Seleccione', 'class' => 'form-control input-sm']); !!}
        </div>
    </div>
    <div class="box-footer">    
        <div class="form-group col-md-12">
            <button class="btn btn-warning pull-left" type="reset" >Limpiar</button>
            {!! Form::submit('Guardar',['class' => 'btn btn-primary pull-right']) !!}
        </div>
    </div>
</div>
<!-- aqui puse la ventana modal -->
<div class="modal fade" id="modalusuario" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Asignar Usuario</h4>
      </div> 
      <div class="modal-body">
        <div class="form-group col-md-12">
          {!! Form::label('nombreUsuario','Nombre y apellido',['style' => 'font-size:small']) !!}
          {!! Form::text('nombreUsuario',$value = null, array('id' => 'nombreUsuario', 'class' => 'form-control autocomplete')) !!}         
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" id="anadir" data-dismiss="modal" >Añadir</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> 
