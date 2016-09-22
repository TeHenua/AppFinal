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

 
{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
<script src="{{ asset('/plugins/bootstrap-input/js/fileinput.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('/js/bootstrap3-typeahead.min.js') }}"></script>
<script src="{{ asset('/js/app.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience. Slimscroll is required when using the
      fixed layout. -->

<!-- Con el import aquí funciona el modal. Puede haber conflicto con otros jquerys  -->      
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script>

$(document).ready(function () { 
  $('input:text').bind({ });
  $('#nombreSocio').autocomplete({
    minLength:3,
    autoFocus: true,
    source: '{{URL('getdata')}}'
  });
  
  $('#usuarioCalendario').autocomplete({
    minLength:3,
    autoFocus: true,
    source: '{{URL('getUsuario')}}'
  });
  $('#nombreUsuario').autocomplete({
    minLength:3,
    autoFocus: true,
    source: '{{URL('getUsuario')}}'
  });

});


$("#tipo_evento").change(function () {
  var selected_option = $('#tipo_evento').val();
  if (selected_option === 'Usuario') {
    $('#usuario_group').show();
  }
});

function ConfirmDelete()
  {
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
    $("#datepickerSocio").datepicker({
      defaultDate: "-40y",
    });
    /************************************************************************/
    $( "#datepicker,#datepicker2,#datepicker3" ).datepicker({
      changeMonth: true,
      changeYear: true, 

    });
  });
  
  $(function($){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});

  $(function () {
    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()), // use the element's text as the event title
          id: $.trim($(this).text())
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

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
      defaultTimedEventDuration: '00:30:00',
      events: {url:"cargaEventos"},
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!

      eventRender: function(event, element, view) {
        if (view.name === "month") {
                element.find(".fc-content")
                    .append("<b>"+event.user+"</b>" );
            }
        // return $('<div class="badge bg-red">' + event.user + event.title + '</div>');
    },
      // 

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

        }else{
          $('#calendar').fullCalendar('gotoDate', date);
          $('#calendar').fullCalendar('changeView', 'agendaDay');
        }
        return date;
      },

      eventClick: function(event, jsEvent, view){
        crsfToken = document.getElementsByName("_token")[0].value;
        var con = confirm("¿Desea eliminar el evento?");
        if(con){
          $.ajax({
            url: 'eliminarEvento',
            data: 'id=' + event.id,
            headers: {
                      "X-CSRF-TOKEN": crsfToken
                  },
                  type: "POST",
                  success: function(){
                    $('#calendar').fullCalendar('removeEvents', event._id);
                    console.log("Evento eliminado");
                  }
          })
        }else{
          console.log("Cancelado");
        }
      }

      
     });
    /* AGREGANDO EVENTOS AL PANEL */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
  </script>

