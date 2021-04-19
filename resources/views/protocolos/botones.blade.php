<div class="d-flex w-100">
  @if($us->hasAnyPermission(['EditarProtocolo','FullProtocolos'])) 
  	<a class="btn btn-sm btn-outline-secondary ml-1" href="/protocolos/{{$protocolo->id}}/edit">Editar</a>
  @endif
  @if($us->hasAnyPermission(['EliminarProtocolo','FullProtocolos']))
      <button class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#modalEliminar{{ $protocolo->id }}">Eliminar</button>
  @endif
</div>



<div class="modal fade bd-example-modal-sm" id="modalEliminar{{$protocolo->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro/a que deseas eliminar el protocolo?
        <li><strong>Protocolo:</strong>{{ $protocolo->descripcion }}</li>
        <!-- <li></li> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="eliminar('{{ $protocolo->descripcion }}','{{$protocolo->id}}')"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
        
      </div>
    </div>
  </div>
</div>