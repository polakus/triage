@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
  <div class="card">
  	<div class="card-header"> Salas </div>
  	<div class="card-body">
	<div class="form-row">
	    <div class="form-group col-md-2">
			<a class="btn btn-dark" href="{{ route('salas.create') }}">Agregar Sala</a>
		</div>
	    <div class="form-group col-md-2">
			<a class="btn btn-dark" href="{{ route('areas.create') }}">Agregar Área</a>
    	</div>
    </div>
    <div class="form-group col-md-3">
      	<label for="inputState">Área</label>
      	<select name="area" id="area" class="form-control">
         	<option value="Todas" selected>Todas</option>
	@foreach($areas as $area)
		@if($area->tipo_dato == $val1)
			<option value="{{$area->tipo_dato}}" selected>{{$area->tipo_dato}}</option>
		@else
			<option value="{{$area->tipo_dato}}">{{$area->tipo_dato}}</option>
		@endif
	@endforeach
      	</select>
    </div>
    <table class="table table-bordered table-sm table-hover table-responsive-sm">
    	<thead class="thead-dark">
        	<tr>
				<th scope="col" style="width:30%">Nombre</th>
          		<th scope="col" style="width:30%">Área</th>
				<th scope="col" style="width:20%">Estado</th>
				<th scope="col" style="width:20%">Acción</th>
        	</tr>
      	</thead>
      	<tbody id="tabla">
        @foreach($salas as $sala)
	       		<tr>
				  	<td>{{ $sala->nombre }}</td>
	       			<td>{{ $sala->area->tipo_dato }}</td>
					<td>
						<form id="f1" class= "form-inline" method="POST" action="{{route('salas.update', $sala->id)}}">
							@csrf
							{{ method_field('PUT') }}
							@if($sala->disponibilidad == 0)
								<button type="submit" style="width:100px" class="btn btn-danger btn-sm">F. de Servicio</button>
							@else
								<button type="submit" style="width:100px" class="btn btn-success btn-sm">Disponible</button>
							@endif
						</form>
					</td>
					<td>
						<form id="f2" name="{{$sala->nombre}}" class= "form-inline" method="POST" action="/salas/{{$sala->id}}">
							@csrf
							{{ method_field('DELETE') }}
							<button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
						</form>
					</td>
	       		</tr>
        @endforeach
      	</tbody>
	</table>
</div>
</div>

<script>
	$('form[id^="f1"').submit( function() {
	    // $(this).append('<input type="hidden" name="n" value="cualquiercosa"\>');
	    // $(this).append('<input type="hidden" name="a" value="cualquiercosa"\>');
		
		if (confirm('¿Desea cambiar el estado del Quirófano?')) {
			$("<input />").attr("type", "hidden")
				.attr("name", "n")
				.attr("value", $('#area').val())
				.appendTo("form");
			// $("<input />").attr("type", "hidden")
			// 	.attr("name", "a")
			// 	.attr("value", $('#area').val())
			// 	.appendTo("form");
	    	return true;
		}else{
			return false;
		}
	});

</script>
<script>
	$('select').on('change', function() {
		$('#tabla tr').filter(function(){
			if($('#area').val() == 'Todas'){
				$(this).toggle($(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1)
			}else{
				$(this).toggle($(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1)
			}
		});
  	}).trigger('change');

	// $("#name").change(function(){
	// 	if($("#name").val()=="basic")
	// 		$("#area option").not("[value^='basic']").hide();
	// 	else
	// 		$("#subscription_interval option").not("[value^='basic']").show();
  	// });

</script>

<script>
	$('form[id^="f2"').submit( function() {
		if (confirm('Por favor, confirme que desea eliminar la sala '.concat($(this).attr('name')))) {
			$("<input />").attr("type", "hidden")
				.attr("name", "n")
				.attr("value", $('#area').val())
				.appendTo("form");
			$("<input />").attr("type", "hidden")
				.attr("name", "a")
				.attr("value", $('#area').val())
				.appendTo("form");
			return true;
		}else{
			return false;
		}
	});
</script>

{{--Ejemplos (IGNORAR) --}}


@endsection

@section("pie")
    
@endsection