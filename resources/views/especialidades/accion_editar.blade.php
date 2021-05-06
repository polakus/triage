<div class="w-100 d-flex">
    @if($us->hasAnyPermission(['EditarEspecialidad','FullEspecialidades']))
    <button type="button" id="bnedit" class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#editar{{ $especialidad->id }}">
        Editar
    </button>
    @endif
    @if($us->hasAnyPermission(['EliminarEspecialidad','FullEspecialidades']))
    <button id="elid{{$especialidad->id}}" type="button" class="btn btn-sm btn-outline-secondary ml-1" data-toggle="modal" data-target="#modalEliminar{{ $especialidad->id }}" >Eliminar</button>
    @endif
</div>

<div class="modal fade" id="editar{{ $especialidad->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Editar especialidad</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container col-md-12">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" id="nomb{{$especialidad->id}}" name="editarnomb" class="form-control" placeholder="Cod" value="{{ $especialidad->nombesp }}">
                                <div id="error_edit_nomb{{$especialidad->id}}"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label>Descripcion </label>
                                <textarea class="form-control" id="desc{{$especialidad->id}}" name="editardesc" rows="3" value="{{$especialidad->descripcion}}">{{ $especialidad->descripcion }}</textarea>
                                <div id="error_edit_desc{{$especialidad->id}}"></div>
                            </div>
                        </div>
                        <div class="form-row">
							<div class="form-group col-md-10">
								<label>Area </label>
								<select id="editarea{{$especialidad->id}}" name="editarea" class="form-control select" style="width: 100% !important;" >
									{{-- <option value="" selected disabled hidden>Seleccione</option> --}}
								@foreach($editareas as $a)
									<option value="{{ $a->id }}" {{$especialidad->id_area == $a->id ? 'selected':''}}>{{ $a->nombre }} </option>
								@endforeach
								</select>
								<div id="error_edit_area{{$especialidad->id}}"></div>
							</div>
						</div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="editaresp({{$especialidad->id}})" class="btn btn-dark">Editar</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
     </div>
    </div>
</div>


<div class="modal fade bd-example-modal-sm" id="modalEliminar{{$especialidad->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro/a que deseas eliminar la especialidad?
        <li><strong>Especialidad:</strong>{{ $especialidad->nombesp }}</li>
        <!-- <li></li> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="eliminar('{{ $especialidad->nombesp }}','{{$especialidad->id}}')"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
