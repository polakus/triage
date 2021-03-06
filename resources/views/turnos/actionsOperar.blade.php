


@if($paciente->operar == 1 || $paciente->estado == "Operar" )
                    <!-- Button trigger modal -->

      <button type="button" class="btn btn-mod btn-sm" data-toggle="modal" data-target="#modal{{ $paciente->id }}" id="button1">
        Quirofano
      </button>


    <!-- Modal -->
    <div class="modal fade" id="modal{{ $paciente->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered"  role="document">
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
                    @if($s->nombre == "Quirofano")
                       <div class="row border">
                          <div class="col border">
                            <label>{{ $s->nombre }}</label> 
                          </div>
                          @if($s->disponibilidad == 1)
                            <div class="col border">
                                <label>Disponible</label>
                            </div>
                            <div class="col border">
                               
                                  <input type="hidden" id="sala{{ $s->id }}" value="{{ $s->nombre }}">
                                  <input type="hidden" id="detalleatencion{{ $paciente->id }}" value="{{ $paciente->id }}">
                                  <input type="hidden" id="id_sala{{ $s->id }}" value={{ $s->id }}>
                                  <input type="hidden" id="tipo{{ $paciente->id }}" value="Operado">
                                  <button type="button" id="add2" name="add" onclick="cargarValorOperar({{ $paciente->id }},{{ $s->id }})" class="btn btn-success">Asignar esta sala</button>
                                
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
    @if($paciente->estado =="Operado")
      {{ $paciente->sala }}
    @endif

  @endif