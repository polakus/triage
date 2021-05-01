@extends("triagepreguntas.test")

@section("cuerpo")
	<div id="alerta"></div>
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">CIE</h4>
        @canany(['FullCie','RegistrarCie'])
        <div class="btn-toolbar mb-2 mb-md-0">
			<button onclick="reset_modal_create()" type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" style="width: 100%;" data-target="#exampleModal">
				Agregar CIE
			</button>
    	</div>
    	@endcanany
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
		  <tbody>

		  </tbody>
		</table>
	</div>

<!-- Modal Create-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h3 class="modal-title" id="exampleModalLabel">Registracion de Cie</h3>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
			<div class="modal-body">
				<div class="container">
					<div class="form-group">
						<div class="form-group">
							<label for="inputEmail4">Código</label>
							<input type="text" name="codigo" id="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo') }}" placeholder="Código">
							<div id="error_codigo"></div>
						</div>
						<div class="form-group">
							<label for="inputEmail4">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Nombre">
							<div id="error_nombre"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="guardar" class="btn btn-success">Guardar</button>
				<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- fin modal -->

<!-- Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Editar cie</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="form-group">
                        <input type="hidden" id="editar_id_cie">
                        <div class="form-group">
                            <label for="inputEmail4">Código</label>    
                            <input type="text" id="editarcod" class="form-control" placeholder="Cod">
                            <div id="edit_error_codigo"></div>
                        </div>
                        <div class="form-group">
							<label for="inputEmail4">Nombre</label>
                            <input type="text" id="editardesc" class="form-control" >
                            <div id="edit_error_nombre"></div>
						</div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" onclick="editarCie()" class="btn btn-dark">Editar</button>            
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal -->

<!-- Modal eliminar -->
<div class="modal fade bd-example-modal-sm" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro/a que deseas eliminar el CIE?
        <li><strong id="seguro-eliminar">CIE: -</strong></li>
		<input type="hidden" id="eliminar-id-cie">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="bn" onclick="eliminarCie()"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal -->
@endsection
@section("scripts")

<script type="text/javascript">
	function iniModalEditar(codigo, descripcion, id){
		document.getElementById('editar_id_cie').value = id;
		document.getElementById('editarcod').value = codigo;
		document.getElementById('editardesc').value = descripcion;
	}
	function iniModalEliminar(codigo, descripcion, id){
		var strong = document.getElementById('seguro-eliminar')
		strong.innerHTML = "CIE: "+codigo+" - "+descripcion;
		document.getElementById('eliminar-id-cie').value=id;
	}
	$(document).ready(function() {
		var us=<?php echo Auth::id();?>;
		var tabla = $('#myTable').DataTable({
			"responsive":true,
			"serverSide":true,
			"processing":true,
			"ajax":{url:"api/cargar_cie/"+us},
			"columns":[
				{data:'codigo'}, 
				{data:'descripcion'}, 
				{data:'button'},
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
				"processing": '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> ',
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
      	var nombre = $('#nombre').val();
		var codigo = $('#codigo').val();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
   		$.ajax({
            type:'POST',
            url:"/cie",
            dataType:"json",
            data:{
                nombre:nombre,
				codigo:codigo,
            },
            success: function(response){
				//VACIA INPUTS
				document.getElementById('nombre').value='';
				document.getElementById('codigo').value='';
				//OCULTA MODAL
				$('#exampleModal').modal('hide');
				//ACTUALIZA TABLA
				var table = $('#myTable').DataTable();
                table.draw();
				//MUESTRA ALERTA
				$('#alerta').addClass('alert '+response.tipo);
				$('#alerta').html('<b>'+response.mensaje+'</b>');
				$("#alerta").fadeTo(2000, 500).slideUp(500, function(){
					$("#alerta").slideUp(500);
				});  
            },
            error:function(err){
				if (err.status == 422) { // when status code is 422, it's a validation issue
					// $('#success_message').fadeIn().html(err.responseJSON.message);
					$.each(err.responseJSON.errors, function (i, error) {
						if(i=="nombre"){
							$('#error_nombre').html('<span style="color: red;">'+error[0]+'</span>');
						}else{
							$('#error_codigo').html('<span style="color: red;">'+error[0]+'</span>');
						}
					});
				}
            }
        });
	});

	function editarCie() {
		var id = $('#editar_id_cie').val();
		var nombre = $('#editardesc').val();
      	var codigo = $('#editarcod').val();
		$.ajaxSetup({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
		});
   		$.ajax({
            type:'PUT',
            url:"/cie/"+id,
            dataType:"json",
            data:{
                nombre:nombre,
				codigo:codigo,
            },
            success: function(response){
				$('#editar').modal('hide');
				var table = $('#myTable').DataTable();
                table.draw();
				// $('#myTable tbody').ready(function(){
				// 	$('#btn-editar-'+id).closest('tr').remove();
				// });
				//MUESTRA ALERTA
				
				$('#alerta').addClass('alert '+response.tipo);
				$('#alerta').html('<b>'+response.mensaje+'</b>');
				$("#alerta").fadeTo(4000, 500).slideUp(500, function(){
					$("#alerta").slideUp(500);
				});
            },
            error: function(err){
				if (err.status == 422) { // when status code is 422, it's a validation issue
					// $('#success_message').fadeIn().html(err.responseJSON.message);
					$.each(err.responseJSON.errors, function (i, error) {
						if(i=="nombre"){
							$('#edit_error_nombre').html('<span style="color: red;">'+error[0]+'</span>');
						}else{
							$('#edit_error_codigo').html('<span style="color: red;">'+error[0]+'</span>');
						}
					});
				}
            }
        });
	}
	function eliminarCie(){
		$('#modalEliminar').modal('hide');
		var id = document.getElementById('eliminar-id-cie').value;
		$.ajaxSetup({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
		});
		$.ajax({
			type:'DELETE',
			url:"/cie/"+id,
			dataType:"json",
			success: function(response){
				var table = $('#myTable').DataTable();
				table.draw();
				$('#alerta').addClass('alert '+response.tipo);
				$('#alerta').html('<b>'+response.mensaje+'</b>');
				$("#alerta").fadeTo(2000, 500).slideUp(500, function(){
					$("#alerta").slideUp(500);
				});
			},
			error:function(err){
				alert("Hubo un error al intentar eliminar elemento");
			}
		});
	}

	function reset_modal_create(id, nombre){
		document.getElementById('codigo').value="";
		document.getElementById('nombre').value="";
		document.getElementById('error_codigo').innerHTML="";
		document.getElementById('error_codigo').innerHTML="";
	}

</script>

@endsection

