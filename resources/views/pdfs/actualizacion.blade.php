

<header><img src="img/cabecera.jpg" width="100%"></header>

<main>
<h3 style="color:red">ACTUALIZACIÓN DATOS SOCIOS/AS</h3>

<h4>Padre/ Madre/ Tutor@</h4>


<p>Tipo de Socio: {{ $socio->tipo_socio }} @if($socio->num_socio!=null)Nº Socio: {{ $socio->num_socio }} @endif </p>
<p>Nombre y Apellidos: {{ $socio->nombre }} {{ $socio->apellido1 }} {{ $socio->apellido2 }}</p>
<p>NIF: {{ $socio->dni }} Fecha de Nacimiento: {{ $socio->fecha_nac }} Lugar de Nacimiento: {{ $socio->lugar_nac }}</p>
<p>Domicilio: {{ $socio->direccion }} {{ $socio->localidad }} {{ $socio->codigo_pos }} ({{ $socio->provincia }})</p>
<p>@if($socio->fijo!=null)Tel. Fijo: {{ $socio->fijo }}@endif @if($socio->movil!=null)Tel. Móvil: {{ $socio->movil }}@endif @if($socio->email!=null) Email: {{ $socio->email }}@endif</p>

@foreach($usuarios as $u)

<h4>Usuari@</h4>

<p>Nombre y Apellidos: </p>
<p>NIF: Fecha de Nacimiento: Lugar de Nacimiento: </p>
<p>Domicilio: </p>
<p>Tel. Fijo: Tel. Móvil: Email: </p>

@endforeach

<h3>DATOS BANCARIOS</h3>

<p>Entidad financiera: </p>
<p>IBAN: </p>


<h3>REPRESENTANTE FAMILIA CON DERECHO A VOTO</h3>
<p>D./Dña.   , NIF </p>

<header style="page-break-before: always;""><img src="img/cabecera.jpg" width="100%"></header>
<p>En virtud de lo dispuesto en los artículos 4, 5 y 6 de la LO 1511999, de 13 de diciembre, de Protección de Datos de Carácter Personal, la Asociación Autismo Araba TEAraba Elkartea (en adelante Autismo Araba), con CIF G01023308, y domicilio la calle Pintor Pablo Uranga n° 2 bajo de Vitoria-Gasteiz, te informa que los datos de carácter personal, vuestros y de vuestro hijo/hija, que nos facilitáis en este formulario, van a quedar incorporados a nuestros ficheros debidamente inscritos en la Agencia Española de Protección de Datos. La finalidad de la recogida y uso de dichos datos tramitar la presente solicitud de preinscripción como asociados, así como su gestión administrativa y contable.</p>

<p>Estos datos no van a ser cedidos a entidad ni persona alguna sin su consentimiento salvo en los casos legalmente permitidos. Autismo Araba garantiza el secreto profesional de quienes intervienen en el tratamiento de dichos datos, así como la intimidad personal y familiar, entendida como un derecho fundamental.</p>

<p>Por tanto puede ejercitar en cualquier momento los derechos de acceso, rectificación, cancelación u oposición de los datos que nos facilita. Para ello deberá remitirse un escrito identificado con la referencia «Protección de Datos», en el que se concrete la solicitud correspondiente y, al que acompañe fotocopia del Documento Nacional de Identidad, a la siguiente dirección: Autismo Araba, calle Pintor Pablo Uranga n° 2 bajo, CP 01008 de Vitoria-Gasteiz o solicitarnos los formularios que tenemos preparados para ello.</p>

<input type="checkbox" name="acepto" selected="selected">
<p>Deseo recibir información periódica acerca de Autismo Araba y sus actividades.</p>
</main>