@extends('layouts.app')

@section('contentheader_title')
    <h1>Gestión de consultas</h1>
@endsection

@section('main-content')
	<section class="content">
	<!-- <?php $nav_usuario_create = 'active';
	$nav_usuario = 'active'; ?> -->
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Datos personales</h3>
		</div>
		<div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-condensed">
				<tr>
					<td><b>Nombre y apellidos</b></td>
					<td>{{$usuario->nombre}} {{$usuario->apellido1}} {{$usuario->apellido2}}</td>
					<td><b>Fecha de nacimiento</b></td>
					<td>{{$usuario->fecha_nac}}</td>
					<td><b>Socio tutor</b></td>
					<td>{{$socio->nombre}} {{$socio->apellido1}} {{$socio->apellido2}}</td>
					@if($socio->fijo!=null)
						<td><b>Tél. fijo</b></td>
						<td>{{$socio->fijo}}</td>
					@endif
					@if($socio->movil!=null)
						<td><b>Tél. móvil</b></td>
						<td>{{$socio->movil}}</td>
					@endif
					@if($socio->email!=null)
						<td><b>Email</b></td>
						<td>{{ $socio->email}}</td>
					@endif
				</tr>
			</table>
		</div>
		<div class="box-header">
			<h3 class="box-title">Datos médicos</h3>
		</div>
		<div class="box-body table-responsive no-padding">
			<table class="table table-striped table-bordered table-condensed">
				<tr>
					<td><b>Diagnóstico</b></td>
					<td>{{$usuario->diagnostico}} </td>
					<td><b>Núm. SS</b></td>
					<td>{{$socio->num_ss}} </td>
					<td><b>Grado de discapacidad</b></td>
					<td>{{$usuario->grado_discapacidad}}</td>
					<td><b>Grado de dependencia</b></td>
					<td>{{$socio->grado_dependencia}} </td>
					<td><b>Puntos de movilidad</b></td>
					<td>{{$socio->puntos_movilidad}} </td>
					
				</tr>
			</table>
    	</div>
    	<div class="box-footer"></div>
	</div>
	<div class="row">
	<div class="col-md-8">
			<div class="box box-primary ">
				<div class="box-header">
					<h3 class="box-title">Nueva consulta</h3>
				</div>
				<div class="box-body">
					<h3>hgkhjkhjkhlk</h3>
					<h3>hgkhjkhjkhlk</h3>
					<h3>hgkhjkhjkhlk</h3>
					<h3>hgkhjkhjkhlk</h3>
					<h3>hgkhjkhjkhlk</h3>
					<h3>hgkhjkhjkhlk</h3>
					<h3>hgkhjkhjkhlk</h3>
					<h3>hgkhjkhjkhlk</h3>
  				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary ">
				<div class="box-header">
					<h3 class="box-title">Resumen última consulta</h3>
				</div>
				<div class="box-body">
			
  				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary ">
				<div class="box-header">
					<h3 class="box-title">Historial</h3>
				</div>
				<div class="box-body">
			
  				</div>
			</div>
		</div>
		
		
	</div>
	
	</section>
@endsection