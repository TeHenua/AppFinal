@extends('layouts.app')

@section('contentheader_title')
    <h1>Calendario</h1>
@endsection

@section('main-content')<section class="content">
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body no-padding">
      <!-- aqui pulso el boton ver-->
        @if(Auth::user()->rol=='administrativo')
          <div class="form-group">
            {!! Form::open(array('route' => array('cargaEventos'), 'method' =>'POST', 'class' => 'form-inline','id'=>'botonVer')) !!}
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <select id="trabajadores" name="trabajadores" class="form-control">
              <option selected="selected">Seleccione</option>
              <!--aqui se genera la lista de trabajadores en la vista-->
              @foreach($trabajadores as $tra)
              <option value="{{ $tra }}">{{ $tra }}</option>
              @endforeach
              <!--***************************************************-->
            </select>
            {!! Form::button('Ver', array('class'=>'btn btn-default' , 'onclick' => 'desmodal()')) !!}
            {!! Form::close() !!}
          </div>
        @endif
       
        <!-- THE CALENDAR -->
        <div id="calendar"></div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /. box -->
  </div>
    <!-- /.col -->
</div>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
{{--       {!! Form::model(new App\Calendario, ['route' => ['guardaEventos'], 'role' => 'form']) !!} --}}
      {{ Form::token() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Nuevo evento</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="trabajadoresM" id="trabajadoresM" value="" class="input-sm">
        <div class="form-group">
          {!! Form::label('titulo','Título',['style' => 'font-size:small']) !!}
          {!! Form::text('titulo', null, ['class' => 'form-control input-sm', 'id' => 'titulo']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('tipo_evento','Tipo de evento',['style' => 'font-size:small']) !!}
          {!! Form::select('tipo_evento', array(
            'Usuario' => 'Usuario',
            'Externa' => 'Externa',
            'Coordinación' => 'Coordinación',
            'Otro' => 'Otro'
            ), null, ['id' => 'tipo_evento','placeholder' => 'Seleccione', 'class' => 'form-control input-sm']); !!}
        </div>
        <div class="form-group" hidden="hidden" id="usuario_group">
          {!! Form::label('usuario','Usuario',['style' => 'font-size:small']) !!}
          {!! Form::text('usuario', $value = null, ['id' => 'usuarioCalendario','class' => 'form-control input-sm autocomplete']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('fecha','Cuándo',['style' => 'font-size:small']) !!}
          <input type="text" name="fecha" id="fecha" value="" readonly class="form-control input-sm" />
          <input type="hidden" name="fechaIni" id="fechaIni" value="" />
          <input type="hidden" name="fechaFin" id="fechaFin" value="" />
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" onclick="guardarEvento()" class="btn btn-default pull-left">Guardar</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
      {{--   {!! Form::close() !!} --}}
    </div>
  </div>
</div>

@endsection

<script type="text/javascript">
  
</script>