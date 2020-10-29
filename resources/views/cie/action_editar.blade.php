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
                <div class="row col-md-16">
                    <div class="form-group">
                        <form method="put" action="{{route('cie.update', $id)}}"></form>
                            @csrf
                            {{ method_field('PUT')}}
                            <div class="table-responsive">
                                <table class="table table-bordered"  id=tablita>
                                    <tr>
                                        <td width="100"><input type="text" name="editarcod" class="form-control" placeholder="Cod" value="{{ $codigo }}"></td>
                                        <td><input type="text" name="editardesc" class="form-control" value="{{ $descripcion }}" ></td>
                                    </tr>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-dark btn-sm">Editar</button>
                        </form>
                    </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>