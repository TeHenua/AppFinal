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
			text-align: justify-all;
		}
	    
	</style> 
</head>
<body>



<header><img src="img/cabecera.jpg" width="100%"></header>


<h3>ACTUALIZACIÓN DATOS SOCIOS/AS</h3>
<ul>
<h4><li><b>Padre/ Madre/ Tutor@</b></li></h4>
</ul>

<p><b>Tipo de Socio:</b> {{ $socio->tipo_socio }} @if($socio->num_socio!=null)Nº Socio: {{ $socio->num_socio }} @endif </p>
<p>Nombre y Apellidos: {{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</p>
<p>NIF: {{ $socio->dni }} Fecha de Nacimiento: {{ $socio->fecha_nac }} Lugar de Nacimiento: {{ $socio->lugar_nac }}</p>
<p>Domicilio: {{ $socio->direccion }} {{ $socio->localidad }} {{ $socio->codigo_pos }} ({{ $socio->provincia }})</p>
<p>@if($socio->fijo!=null)Tel. Fijo: {{ $socio->fijo }}@endif @if($socio->movil!=null)Tel. Móvil: {{ $socio->movil }}@endif @if($socio->email!=null) Email: {{ $socio->email }}@endif</p>

@foreach($usuarios as $u)
<ul>
<h4><li><b>Usuari@</b></li></h4>
</ul>
<p>@if($u->num_socio!=null)Nº Socio: {{ $u->num_socio }} @endif </p>
<p>Nombre y Apellidos: {{$u->nombre}} {{$u->apellido1}} {{$u->apellido2}} </p>
<p>@if($u->dni!=null)NIF: {{$u->dni}} @endif Fecha de Nacimiento: {{ $socio->fecha_nac }} Lugar de Nacimiento: {{ $socio->lugar_nac }}</p>
<p>Domicilio: {{ $u->direccion }} {{ $u->localidad }} {{ $u->codigo_pos }} ({{ $u->provincia }})</p>
@endforeach

<h4>DATOS BANCARIOS</h4>

<p>IBAN: {{$socio->num_cuenta}}</p>


<header style="page-break-before: always;""><img src="img/cabecera.jpg" width="100%"></header>
<p>En virtud de lo dispuesto en los artículos 4, 5 y 6 de la LO 1511999, de 13 de diciembre, de Protección de Datos de Carácter Personal, la Asociación Autismo Araba TEAraba Elkartea (en adelante Autismo Araba), con CIF G01023308, y domicilio la calle Pintor Pablo Uranga n° 2 bajo de Vitoria-Gasteiz, te informa que los datos de carácter personal, vuestros y de vuestro hijo/hija, que nos facilitáis en este formulario, van a quedar incorporados a nuestros ficheros debidamente inscritos en la Agencia Española de Protección de Datos. La finalidad de la recogida y uso de dichos datos es tramitar la actualización de datos como asociados, así como su gestión administrativa y contable.</p>

<p>Estos datos no van a ser cedidos a entidad ni persona alguna sin su consentimiento salvo en los casos legalmente permitidos. Autismo Araba garantiza el secreto profesional de quienes intervienen en el tratamiento de dichos datos, así como la intimidad personal y familiar, entendida como un derecho fundamental.</p>

<p>Por tanto puede ejercitar en cualquier momento los derechos de acceso, rectificación, cancelación u oposición de los datos que nos facilita. Para ello deberá remitirse un escrito identificado con la referencia «Protección de Datos», en el que se concrete la solicitud correspondiente y, al que acompañe fotocopia del Documento Nacional de Identidad, a la siguiente dirección: Autismo Araba, calle Pintor Pablo Uranga n° 2 bajo, CP 01008 de Vitoria-Gasteiz o solicitarnos los formularios que tenemos preparados para ello.</p>

<p><input type="checkbox" name="acepto" selected="selected" style="display: inline;"> Deseo recibir información periódica acerca de Autismo Araba y sus actividades.</p>

<p>Al suscribir el presente documento, como titular, tutor o responsable legal/familiar del menor, autoriza expresamente a Autismo Araba para el tratamiento de los datos personales arriba consignados, de acuerdo con las finalidades antes expresadas, y manifiesta que los datos personales facilitados son ciertos y que se ajustan a la realidad.</p>

@if($usuarios!=null)
<p>D./Dña.{{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}, NIF {{$socio->dni}}, en calidad de Tutor o Representante Legal o Familiar del menor:</p>
	@foreach($usuarios as $u)
		<p>{{$u->nombre}} {{$u->apellido1}} {{$u->apellido2}}</p>
	@endforeach
@endif
<p>Firma:</p>
<br/><br/>
<p style="text-align: right;">Vitoria-Gasteiz, a __ de ____________________ de 20__</p>
</body>
</html>