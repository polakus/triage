<div class="w-100 d-flex">
    @if($us->can('FullSintomas') or $us->can('EditarSintoma'))
    <button type="button" onclick="iniEditModal({{$sintoma->id}},'{{$sintoma->descripcion}}',{{$sintoma->dias}},{{$sintoma->horas}})" style="width: 30%" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalEditar">Editar</button>
    @endif
    @if($us->can('FullSintomas') or $us->can('EliminarSintoma'))
    <button type="button" class="btn btn-outline-secondary btn-sm ml-1" style="width: 30%;" data-toggle="modal" data-target="#modalEliminar{{ $sintoma->id }}">Eliminar</button>
    @endif
</div>
{{--
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
--}}
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
        <h6><strong style="color:red;">¡Cuidado! </strong>Si elimina este síntoma el protocolo asociado al mismo se verá afectado también.</h6>
        <hr>
        <h6>Estas seguro/a que deseas eliminar el sintoma?</h6>
        <h6><li><strong>Sintoma: {{ $sintoma->descripcion }}</strong> </li></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="bn{{$sintoma->id}}" onclick="eliminar({{ $sintoma->id }},'{{ $sintoma->descripcion }}')"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
        
      </div>
    </div>
  </div>
</div>

