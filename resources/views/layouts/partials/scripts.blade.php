<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" ></script>
<script src="{{ asset('/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('plugins/fullcalendar/lang/es.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-input/js/fileinput.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/bootstrap3-typeahead.min.js') }}"></script>
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->
<!-- Con el import aquí funciona el modal. Puede haber conflicto con otros jquerys  -->      
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{asset('/plugins/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>

<script src="{{asset('/plugins/tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('/plugins/tinymce/js/tinymce/langs/es.js')}}"></script>
<script>
  $.ajaxSetup({
    headers:
      { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  });

var editor_config = {
  path_absolute : "{{URL::to('/')}}",
  selector: ".texto",
  height : 350,
  plugins : ["advlist autolink lists link image charmap print preview hr anchor pagebreak","searchreplace wordcount visualblocks visualchars code fullscreen","insertdatetime media nonbreaking save table contextmenu directionality","emoticons template paste textcolor colorpicker textpattern"],
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
  relative_urls: false,
  file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
      } else {
          cmsURL = cmsURL + "&type=Files";
      }
      tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
      });
  }
};

tinymce.init(editor_config);

function cargarGrupos(){
  var grupo = $('#selectGrupo').val();
  $.ajax({
    url: 'cargaGrupos',
    data: 'grupo=' + grupo,
    type: 'POST',
    headers:  {"X-CSRF-TOKEN": crsfToken},
  })
}

function updateEventos(){
  var id = $('#idEvento').val();
  var titulo = $('#titulo').val();
  var inicio = $('#datetimepicker').val();
  var fin = $('#datetimepicker2').val();
  var tipo_evento = $('#tipo_evento').val();
  var usuario = $('#usuario').val();
  var grupo = $('#grupoCalendario').val();
  crsfToken = document.getElementsByName("_token")[0].value;
  $.ajax({
    url: 'updateEventos',
    data: 'title=' + titulo +'&start=' + inicio +'&end=' + fin+ '&id='+id+'&tipo_evento='+tipo_evento+'&usuario='+usuario+'&grupo='+grupo,
    type: "POST",
    headers: {
      "X-CSRF-TOKEN": crsfToken
    },
    success: function(json){
      $.ajax({
        url: 'cargaEventos',
        type: "post",
        data: { '_token': $('input[name=_token]').val()},
        success: function(data){
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('addEventSource',data);
          $('#calendar').fullCalendar('rerenderEvents');
        }
      });
    },
    error: function(json){
      console.log("error al actualizar evento");
    }
  });
}

function borrarEvento(){
  crsfToken = document.getElementsByName("_token")[0].value;
    var con = confirm("¿Desea eliminar el evento?");
    var id = $('#idEvento').val();
    if(con){
      $.ajax({
        url: 'eliminarEvento',
        data: 'id=' + id,
        headers: {
          "X-CSRF-TOKEN": crsfToken
        },
        type: "POST",
        success: function(){
          $('#calendar').fullCalendar('removeEvents',id);
          console.log("Evento eliminado");
        }
      })
    }else{
      console.log("Cancelado");
    }
}

function limpiarEvento(){
  $('#idEvento').val('');
  $('#titulo').val('');
  $('#datetimepicker').val('');
  $('#datetimepicker2').val('');
  $('#tipo_evento').val('');
  $('#usuario').val('');
  $('#grupoCalendario').val('');
  $('#guardarBoton').attr("disabled", false);
}

function desmodal(){
    $nombre = document.getElementById('trabajadores').value;
    document.getElementById('trabajadoresM').value=$nombre;
  }


function guardarEvento(){
//aqui obtengo el valor del desplegable 
  $trabajador= [$('#trabajadores').val()];
  if($trabajador==null){
    $trabajador={{ Auth::user()->name }}
  }
  $titulo = [$('#titulo').val()];
  $tipo_evento = [$('#tipo_evento').val()];
  $usuarioCalendario = [$('#usuario').val()];
  if($usuarioCalendario==""){
    $usuarioCalendario=null;
  }
  $fechaIni = [$('#datetimepicker').val()];
  $fechaFin = [$('#datetimepicker2').val()];
  $grupo = $('#grupoCalendario').val();
  console.log($grupo);
  $.ajax({
    url: 'guardaEventos',
    data: {'titulo': $titulo, 'tipo_evento': $tipo_evento, 'usuarioCalendario': $usuarioCalendario, 'fechaIni': $fechaIni,
      'fechaFin': $fechaFin, 'grupo': $grupo ,'trabajador': $trabajador, '_token': $('input[name=_token]').val()},
    type: "POST",
    success: function(){
      // $('#myModal').modal('hide');
      $.ajax({
        url: 'cargaEventos',
        type: "post",
        data: {'trabajador': $trabajador, '_token': $('input[name=_token]').val()},
        success: function(data){
          $('#calendar').fullCalendar('removeEvents');
          $('#calendar').fullCalendar('addEventSource',data);
          $('#calendar').fullCalendar('rerenderEvents');
        }
      });
    }
  });
}

