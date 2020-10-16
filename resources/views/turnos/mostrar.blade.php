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
        <table class="table table-striped table-bordered table-sm" id="example" >
          <thead>
            <tr>
              <th>Nombre y Apellido</th>
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
          {{--  @foreach($pacientes as $p)
              @if($p->color == "verde")
              <tr class="table-success">
            @elseif($p->color== "amarillo")
              <tr class="table-warning">
            @elseif($p->color=="rojo")
              <tr class="table-danger">
            @endif
              <td> {{ $p->nombre }} {{ $p->apellido }}</td>
              <td> {{ $p->fecha }} {{ $p->hora }}</td>
              <td> {{ $p->tipo_dato }}</td>
              <td> {{ $p->especialidad}} </td>
              <td> {{ $p->estado }}</td>
              <td>
                @foreach($historial as $h)
                  @if($h->id_detalle_atencion == $p->id)
                    CIE:{{ $h->codigo }}-{{ $h->descripcion }}
                    <br>
                    {{ $h->observacion }}

                  @endif
                @endforeach
              </td>
               <td>
                @if($p->estado != "consulta" && $p->estado!= "alta" && $p->estado !="Internado" && $p->estado != "Operado" && $p->estado != "Operar")
                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal{{ $p->id }}" id="button1">

                      Asignar sala
                    </button>


                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Salas</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container col-md-12">
                              
                              @if($p->estado == "Internar")
                                @foreach($salas as $s)
                                  @if($s->tipo_dato == "Internacion")
                                    <div class="row border">
                                      <div class="col border">
                                       <label>{{ $s->nombre }}</label> 
                                      </div>

                                      @if($s->disponibilidad == 1)
                                          <div class="col">
                                              <label>Disponible</label>
                                          </div>
                                          <div class="col border">
                                              <form method="POST" action="/turnos">
                                                @csrf
                                                <input type="hidden" name="sala" value="{{ $s->nombre }}">
                                                <input type="hidden" name="detalleatencion" value="{{ $p->id }}">
                                                <input type="hidden" name="id_sala" value={{ $s->id }}>
                                                <input type="hidden" name="tipo" value="Internado">
                                                <button type="submit" id="add" name="add" class="btn btn-success btn-sm">Asignar esta sala</button>
                                              </form>
                                          </div>
                                      @else
                                          <div class="col border">
                                            <label>No disponible</label>
                                          </div>
                                           <div class="col border">
                                            <button type="submit" id="add" name="add" class="btn btn-success btn-sm" disabled>Asignar esta sala</button>
                                          </div>
                                      @endif
                                    </div>

                                  @endif
                                @endforeach
                              @endif
                          </div> 
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  @if($p->estado != "consulta" && $p->estado != "Operado")
                    {{ $p->sala }}
                  @endif

                @endif
              </td>

              <td>
                @if($p->operar == 1 || $p->estado == "Operar" )
                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#modal{{ $p->id }}" id="button1">
                      Quirofano
                    </button>


                  <!-- Modal -->
                  <div class="modal fade" id="modal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Salas de Quirofanos</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container col-md-12">

                             @foreach($salas as $s)
                                  @if($s->tipo_dato == "Quirofano")
                                     <div class="row border">
                                        <div class="col border">
                                          <label>{{ $s->nombre }}</label> 
                                        </div>
                                        @if($s->disponibilidad == 1)
                                          <div class="col border">
                                              <label>Disponible</label>
                                          </div>
                                          <div class="col border">
                                              <form method="POST" action="/turnos">
                                                @csrf
                                                <input type="hidden" name="sala" value="{{ $s->nombre }}">
                                                <input type="hidden" name="detalleatencion" value="{{ $p->id }}">
                                                <input type="hidden" name="id_sala" value={{ $s->id }}>
                                                <input type="hidden" name="tipo" value="Operado">
                                                <button type="submit" id="add" name="add" class="btn btn-success">Asignar esta sala</button>
                                              </form>
                                            </div>
                                        @else
                                            <div class="col border">
                                              <label>No disponible</label>
                                            </div>
                                             <div class="col border">
                                              <button type="submit" id="add" name="add" class="btn btn-success" disabled>Asignar esta sala</button>
                                            </div>
                                        @endif
                                     </div>
                                  @endif
                                @endforeach
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  @if($p->estado =="Operado")
                    {{ $p->sala }}
                  @endif

                @endif
              </td> 
              <td>
                @if($p->estado == "Internado")
                  <a href="{{ route('turnos.edit',$p->id) }}" class="btn btn-success btn-sm">Dar de alta</a>
                @endif
              </td>  
              </tr>
           @endforeach --}}
          </tbody>
        </table>
</div>



@endsection
@section("scripts")



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


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
   

    // $('body').on('click', '.asignar', function(){
    //   var 
       
    // });
       
    
    var table=$('#example').DataTable({
      "serverSide":true,
           "ajax":{url:"{{ url('api/mostrar') }}",
              
         },
           "columns":[
            {data:'paciente_full'},
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
                              $(row).css('background-color','#85F361')
                            }
                            else{
                              $(row).css('background-color','#F6FC3C')
                            }
                          }
                         },
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