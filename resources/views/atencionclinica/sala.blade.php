@extends('triagepreguntas.test')

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Pacientes para atender</h4>
</div>
<div class="form-group">
      <input type="hidden" name="cantidad_actual" id="cantidad_actual" value="{{ $cantidad }}">
       
         <h6>{{ $mensaje }}</h6>
     
      <a href="{{ route('atencionclinica.edit', Auth::id() ) }}"class="btn btn-mod btn-sm" style="width:220px;">Cambiar ubicacion</a>
</div>
<div class="form-row" id="seccionRecargar">
        <div class="form-group col-md-2" style="font-size: 17px;">
              <label for="inputState">Área</label>
              <select name="area" id="area" class="form-control form-control-sm">
                <option value="Todas" selected>Todas</option>

                    @foreach($areas as $area)
                      @if($area->nombre == $val1)
                        <option value="{{$area->nombre}}" selected>{{$area->nombre}}</option>
                      @else
                        <option value="{{$area->nombre}}">{{$area->nombre}}</option>
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
  <button class="btn btn-mod btn-sm" style="height: 30px;float: right;"  onclick="document.location.reload();">Refresh</button>
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-sm" id="table_id">
    <thead>
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
        <td>{{ $paciente->nombre }}</td>
        <td>
        <div class="form-row" >
          <button type="button" class="btn btn-dark btn-sm ml-1" id="button{{ $paciente->id }}" onclick="sala({{ $paciente->id_atencion}},{{ $paciente->id }},{{ $paciente->Paciente_id }})">Triaje</button>
        </div>
       
        
        </td>
      </tr>
      
      @endforeach

    </tbody>
  </table>
</div>
<div id="formulario">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Formulario</h4>
</div>
<h5> Sintomas descripto</h5>
<ul class="list-group " id="lista_sintomas">

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
        
        </tbody>
    </table>
  </div>
</div>
{{-- form id="frm1" method="POST" action="/atencionclinica">
  @csrf --}}
  
  <input type="hidden" name="detalleatencion1" id="detalleatencion1">
  {{-- <input type="hidden" name="atencion" value={{ $id }}> --}}
  <input type="hidden" name="id_det_profesional_sala" id="id_det_profesional_sala" value="{{ $id_det_profesional_sala }}">
  <h5>Preguntas y Analisis</h5>
  <div class="row">
    <div class="col">
      
      <textarea class="form-control form-control-sm" id="descripto" name="descripto" rows="3"></textarea>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-2">
      <label for="exampleFormControlTextarea1">CIE</label>
      
      <input type="text" name="cieslist" id="cieslist" class="form-control form-control-sm">
      <div id="error_cieslist"></div>
    </div>
    <div class="col-md-2">
      <label for="exampleFormControlTextarea1">Codigo del Triaje</label>
      <select id="color" name="color" class="form-control form-control-sm">
  
        
        
      </select>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col">
      <label for="exampleFormControlTextarea1">Desea agregar alguna observacion?</label>
      <textarea class="form-control" type="text" id="observacion" name="observacion" rows="3" ></textarea>
      <div id="error_observacion"></div>
      
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
  
  <input type="hidden" name="mensaje" id="mensaje"value="{{ $mensaje }}">
  
  <br>
  <button type="button" onclick="continuar('finalizar')"class="btn btn-dark btn-sm" name="boton">Finalizar</button>
  <button type="button" onclick="continuar('continuar')"class="btn btn-dark btn-sm" name="Continuar">Continuar Luego</button>

  {{-- Para redireccionar --}}
  <form style="display: none" action="/atencionclinica/atencionsala" method="GET" id="form">
	  <input type="hidden" id="val1" name="val1" >
	  <input type="hidden" id="val1" name="val1" >
      <input type="text" name="id_det_profesional_sala" value="{{ $id_det_profesional_sala }}">
	  <input type="hidden" name="mensaje" value="{{ $mensaje }}">
	</form>
{{-- </form> --}}

</div>
@endsection

@section("scripts")
@parent
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


</script>

<script type="text/javascript">

