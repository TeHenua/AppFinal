@extends('layouts.app')

@section('contentheader_title')
    <h1>Detalle socio</h1>
@endsection

@section('main-content')

	<div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos personales</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-condensed">
                            <tr>
                                <td>Dni</td>
                                <td>{{ $socio->dni}}</td>
                            </tr>
                            <tr>
                                <td>Nº Socio</td>
                                <td>{{ $socio->num_socio}}</td>
                            </tr>
                            <tr>
                                <td>Tipo Socio</td>
                                <td>{{ $socio->tipo_socio}}</td>
                            </tr>
                            <tr>
                                <td>Nombre y apellidos</td>
                                <td>{{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</td>
                            </tr>
                            <tr>
                                <td>Nacimiento</td>
                                <td>Fecha {{ $socio->fecha_nac}} Lugar {{ $socio->lugar_nac }}</td>
                            </tr>
                            <tr>
                                <td>Dirección</td>
                                <td>{{ $socio->direccion}} {{ $socio->localidad }} {{ $socio->codigo_pos }} {{ $socio->provincia }}</td>
                            </tr>
                            <tr>
                                <td>Teléfonos</td>
                                <td>@if($socio->fijo)Fijo {{ $socio->fijo}}@endif @if($socio->movil) Móvil {{ $socio->movil }}@endif</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $socio->email }}</td>
                            </tr>
                            <tr>
                                <td>Tipo contacto</td>
                                <td>{{ $socio->tipo_comunicacion}}</td>
                            </tr>
                            <tr>
                                <td>Ocupación</td>
                                <td>{{ $socio->ocupacion}}</td>
                            </tr>                             
                        </table>
                    </div>
                     <div class="box-footer">
                        {{ link_to_route('socios.edit', 'Editar socio', array($socio->id) ,array('class' => 'btn btn-warning')) }}
                        {{ Form::open(array('route' => array('socios.destroy', $socio->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()' ,'style="display: inline;"')) }}
                                <button type="submit" class="btn btn-danger" >Borrar</button>
                                {{ Form::close() }}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection