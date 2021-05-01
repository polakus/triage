@extends("triagepreguntas.test")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div id="alert" role="alert"> </div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Usuarios pendiente</h4>
  </div>

  <div class="form-row">
    <div class="form-group col-md-2">
      <a class="btn btn-dark" href="{{ route('usuarios.index') }}">Volver</a>
    </div>
  </div>
		
  <div class="table-responsive">
    
    <table id="tpend" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
      <thead class="thead-dark">
        <tr>
          <th scope="col" >Usuario</th>
          <th scope="col" >Email</th>
          <th scope="col" >Acción<nav></nav></th>
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
  </div>

@endsection
@section("scripts")



<script type="text/javascript">
  $(document).ready(function() {
    $('#tpend').DataTable({
      "processing":true,
      "responsive":true,
      "serverSide":true,
      "ajax":{url:"{{ url('api/usuariospendientes') }}",},
         "columns":[
            {data:'username'},
            {data:'email'},
            {data:'buttons'}
          ],
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
         "processing": '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> ',
        "search": "Buscar:",
        "searchPlaceholder": "",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
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
  });

</script>




@endsection

@section("pie")
    
@endsection