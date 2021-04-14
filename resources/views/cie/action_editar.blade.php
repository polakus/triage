<style type="text/css">
    .btn{
        width: 45%;
        margin: 1px;
    }
    @media only screen and (max-width: 400px){
        .btn{
            width: 100%;
            margin: 1px;
        }
    }
</style>

@if($us->can('FullCie') or $us->can('EditarCie'))
<button type="button" class="btn btn-outline-secondary btn-sm "  data-toggle="modal" data-target="#editar{{ $enfermedad->id }}">
    Editar
</button>
@endif
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
@if($us->can('FullCie') or $us->can('EliminarCie'))
<button type="button" class="btn btn-outline-secondary btn-sm "  id="eliminarcie" onclick="eliminarCie({{$enfermedad->id}})">
    Eliminar
</button>
@endif