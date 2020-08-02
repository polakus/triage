@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="card">
  <div class="card-header"> Editar Paciente </div>
    <div class="card-body">
          <div class="row">
            <div class="col">
               <button class="btn btn-dark" id="btnver" onclick="ver()">Cargar datos NN</button>
               <button class="btn btn-dark" id="btnocultar" onclick="ocultar()">Ocultar datos nn</button>
            </div>
           
          </div>
          <br>
          <div class="row" id="historial">
            <div class="col">
              <table class="table table-bordered table-responsive" id="tablann">
                  <thead>
                    <tr>
                      <th>
                        Fecha y Horario
                      </th>
                      <th>
                        Historial
                      </th>
                      <th>
                        Accion
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($nn as $n)
                      <tr>
                        <td>{{ $n->fechaNac }}</td>
                        <td>{{ $n->descripcion }}</td>
                        <td>
                          <form method="POST" action="/pacientes/{{ $n->id_atencion }}">
                            @csrf
                            <input type="hidden" name="id_paciente" value="{{ $id }}">
                            {{ method_field('PUT') }}
                            <button type="submit"class="btn btn-success">Seleccionar</button>
                          </form>
                          
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
          </div>

          <br>
          <form method="POST" action="/pacientes/{{ $id }}">
            @csrf
            {{ method_field('PUT') }}
            <input type="hidden" name="comprobador" value="1">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="{{ $paciente->nombre }}" >
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Apellido</label>
                <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="{{ $paciente->apellido }}">
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="{{ $paciente->telefono }}">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputEmail4">Fecha de Nacimiento</label>
                <input type="text" name="fechaNac" class="form-control" id="inputEmail4" placeholder="dd/mm/aaaa" value="{{ $paciente->fechaNac }}">
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">Sexo</label>
                <select name="sexo" id="inputState" class="form-control">
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                </select>
              </div>
              <div class="form-group col-md-8">
                <label for="inputAddress">Dirección</label>
                <input type="text" name="direccion" class="form-control" id="inputAddress" placeholder="Dirección" value="{{ $paciente->domicilio }}">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputZip">Documento</label>
                <input type="number" max="99999999" min="1000000" name="dni" class="form-control" id="inputZip" placeholder="Número de Documento" value="{{ $paciente->dni }}">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
        </div>
      </div>



{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#tablann').DataTable();
} );
</script>


<script>
  document.getElementById('historial').style.display = 'none';
  document.getElementById('btnocultar').style.display = 'none';
function ver() {
     document.getElementById('historial').style.display = 'block';
     document.getElementById('btnver').style.display = 'none';
      document.getElementById('btnocultar').style.display = 'block';
}
function ocultar(){
  document.getElementById('historial').style.display = 'none';
     document.getElementById('btnver').style.display = 'block';
      document.getElementById('btnocultar').style.display = 'none';
}
</script>

@endsection
