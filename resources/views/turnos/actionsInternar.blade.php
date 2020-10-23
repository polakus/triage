<?php 
 $salas= DB::table('salas as s')
                  ->join('Areas as a','a.id','=','s.id_area')
                  ->select('a.tipo_dato','s.nombre','s.camas','s.disponibilidad','s.id')
                  ->get();

?>

 @if($estado =="Internar")
                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal{{ $id }}" id="button1">

                      Asignar sala
                      
                    </button>


                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                              {{-- <form method="POST" action="/turnos"> --}}
                                                
                                                {{-- @csrf --}}
                                               
                                                <input type="hidden" name="sala" id="sala{{ $s->id }}" value="{{ $s->nombre }}">
                                                <input type="hidden" name="detalleatencion"  id="detalleatencion{{ $id }}"value="{{ $id }}">
                                                <input type="hidden" name="id_sala" id="id_sala{{ $s->id }}" value={{ $s->id }}>
                                                <input type="hidden" name="tipo" id="tipo{{ $id }}" value="Internado">
                                                <button type="button" onclick='cargarValores({{ $id }},{{ $s->id }})' id="asignar"name="add" class="btn btn-success btn-sm asignar">Asignar esta sala</button>
                                              {{-- </form> --}}
                                          </div>
                                      @else
                                          <div class="col border">
                                            <label>No disponible</label>
                                          </div>
                                           <div class="col border">
                                            <button type="submit" id="add" name="add"  class="btn btn-success btn-sm" disabled>Asignar esta sala</button>
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
                  @if($estado != "consulta" && $estado != "Operado")
                    {{ $sala }}
                  @endif

  @endif

