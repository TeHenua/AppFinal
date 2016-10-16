{{ Form::token() }}

<div class="box box-primary">  
    <div class="box-header with-border"><h4>Datos personales</h4></div>
    <div class="box-body">  
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
            {!! Form::label('dni','NIF/NIE',['style' => 'font-size:small']) !!}
            {!! Form::text('dni', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('num_socio','Número socio',['style' => 'font-size:small']) !!}
            {!! Form::text('num_socio', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('dni_tutor','Socio/tutor',['id'=> 'dni_tutor', 'style' => 'font-size:small']) !!}
            <div class="input-group">
                <span class="input-group-btn">
                    {!! Form::button('Buscar', array('class' => 'btn btn-info btn-sm','id' => 'btnBuscar', 'data-toggle' => 'modal', 'data-target' => '#modalSocio')) !!}
                </span>
                {!! Form::text('nombreSocio', null, ['class' => 'form-control input-sm', 'id'=>'nombreSocio','readonly']) !!}
            </div>    
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('fecha_nac','Fecha de nacimiento',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {{ Form::text('fecha_nac', null, array('id' => 'datepicker', 'class' => 'form-control input-sm', 'placeholder' => 'AAAA-MM-DD')) }}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('lugar_nac','Lugar de nacimiento',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('lugar_nac', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('colegio','Colegio',['style' => 'font-size:small']) !!}
            {!! Form::text('colegio', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-6">
            {!! Form::label('ocupacion','Ocupación',['style' => 'font-size:small']) !!}
            {!! Form::text('ocupacion', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('num_ss','Número Seguridad Social',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('num_ss', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-3">
            {!! Form::label('tis','TIS',['style' => 'font-size:small']) !!}
            {!! Form::text('tis', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('primera_entrevista','Primera entrevista',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {{ Form::text('primera_entrevista', null, array('id' => 'datepicker2', 'class' => 'form-control input-sm', 'placeholder' => 'AAAA-MM-DD')) }}
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
        <div class="box-header with-border"><h4>Datos médicos</h4></div>
    <div class="box-body">
        <div class="form-group col-md-6">
            {!! Form::label('diagnostico','Diagnóstico',['style' => 'font-size:small']) !!}
            <i class="fa fa-asterisk ob"></i>
            {!! Form::text('diagnostico', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('grado_discapacidad','G. discapacidad',['style' => 'font-size:small']) !!}
            {!! Form::text('grado_discapacidad', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('grado_dependencia','G. dependencia',['style' => 'font-size:small']) !!}
            {!! Form::text('grado_dependencia', null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group col-md-2">
            {!! Form::label('puntos_mov','P. movilidad',['style' => 'font-size:small']) !!}
            {!! Form::text('puntos_mov', null, ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
    <div class="box-header with-border"><h4>Archivos</h4></div>
    <div class="box-body">

        <div class="form-group col-md-4">
            {!! Form::label('voto','Voto',['style' => 'font-size:small']) !!}
            <input type="file" id="file" name="voto">       
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('diagnostico','Diagnóstico',['style' => 'font-size:small']) !!}
            <input type="file" id="file" name="diagnostico">       
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('librofamilia','Libro de familia / Tutoria',['style' => 'font-size:small']) !!}
            <input type="file" id="file" name="dlibrofamilia">       
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('custodia','Custodia',['style' => 'font-size:small']) !!}
            <input type="file" id="file" name="custodia">
            <div class="checkbox">
                <label>
                    <input name="alerta_custodia" value="1" type="checkbox" @if ($usuario->alerta_custodia == '1') checked @endif>
                    Marcar si existe una alerta de custodia
                </label>
                
            </div>            
        </div> 
        <div class="form-group col-md-4">
            {!! Form::label('medica','Médica',['style' => 'font-size:small']) !!}
            <input type="file" id="file1" name="medica">
            <div class="checkbox">
                <label>
                    <input name="alerta_medica" value="1" type="checkbox" @if ($usuario->alerta_medica == '1') checked @endif>
                    Marcar si existe una alerta médica
                </label>
                
            </div>    
        </div> 
        <div class="form-group col-md-4">
            {!! Form::label('lopd','LOPD',['style' => 'font-size:small']) !!}
            <input type="file" id="file2" name="lopd">

        </div>
    </div>
    <div class="box-footer">    
        <div class="form-group col-md-12">
            <button class="btn btn-warning pull-left" type="reset" >Limpiar</button>
            {!! Form::submit('Guardar',['class' => 'btn btn-primary pull-right']) !!}
        </div>
    </div>
</div>    

<div class="modal fade" id="modalSocio" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Asignar Socio / Tutor</h4>
        </div> 
        <div class="modal-body">
            <div class="form-group col-md-12">
                {!! Form::label('nombreSocioM','Nombre y apellido',['style' => 'font-size:small']) !!}
                {!! Form::text('nombreSocioM',$value = null, array('id' => 'nombreSocioM', 'class' => 'form-control autocomplete')) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" id="anadir" data-dismiss="modal" 
                onclick="moverSocio()">Añadir</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <script type="text/javascript">
                    function moverSocio(){
                    $nombre = document.getElementById('nombreSocioM').value;
                    document.getElementById('nombreSocio').value=$nombre;
                    }
                </script>
            </div>
        </div>
    </div>
</div>