$(function () {
  $(window).load(function () {
    $(':input:visible:enabled:first').focus();
  });
})

$.datetimepicker.setLocale('es');

$('#datetimepicker').datetimepicker({
  step:15,
  disabledWeekDays:[0,6],
  dayOfWeekStart:1,
  defaultTime:'09:00',
  onClose:function(){
    $('#datetimepicker2').val($('#datetimepicker').val());
  }
});
$('#datetimepicker2').datetimepicker({
  step:15,
  disabledWeekDays:[0,6],
  dayOfWeekStart:1
});

$('input:text').bind({ });

$('#nombreSocioM').autocomplete({
  minLength:3,
  autoFocus: true,
  source: '{{URL('getdata')}}'
});

$('.usuarioAuto').autocomplete({
  minLength:3,
  autoFocus: true,
  source: '{{URL('getUsuario')}}'
});


//aqui enviamos a las routes el trabajador seleccionado
$('#botonVer').click(function(){  
  //aqui obtengo el valor del desplegable 
  $trabajador= [$('#trabajadores').val()];
  $.ajax({
    url: 'cargaEventos',
    type: "post",
    data: {'trabajador': $trabajador, '_token': $('input[name=_token]').val()},

    success: function(data){
      $('#calendar').fullCalendar('removeEvents');
      $('#calendar').fullCalendar('addEventSource',data);
      $('#calendar').fullCalendar('rerenderEvents');
    }

  });
});

function ConfirmDelete(){
  var x = confirm("¿Seguro que quieres borrarlo?");
  if (x)
    return true;
  else
    return false;
}

$( function() {
  $("#file,#file1,#file2").fileinput({
    showUpload: false,
    showRemove: false,
    showPreview: false
  });
});


$( function() {
  //Esto es para que la fecha de nacimiento de socio aparezca 40 años atras
  $("#dpSocio").datepicker({
    defaultDate: "-40y",
    changeMonth: true,
    changeYear: true
  });
  /************************************************************************/
  $( "#dpUsuarioNac,#dpUsuarioEnt,#dpSocio,#dpContacto" ).datepicker({
    changeMonth: true,
    changeYear: true, 
    dateFormat: 'yy-mm-dd',
    beforeShow: function() {
      setTimeout(function(){
          $('.ui-datepicker').css('z-index', 99999999999999);
      }, 0);
  }
  });
});
  
$(function($){
  $.datepicker.regional['es'] = {
      closeText: 'Cerrar',
      prevText: '',
      nextText: '',
      currentText: 'Hoy',
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      weekHeader: 'Sm',
      dateFormat: 'dd/mm/yy',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: false,
      yearSuffix: ''
  };
  $.datepicker.setDefaults($.datepicker.regional['es']);
});


