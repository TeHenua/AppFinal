@extends('layouts.app')

@section('contentheader_title')
    <h1>Detalle usuario</h1>
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
                                <td>Nombre y apellidos</td>
                                <td>{{ $usuario->nombre }} {{ $usuario->apellido1 }} {{ $usuario->apellido2 }}</td>
                            </tr>
                            <tr>
                                <td>Dirección</td>
                                <td>{{ $usuario->direccion }} {{ $usuario->codigo_pos }} {{ $usuario->localidad }}</td>
                            </tr>
                            <tr>
                                <td>Dni</td>
                                <td>{{ $usuario->dni}}</td>
                            </tr>
                            <tr>
                                <td>Fecha nacimiento</td>
                                <td>{{ $usuario->fecha_nac}} {{ $usuario->lugar_nac }}</td>
                            </tr>
                            <tr>
                                <td>Numero Seguridad Social</td>
                                <td>{{ $usuario->num_ss}}</td>
                            </tr>
                            <tr>
                                <td>Colegio</td>
                                <td>{{ $usuario->colegio}}</td>
                            </tr>
                            <tr>
                                <td>Ocupación</td>
                                <td>{{ $usuario->ocupacion}}</td>
                            </tr>
                            <tr>
                                <td>Diagnóstico</td>
                                <td>{{ $usuario->diagnostico }}</td>
                            </tr>
                            <tr>
                                <td>Grado discapacidad</td>
                                <td>{{ $usuario->grado_discapacidad}}</td>
                            </tr>
                            <tr>
                                <td>Grado dependencia</td>
                                <td>{{ $usuario->grado_dependencia}}</td>
                            </tr>
                            
                        </table>
                    </div>
                    <div class="box-footer">
                        @if($socio)
                            {{ link_to_route('lopd', 'Generar Lopd', array($usuario->id) ,array('class' => 'btn btn-success')) }}
                            
                        @endif
                        {{ link_to_route('usuarios.edit', 'Editar usuario', array($usuario->id) ,array('class' => 'btn btn-warning')) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Socio</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-condensed">
                            @if($socio)
                                <tr>
                                    <td>Nombre y apellidos</td>
                                    <td colspan="2">{{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</td>
                                </tr>
                                <tr>
                                    <td>Dirección</td>
                                    <td colspan="2">{{ $socio->direccion }} {{ $socio->codigo_pos }} {{ $socio->localidad }}</td>
                                </tr>
                                <tr>
                                    <td>Teléfonos</td>
                                    <td>Fijo {{ $socio->fijo }} </td>
                                    <td>Móvil {{ $socio->movil }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td colspan="2">{{ $socio->email }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo comunicación</td>
                                    <td colspan="2">{{ $socio->tipo_comunicacion }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="box-footer">
                        @if($socio)
                            {{ link_to_route('socios.edit', 'Editar socio', array($socio->id) ,array('class' => 'btn btn-warning')) }}
                            {{ Form::open(array('route' => array('socios.destroy', $socio->id), 'method' => 'delete', 'onsubmit' => 'return ConfirmDelete()' ,'style="display: inline;"')) }}
                                <button type="submit" class="btn btn-danger" >Borrar</button>
                            {{ Form::close() }}
                        @else
                            {{ link_to_route('socios.create', 'Añadir socio',null ,array('class' => 'btn btn-success')) }}
                        @endif
                    </div>
                </div>    
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contactos</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-condensed">

                            @foreach($contactos as $con)
                                 <tr>
                                    <td>Nombre y apellidos</td>
                                    <td colspan="2">{{ $con->nombre }} {{ $con->apellido1 }} {{ $con->apellido2 }}</td>
                                </tr>
                                <tr>
                                    <td>Dirección</td>
                                    <td colspan="2">{{ $con->direccion }} {{ $con->codigo_pos }} {{ $con->localidad }}</td>
                                </tr>
                                <tr>
                                    <td>Teléfonos</td>
                                    <td>Fijo {{ $con->fijo }} </td>
                                    <td>Móvil {{ $con->movil }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td colspan="2">{{ $con->email }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo comunicación</td>
                                    <td colspan="2">{{ $con->tipo_comunicacion }}</td>
                                </tr>
                                <tr><td></td><td></td></tr>
                            @endforeach
            
                        </table>
                    </div>
                    <div class="box-footer">
                        {{ link_to_route('contactos.create', 'Añadir contacto',null ,array('class' => 'btn btn-success')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>    
@endsection