@extends("triagepreguntas.test")





@section("cuerpo")

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Pacientes para atender</h4>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
@if($mensaje=="") 
      <div id="Salas">
        <form method="POST" action="/atencionclinica/sala">
          @csrf
        <h5>Indicar en que sala se encuentra situado</h5>
        <div class="form-row">
        
          <div class="form-group col-md-4" style="font-size: 17px;">
              <label for="inputState">Sala</label>
              <select name="sala" id="sala" class="form-control">
                
                    @foreach($salas as $s)
                        
                        <option value="{{ $s->id}}-{{ $s->tipo_dato }} {{ $s->nombre }} ">{{ $s->tipo_dato }} {{ $s->nombre }}</option>
                    @endforeach
              </select>
          </div>

      </div>
      <div class="row">
        <div class="col">
          <button  type="submit" class="btn btn-success btn-sm">Listo</button>
        </div>
        
      </div>
      </form>
      </div>
@else
<div class="form-group">
      <input type="hidden" name="cantidad_actual" id="cantidad_actual" value="{{ $cantidad }}">
       
         <h6>{{ $mensaje }}</h6>
     
      <a href="{{ route('atencionclinica.edit', Auth::id() ) }}"class="btn btn-dark btn-sm" style="width:220px;">Cambiar ubicacion</a>
</div>
<div class="form-row" id="seccionRecargar">
        <div class="form-group col-md-2" style="font-size: 17px;">
              <label for="inputState">Área</label>
              <select name="area" id="area" class="form-control form-control-sm">
                <option value="Todas" selected>Todas</option>

                    @foreach($areas as $area)
                      @if($area->tipo_dato == $val1)
                        <option value="{{$area->tipo_dato}}" selected>{{$area->tipo_dato}}</option>
                      @else
                        <option value="{{$area->tipo_dato}}">{{$area->tipo_dato}}</option>
                      @endif
                    @endforeach
              </select>
          </div>
          <div class="form-group col-md-2" style="font-size: 17px;">
              <label for="inputState">Especialidades</label>
              <select name="esp" id="esp" class="form-control form-control-sm">
                <option value="Todas" selected>Todas</option>
                    @foreach($especialidades as $esp)
                      @if($esp->nombre == $val2)
                        <option value="{{ $esp->nombre }}" selected>{{ $esp->nombre }}</option>
                      @else
                        <option value="{{ $esp->nombre }}">{{ $esp->nombre }}</option>
                      @endif
                    @endforeach
              </select>
          </div>
</div>
<div class="form-group row-cols-3">
  <label>Pacientes nuevos</label>
  <input type="text" name="cantidad" disabled value="0" id="cantidad" style="width: 40px;text-align: center;">
  <button class="btn btn-dark btn-sm" style="height: 30px;float: right;"  onclick="document.location.reload();">Refresh</button>
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-sm" id="table_id">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Fecha</th>
        <th scope="col">Especialidad</th>
        <th scope="col">Area</th>
        <th scope="col">Accion</th>
        
      </tr>
    </thead>
    <tbody id="tabla">
      @foreach($pacientes as $paciente)
          @if($paciente->color == "verde")
          <tr class="table-success">
        @elseif($paciente->color== "amarillo")
          <tr class="table-warning">
        @elseif($paciente->color=="rojo")
          <tr class="table-danger">
        @endif
      
        <td>{{ $paciente->nombre }}</td>
        <td> {{ $paciente->apellido }}</td>
       
        <td>{{ $paciente->fecha }}</td>
        <td> {{ $paciente->especialidad }}</td>
        <td>{{ $paciente->tipo_dato }}</td>
        <td>
        <div class="form-row" >
           <form id="frm1" class= "form-inline" action="{{route('atencionclinica.show',$paciente->id_atencion)}}" method="GET">
              <input type="hidden" name="detalleatencion" value="{{ $paciente->id }}">
              <input type="hidden" name="mensaje" value="{{ $mensaje }}">

              <button type="submit" class="btn btn-dark btn-sm ml-1">Triaje</button>
           </form>
           {{-- <button type="submit" class="btn btn-primary btn-sm ml-1">Editar</button> --}}
        </div>
       
        
        </td>
      </tr>
      
      @endforeach

    </tbody>
  </table>
</div>
@endif