$(document).ready(function() {
    $('#table_id').DataTable({
       "responsive":true,
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
  




<script type="text/javascript">

function sala(id,detalleatencion,id_paciente){
  
  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({
          type:'GET',
          url:"/atencionclinica/"+id,
          dataType:"json",
          data:{
              detalleatencion:detalleatencion,
              id_paciente:id_paciente
          },
          success: function(response){
            document.getElementById("button"+detalleatencion).disabled=true;
            document.getElementById('formulario').style.display = 'block';
            var detalleatencion1 = document.getElementById("detalleatencion1");
                detalleatencion1.value= detalleatencion;

              for(i=0;i<response.preguntas.length;i++){
                $('#lista_sintomas').append('<li class="list-group-item">'+response.preguntas[i].descripcion+'</li>');
              };
             
    
                $('#myTable2').DataTable({
                  "responsive":true,
                  "processing":true,
                      "serverSide":true,
                       "ajax":{url:"{{ url('api/historial') }}",
                       data:{id_paciente:id_paciente}
                          
                     },
                       "columns":[
                        {data:'codigo'},
                        {data:'descripcion'},
                        {data:'observacion'}
                        
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
                var textarea = document.getElementById("descripto");

                textarea.value= response.paciente_seleccionado.respuestas;
                for(j=0;j<response.codigos.length;j++){
                  $('#color').append('<option value="'+response.codigos[j].color+'">'+response.codigos[j].color+'</option>');
                }
                // CIE


              },
          error:function(err){
              if (err.status == 422) { // when status code is 422, it's a validation issue
                console.log(err.responseJSON);
                // $('#success_message').fadeIn().html(err.responseJSON.message);

                // // you can loop through the errors object and show it to the user
                // console.warn(err.responseJSON.errors);
                // // display errors on each form field
                // $.each(err.responseJSON.errors, function (i, error) {
                //     var el = $(document).find('[name="'+i+'"]');
                //     el.after($('<span style="color: red;">'+error[0]+'</span>'));
                // });
              }
          }
    });
  

}

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
// document.getElementById('his').style.display = 'none';
document.getElementById('formulario').style.display = 'none';
document.getElementById('btnver').style.display = 'none';
document.getElementById('formgruop').style.display = 'none';
                $('input[id=blankRadio1]').click(function() {                    
                    document.getElementById('formgruop').style.display = 'block'
                              
                });
                $('input[id=blankRadio2]').click(function() {
                  document.getElementById('formgruop').style.display = 'none'
                });
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

<script type="text/javascript">
	function continuar(boton){
		var detalleatencion1=$('#detalleatencion1').val();
		var id_det_profesional_sala=$('#id_det_profesional_sala').val();
		var descripto=$('#descripto').val();
		var cieslist=$('#cieslist').val();
		var observacion=$('#observacion').val();
		var internar = $("input[name='internar']:checked").val();
		var op = $("input[name='op']:checked").val();
		var color = $('#color').val();
		var mensaje = $('#mensaje').val();
		var buttonpressed = $(this).attr('name');
		var boton=boton;
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
   		$.ajax({
            type:'POST',
            url:"/atencionclinica",
            dataType:"json",
            data:{
                detalleatencion1:detalleatencion1,
                id_det_profesional_sala:id_det_profesional_sala,
                descripto:descripto,
                cieslist:cieslist,
                observacion:observacion,
                internar:internar,
                op:op,
                color:color,
                mensaje:mensaje,
                boton:boton

            },
            success: function(response){
            	$("#val1").val($('#area').val());
				$("#val2").val($('#esp').val());
				$("#form").submit();
				
            },
            error:function(err){
            	// console.log(err.responseJSON);
				if (err.status == 422) { // when status code is 422, it's a validation issue
					console.log(err.responseJSON);
			
					$('#success_message').fadeIn().html(err.responseJSON.message);
					$.each(err.responseJSON.errors, function (i, error) {
						if(i=="cieslist"){
							$('#error_cieslist').html('<span style="color: red;">'+error[0]+'</span>');
						}
						else{

							$('#error_observacion').html('<span style="color: red;">'+error[0]+'</span>');
						}
						// var el = $(document).find('[name="'+i+'"]');
						// // alert(i);
						// el.after($('<span style="color: red;">'+error[0]+'</span>'));
						// alert(error)
					});
				}
				// alert("eentro o no entro"); 	
				// $('#exampleModal').removeClass('fade');
				// $('#exampleModal').modal('show');
				// $('#exampleModal').addClass('fade');
            }
        });
	}
	function finalizar(){
		var var_name = $("input[name='internar']:checked").val();
		alert(var_name);
	}



</script>


@endsection