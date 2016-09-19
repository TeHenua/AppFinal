<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/js/bootstrap3-typeahead.min.js') }}"></script>
</head>
<body>

<input class="typeahead form-control" style="margin:0px auto;width:300px;" type="text">


</body>

<script>
	
	var path = "{{ route('autocomplete') }}";

  $('input.typeahead').typeahead({
  	hint: true,
  	highlight: true,
	minLength: 1,
      source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
          return process(data);
        });
      }
  });
</script>
</html>