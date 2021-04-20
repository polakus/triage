<div class="w-100 d-flex">
    @if($us->can('FullSintomas') or $us->can('EditarSintoma'))
    <button type="button" class="btn btn-outline-secondary btn-sm " style="width: 30%" data-toggle="modal" data-target="#editar{{ $sintoma->id }}">Editar</button>
    @endif
    @if($us->can('FullSintomas') or $us->can('EliminarSintoma'))
    <button type="button" class="btn btn-outline-secondary btn-sm ml-1" style="width: 30%;" data-toggle="modal" data-target="#modalEliminar{{ $sintoma->id }}">Eliminar</button>
    @endif
</div>
<div class="modal fade" id="editar{{$sintoma->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Editar síntoma</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <h6><strong style="color:red;">¡Cuidado! </strong>Si edita este síntoma el protocolo asociado al mismo se verá afectado también.</h6>
                <hr>
				<div class="container">
                    <div class="form-group">
                        <div id="div_nombre{{$sintoma->id}}" class="form-row">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="nombre{{$sintoma->id}}" class="form-control" placeholder="Nombre" value="{{$sintoma->descripcion}}">
                        </div>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button id="guardar" type="button" onclick="editar({{$sintoma->id}})" class="btn btn-dark">Editar</button>
				<button onclick="reset_modal_edit({{$sintoma->id}},'{{$sintoma->descripcion}}')" type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-sm" id="modalEliminar{{$sintoma->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro/a que deseas eliminar el sintoma?
        <li><strong>Sintoma: {{ $sintoma->descripcion }}</strong> </li>
        <!-- <li></li> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="bn{{$sintoma->id}}" onclick="eliminar({{ $sintoma->id }},'{{ $sintoma->descripcion }}')"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
        
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
