@extends("triagepreguntas.test")
@section("css")

<style type="text/css">
  .color-rojo{
    background:linear-gradient(#EC7063,#E70E0E)!important;
  }
  .color-rojo:hover{
    background: linear-gradient(#E70E0E,#B22222) !important;
  }
  .color-verde{
    background:linear-gradient(#B3FFAA,#7CBC14)!important; 

  }
  .color-verde:hover{
    background:linear-gradient(#7CBC14,#669C0C)!important; 
  }

  .color-amarillo{
    background: linear-gradient(#F8FFAA,#DCE616)!important; 
  }
  .color-amarillo:hover{
    background: linear-gradient(#DCE616,#B5BD1C)!important; 
  }
  thead th{
    border-bottom: 0px solid grey !important;
  }
</style>
@endsection
@section("cuerpo")
<div id="alerta"></div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Atenciones</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a type="button" class="btn btn-sm btn-outline-secondary"  data-toggle="modal" data-target="#modalConfigurar">Configurar Salas</a>
          </div>
        </div>
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

<div class="table-responsive" >
        <table class="table table-striped table-bordered table-hover  table-sm" id="example">
          <thead>
            <tr>
              <th >Nombre y Apellido</th>
              <th>Fecha y hora</th>
              <th>Areas</th>
              <th>Especialidades</th>
              <th>Condicion</th>
              <th>Observacion</th>
              <th >Sala de internacion</th>
              <th >Sala de operacion</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody id="tabla">

          </tbody>
        </table>
</div>

<div class="modal fade bd-example-modal-sm" id="modalConfigurar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuracion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
            <div class="form-group col-md-10">
              <label for="inputState">Sala de Internacion</label>
              <select id="area_internacion" class="form-control form-control-sm select" style="width: 100% ;">
                @foreach($areas as $area)
                  <option value="{{ $area->id }}"> {{ $area->nombre }}</option>
                @endforeach
              </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-10">
              <label for="inputState">Sala de Operacion</label>
              <select id="area_operacion" class="form-control form-control-sm select" style="width: 100% ;">
                @foreach($areas as $area)
                  <option value="{{ $area->id }}"> {{ $area->nombre }}</option>
                @endforeach
              </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="cargar_conf()"><i class="far fa-check-circle" ></i> Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="far fa-times-circle"></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section("scripts")


<script type="text/javascript">
  $(document).ready(function() {
    $('#cod').select2();
});


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
    var us = <?php echo Auth::id(); ?>;
    let url = "{{ url('api/mostrar') }}";
    url = url+"/"+us;
    
    var table=$('#example').DataTable({
      "serverSide":true,
           "ajax":{url:url,
              
         },
           "columns":[
            {data:'paciente_full',"orderable": "false"},
            {data:'fecha_hora'},
            {data:'nombre'},
            {data:'especialidad'},
            {data:'estado'},
            {data:'observacion'},
            {data:'Internacion'},
            {data:'Operar'},
            {data:'DarAlta'}
           ], 
           // "order": [[1, 'desc']],
         "createdRow": function( row, data, dataIndex){
                          if(data.color=="rojo"){

                           // $(row).css('background-color', '#FFAAAA');
                           $(row).addClass('color-rojo');

                          }
                          else{
                            if(data.color=="verde"){
                              // $(row).css('background-color','#B3FFAA');
                              $(row).addClass('color-verde');
                             
                            }
                            else{
                              // $(row).css('background-color','#F8FFAA')
                              $(row).addClass('color-amarillo');
                            }
                          }
                         },
          "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 6 },
            { responsivePriority: 3, targets: 7 }
          
        ],

      "responsive": true,
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
    // alert(sala);
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
   function darAlta(id){
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

       $.ajax({
                type:'get',
                url:"/turnos/"+id+"/edit",
                dataType:"json",
                
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

   function cargar_conf(){
    let area_internacion = document.getElementById('area_internacion').value;
    let area_operacion =  document.getElementById('area_operacion').value;
    $('#modalConfigurar').modal('hide');
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

       $.ajax({
                type:'POST',
                url:"/turnos/mostrar/conf",
                dataType:"json",
                data:{area_operacion:area_operacion,
                  area_internacion:area_internacion},
                success: function(response){
                    $('#alerta').addClass('alert alert-success');
                    $('#alerta').html('Cambios realizados exitosamente!');
                    $("#alerta").fadeTo(1500, 500).slideUp(500, function(){
                    $("#alerta").slideUp(500);
                     });  
                    var table = $('#example').DataTable();
                    table.draw();

                    },
                error:function(){
                  alert("No se logro realizar los cambios");
                    // $("#labelNombre").text("Error 2");
                    // $("#labelNombre").addClass('text-danger');
                }
            });
   }
</script>


@endsection