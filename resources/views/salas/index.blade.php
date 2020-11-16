@extends("triagepreguntas.test")


@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h4> Salas </h4>
	<div class="btn-toolbar mb-2 mb-md-0">
		<div class="btn-group mr-2">
			<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
				Agregar Sala
			</button>
			{{--
		<a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('salas.create') }}">Agregar Sala</a>
		--}}
        <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('areas.create') }}">Agregar Area</a>
      </div>
    </div>
</div>
{{--
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
--}}
<div class="table-responsive">
	<table  class="table table-bordered table-sm table-striped table-hover" id="myTable">
		<thead >
		<tr>
			<th scope="col" >Nombre</th>
			<th scope="col" >Área</th>
			<th scope="col" >Estado</th>
			<th scope="col" >Acción</th>
		</tr>
		</thead>
		<tbody>
			{{--
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
							<button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
						</form>
					</td>
				</tr>
		@endforeach
		--}}
		</tbody>
	</table>
</div>
<!-- Modal Create -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Registracion de Sala</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="form-group">
						<div class="form-row">
							<label for="inputEmail4">Nombre</label>
							<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
							<div id="error_nombre"></div>
						</div>
						<div class="form-row">
							<label for="inputState">Área</label>
							<select name="areac" id="areac" class="form-control">
								<option value="" selected disabled hidden>Seleccione</option>
							@foreach($areas as $area)
								<option value="{{$area->id}}" {{old('area') == $area->id ? 'selected':''}}>{{$area->tipo_dato}}</option>
							@endforeach
							</select>
							<div id="error_area"></div>
						</div>
						<div class="form-row">
							<label for="inputEmail4">Nro. Camas</label>
							<input type="number" id="camas" name="camas" min="0" max="200" placeholder="Nro. Camas" class="form-control">
							<div id="error_camas"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="guardar" type="button" class="btn btn-dark">Guardar</button>
				<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- fin modal -->
@endsection

@section("scripts")
@parent
<script>
	$('form[id^="f1"').submit( function() {
		if (confirm('¿Desea cambiar el estado del Quirófano?')) {
			$("<input />").attr("type", "hidden")
				.attr("name", "n")
				.attr("value", $('#area').val())
				.appendTo("form");
	    	return true;
		}else{
			return false;
		}
	});

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

<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
    	"responsive":true,
		"serverSide":true,
			"ajax":{url:"{{ url('api/tablasalas') }}",},
			"columns":[
				{data:'nombre'}, 
				{data:'area'}, 
				{data:'habilita'},
				{data:'elimina'},
			],
      
       	"language": {
			"decimal": ",",
			"thousands": ".",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoPostFix": "",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"loadingRecords": "Cargando...",
			"lengthMenu": "Mostrar _MENU_ registros",
			"paginate": {
				"first": "Primero",
				"last": "Último",
				"next": "Siguiente",
				"previous": "Anterior"
			},
			"processing": "Procesando...",
			"search": "Buscar:",
			"searchPlaceholder": "",
			"zeroRecords": "No se encontraron resultados",
			"emptyTable": "Ningún dato disponible en esta tabla",
			"aria": {
				"sortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sortDescending": ": Activar para ordenar la columna de manera descendente"
			},
			//only works for built-in buttons, not for custom buttons
			"buttons": {
				"create": "Nuevo",
				"edit": "Cambiar",
				"remove": "Borrar",
				"copy": "Copiar",
				"csv": "fichero CSV",
				"excel": "tabla Excel",
				"pdf": "documento PDF",
				"print": "Imprimir",
				"colvis": "Visibilidad columnas",
				"collection": "Colección",
				"upload": "Seleccione fichero...."
			},
			"select": {
				"rows": {
					_: '%d filas seleccionadas',
					0: 'clic fila para seleccionar',
					1: 'una fila seleccionada'
				}
			}
		}
    });
} );
	$('#guardar').click(function() {
      	var nombre = $('#nombre').val();
		var area = $('#areac').val();
		var camas = $('#camas').val();
		$('#error_nombre').empty();
		$('#error_area').empty();
		$('#error_camas').empty();
		// alert(nombre);
		// alert(area);
		// alert(camas);
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
   		$.ajax({
            type:'POST',
            url:"/salas",
            dataType:"json",
            data:{
                nombre: nombre,
				area: area,
				camas: camas,
            },
            success: function(response){
				$('#exampleModal').modal('hide');
				var table = $('#myTable').DataTable();
                table.draw();
            },
            error:function(err){
				// alert("No se pudo guardar la sala");
				if (err.status == 422) { // when status code is 422, it's a validation issue
					$('#success_message').fadeIn().html(err.responseJSON.message);
					$.each(err.responseJSON.errors, function (i, error) {
						switch( i ){
							case "nombre":
								$('#error_nombre').html('<span style="color: red;">'+error[0]+'</span>');
							break;
							case "camas":
								$('#error_camas').html('<span style="color: red;">'+error[0]+'</span>');
							break;
							case "area":
								$('#error_area').html('<span style="color: red;">'+error[0]+'</span>');
							break;
							default:
								alert("Ocurrió un error en la función de error de ajax");
						}
					});
				}
            }
        });
	});
</script>

@endsection



@section("pie")
    
@endsection