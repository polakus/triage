
@extends('triagepreguntas.test')

@section('cuerpo')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Editar Paciente</h1>
        
</div>
<div class="row">
            <div class="col">
               <button class="btn btn-dark"  id="btnver" onclick="ver()">Cargar datos NN</button>
               <button class="btn btn-dark" id="btnocultar" onclick="ocultar()">Ocultar datos nn</button>
            </div>
           
          </div>
          <br>
          <div class="row" id="historial">
            <div class="col">
              <div class="table-responsive">
              <table class="table table-bordered table-sm" id="tablann">
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
                            <button type="submit"class="btn btn-success btn-sm">Seleccionar</button>
                          </form>
                          
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              </div>
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
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{count($errors)>0 ? old('nombre'):$paciente->nombre}}" placeholder="Nombre">
                @error('nombre')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Apellido</label>
                <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{count($errors)>0 ? old('apellido'):$paciente->apellido}}" placeholder="Apellido">
                @error('apellido')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Teléfono</label>
                <input type="number" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{count($errors)>0 ? old('telefono'):$paciente->telefono}}" placeholder="Teléfono">
                @error('telefono')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputEmail4">Fecha de Nacimiento</label>
                <input type="date" name="fechaNac" class="form-control @error('fechaNac') is-invalid @enderror" value="{{count($errors)>0 ? old('fechaNac'):$paciente->fechaNac}}" id="inputEmail4">
                @error('fechaNac')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">Sexo</label>
                <select name="sexo" id="inputState" class="form-control @error('sexo') is-invalid @enderror" >
                @if(count($errors)>0)
                  <option value="" ></option>
                  <option value="Masculino" {{ (collect(old('sexo'))->contains('Masculino')) ? 'selected':'' }}>Masculino</option>
                  <option value="Femenino" {{ (collect(old('sexo'))->contains('Femenino')) ? 'selected':'' }}>Femenino</option>
                @else
                  <option value="" ></option>
                  <option value="Masculino" {{ $paciente->sexo == 'Masculino' ? 'selected':'' }}>Masculino</option>
                  <option value="Femenino" {{ $paciente->sexo == 'Femenino' ? 'selected':'' }}>Femenino</option>
                @endif
                </select>
                @error('sexo')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-8">
                <label for="inputAddress">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ count($errors)>0 ? old('direccion') : $paciente->domicilio}}" id="inputAddress" placeholder="Dirección">
                @error('direccion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputZip">Documento</label>
                <input type="number" max="99999999" min="1000000" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{count($errors)>0 ? old('dni'):$paciente->dni}}" id="inputZip" placeholder="Número de Documento">
                @error('dni')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}" class="btn btn-primary">Volver</a>
          </form>
@endsection
@section("scripts")
@parent
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#tablann').DataTable({
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
        "searchPlaceholder": "Término de búsqueda",
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
