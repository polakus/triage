<button type="button" class="btn btn-outline-secondary btn-sm " style="width: 20%" data-toggle="modal" data-target="#editar{{ $id }}">Editar</button>
<button type="button" class="btn btn-outline-secondary btn-sm " style="width: 20%;" onclick="eliminar({{ $id }},'{{ $descripcion }}')">Eliminar</button>
<div class="modal fade" id="editar{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Editar síntoma</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <h6><strong style="color:red;">¡Cuidado! </strong>Si edita este síntoma el protocolo asociado al mismo se verá afectado también.</h6>
                <hr>
				<div class="container">
                    <div class="form-group">
                        <div class="form-row">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre{{$id}}" name="nombre" class="form-control" placeholder="Nombre" value={{$descripcion}}>
                        </div>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="guardar" type="button" onclick="editar({{$id}})" class="btn btn-dark">Editar</button>
				<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
function editar(id) {
        var nombre_sintoma = document.getElementById("nombre"+id).value;
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        $.ajax({
            type:'PUT',
            url:"/sintomas/"+id,
            dataType:"json",
            data:{
                nombre_sintoma:nombre_sintoma,
            },
            success: function(response){
                // var table = $('#myTable').DataTable();
                // table.draw();
                // var inputNombre = document.getElementById("nombre_sintoma");
                // inputNombre.value="";
                alert("si");

                // document.getElementById('desc').classList.add('is-invalid');
                // var ele_span = document.createElement('span');
                // ele_span.setAttribute('class', 'invalid-feedback');
                // ele_span.setAttribute('role', 'alert');
                // ele_span.innerHTML = "<strong>" + err.responseJSON.errors.desc + "</strong>";
                // document.getElementById('div_desc').appendChild(ele_span);
            },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
                    alert("no");
                    // console.log(err.responseJSON);
                    // $('#success_message').fadeIn().html(err.responseJSON.message);
                    // $.each(err.responseJSON.errors, function (i, error) {
                    //     $('#error_sintoma').html('<span style="color: red;">'+error[0]+'</span>');
                    // });
                }
            }
        });
    }

</script>
