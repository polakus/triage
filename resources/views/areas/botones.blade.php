<div class="d-flex w-100">
  @if($us->hasAnyPermission(['EditarArea','FullSalas']))
  <button type="button"  class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#modal_editar_area{{$area->id}}">Editar</button>
  @endif
  @if($us->hasAnyPermission(['EliminarArea','FullSalas']))
  <button type="button"  class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#modalEliminarArea{{$area->id}}">Eliminar</button>
  @endif
</div>
<!-- Modal Edit -->
<div class="modal fade" id="modal_editar_area{{$area->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Editar Área</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="div_edit_area{{$area->id}}" class="form-group">
                    <label for="nombarea">Nombre</label>
                    <input type="text" id="nombarea{{$area->id}}" name="nombarea" class="form-control" placeholder="Nombre" value="{{$area->nombre}}">
                </div>
            </div>
            <div class="modal-footer">
                <button  onclick="editararea({{$area->id}})"type="button" class="btn btn-dark">Guardar</button>
                <button id="eliminarea{{$area->id}}" type="button" onclick="reset_modal_edit({{$area->id}}, '{{$area->nombre}}')" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin modal -->

<!-- Modal Delete -->
<div class="modal fade bd-example-modal-sm" id="modalEliminarArea{{$area->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alerta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Estas seguro/a que deseas eliminar el área?
        <li><strong>Área : {{ $area->nombre }}</strong></li>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="btn_area{{$area->id}}" onclick="eliminarea({{$area->id}})"><i class="far fa-check-circle"></i> Eliminar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin modal -->

<script>
function editararea(id) {
  document.getElementById('nombarea'+id).classList.remove('is-invalid');
  let spans = document.getElementsByClassName('invalid-feedback');
  while(spans.length>0){
    spans[0].remove();  //si son muchos podría haber error
  }
  var nombre = document.getElementById('nombarea'+id).value;
  // $('#error_nombre').empty();
  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
  $.ajax({
    type:'PUT',
    url:"/areas/"+id,
    dataType:"json",
    data:{
        nombre: nombre,
    },
    success: function(response){
      $('#modal_editar_area'+id).modal('hide');
      var table = $('#tableAreas').DataTable();
      table.draw();

      $('#alerta').addClass('alert '+response.tipo);
      $('#alerta').html('<b>'+response.mensaje+'</b>');
      $("#alerta").fadeTo(4000, 500).slideUp(500, function(){
          $("#alerta").slideUp(500);
      });
    
      quitaOpcion(id,"areac");
      agregaOpcion(id,nombre,"areac");
    },
    error:function(err){
      if (err.status == 422) { // when status code is 422, it's a validation issue
        document.getElementById('nombarea'+id).classList.add('is-invalid');
        var ele_span = document.createElement('span');
        ele_span.setAttribute('class', 'invalid-feedback');
        ele_span.setAttribute('role', 'alert');
        ele_span.innerHTML = "<strong>" + err.responseJSON.errors.nombre + "</strong>";
        document.getElementById('div_edit_area'+id).appendChild(ele_span);
      }
    }
  });
}
function eliminarea(id) {
  // var modal = $('#modalEliminarArea'+id);
  $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
  });
  $.ajax({
    type:'DELETE',
    url:"/areas/"+id,
    dataType:"json",
    success: function(response){
      // var table = $('#tableAreas').DataTable();
      // table.draw();
      // modal.modal('hide');
      $('#tableAreas tbody').ready(function(){
        $('#btn_area'+id).closest('tr').remove();
      });

      $('#alerta').addClass('alert '+response.tipo);
      $('#alerta').html('<b>'+response.mensaje+'</b>');
      $("#alerta").fadeTo(4000, 500).slideUp(500, function(){
          $("#alerta").slideUp(500);
      });
      quitaOpcion(id,"areac");
    },
    error:function(err){
      // if (err.status == 422) { // when status code is 422, it's a validation issue
      // }
        alert("Hubo un problema al intentar eliminar el área");
    }
  });
}
function reset_modal_edit(id, nombre){
  document.getElementById('nombarea'+id).classList.remove('is-invalid');
  document.getElementById('nombarea'+id).value=nombre;
  let spans = document.getElementsByClassName('invalid-feedback');
  while(spans.length>0){
    spans[0].remove();
  }
}
</script>