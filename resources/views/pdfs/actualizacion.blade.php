<!DOCTYPE html>
<html>
<head>
	<title>ACTUALIZACIÓN DATOS SOCIOS/AS</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,700|Oswald');

		h3{text-align: center;}
		h3,h4{
			font-family: 'Open Sans', sans-serif;
			font-weight: bold;
		}
		body{
			font-family: 'Oswald', sans-serif;
			
		}
		p{
			text-align: justify;
		}
	     table,tr,td{
	     	border: 1px solid gray;
	     	border-collapse: collapse;
	    }
	    th, td {
    		padding: 8px;
		}
		#pie { position: fixed; bottom: 15px; text-align: right; border-bottom: 15px solid #FF3399; font-size: 0.8em} 
	</style> 
</head>
<body>



<header><img src="img/cabecera.jpg" width="100%"></header>


<h3>ACTUALIZACIÓN DATOS SOCIOS/AS</h3>
<h4><b>Padre/ Madre/ Tutor@</b></h4>
<table style="width: 100%; font-size: 0.9em;">
	<tr>
		<td>Nº Socio: @if($socio->num_socio!=null) <b>{{ $socio->num_socio }}</b> @endif</td>
		<td colspan="2">Tipo de Socio: <b>{{ $socio->tipo_socio }}</b></td>
	</tr>
	<tr>
		<td colspan="3">Nombre y Apellidos: <b>{{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</b></td>
	</tr>
	<tr>
		<td>NIF: <b>{{ $socio->dni }}</b></td>
		<td>Fecha de Nacimiento: <b>{{ $socio->fecha_nac }}</b></td>
		<td>Lugar de Nacimiento: <b>{{ $socio->lugar_nac }}</b></td>
	</tr>
	<tr>
		<td colspan="3">Domicilio: <b>{{ $socio->direccion }} {{ $socio->localidad }} {{ $socio->codigo_pos }} ({{ $socio->provincia }}</b>)</td>
	</tr>
	<tr>
		<td>Tel. Fijo: @if($socio->fijo!=null)<b>{{ $socio->fijo }}</b>@endif</td>
		<td>Tel. Móvil: @if($socio->movil!=null)<b>{{ $socio->movil }}</b>@endif</td>
		<td>Email: @if($socio->email!=null)<b>{{ $socio->email }}</b>@endif</td>
	</tr>
</table>

<br/>
@foreach($usuarios as $u)
<h4><b>Usuari@</b></h4>
<table style="width: 100%; font-size: 0.9em;">
	<tr>
		<td>Nº Socio: @if($u->num_socio!=null)<b>{{ $u->num_socio }}</b> @endif</td>
		<td colspan="2">Nombre y Apellidos: <b>{{$u->nombre}} {{$u->apellido1}} {{$u->apellido2}}</b></td>
	</tr>
	<tr>
		<td>NIF: @if($u->dni!=null)<b>{{$u->dni}}</b>@endif </td>
		<td>Fecha de Nacimiento: <b>{{ $socio->fecha_nac }}</b></td>
		<td>Lugar de Nacimiento: <b>{{ $socio->lugar_nac }}</b></td>
	</tr>
	<tr>
		<td colspan="3">Domicilio: <b>{{ $u->direccion }} {{ $u->localidad }} {{ $u->codigo_pos }} ({{ $u->provincia }}</b>)</td>
	</tr>
</table>
<br>
@endforeach

<h4>DATOS BANCARIOS</h4>
<table style="width: 100%; font-size: 0.9em;">
	<tr>
		<td>IBAN: <b>{{$socio->num_cuenta}}</b></td>
	</tr>
</table>

<header style="page-break-before: always;""><img src="img/cabecera.jpg" width="100%"></header>
<p>En virtud de lo dispuesto en los artículos 4, 5 y 6 de la LO 1511999, de 13 de diciembre, de Protección de Datos de Carácter Personal, la Asociación Autismo Araba TEAraba Elkartea (en adelante Autismo Araba), con CIF G01023308, y domicilio la calle Pintor Pablo Uranga n° 2 bajo de Vitoria-Gasteiz, te informa que los datos de carácter personal, vuestros y de vuestro hijo/hija, que nos facilitáis en este formulario, van a quedar incorporados a nuestros ficheros debidamente inscritos en la Agencia Española de Protección de Datos. La finalidad de la recogida y uso de dichos datos es tramitar la actualización de datos como asociados, así como su gestión administrativa y contable.</p>

<p>Estos datos no van a ser cedidos a entidad ni persona alguna sin su consentimiento salvo en los casos legalmente permitidos. Autismo Araba garantiza el secreto profesional de quienes intervienen en el tratamiento de dichos datos, así como la intimidad personal y familiar, entendida como un derecho fundamental.</p>

<p>Por tanto puede ejercitar en cualquier momento los derechos de acceso, rectificación, cancelación u oposición de los datos que nos facilita. Para ello deberá remitirse un escrito identificado con la referencia "Protección de Datos", en el que se concrete la solicitud correspondiente y, al que acompañe fotocopia del Documento Nacional de Identidad, a la siguiente dirección: Autismo Araba, calle Pintor Pablo Uranga n° 2 bajo, CP 01008 de Vitoria-Gasteiz o solicitarnos los formularios que tenemos preparados para ello.</p>

<script type="text/php"> </script>
<p><input type="checkbox" name="acepto" selected="selected" style="display: inline;"> Deseo recibir información periódica acerca de Autismo Araba y sus actividades.</p>

<p>Al suscribir el presente documento, como titular, tutor o responsable legal/familiar del menor, autoriza expresamente a Autismo Araba para el tratamiento de los datos personales arriba consignados, de acuerdo con las finalidades antes expresadas, y manifiesta que los datos personales facilitados son ciertos y que se ajustan a la realidad.</p>

@if($usuarios!=null)
<p>D./Dña. {{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}, NIF {{$socio->dni}}, en calidad de Tutor o Representante Legal o Familiar del menor o incapaz:</p>
<ul>
	@foreach($usuarios as $u)
		<li>{{$u->nombre}} {{$u->apellido1}} {{$u->apellido2}}</li>
	@endforeach
</ul>
	
@endif
<p>Firma:</p>
<br/><br/>
<p style="text-align: right;">Vitoria-Gasteiz, a <?php setlocale(LC_TIME,"spanish"); echo strftime("%d de %B de %Y"); ?></p>

</body>
</html>	