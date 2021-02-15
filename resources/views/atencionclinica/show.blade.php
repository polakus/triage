@extends("triagepreguntas.test")


@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Pacientes para atender</h4>
</div>
<div class="form-group" style="margin-right: 10px;">
  <h6>{{ $mensaje }}</h6>
  <a href="{{ route('atencionclinica.index') }}"class="btn btn-dark btn-sm">Cambiar ubicacion</a>
</div>
<div class="form-row">
  <div class="form-group col-md-2">
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
  <div class="form-group col-md-2">
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
<div class="table-responsive">
  <table class="table table-bordered table-sm table-hover table-responsive-sm" id="table_id">
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
           <form class= "form-inline" action="{{route('atencionclinica.show',$paciente->id_atencion)}}" method="GET">
              @if($paciente->id_atencion != $id)
                <input type="hidden" name="detalleatencion" value="{{ $paciente->id }}">
                <button type="submit" class="btn btn-primary btn-sm">Triaje</button>
              @else
                <button type="submit" class="btn btn-dark btn-sm ml-1" disabled>Triaje</button>
              @endif
           </form>
           {{-- <button type="submit" class="btn btn-primary btn-sm ml-1">Editar</button> --}}
        </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
@section("pie")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Formulario</h4>
</div>
<h5> Sintomas descripto</h5>
<ul class="list-group ">
  @foreach($preguntas as $pregunta)
      <li class="list-group-item">{{ $pregunta->descripcion }}</li>
  @endforeach
</ul>
<div class="form-row">
  <div class="form-group col-md-2">
    <button class="btn btn-dark btn-sm" id="btnver" onclick="ver()">Ver Historial</button>
    <button class="btn btn-dark btn-sm" id="btnocultar" onclick="ocultar()">Ocultar Historial</button>
  </div>
</div>

<div class="form-group" id="his">
  <H5> Historial</H5>
  <div class="table-responsive">
    <table class="table table-bordered table-sm" id="myTable2">
      <thead class="thead-dark">
          <tr>
            <th scope="col col-md-2">CIE</th>
            <th scope="col col-md-2">Descripcion CIE</th>
            <th scope="col">Observacion</th>            
          </tr>
        </thead>
        <tbody>
          @foreach($historial as $h)
          <tr>
            <td>{{ $h->codigo }}</td>
            <td>{{ $h->descripcion }}</td>
            <td>{{ $h->observacion }}</td>
          @endforeach
        </tr>
        </tbody>
    </table>
  </div>
</div>
<form id="frm1" method="POST" action="/atencionclinica">
  @csrf
  
  <input type="hidden" name="detalleatencion1" value="{{ $detalleatencion }}">
  <input type="hidden" name="atencion" value={{ $id }}>
  <h5>Preguntas y Analisis</h5>
  <div class="row">
    <div class="col">
      
      <textarea class="form-control form-control-sm" id="descrito" name="descripto" rows="3">{{ $paciente_seleccionado->respuestas }}</textarea>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-2">
      <label for="exampleFormControlTextarea1">CIE</label>
      
      <input type="text" name="cieslist" id="cieslist" class="form-control form-control-sm @error('cieslist') is-invalid @enderror">
      @error('cieslist')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="col-md-2">
      <label for="exampleFormControlTextarea1">Codigo del Triaje</label>
      <select id="inputState" name="color" class="form-control form-control-sm">
        @foreach($codigos as $c)
          <option value="{{ $c->color }}">{{ $c->color }}</option>
        @endforeach
        
        
      </select>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <label for="exampleFormControlTextarea1">Desea agregar alguna observacion?</label>
      <textarea class="form-control  @error('observacion') is-invalid @enderror" type="text" id="observacion" name="observacion" rows="3" ></textarea>
      @error('observacion')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
      
    </div>
  </div>
  <br>
  <label for="exampleFormControlTextarea1">Que desea hacer?</label>
  <div class="row">
    <div class="col">
       <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio1" value="Internar" aria-label="..."> Internarlo</label>
       <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio2" value="Operar" aria-label="..."> Operar</label>
       <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio2" value="Shock Room" aria-label="...">Shock Room</label>
       <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio2" value="alta" aria-label="..."> Dar de alta</label>
    </div>
    
  </div>
  <div class="row" id="formgruop">
      <div class="col">
        <label>Para luego operar?</label>
        <div class="form-check">
      <label><input class="form-check-input position-static ml-1" type="radio" name="op" id="op1" value="si" aria-label="..."> Si</label>
      <label><input class="form-check-input position-static ml-1" type="radio" name="op" id="op2" value="no" aria-label="...">No</label>
        </div>
     
      </div>
  </div>
  
  <input type="hidden" name="mensaje" value="{{ $mensaje }}">
  <input type="hidden" name="id_det_profesional_sala" value="{{ $id_det_profesional_sala }}">
  <br>
  <button type="submit" class="btn btn-dark btn-sm" name="boton">Finalizar</button>
  <button type="submit" class="btn btn-dark btn-sm" name="Continuar">Continuar Luego</button>
  
</form>
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
{{-- Scrips para el pie --}}
<script type="text/javascript">

$(document).ready(function() {
    $('#myTable2').DataTable({
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

 <script>
  $( function() {
    cies=<?php echo $cie ?>;
    var availableTags=[];
    for(let i=0; i<cies.length;i++){
      availableTags.push(cies[i].codigo+"-"+cies[i].descripcion);
    }
   
    $( "#cieslist" ).autocomplete({
      source: availableTags
    });
   
  

  } );
 
  
 </script>

 <script> 
  document.getElementById('his').style.display = 'none';
  document.getElementById('btnocultar').style.display = 'none';
            $(document).ready(function() {
              document.getElementById('formgruop').style.display = 'none'
                $('input[id=blankRadio1]').click(function() {                    
                    document.getElementById('formgruop').style.display = 'block'
                              
                });
                $('input[id=blankRadio2]').click(function() {
                  document.getElementById('formgruop').style.display = 'none'
                });

                

                
            });
</script>


<script>
function ver() {
     document.getElementById('his').style.display = 'block';
     document.getElementById('btnver').style.display = 'none';
      document.getElementById('btnocultar').style.display = 'block';
}
function ocultar(){
  document.getElementById('his').style.display = 'none';
     document.getElementById('btnver').style.display = 'block';
      document.getElementById('btnocultar').style.display = 'none';
}
</script>
 
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

@endsection

