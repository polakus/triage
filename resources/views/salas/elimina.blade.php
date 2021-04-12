{{-- <button type="button" id="bn{{$sala->id}}" onclick="elimina({{$sala->id}})" class="btn btn-outline-secondary btn-sm">Eliminar</button>
 --}}
<!-- Small modal -->
<button type="button"  class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#modalEliminar{{ $sala->id }}">Eliminar</button>

<div class="modal fade bd-example-modal-sm" id="modalEliminar{{ $sala->id }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro/a que deseas eliminar la sala?
        <li>Area: {{ $sala->area->nombre }}</li>
        <li>Sala: {{ $sala->nombre }}</li>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="bn{{$sala->id}}" onclick="elimina({{$sala->id}})"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
<script>

    function elimina(id) {
            $('#modalEliminar'+id).modal('hide');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'DELETE',
                url:"/salas/"+id,
                dataType:"json",
                success: function(response){
                    $('#myTable tbody').ready(function(){
                        $('#bn'+id).closest('tr').remove();
                    });
                },
                error:function(err){
                    alert("No se pudo eliminar la sala");
                }
            });
       }

</script>