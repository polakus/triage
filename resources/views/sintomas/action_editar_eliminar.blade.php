<button type="button" class="btn btn-outline-secondary btn-sm " style="width: 30%" data-toggle="modal" data-target="#editar{{ $id }}">Editar</button>
<button type="button" class="btn btn-outline-secondary btn-sm " style="width: 30%;" onclick="eliminar({{ $id }},'{{ $descripcion }}')">Eliminar</button>
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
                        <div id="div_nombre{{$id}}" class="form-row">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre{{$id}}" class="form-control" placeholder="Nombre" value="{{$descripcion}}">
                        </div>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="guardar" type="button" onclick="editar({{$id}})" class="btn btn-dark">Editar</button>
				<button onclick="reset_modal_edit({{$id}},'{{$descripcion}}')" type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<script>
function editar(id) {
    //limpia div para mensajes de error
    document.getElementById('nombre'+id).classList.remove('is-invalid');
    let spans = document.getElementsByClassName('invalid-feedback');
    while(spans.length>0){
        spans[0].remove();  //si son muchos podría haber error
    }
    var nombre = document.getElementById("nombre"+id).value;
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
        type:'PUT',
        url:"/sintomas/"+id,
        dataType:"json",
        data:{
            nombre:nombre,
        },
        success: function(response){
            $('#editar'+id).modal('hide');
            //ACTUALIZA TABLA
            var table = $('#myTable').DataTable();
            table.draw();
            //MUESTRA ALERTA
            $('#alerta').addClass('alert '+response.tipo);
            $('#alerta').html('<b>'+response.mensaje+'</b>');
            $("#alerta").fadeTo(4000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);
            });  
        },
        error:function(err){
            if (err.status == 422) { // when status code is 422, it's a validation issue
                document.getElementById('nombre'+id).classList.add('is-invalid');
                var ele_span = document.createElement('span');
                ele_span.setAttribute('class', 'invalid-feedback');
                ele_span.setAttribute('role', 'alert');
                ele_span.innerHTML = "<strong>" + err.responseJSON.errors.nombre + "</strong>";
                document.getElementById('div_nombre'+id).appendChild(ele_span);
            }
        }
    });
}
function reset_modal_edit(id, descripcion){
    document.getElementById('nombre'+id).classList.remove('is-invalid');
    document.getElementById('nombre'+id).value=descripcion;
    let spans = document.getElementsByClassName('invalid-feedback');
    while(spans.length>0){
        spans[0].remove();
    }
}

</script>