$(function () {
  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)
  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();
  //envia la fecha y el titulo
  $( "form" ).submit(function( date, event ) { 
    var titulo = $( "input:first" ).val();
    var fechaIni = $( "#fechaIni" ).val();
    var fechaFin = $( "#fechaFin" ).val();
    var fecha = $("#fecha");

  });
  //aqui empieza a pintar el calendario
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay'
    },
    buttonText: {
      today: 'hoy',
      month: 'mes',
      week: 'semana',
      day: 'dia'
    },
    forceEventDuration: true,
    defaultTimedEventDuration: '00:45:00',
    slotDuration: '00:15:00',
    //aqui se pintan los eventos
    weekends:false,
    events: {
      url:"cargaEventos"
    },
    editable: true,
    droppable: true, // this allows things to be dropped onto the calendar !!!
    
    eventRender: function(event, element, view) {
      if(event.user!=null){
        element.find(".fc-content").append("<b> "+event.user+"</b>" );
      }
    },
    eventResize: function(event){
      var start = event.start.format("YYYY-MM-DD HH:mm");
      var back = event.backgroundColor;
      var allDay = event.allDay;
      if(event.end){
        var end = event.end.format("YYYY-MM-DD HH:mm");
      }else{
        var end = "NULL";
      }
      crsfToken = document.getElementsByName("_token")[0].value;
      $.ajax({
        url: 'actualizaEventos',
        data: 'title=' + event.title +'&start=' + start+'&end=' + end+ '&id='+event.id+'&background='+back+'&allday='+allDay,
        type: "POST",
        headers: {
          "X-CSRF-TOKEN": crsfToken
        },
        success: function(json){
          console.log("updated successfully");
        },
        error: function(json){
          console.log("error al actualizar evento");
        }
      });
    },
    eventDrop: function(event, delta){
      var start = event.start.format("YYYY-MM-DD HH:mm");
      if(event.end){
        var end = event.end.format("YYYY-MM-DD HH:mm");
      }else{
        var end = "NULL";
      }
      var back = event.backgroundColor;
      var allDay = event.allDay;
      crsfToken = document.getElementsByName("_token")[0].value;
      $.ajax({
        url: 'actualizaEventos',
        data: 'title=' + event.title +'&start=' + start+'&end=' + end+ '&id='+event.id+'&background='+back+'&allday='+allDay,
        type: "POST",
        headers: {
          "X-CSRF-TOKEN": crsfToken
        },
        success: function(json){
          console.log("updated successfully eventrop");
        },
        error: function(json){
          console.log("error al actualizar eventdrop");
        }
      });
    },
    dayClick: function(date, jsEvent, event, view){
      var view = $('#calendar').fullCalendar('getView');
      if(view.name != 'month'){
        var fecha = date.format("DD MMM hh:mm");
        var fechaMas = fecha.substring(8,10);
        var minutos = fecha.substring(11);
        var hora = parseInt(fechaMas)+1;
        if(hora<=9){
          var hora = "0"+hora;
        }
        fecha += " - "+hora+":"+minutos;
        var fin = moment(date).add(1,'hours');
        $("#myModal").modal('show');
        $(".modal-body #fecha").val(fecha);
        $(".modal-body #fechaIni").val( date.format("YYYY-MM-DD HH:mm") );
        console.log(date.format("YYYY-MM-DD HH:mm"));
        $(".modal-body #fechaFin").val( fin.format("YYYY-MM-DD HH:mm") );
        $(".modal-body .user").val($("#trabajadores").val);
      }else{
        $('#calendar').fullCalendar('gotoDate', date);
        $('#calendar').fullCalendar('changeView', 'agendaDay');
      }
      return date;
    },

    eventClick: function(event, jsEvent,view){
      $('#titulo').val(event.title);
      $('#datetimepicker').val(event.start.format("YYYY/MM/DD HH:mm"));
      $('#datetimepicker2').val(event.end.format("YYYY/MM/DD HH:mm"));
      var color = event.backgroundColor;
      var tipo;
      switch(color){
        case "#00BFFF":
          tipo = 'Usuario';
        break;
        case "#30912e":
          tipo = 'Interna';
        break;
        case "#ffa64d":
          tipo = 'Externa';
        break;
        case "#66cc66":
          tipo = 'Coordinación interna';
        break;
        case "#963048":
          tipo = 'Coordinación externa';
        break;
        case "#b366ff":
          tipo = 'Grupo';
        break;
        case null:
          tipo = 'Otro';
        break;
      }
      $('#tipo_evento').val(tipo);
      crsfToken = document.getElementsByName("_token")[0].value;
      $.ajax({
        url: 'cargaDatos',
        data: '&id='+event.id,
        type: "POST",
        headers: {
          "X-CSRF-TOKEN": crsfToken
        },
        success: function(data){
          $('#usuario').val(data);
        },
        error: function(json){
          console.log("error al cargar datos de usuario");
        }
      });
      $('#usuario').val('');
      $('#grupoCalendario').val('');
      $('#idEvento').val(event._id);
      $('#guardarBoton').attr("disabled", true);
    }
  });
});
</script>

