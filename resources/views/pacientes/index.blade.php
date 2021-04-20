
@extends('triagepreguntas.test')

@section("css")
<style type="text/css">
  .select{
    width: 100% !important;
  }
</style>

@endsection

@section("cuerpo")
@if (Session::has('success'))
  <div class="alert alert-success" role="alert" id="alerta">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pacientes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2 d-flex" style="width: 260px;">
            @canany(['RegistrarPaciente','FullPacientes'])
            <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ url('pacientes/create') }}">Registrar</a>
            @endcanany
            @canany(['RegistrarPacienteNN','FullPacientes'])
            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#myModal">Cargar pacientes NN</button>
            @endcanany
          </div>
          {{-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button> --}}
        </div>
</div>
{{-- <div class="table-responsive"> --}}
        <table id ="myTable" class="table table-hover table-striped table-bordered table-sm">
          <thead class="table__thead"> 
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
          
          </tbody>
        </table>

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
     
      <div class="modal-body ui-front">
          <div class="form-group col-md-10 op">
            <label>Para:</label>
            <select class="form-control select" style="width: 100%;" name="condicion" id="condicion">
              <option value="Operar" >Operar</option>      
              <option value="Internar">Internar</option>               
            </select>
          </div>
          <div class="form-group col-md-10 " id="operar">
            <label>Luego para operar?:</label>
            <select class="form-control select" style="width: 100%;"name="selectop" id="selectop">
              <option value="si">Si</option>      
              <option value="no">No</option>               
            </select>
          </div>
          <div class="form-group col-md-10 ">
            <label>Color:</label>
            <select class="form-control select"style="width: 100%;" name="id_color" id="id_color">
              @foreach($colores as $color)
              <option value="{{ $color->id }}">{{ $color->color }}</option>
             
              @endforeach         
            </select>
          </div>
          <div class="form-group col-md-10 ">
            <label>CIE:</label>
             <input type="text" name="ciess" id="cieslist" class="form-control form-control-sm">
             <div id="error_modal_cie"></div>
     
          </div>
          <div class="form-group col-md-10 ">        
            <label for="exampleFormControlTextarea1">Observacion</label>
            <textarea class="form-control" id="observacion" rows="3" name="observacion"></textarea>
            <div id="error_modal_observacion"></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="cargar_nn()">Save changes</button>
      </div>
    
    </div>
  </div>
</div>

@endsection
@section("scripts")
@parent
<script type="text/javascript">
  $("document").ready(function(){
    // setTimeout(function(){
    //    $("div.alert").remove();
    // }, 5000 ); // 5 secs
   $("#alerta").fadeTo(2000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);
              });


});
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
<script >
  document.getElementById('operar').style.display = 'none';
 
  $('.op').change(function (e) {
    if(e.target.value == "Internar"){
      document.getElementById('operar').style.display = 'block';
    }
    else{
      document.getElementById('operar').style.display = 'none';
    }
    
});
</script>


<script type="text/javascript">
  
  $(document).ready(function() {
    var us =<?php echo Auth::id(); ?>;
    $('#myTable').DataTable({
      "responsive": true,
      "processing":true,
          "serverSide":true,
           "ajax":{url:"api/ApiPacientes/"+us},//"{{ url('api/tablasalas') }}",},
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
<script type="text/javascript">
  function cargar_nn(){
    
    var condicion= $("#condicion").val();
    var ciess = $("#cieslist").val();
    var observacion=$("#observacion").val();
    var selectop = $("#selectop").val();
    var id_color =$("#id_color").val();

    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

    $.ajax({
            type:'POST',
            url:"/pacientes/nn",
            dataType:"json",
            data:{
                condicion:condicion,
                ciess:ciess,
                observacion:observacion,
                selectop:selectop,
                id_color:id_color
            },
            success: function(response){
                $('#myModal').modal('hide');
                alert("El paciente fue cargado exitosamente")
                var table = $('#myTable').DataTable();
                table.draw();
                },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue

                  // console.log(err.responseJSON);
                  // $('#success_message').fadeIn().html(err.responseJSON.message);

                  // // you can loop through the errors object and show it to the user
                  // console.warn(err.responseJSON.errors);
                  // // display errors on each form field
                  $.each(err.responseJSON.errors, function (i, error) {
                      if(i=='ciess'){
                        $('#error_modal_cie').html('<span style="color: red;">'+error[0]+'</span>');
                      }
                      else{
                        $('#error_modal_observacion').html('<span style="color: red;">'+error[0]+'</span>');
                      }
                  //     var el = $(document).find('[name="'+i+'"]');
                  //     el.after($('<span style="color: red;">'+error[0]+'</span>'));
                  });
                }
            }
          });
  }



</script>






@endsection

@section("pie")
  
@endsection