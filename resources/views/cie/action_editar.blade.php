<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar{{ $id }}">
    Editar
</button>
<div class="modal fade" id="editar{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="form-group">
                            <label for="inputEmail4">Código</label>    
                            <input type="text" id="editarcod{{$id}}" class="form-control" placeholder="Cod" value="{{ $codigo }}">
                            <div id="edit_error_codigo{{$id}}"></div>
                        </div>
                        <div class="form-group">
							<label for="inputEmail4">Nombre</label>
                            <input type="text" id="editardesc{{$id}}" class="form-control" value="{{ $descripcion }}" >
                            <div id="edit_error_nombre{{$id}}"></div>
						</div>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" onclick="cargarid({{ $id }})" class="btn btn-dark btn-sm">Editar</button>            
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>