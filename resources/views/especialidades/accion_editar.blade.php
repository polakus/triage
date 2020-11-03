<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar{{ $especialidades->id }}">
    Editar
</button>
<div class="modal fade" id="editar{{ $especialidades->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="text" id="nomb{{$especialidades->id}}" name="editarnomb" class="form-control" placeholder="Cod" value="{{ $especialidades->nombre }}">
                                <div id="error_edit_nomb{{$especialidades->id}}"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label>Descripcion </label>
                                <textarea class="form-control" id="desc{{$especialidades->id}}" name="editardesc" rows="3" value="{{$especialidades->descripcion}}">{{ $especialidades->descripcion }}</textarea>
                                <div id="error_edit_desc{{$especialidades->id}}"></div>
                            </div>
                        </div>
                        <div class="form-row">
							<div class="form-group">
								<label>Area </label>
								<select id="editarea{{$especialidades->id}}" name="editarea" class="form-control">
									<option value="" selected disabled hidden>Seleccione</option>
								@foreach($editareas as $a)
									<option value="{{ $a->id }}" {{$area_seleccionada == $a->id ? 'selected':''}}>{{ $a->tipo_dato }} </option>
								@endforeach
								</select>
								<div id="error_edit_area{{$especialidades->id}}"></div>
							</div>
						</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" onclick="editaresp({{$especialidades->id}})" class="btn btn-dark">Editar</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
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
                // alert("si");
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
</script>