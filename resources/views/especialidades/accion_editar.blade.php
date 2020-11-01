<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar{{ $id }}">
    Editar
</button>
<div class="modal fade" id="editar{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Editar especialidad</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="/especialidades/{{ $id }}">
                @csrf
                <div class="modal-body">
                    <div class="container col-md-12">
                        <div class="form-group">
                            {{ method_field('PUT') }}
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" id="nomb{{$id}}" name="editarnom" class="form-control" placeholder="Cod" value="{{ $nombre }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label>Descripcion </label>
                                    <textarea class="form-control" id="desc{{$id}}" name="des" rows="3">{{ $descripcion }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark">Editar</button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>