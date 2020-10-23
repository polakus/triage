@extends("triagepreguntas.test")



@section("cuerpo")

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">CIE</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">
              Agregar CIE
            </button>
		   
      </div>
    </div>
    </div>
	
	
	<div class="table-responsive">
	    <table class="table table-bordered table-sm table-hover" id="myTable">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Codigo</th>
		      <th scope="col">Descripcion</th>
		      <th scope="col">Accion</th>
		    </tr>
		  </thead>
		  <tbody id="tabla" >
		   	@foreach($cie as $c)
		   		<tr>
		   			<td>{{ $c->codigo }}</td>
		   			<td>{{ $c->descripcion }}</td>
		   			<td>
		   			<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar{{ $c->id }}">
		              Editar
		            </button>
		            <div class="modal fade" id="editar{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			            <div class="modal-dialog">
			              <div class="modal-content">
			                <div class="modal-header">
			                  <h3 class="modal-title" id="exampleModalLabel">Editar cie</h3>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                  </button>
			                </div>
			                <div class="modal-body">
			                  <div class="row col-md-16">
								<div class="form-group">
									<form method="POST" action="/cie/{{ $c->id }}">
										@csrf
										{{ method_field('PUT') }}
										<div class="table-responsive">
											<table class="table table-bordered"  id=tablita>
												<tr>
													<td width="100"><input type="text" name="editarcod" class="form-control" placeholder="Cod" value="{{ $c->codigo }}"></td>
													<td><input type="text" name="editardesc" class="form-control" value="{{ $c->descripcion }}" ></td>
													
												</tr>
											</table>
											
										</div>
										&nbsp 
										<button type="submit" class="btn btn-dark btn-sm">Editar</button>
									</form>
								</div>
								
							</div>
			                  
			                  
			                 
			                  
			                </div>
			                <div class="modal-footer">
			                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			                
			                </div>
			              </div>
			            </div>
			          </div>
			          </td>

		   		</tr>

		   	@endforeach
		  </tbody>
		</table>
	</div>
{{-- </div> --}}


<!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Registracion de Cie</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="/cie">
				@csrf
                <div class="modal-body">
                  <div class="row col-md-16">
					<div class="form-group">
						
							<div class="table-responsive">
								<table class="table table-bordered table-sm"  id=tabla_sintomas>
									<tr>
										<td width="100px;"><input type="text" name="ciecodigo[]" class="form-control" placeholder="Cod"></td>
										<td><input type="text" name="ciedescripcion[]" class="form-control"placeholder="Nombre"></td>
										<td><button type="button" id="add" name="add" class="btn btn-dark btn-sm">Agregar filas</button></td>
									</tr>
								</table>
								
							</div>
							&nbsp 
							
						
					</div>
					
				</div>
                  
                  
                 
                  
                </div>
                <div class="modal-footer">
                	<button type="submit" class="btn btn-success">Guardar</button>
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                	
                </div>
                </form>
              </div>
            </div>
          </div>



@endsection
@section("scripts")




<script >
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
	
		$('#tabla_sintomas').append('<tr id="row'+i+'">'+
						'<td><input type="text" name="ciecodigo[]" class="form-control"placeholder="Cod"></td>'+
						'<td><input type="text" name="ciedescripcion[]" class="form-control"placeholder="Nombre"></td>'+
						'<td><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn_remove">Quitar</button></td>'+
					'</tr>');
	});

	$(document).on('click','.btn_remove',function(){
		var id= $(this).attr('id');
		$('#row'+id).remove();
	});

})
</script>

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

