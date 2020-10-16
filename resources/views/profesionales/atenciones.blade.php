@extends('triagepreguntas.test')

@section('cuerpo')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Pacientes atendidos</h1>
        
</div>
<div class="form-row">

  <div class="form-group col-md-2">
      <label for="inputState">Profesional</label>
      <input type="text" id="buscar" class="form-control form-control-sm">
  </div>

{{--   <div class="form-group col-md-2">
      <label for="inputState">Fecha Desde</label>
      <input type="date" class="form-control form-control-sm" data-date-format="DD-MMMM-YYYY" name="fecha" id="fecha_buscar">
  </div> 
   --}}
  
</div>
<label>Filtro para buscar por un rango de fechas:</label>
<div class="table">
  <div class="row">
    <div class="col-md-2">
      <input type="date" class="form-control form-control-sm" data-date-format="DD-MMMM-YYYY" name="fecha" id="fecha_desde">
    </div>
     <div class="col-md-2">
      <input type="date" class="form-control form-control-sm" data-date-format="DD-MMMM-YYYY" name="fecha" id="fecha_hasta">
    </div>
     <div class="col-md-2">
      <button class="btn btn-dark btn-sm" id="search">Buscar</button>
    </div>
    
  </div>
</div>

<div class="table-responsive ">
        <table id ="myTable" class="table table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th>Matricula</th>
              <th >Profesional</th>
              <th >Paciente</th>
              <th >Fecha y hora de atencion</th>
             
            </tr>
           
          </thead>
          
          <tbody>
          </tbody>
        </table>
</div>
@endsection

@section("scripts")
{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  
</script>

<script type="text/javascript">
   $(document).ready(function() {
      function fechas(desde,hasta){
        var table=$('#myTable').DataTable({
          "processing":true,
          "serverSide":true,
           "ajax":{url:"{{ url('api/profesionales') }}",
                   data:{desde:desde,hasta:hasta}
         },
           "columns":[
            {data:'matricula'},
            {data:'full_name'
          },
            {data:'full_name_paciente'},
            {data:'fecha'}
            
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

         // Funcion para hacer busquedas 
        searchByColumn(table);
        function searchByColumn(table){
         $(document).on('keyup change','#buscar',function(){
           // table.search('').columns().search(this.value).draw();
           table.columns(1).search(this.value).draw()

         });
         
        };
    
      };
     
      fechas("","");
      $('#search').click(function(){
           var desde = $('#fecha_desde').val();
           var hasta = $('#fecha_hasta').val();


           if(desde>hasta){ alert("Rango incorrecto... La fecha desde es superior a la fecha hasta")}
           else{$('#myTable').DataTable().destroy(); fechas(desde,hasta)};

      });

} );
 

//     // Funcion para hacer busquedas 
//     searchByColumn(table);
//     function searchByColumn(table){
//     	$(document).on('keyup change','#buscar',function(){
//     		table.search('').columns().search('').draw();
//     		table.columns(1).search(this.value).draw()

//     	});
//     	$(document).on('change','#fecha_buscar',function(){
//     		table.search('').columns().search('').draw();
//     		table.columns(3).search(this.value).draw()

//     	});
//     }
// } 
// );

// $('#myTable thead tr').clone(true).appendTo('#myTable thead');
// $('#myTable thead tr:eq(1) th').each(function(i){
//   var title=$(this).text();
//   $(this).html('<input type="text" placeholder="Buscar..." />');
//   $('input',this).on('keyup change',function(){
//     if(table.column(i).search()!== this.value){
    
//       table
//         .column(i)
//         .search(this.value)
//         .draw()
//     }
//   })
// })

 

</script>
@endsection