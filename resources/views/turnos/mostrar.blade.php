@extends("triagepreguntas.test")



@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Atenciones</h4>
</div>

<div class="form-row">


  <div class="form-group col-md-2">
      <label for="inputState">Condicion</label>
      <select name="cod" id="cod" class="form-control form-control-sm">
        <option value="Todas" selected>Todas</option>
        <option value="Operar">Operar</option>
        <option value="Internar" >Internar</option>
        <option value="Shock Room">Shoock Room</option>
        <option value="consulta" >Consulta</option>

        <option value="Internado">Internado</option>

        <option value="Operado" >Operado</option>
        <option value="alta"> Alta</option>

      </select>
  </div>

  <div class="form-group col-md-2">
      <label for="inputState">Fecha</label>
      <input type="date" class="form-control form-control-sm" data-date-format="DD-MMMM-YYYY" name="fecha" id="fecha">
  </div>
</div>

<div class="table-responsive">
        <table class="table table-striped table-hover table-bordered table-sm" id="example" >
          <thead>
            <tr>
              <th width="100px">Nombre y Apellido</th>
              <th>Fecha y hora</th>
              <th>Areas</th>
              <th>Especialidades</th>
              <th>Condicion</th>
              <th>Observacion</th>
              <th width="100px">Sala de internacion</th>
              <th >Sala de operacion</th>
              <th width="70px">Accion</th>
            </tr>
          </thead>
          <tbody id="tabla">

          </tbody>
        </table>
</div>



@endsection
@section("scripts")


<script type="text/javascript">

  // var fecha = new Date(); //Fecha actual
  // var mes = fecha.getMonth()+1; //obteniendo mes
  // var dia = fecha.getDate(); //obteniendo dia
  // var ano = fecha.getFullYear(); //obteniendo año
  // if(dia<10)
    // dia='0'+dia; //agrega cero si el menor de 10
  // if(mes<10)
    // mes='0'+mes //agrega cero si el menor de 10
  // document.getElementById('fecha').value=ano+"-"+mes+"-"+dia;
  // $('input').on('change', function() {
   
  //     $("#tabla tr").filter(function() {
  //         $(this).toggle($(this).text().toLowerCase().indexOf($('#fecha').val().toLowerCase()) > -1)
  //       });
    
    
  //   }).trigger('change');
</script>
<script type="text/javascript">
  $(document).ready(function() {
   
    var table=$('#example').DataTable({
      "serverSide":true,
           "ajax":{url:"{{ url('api/mostrar') }}",
              
         },
           "columns":[
            {data:'paciente_full',"orderable": "false"},
            {data:'fecha_hora'},
            {data:'tipo_dato'},
            {data:'especialidad'},
            {data:'estado'},
            {data:'observacion'},
            {data:'Internacion'},
            {data:'Operar'},
            {data:'DarAlta'}
           ],
         "createdRow": function( row, data, dataIndex){
                          if(data.color=="rojo"){

                           $(row).css('background-color', '#F39B9B');
                          }
                          else{
                            if(data.color=="verde"){
                              $(row).css('background-color','#85F361');
                             
                            }
                            else{
                              $(row).css('background-color','#DEE512')
                            }
                          }
                         },
      "processing":true,
      "ordering": false,
      "iDisplayLength": 10,
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
      
      $(document).on('change','#cod',function(){
        if(this.value=="Todas"){
          table.search('').columns().search('').draw();
          table.columns(4).search('').draw();
        }
        else{
          table.search('').columns().search('').draw();
          table.columns(4).search(this.value).draw();
        }

      });

      $(document).on('change','#fecha',function(){
        table.search('').columns().search('').draw();
          table.columns(1).search(this.value).draw();
      })

    }

} );

  function cargarValores(id,sala_id){
    $('#exampleModal'+id).modal('hide');
    var detalleatencion=$('#detalleatencion'+id).val();
    var tipo=$('#tipo'+id).val();
    var id_sala=$('#id_sala'+sala_id).val();
    var sala=$('#sala'+sala_id).val();
   
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

       $.ajax({
                type:'POST',
                url:"/turnos",
                dataType:"json",
                data:{
                    detalleatencion:detalleatencion,
                    tipo:tipo,
                    id_sala:id_sala,
                    sala:sala
                },
                success: function(response){
                    
                    var table = $('#example').DataTable();
                    table.draw();

                    },
                error:function(){
                    // $("#labelNombre").text("Error 2");
                    // $("#labelNombre").addClass('text-danger');
                }
            });
   };
   function cargarValorOperar(id,sala_id){
    $('#modal'+id).modal('hide');
    var detalleatencion=$('#detalleatencion'+id).val();
    var tipo=$('#tipo'+id).val();
    var id_sala=$('#id_sala'+sala_id).val();
    var sala=$('#sala'+sala_id).val();
    alert(sala);
      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

       $.ajax({
                type:'POST',
                url:"/turnos",
                dataType:"json",
                data:{
                    detalleatencion:detalleatencion,
                    tipo:tipo,
                    id_sala:id_sala,
                    sala:sala
                },
                success: function(response){
                    
                    var table = $('#example').DataTable();
                    table.draw();

                    },
                error:function(){
                    // $("#labelNombre").text("Error 2");
                    // $("#labelNombre").addClass('text-danger');
                }
            });
   }
</script>


@endsection