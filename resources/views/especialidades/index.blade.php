@extends("triagepreguntas.test")




@section("cuerpo")

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Protolocos</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
              Agregar un protocolo
            </button>
          </div>
        </div>
</div>
	
	

	<div class="table-responsive">
	    <table class="table table-bordered table-hover table-sm table-striped" id="myTable">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Nombre</th>
		      <th scope="col">Descripcion</th>
		      <th scope="col">Areas</th>
		      <th scope="col">Accion</th>
		    </tr>
		  </thead>
		  <tbody id="tabla" >
		   	@foreach($especialidades as $e)
		   		<tr>
		   			<td>{{ $e->nombre }}</td>
		   			<td>{{ $e->descripcion }}</td>
		   			<td>{{ $e->tipo_dato }}</td>
		   			<td>
		   			<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar{{ $e->id }}">
		              Editar
		            </button>
		            <div class="modal fade" id="editar{{ $e->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			            <div class="modal-dialog">
			              <div class="modal-content">
			                <div class="modal-header">
			                  <h3 class="modal-title" id="exampleModalLabel">Editar especialidad</h3>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                  </button>
			                </div>
			                <form method="POST" action="/especialidades/{{ $e->id }}">
							@csrf
			                <div class="modal-body">
			                   <div class="container col-md-12">
								<div class="form-group">
									
										{{ method_field('PUT') }}
										<div class="form-row">
											<div class="form-group">
												<label>Nombre</label>
												<input type="text" name="editarnom" class="form-control" placeholder="Cod" value="{{ $e->nombre }}">
											</div>

										</div>
										<div class="form-row">
											<div class="form-group col-md-10">
												<label>Descripcion </label>
												<textarea class="form-control" id="d" name="des" rows="3">{{ $e->descripcion }}</textarea>
											</div>
										</div>
										
										
										
									
								</div>
								
							</div>
			                  
			                  
			                 
			                  
			                </div>
			                <div class="modal-footer">
			                	<button type="submit" class="btn btn-dark">Editar</button>
			                	
			                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			                
			                </div>
			                </form>
			              </div>
			            </div>
			          </div>
			          </td>

		   		</tr>

		   	@endforeach
		  </tbody>
		</table>
</div>


<!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Registracion de Especialidad</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="/especialidades">
					@csrf
                <div class="modal-body">
                   <div class="container">
					<div class="form-group">
						
							<div class="form-row">
									<div class="form-group">
											<label>Nombre</label>
											<input type="text" name="esp_nombre" class="form-control" placeholder="Nombre">
									</div>

							</div>
							<div class="form-row">
									<div class="form-group col-md-10">
										<label>Descripcion </label>
										<textarea class="form-control" name="descripcion" rows="3" placeholder="Descripcion"></textarea>
									</div>
							</div>
								<div class="form-row">
									<div class="form-group">
										<label>Area </label>
										<select class="form-control">
											@foreach($areas as $a)
												<option value="{{ $a->id }}">{{ $a->tipo_dato }} </option>

											@endforeach
										</select>
									</div>
							</div>

						
					</div>
					
				</div>
                  
                  
                 
                  
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-dark">Guardar</button>
                  
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                
                </div>
                </form>
              </div>
            </div>
          </div>

@endsection
@section("scripts")
{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
      
      
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
</script>







@endsection