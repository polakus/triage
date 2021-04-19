<div style="display:flex; width:100%;">
	  <a class="btn btn-sm btn-outline-secondary" onclick=VerPermisos({{ $rol->id }})> Ver Permisos</a>
    @if($us->hasAnyPermission(['EditarRol','FullRoles']))
    <a class="btn btn-sm btn-outline-secondary" href="roles/{{ $rol->id }}/edit"> Editar</a>
    @endif
    @if($us->hasAnyPermission(['EliminarRol','FullRoles']))
    <a class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalEliminar{{ $rol->id }}"> Eliminar</a>
    @endif
</div>




<div class="modal fade bd-example-modal-sm" id="modalEliminar{{ $rol->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
        <li>Rol: {{ $rol->name }}</li>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="bn{{$rol->id}}" onclick="eliminar({{$rol->id}})"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-sm" id="VerPermiso{{ $rol->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Permisos de Rol {{ $rol->name }}</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body{{ $rol->id }}">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>