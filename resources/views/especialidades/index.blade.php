@extends("triagepreguntas.test")




@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h4 class="h4">Especialidades</h4>
	<div class="btn-toolbar mb-2 mb-md-0">
		<div class="btn-group mr-2">
			<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
				Agregar especialidad
			</button>
		</div>
	</div>
</div>
	
	

<div class="table-responsive">
	<table class="table table-bordered table-hover table-sm table-striped" id="myTable">
		<thead >
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Descripcion</th>
				<th scope="col">Areas</th>
				<th scope="col">Accion</th>
			</tr>
		</thead>
		<tbody >
			
		</tbody>
	</table>
</div>


<!-- Modal Create -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="exampleModalLabel">Registracion de Especialidad</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="form-group">
						<div class="form-row">
							<div class="form-group">
								<label>Nombre</label>
								<input type="text" id="esp_nombre" name="esp_nombre" class="form-control" placeholder="Nombre">
								<div id="error_esp_nombre"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-10">
								<label>Descripcion </label>
								<textarea id="descripcion" name="descripcion" class="form-control" rows="3" placeholder="Descripcion"></textarea>
								<div id="error_descripcion"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group">
								<label>Area </label>
								<select id="area" name="area" class="form-control">
									<option value="" selected disabled hidden>Seleccione</option>
								@foreach($areas as $a)
									<option value="{{ $a->id }}" {{old('area') == $a->id ? 'selected':''}}>{{ $a->tipo_dato }} </option>
								@endforeach
								</select>
								<div id="error_area"></div>
							</div>
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
{{-- JS Datatables --}}

<script type="text/javascript">
	$(document).ready(function() {
		$('#myTable').DataTable({
			"responsive":true,
			"serverSide":true,
			"ajax":{url:"{{ url('api/dtespecialidades') }}",},
			"columns":[
				{data:'nombre'}, 
				{data:'descripcion'}, 
				{data:'tipo_dato'},
				{data:'button'},
			],
			"columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 3 },
            { responsivePriority: 3, targets: 1 }
            
          
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
	});

	$('#guardar').click(function() {
      	var esp_nombre = $('#esp_nombre').val();
		var descripcion = $('#descripcion').val();
		var area = $('#area').val();
		$('#error_esp_nombre').empty();
		$('#error_descripcion').empty();
		$('#error_area').empty();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
   		$.ajax({
            type:'POST',
            url:"/especialidades",
            dataType:"json",
            data:{
                esp_nombre:esp_nombre,
				descripcion:descripcion,
				area:area,
            },
            success: function(response){
				$('#exampleModal').modal('hide');
				var table = $('#myTable').DataTable();
                table.draw();
            },
            error:function(err){
				if (err.status == 422) { // when status code is 422, it's a validation issue
					$('#success_message').fadeIn().html(err.responseJSON.message);
					$.each(err.responseJSON.errors, function (i, error) {
						switch( i ){
							case "esp_nombre":
								$('#error_esp_nombre').html('<span style="color: red;">'+error[0]+'</span>');
							break;
							case "descripcion":
								$('#error_descripcion').html('<span style="color: red;">'+error[0]+'</span>');
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