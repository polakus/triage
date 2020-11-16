@extends("triagepreguntas.test")

@section("cabecera")
    
@endsection

@section("cuerpo")

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h5 class="h5">Registracion de un nuevo protocolo</h5>
</div>
<div class="flash-message">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('protocolos.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div>
<form method="POST" action="/protocolos/{{$protocolo->id}}">
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Descripción</label>
      <input type="text" name="desc"  class="form-control form-control-sm @error('desc') is-invalid @enderror" value="{{ count($errors) > 0 ? old('desc') : $protocolo->descripcion }}" placeholder="Nombre">
      @error('desc')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="form-group col-md-2">
      <label for="inputState">Código</label>
      <select name="codigo" id="inputState" class="form-control select">
        @foreach($codigos as $codigo)
          @if($codigo->color == $protocolo->color)
            <option value="{{$codigo->id}}"selected>{{$codigo->color}}</option>
          @else
            <option value="{{$codigo->id}}">{{$codigo->color}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputEsp">Especialidad</label>
      <select name="especialidad" id="esp" class="form-control select">
        @foreach($especialidades as $esp)
          @if($esp->nombre == $protocolo->nombre)
            <option value="{{$esp->id}}" selected="">{{$esp->nombre}}</option>
          @else
             <option value="{{$esp->id}}">{{$esp->nombre}}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>
   <h5>Sintomas Actuales</h5>
   <div class="table-responsive">
     <table id="tabla_actual" class="table table-sm table-bordered table-striped">
      <thead>
        <tr>
          <th>Descripcion</th>
        </tr>
       </thead>
       <tbody>
         @foreach($sintomas_actuales as $sintoma_actual)
          <tr>
            <td> {{$sintoma_actual->descripcion}} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <h5 >Sintomas para Agregar</h5>
    @error('cbs')
      <span style="color:#dc3545" role="alert">
          <strong>{{ $message }}</strong>
      </span>
    @enderror
    <div class="table-responsive">
      <table id="dtBasicExample" class="table table-striped @error('cbs') table-danger @enderror table-bordered table-sm" width="100%">
      <thead>
        <tr>
          <th>Acción      </th>
          <th>Descripción </th>
        </tr>
      </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  <button type="submit" class="btn btn-mod">Registrar</button>
  <a class="btn btn-outline-secondary btn-close" href="{{ route('protocolos.index') }}">Volver</a>
</form>
 
@endsection
@section("scripts")


<label></label>
<script type="text/javascript">
  $(document).ready(function() {
    $('#dtBasicExample').DataTable({
      "serverSide":true,
			"ajax":{
        url: "{{ url('api/editprotocolo') }}",
        data: {"id": <?php echo $protocolo->id;?>},
      },
			"columns":[ 
				{data:'checkbox'},
				{data:'descripcion'}, 
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
} );
</script>

@endsection