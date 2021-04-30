
<div class="d-flex w-100">
    @if($us->hasAnyPermission(['FullCie','EditarCie']))
    <button type="button" class="btn btn-outline-secondary btn-sm "  data-toggle="modal" data-target="#editar{{ $enfermedad->id }}">
        Editar
    </button>
    @endif
    @if($us->hasAnyPermission(['FullCie','EliminarCie']))
    <button type="button" class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#modalEliminar{{ $enfermedad->id }}"  id="eliminarcie" >
        Eliminar
    </button>
    @endif
</div>
<div class="modal fade" id="editar{{ $enfermedad->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <!-- <input type="text" id="idcie" value="{{$enfermedad->id}}"> -->
                        <div class="form-group">
                            <label for="inputEmail4">Código</label>    
                            <input type="text" id="editarcod{{$enfermedad->id}}" class="form-control" placeholder="Cod" value="{{ $enfermedad->codigo }}">
                            <div id="edit_error_codigo{{$enfermedad->id}}"></div>
                        </div>
                        <div class="form-group">
							<label for="inputEmail4">Nombre</label>
                            <input type="text" id="editardesc{{$enfermedad->id}}" class="form-control" value="{{ $enfermedad->descripcion }}" >
                            <div id="edit_error_nombre{{$enfermedad->id}}"></div>
						</div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cargarid({{ $enfermedad->id }})" class="btn btn-dark">Editar</button>            
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-sm" id="modalEliminar{{ $enfermedad->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
        <li><strong>CIE: {{ $enfermedad->codigo }}-{{ $enfermedad->descripcion }}</strong></li>
        <!-- <li></li> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="bn{{$enfermedad->id}}" onclick="eliminarCie({{$enfermedad->id}})"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
        
      </div>
    </div>
  </div>
</div>