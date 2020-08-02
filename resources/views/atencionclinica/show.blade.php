@extends("layouts.plantillaTest")





@section("cuerpo")
<div class="card">
  <div class="card-header"> Pacientes para Atender </div>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-2">
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
          <div class="form-group col-md-2">
              <label for="inputState">Especialidades</label>
              <select name="esp" id="esp" class="form-control">
                <option value="Todas" selected>Todas</option>
                    @foreach($especialidades as $esp)
                        <option value="{{ $esp->nombre }}">{{ $esp->nombre }}</option>
                    @endforeach
              </select>
          </div>
      </div>


          <form class="form-inline" method="GET" action="/atencionclinica">
            {{-- <input type="hidden" name="id_med" value="<?php echo $id_medicoAux?>"> --}}
            <button type="submit" class="btn btn-dark btn-sm">Refresh</button>
          </form>
          <table class="table table-bordered table-sm table-hover table-responsive-sm">
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
                        <button type="submit" class="btn btn-primary btn-sm ml-1" disabled>Triaje</button>
                      @endif
                   </form>
                   <button type="submit" class="btn btn-primary btn-sm ml-1">Editar</button>
                </div>
               
                
                </td>
              </tr>
              
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
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


@endsection
@section("pie")

<div class="contenedor container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulario</div>
                    <div class="card-body">
                      <H4> Sintomas descripto</H4>
                        <ul class="list-group">
                          @foreach($preguntas as $pregunta)
                              <li class="list-group-item">{{ $pregunta->descripcion }}</li>
                          @endforeach
                        </ul>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <button class="btn btn-success" id="btnver" onclick="ver()">Ver Historial</button>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <button class="btn btn-success" id="btnocultar" onclick="ocultar()">Ocultar Historial</button>
                          </div>
                        </div>
                          <div class="form-group" id="his">
                            <H4> Historial</H4>

                            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Filtrar por descripcion" >
                            <div class="table-responsive">
                              <table class="table table-bordered" id="myTable2">
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
                         
                       
                        <form id="form" method="POST" action="/atencionclinica">
                          @csrf
                          
                          <input type="hidden" name="detalleatencion1" value="{{ $detalleatencion }}">
                          <input type="hidden" name="atencion" value={{ $id }}>
                          <h4>Preguntas y Analisis</h4>
                          <div class="row">
                            <div class="col">
                              
                              <textarea class="form-control" id="descrito" name="descripto" rows="3">{{ $paciente_seleccionado->respuestas }}</textarea>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-2">
                              <label for="exampleFormControlTextarea1">CIE</label>
                              
                              <input type="text" name="cieslist" id="cieslist" class="form-control">
                            </div>
                            <div class="col-md-2">
                              <label for="exampleFormControlTextarea1">Codigo del Triaje</label>
                              <select id="inputState" name="color" class="form-control">
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
                              <textarea class="form-control" type="text" id="observacion" name="observacion" rows="3"></textarea>
                            </div>
                          </div>
                          <br>
                          <label for="exampleFormControlTextarea1">Que desea hacer?</label>
                          <div class="row">
                            <div class="form-check">
                            <label><input class="form-check-input position-static" type="radio" name="internar" id="blankRadio1" value="Internar" aria-label="..."> Internarlo</label>
                            </div>

                            <div class="form-check">
                              <label><input class="form-check-input position-static" type="radio" name="internar" id="blankRadio2" value="Operar" aria-label="..."> Operar</label>
                            </div>
                            
                            <div class="form-check">
                              <label><input class="form-check-input position-static" type="radio" name="internar" id="blankRadio2" value="Shock Room" aria-label="...">Shock Room</label>
                            </div>
                            <div class="form-check">
                              <label><input class="form-check-input position-static" type="radio" name="internar" id="blankRadio2" value="alta" aria-label="..."> Dar de alta</label>
                            </div>
                          </div>
                          <div class="form-group" id="formgruop">
                            <label>Para luego operar?</label>
                            <div class="form-check">
                              <label><input class="form-check-input position-static" type="radio" name="op" id="op1" value="si" aria-label="..."> Si</label>
                              <label><input class="form-check-input position-static" type="radio" name="op" id="op2" value="no" aria-label="..."> No</label>
                            </div>
                            
                          </div>
                          
                         
                          <br>
                          <button type="submit" class="btn btn-success" name="boton">Finalizar</button>
                          <button type="submit" class="btn btn-success" name="Continuar">Continuar Luego</button>
                          
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>

@endsection
