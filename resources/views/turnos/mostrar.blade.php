@extends("layouts.plantillaTest")

@section("cuerpo")
<div class="card">
  <div class="card-header">Turnos de Pacientes </div>
    <div class="card-body">
        <div class="form-row">
          {{-- <div class="form-group col-md-2">
                <label for="inputState">Área</label>
                <select name="area" id="area" class="form-control">
                  <option value="Todas" selected>Todas</option>

                      @foreach($areas as $area)
                        @if($area->tipo_dato == $val1)
                          <option value="{{$area->tipo_dato}}" selected>{{$area->tipo_dato}}</option>
                        @else
                          <option value="{{$area->tipo_dato}}">{{$area->tipo_dato}}</option>
                        @endif
                      @endforeach
                </select>
            </div> --}}
            <div class="form-group col-md-2">
                <label for="inputState">Condicion</label>
                <select name="cod" id="cod" class="form-control">
                  <option value="Todas" selected>Todas</option>
                  <option value="Operar">Operar</option>
                  <option value="Internar" >Internar</option>
                  <option value="Shock Room">Shoock Room</option>
                  <option value="consulta" >Consulta</option>

                  <option value="Internado">Internado</option>

                  <option value="Operado" >Operado</option>

                </select>
            </div>
        </div>
        
        <table class="table table-bordered table-sm table-hover" id="tabla_id">
          <thead class="thead-dark">
                  <tr>
                      <th scope="col" width="140" >Nombre y Apellido </th>
                      <th scope="col" width="140" >Fecha y hora</th>
                      <th scope="col" width="140">Area</th>
                      <th scope="col">Especialidad</th>
                      <th scope="col" >Condicion</th>
                      <th scope="col" >Observacion</th>
                      <th scope="col" >Sala de internacion</th>
                      <th scope="col">Sala de operacion</th>
                  </tr>
          </thead>
          <tbody id="tabla">
            @foreach($pacientes as $p)
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

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal{{ $p->id }}" id="button1">
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
                                          <div class="col border">
                                              <label>Disponible</label>
                                          </div>
                                          <div class="col border">
                                              <form method="POST" action="/turnos">
                                                @csrf
                                                <input type="hidden" name="sala" value="{{ $s->nombre }}">
                                                <input type="hidden" name="detalleatencion" value="{{ $p->id }}">
                                                <input type="hidden" name="id_sala" value={{ $s->id }}>
                                                <input type="hidden" name="tipo" value="Internado">
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

                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal{{ $p->id }}" id="button1">
                      Asignar quirofano
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
            </tr>


            @endforeach
          </tbody>
         
        </table>

      </div>
  </div>

{{-- 
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}



{{-- <script>
  $("form").submit( function() {
      // $(this).append('<input type="hidden" name="n" value="cualquiercosa"\>');
      // $(this).append('<input type="hidden" name="a" value="cualquiercosa"\>');
    
    
      $("<input />").attr("type", "hidden")
        .attr("name", "a")
        .attr("value", $('#area').val())
        .appendTo("form");
      $("<input />").attr("type", "hidden")
        .attr("name", "m")
        .attr("value", $('#esp').val())
        .appendTo("form");
        return true;
    
  });

</script> --}}

{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  

$(document).ready(function() {
    $('#tabla_id').DataTable();
} );
</script>

<script>
  $('select').on('change', function() {
    if($('#cod').val() == 'Todas'){
     
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#cod').val().toLowerCase()) == -1)
        });
    }else{
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#cod').val().toLowerCase()) > -1)
        });
    }
    
    }).trigger('change');


</script>

@endsection