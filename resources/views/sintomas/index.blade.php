@extends("triagepreguntas.test")

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Sintomas</h4>
  <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#exampleModal">
          Agregar sintoma
        </button>
      </div>
    </div>
</div>
<div class="table-responsive">
 <table class="table table-bordered table-striped table-hover table-sm" id="myTable">
  <thead>
    <tr>
      <th scope="col" >#</th>
      <th scope="col">Sintomas</th>
      <th scope="col" >Accion</th>
    </tr>
  </thead>
  <tbody>
   @foreach($sintomas as $sintoma)
      <tr>
        <form class= "form-inline" method="POST" action="/sintomas/{{ $sintoma->id }} ">
          @csrf
          {{ method_field('DELETE') }}
          <td>{{ $sintoma->id }}</td>
          <td>{{ $sintoma->descripcion }}</td>
          <td><button type="submit" class="btn btn-danger btn-sm">Eliminar</button></td>
        </form>
      </tr>


   @endforeach
  </tbody>
</table>
</div>
<!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Registracion de Sintomas</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="/sintomas">
                      @csrf
            <div class="modal-body">
             <div class="row col-md-10">
                  <div class="form-group">
                    
                      <div class="table-responsive">
                        <table class="table table-sm table-bordered"  id=tabla_sintomas>
                          <tr>
                            <td><input type="text" name="text_sintomas[]" class="form-control" placeholder="Nombre del Sintoma"></td>
                            <td><button type="button" id="add" name="add" class="btn btn-dark btn-sm">Agregar filas</button></td>
                          </tr>
                        </table>
                        
                      </div>
                      
                  </div>
                  
                </div>
              
              
             
              
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success ">Guardar</button>
              <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
          
                   
            </div>
             </form>
          </div>
        </div>
      </div>


@endsection
@section("scripts")

<script >
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;

    $('#tabla_sintomas').append('<tr id="row'+i+'">'+
            '<td><input type="text" name="text_sintomas[]" class="form-control" placeholder="Nombre del Sintoma"></td>'+
            '<td><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn-sm btn_remove">Quitar</button></td>'+
          '</tr>');
  });

  $(document).on('click','.btn_remove',function(){
    var id= $(this).attr('id');
    $('#row'+id).remove();
  });

})
</script>


{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
      
      
       "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        //only works for built-in buttons, not for custom buttons
        "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
    }           
    });
} );
</script>
@endsection
