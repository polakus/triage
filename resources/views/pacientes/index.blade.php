{{-- @extends("layouts.plantillaTest") --}}
@extends('triagepreguntas.test')

@section("cabecera")
    
@endsection




@section("estilos")
  {{-- <style type="text/css">
    .btn{
      display: inline-block;
      transition: .3s;
      border:solid 1.5px;
    }
    .btn-black{
      
      border-color: #2D2C31;
      color: #2D2C31;
      background-color: #eee;
      text-decoration: none;
      
    }
    .btn-black:hover{
      border:solid 1px;
      border-color: #eee;
      color: #eee;
      background-color: #2D2C31;
      text-decoration: none;
    }
  </style> --}}
@endsection

@section("cuerpo")
@if (Session::has('success'))
  <div class="alert alert-success" role="alert">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pacientes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ url('pacientes/create') }}">Registrar</a>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#myModal">Cargar pacientes NN</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
</div>
<div class="table-responsive">
        <table id ="myTable" class="table table-hover table-striped table-bordered table-sm">
          <thead>
            <tr>
              <th >Apellido</th>
              <th >Nombre</th>
              <th >DNI</th>
              <th >Telefono</th>
              <th >Fecha Nacimiento</th>
              <th >Sexo</th>      
              <th width="150px">Acción</th>
            </tr>
          </thead>
          <tbody>
           {{--  @foreach($pacientes as $paciente)
                <tr>
                  <td><strong>{{ $paciente->apellido }}</strong></td>
                  <td>{{ $paciente->nombre }}</td>
                  <td>{{ $paciente->dni }}</td>
                  <td>{{ $paciente->telefono }}</td>
                  <td>{{ $paciente->fechaNac }}</td>
                  <td>{{ $paciente->sexo }}</td>
                  <td>
                    <div class="form-row">
                     <form class= "form-inline" action="{{route('triagepreguntas.show',$paciente->Paciente_id)}}" method="GET">
                        <button type="submit" class="btn btn-sm btn-outline-secondary ml-1">Triaje</button>
                      </form>
                      <a href="{{ route('pacientes.edit', $paciente->Paciente_id) }}"  class="btn btn-sm btn-outline-secondary ml-1">Editar</a>
                    </div>
                </td>
            @endforeach --}}
          </tbody>
        </table>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Cargar paciente de urgencias</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="/pacientes/nn">
      @csrf
      <div class="modal-body">
          <div class="form-group col-md-10 op">
            <label>Para:</label>
            <select class="form-control" name="condicion">
              <option value="Operar">Operar</option>      
              <option value="Internar">Internar</option>               
            </select>
          </div>
          <div class="form-group col-md-10 " id="operar">
            <label>Luego para operar?:</label>
            <select class="form-control" name="selectop">
              <option value="si">Si</option>      
              <option value="no">No</option>               
            </select>
          </div>
          <div class="form-group col-md-10 ">
            <label>Color:</label>
            <select class="form-control" name="id_color">
              @foreach($colores as $color)
              <option value="{{ $color->id }}">{{ $color->color }}</option>
             
              @endforeach         
            </select>
          </div>
          <div class="form-group col-md-10 ">
            <label>CIE:</label>
            <div class="table-responsive">
              <input type="text" name="searchcie" id="searchcie" class="form-control" placeholder="Buscar por cie" onkeyup="myFunctioncie()">
              <table class="table table-bordered"  id=TablaCie>
                @foreach($cie as $ci)
                  <tr>
                    <td>{{ $ci->codigo }}-{{ $ci->descripcion }}</td>
                    
                    <td>
                      <div class="custom-control custom-radio">
                        <input type="radio" id="customRadio{{ $ci->id }}" name="radiocie" class="custom-control-input" value="{{ $ci->id }}" >
                        <label class="custom-control-label" for="customRadio{{$ci->id }}"> </label>
                      </div>

                    </td>
                  </tr>
                @endforeach            
              </table> 
           </div>
          </div>
          <div class="form-group col-md-10 ">        
            <label for="exampleFormControlTextarea1">Observacion</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="observacion"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
     </form>
    </div>
  </div>
</div>

@endsection
@section("scripts")
<script>
function myFunctioncie() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchcie");
  if(input.value.length==0){
    
    document.getElementById('TablaCie').style.display ="none";
  }
  filter = input.value.toUpperCase();
  table = document.getElementById("TablaCie");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && input.value.length>0) {
        tr[i].style.display = "";
        
        document.getElementById('TablaCie').style.display = 'block';
      } else {

        tr[i].style.display = "none";
      }
    }       
  }
}

</script>

<script >
  document.getElementById('operar').style.display = 'none';
  document.getElementById('TablaCie').style.display = 'none';
  $('.op').change(function (e) {
    if(e.target.value == "Internar"){
      document.getElementById('operar').style.display = 'block';
    }
    else{
      document.getElementById('operar').style.display = 'none';
    }
    
});
</script>

{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
      "processing":true,
          "serverSide":true,
           "ajax":{url:"{{ url('api/ApiPacientes') }}",
              
         },
           "columns":[
            {data:'apellido'},
            {data:'nombre'},
            {data:'dni'},
            {data:'telefono'},
            {data:'fechaNac'},
            {data:'sexo'},
            {data:'btn'},
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


{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}







@endsection

@section("pie")
  
@endsection