{{-- ESTO ES VIEJO --}}
{{-- <div class="card"> 
  <div class="card-header" style="font-size: 20px;">Pacientes para atender</div>
    <div class="card-body">
     
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      
    @if($mensaje=="") 
      <div id="Salas">
        <form method="POST" action="/atencionclinica/sala">
          @csrf
        <h5>Indicar en que sala se encuentra situado</h5>
        <div class="form-row">
        
          <div class="form-group col-md-4" style="font-size: 17px;">
              <label for="inputState">Sala</label>
              <select name="sala" id="sala" class="form-control">
                
                    @foreach($salas as $s)
                        
                        <option value="{{ $s->id}}-{{ $s->tipo_dato }} {{ $s->nombre }} ">{{ $s->tipo_dato }} {{ $s->nombre }}</option>
                    @endforeach
              </select>
          </div>

      </div>
      <div class="row">
        <div class="col">
          <button  type="submit" class="btn btn-success btn-sm">Listo</button>
        </div>
        
      </div>
      </form>
      </div>
  @else
  <div class="form-group">
      <input type="hidden" name="cantidad_actual" id="cantidad_actual" value="{{ $cantidad }}">
       
         <h6>{{ $mensaje }}</h6>
     
      <a href="{{ route('atencionclinica.edit', Auth::id() ) }}"class="btn btn-dark btn-sm" style="width:220px;">Cambiar ubicacion</a>
      

  </div>
  
      <div class="form-row" id="seccionRecargar">
       
        <div class="form-group col-md-2" style="font-size: 17px;">
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
          </div>
          <div class="form-group col-md-2" style="font-size: 17px;">
              <label for="inputState">Especialidades</label>
              <select name="esp" id="esp" class="form-control">
                <option value="Todas" selected>Todas</option>
                    @foreach($especialidades as $esp)
                      @if($esp->nombre == $val2)
                        <option value="{{ $esp->nombre }}" selected>{{ $esp->nombre }}</option>
                      @else
                        <option value="{{ $esp->nombre }}">{{ $esp->nombre }}</option>
                      @endif
                    @endforeach
              </select>
          </div>

      </div>
      <div class="form-group row-cols-3">
       
        <label>Pacientes activos</label>
        <input type="text" name="cantidad" disabled value="0" id="cantidad" style="width: 40px;text-align: center;">
        <button class="btn btn-dark btn-sm" style="height: 30px;float: right;"  onclick="document.location.reload();">Refresh</button>
      </div>
      
          
          <table class="table table-bordered  table-sm table-hover table-responsive-sm" id="table_id">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Area</th>
                <th scope="col">Accion</th>
                
              </tr>
            </thead>
            <tbody id="tabla">
              @foreach($pacientes as $paciente)
                  @if($paciente->color == "verde")
                  <tr class="table-success">
                @elseif($paciente->color== "amarillo")
                  <tr class="table-warning">
                @elseif($paciente->color=="rojo")
                  <tr class="table-danger">
                @endif
              
                <td>{{ $paciente->nombre }}</td>
                <td> {{ $paciente->apellido }}</td>
               
                <td>{{ $paciente->fecha }}</td>
                <td> {{ $paciente->especialidad }}</td>
                <td>{{ $paciente->tipo_dato }}</td>
                <td>
                <div class="form-row">
                   <form id="frm1" class= "form-inline" action="{{route('atencionclinica.show',$paciente->id_atencion)}}" method="GET">
                      <input type="hidden" name="detalleatencion" value="{{ $paciente->id }}">
                      <input type="hidden" name="mensaje" value="{{ $mensaje }}">

                      <button type="submit" class="btn btn-primary btn-sm ml-1">Triaje</button>
                   </form>
                   <button type="submit" class="btn btn-primary btn-sm ml-1">Editar</button>
                </div>
               
                
                </td>
              </tr>
              
              @endforeach
           

            </tbody>
          </table>
      @endif
       --}}
    

    
@endsection
@section("scripts")
<script>
  $('select').on('change', function() {
    if($('#esp').val() == 'Todas' && $('#area').val()=='Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) == -1 &&
           $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1 )
        });
    }else if($('#esp').val() != 'Todas' && $('#area').val() == 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) > -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1
            )
        });
    }else if($('#esp').val() == 'Todas' && $('#area').val() != 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) == -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1
            )
        });
    }else if($('#esp').val() != 'Todas' && $('#area').val() != 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) > -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1
            )
        });
    }
    
    
    

    }).trigger('change');

  $("#name").change(function(){
    if($("#name").val()=="basic")
      $("#area option").not("[value^='basic']").hide();
    else
      $("#subscription_interval option").not("[value^='basic']").show();
    });

</script>

{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#table_id').DataTable({
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

{{-- <script type="text/javascript">
  
    
    var x = document.createElement('input');
    x.setAttribute('type','hidden');
    x.setAttribute('name','val1');
    x.setAttribute('value',"probando");

    document.getElementById("frm1").appendChild(x);
  
</script> --}}
<script>
  $('form[id^="frm1"').submit( function() {
    
      $("<input />").attr("type", "hidden")
        .attr("name", "val1")
        .attr("value",$('#area').val())
        .appendTo("form");
      $("<input />").attr("type", "hidden")
        .attr("name", "val2")
        .attr("value", $('#esp').val())
        .appendTo("form");
      return true;
   
  });
</script>


<script type="text/javascript">
  function actualizar(){
   
   var cant=document.getElementById("cantidad_actual").value;
   
   var ruta = "{{ route('refresh') }}";
   var token = $("#token").val();
   $.ajax({
    headers:{'X-CSRF-TOKE':token},
    type:'POST',
    url: ruta,
    dataType:'json',
    data:{cant:cant,"_token": "{{ csrf_token() }}"}
   }).done(function(info){
      var cantidad_actual=document.getElementById("cantidad_actual");
      if(cantidad_actual.value != info.cantidad_nueva){
           var inputNombre = document.getElementById("cantidad");
           inputNombre.value = parseInt(inputNombre.value) + info.cantidad_nueva - cantidad_actual.value;
           cantidad_actual.value=info.cantidad_nueva
         
      }
      
   })
};
//Función para actualizar cada 4 segundos(4000 milisegundos)
  setInterval("actualizar()",4000);
</script>
  
</script>
@endsection
