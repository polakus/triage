
@if($us->hasAnyPermission(['EditarEspecialidad','FullEspecialidades']))
<button type="button" id="bnedit" class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#editar{{ $especialidad->id }}">
    Editar
</button>
@endif
<div class="modal fade" id="editar{{ $especialidad->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Editar especialidad</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container col-md-12">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="nomb{{$especialidad->id}}" name="editarnomb" class="form-control" placeholder="Cod" value="{{ $especialidad->nombesp }}">
                                <div id="error_edit_nomb{{$especialidad->id}}"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label>Descripcion </label>
                                <textarea class="form-control" id="desc{{$especialidad->id}}" name="editardesc" rows="3" value="{{$especialidad->descripcion}}">{{ $especialidad->descripcion }}</textarea>
                                <div id="error_edit_desc{{$especialidad->id}}"></div>
                            </div>
                        </div>
                        <div class="form-row">
							<div class="form-group col-md-10">
								<label>Area </label>
								<select id="editarea{{$especialidad->id}}" name="editarea" class="form-control select" style="width: 100% !important;" >
									{{-- <option value="" selected disabled hidden>Seleccione</option> --}}
								@foreach($editareas as $a)
									<option value="{{ $a->id }}" {{$especialidad->id_area == $a->id ? 'selected':''}}>{{ $a->nombre }} </option>
								@endforeach
								</select>
								<div id="error_edit_area{{$especialidad->id}}"></div>
							</div>
						</div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="editaresp({{$especialidad->id}})" class="btn btn-dark">Editar</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
     </div>
    </div>
</div>
@if($us->hasAnyPermission(['EliminarEspecialidad','FullEspecialidades']))
<button id="elid{{$especialidad->id}}" type="button" class="btn btn-sm btn-outline-secondary ml-1" onclick="eliminar('{{ $especialidad->nombesp }}','{{$especialidad->id}}')">Eliminar</button>
@endif
<script>
    var select2=$('.select').select2();
    function editaresp(id) {
      	var nombre = $('#nomb'+id).val();
		var descripcion = $('#desc'+id).val();
		var area = $('#editarea'+id).val();
		$('#error_edit_nomb'+id).empty();
		$('#error_edit_desc'+id).empty();
		$('#error_edit_area'+id).empty();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
   		$.ajax({
            type:'PUT',
            url:"/especialidades/"+id,
            dataType:"json",
            data:{
                esp_nombre:nombre,
				descripcion:descripcion,
				area:area,
            },
            success: function(response){
				$('#editar'+id).modal('hide');
				var table = $('#myTable').DataTable();
                table.draw();
            },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
					$('#success_message').fadeIn().html(err.responseJSON.message);
					$.each(err.responseJSON.errors, function (i, error) {
						switch( i ){
							case "esp_nombre":
								$('#error_edit_nomb'+id).html('<span style="color: red;">'+error[0]+'</span>');
							break;
							case "descripcion":
								$('#error_edit_desc'+id).html('<span style="color: red;">'+error[0]+'</span>');
							break;
							case "area":
								$('#error_edit_area'+id).html('<span style="color: red;">'+error[0]+'</span>');
							break;
							default:
								alert("Ocurrió un error en la función de error de ajax");
						}
					});
				}
            }
        });
	}


    function eliminar(name, id){
         if (confirm('¿Esta seguro de eliminar la especialidad'+name+' ? Tenga en cuenta que se eliminara todos los datos relacionados a ella.')) {
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'DELETE',
                url:"/especialidades/"+id,
                dataType:"json",
                success: function(response){
                    $('#myTable tbody').ready(function(){
                        $('#elid'+id).closest('tr').remove();
                    });
                },
                error:function(err){
                    // if (err.status == 422) { // when status code is 422, it's a validation issue
                        
                    // }
                    alert("no elimino");
                }
            });
        }
    }
</script>