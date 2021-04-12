{{-- <buttons class="btn btn-sm btn-outline-secondary" id="btn{{$permiso->id}}" onclick="seleccionar_permiso({{ $permiso->id }})"> Agregar </buttons> --}}
<div style="display:flex; width:100%;">
	<a class="btn btn-sm btn-outline-secondary" onclick=VerPermisos({{ $id }})> Ver Permisos</a>
    <a class="btn btn-sm btn-outline-secondary" href="roles/{{ $id }}/edit"> Editar</a>
    <a class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalEliminar{{ $id }}"> Eliminar</a>
</div>




<div class="modal fade bd-example-modal-sm" id="modalEliminar{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro/a que deseas eliminar el rol?
        <li>Rol: {{ $name }}</li>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="bn{{$id}}" onclick="eliminar({{$id}})"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-sm" id="VerPermiso{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Permisos de Rol {{ $name }}</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body{{ $id }}">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>