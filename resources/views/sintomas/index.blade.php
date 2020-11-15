@extends("triagepreguntas.test")

@section('css')
<style type="text/css">
    .contenido{
        display: block;
        padding: 10px;
        width:400px;
    
        flex-wrap: wrap;

    }
    .botones{
        
        display: flex;
        
        
    }
    .botones input{
        flex-grow: 1;
        width:60%;
    }
    .botones button{
        width: 40%;
        flex-grow: 1;
    }
    .error div{
        margin-left: 10px;
        
    }

    @media only screen and (max-width: 390px){
        .botones{
            display: block;

        }
        .botones input{
            width: 100%;
            margin-bottom: 3px;
        }
        .botones button{
            width: 100%;
        }
    }
   

</style>

@endsection
@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Sintomas</h4>
  <div class="contenido">
    <div class="botones">
      <input type="text" class="form-control form-inline form-control-sm ml-2 " placeholder="Nombre del sintoma"  name="nombre_sintoma" id="nombre_sintoma" >
         <button class="btn btn-outline-secondary btn-sm ml-2"  id="agregar">Agregar sintoma</button>
    </div>
    <div class="error">
        <div id="error_sintoma"></div>
    </div>
   </div>
 
  
</div>
<div class="table-responsive">
 <table class="table table-bordered table-striped table-hover table-sm" id="myTable">
  <thead>
    <tr>
      <th scope="col" >#</th>
      <th scope="col">Sintomas</th>
      <th scope="col" >Accion</th>
    </tr>
  </thead>
  <tbody>
 
  </tbody>
</table>
</div>


@endsection
@section("scripts")
@parent




{{-- JS Datatables --}}



<script type="text/javascript">
  $(document).ready(function() {
   var table= $('#myTable').DataTable({
       "processing":true,
        "responsive":true,
          "serverSide":true,
           "ajax":{url:"{{ url('api/sintomas_cargar') }}",
              
         },
           "columns":[
            {data:'id'},
            {data:'descripcion'},
            {data:'button'},
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

   $('#agregar').click(function() {
      var nombre_sintoma = $('#nombre_sintoma').val();
    
    $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

   $.ajax({

            type:'POST',
            url:"/sintomas",
            dataType:"json",
            data:{
                nombre_sintoma:nombre_sintoma,
            },
            success: function(response){
                
                var table = $('#myTable').DataTable();
                table.draw();
                var inputNombre = document.getElementById("nombre_sintoma");
                inputNombre.value="";

                },
            error:function(err){
               if (err.status == 422) { // when status code is 422, it's a validation issue
            console.log(err.responseJSON);
            $('#success_message').fadeIn().html(err.responseJSON.message);
            $.each(err.responseJSON.errors, function (i, error) {
                $('#error_sintoma').html('<span style="color: red;">'+error[0]+'</span>');
                // var el = $(document).find('[name="'+i+'"]');
                // el.after($('<span style="color: red;">'+error[0]+'</span>'));
                // alert(error[0])
            });
        }
                // $("#labelNombre").text("Error 2");
                // $("#labelNombre").addClass('text-danger');
            }
        });
});
  
    
} );
</script>

<script type="text/javascript">
function eliminar(id){

  $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });
  $.ajax({

            type:'DELETE',
            url:"/sintomas/"+id,
            dataType:"json",
            data:{
                id:id,
            },
            success: function(response){
                var table=$("#myTable").DataTable();
                table.draw();

                },
            error:function(err){
        //        if (err.status == 422) { // when status code is 422, it's a validation issue
        //     console.log(err.responseJSON);
        //     $('#success_message').fadeIn().html(err.responseJSON.message);

            
        //     $.each(err.responseJSON.errors, function (i, error) {
                
        //         alert(error[0])
        //     });
        // }
               
            }
        });
}

</script>


@endsection
