@extends("triagepreguntas.test")

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h2">Protocolos</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('protocolos.create') }}">Agregar Protocolo</a>
      </div>
    </div>
</div>


<div class="table-responsive" >
        <table class="table table-striped table-bordered table-hover  table-sm" id="example">
          <thead>
            <tr>
              <th width="20px">Sintomas</th>
              <th >Protocolo</th>
              <th>Codigo</th>
              <th>Especialidad</th>
              <th>Lista de Sintomas</th>
              <th> Accion</th>
            </tr>
          </thead>
          <tbody id="tabla">

          </tbody>
        </table>
</div>

{{-- <table id="myTable" class="table table-bordered table-hover table-striped table-sm">
	<thead class="thead-dark">
		<tr>
            <th></th>
			<th >Nombre</th>
			<th >Código</th>
            <th >Especialidad</th>
		</tr>
	</thead>
	<tbody>
	@foreach($protocolos as $protocolo)

			<tr>
				<td>{{ $protocolo->descripcion }}</td>
				<td>{{ $protocolo->codigo->color }}</td>
				<td>
					<div class="form-row">
						<form id="a1{{$protocolo->id}}" class= "form-inline" action="/protocolos/{{$protocolo->id}}" method="get">
							<button type="submit" class="btn btn-dark btn-sm ml-1">Ver</button>
						</form>

						<form id="a2{{$protocolo->id}}" name="{{$protocolo->descripcion}}" action="/protocolos/{{$protocolo->id}}" method="post">
							@csrf
							{{method_field('DELETE')}}
							<button type="submit" class="btn btn-danger btn-sm ml-1" value="{{$protocolo->descripcion}}">Eliminar</button>
						</form>
					</div>
				</td>
			</tr>

	@endforeach
	</tbody>
</table> --}}
@endsection

@section("scripts")
@parent

{{-- <script>
$('form[id^="a2"').submit( function() {
	if (confirm('Por favor, confirme que desea eliminar el protocolo '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script> --}}

{{-- <script type="text/javascript">
  $(document).ready(function() {
    function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
           
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
};

    $('#myTable').DataTable({
      // "processing":true,
      "serverSide":true,
      "ajax":{url:"{{ url('api/protocolos') }}"},
      "columns":[
                {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
                },
                {data:'descripcion'},
                {data:'color'},
                {data:'nombre'}        
                ],
      "responsive": true,
      "processing":true,
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

    $('#myTable tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        // alert("hola");
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

} );
</script> --}}
<script type="text/javascript">
    function format ( d ) {
    // `d` is the original data object for the row

    var table='<table width="100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    var sintomas=d.sintomas.split('-');
    
    var filas="";
    var i=0;
    for(i=0;i<sintomas.length;i++){
        filas=filas+'<tr class="table-danger">'+'<td>'+sintomas[i]+'</td>'+'<tr>';
    }
    table=table+filas+'</table>';
    return table;
    
};

  $(document).ready(function() {
   
    var table=$('#example').DataTable({
      "serverSide":true,
           "ajax":{url:"{{ url('api/protocolos') }}",
              
         },
           "columns":[
           {
                "className":      'details-control',
                "orderable":      false,
                "data":           'ver',
                "defaultContent": ''
            },
            {data:'descripcion'},
            {data:'codigo'},
            {data:'especialidad'},
            {data:'sintomas'},
            {data:'buttons'}
            
           ],
           "columnDefs": [
            {
                "targets": [ 4 ],
                "visible": false,
                
            },
            // {
            //     "targets": [ 3 ],
            //     "visible": false
            // }
        ],
           // "order": [[1, 'desc']],

      // "responsive": true,
      "processing":true,
      "ordering": false,
      "iDisplayLength": 10,
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

    // Funcion para hacer busquedas 
    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
        
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

} );

 
</script>
<script type="text/javascript">
    function eliminar(id){
        if (confirm('Esta seguro de eliminar el protocolo? '.concat($(this).attr('name')))) {
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });
        $.ajax({
            type:'DELETE',
            url:"/protocolos/"+id,
            dataType:"json",
           
            success: function(response){
                alert("El protocolo fue eliminado exitosamente")
                var table = $('#example').DataTable();
                table.draw();
                },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
                  $.each(err.responseJSON.errors, function (i, error) {
                    alert(error[0]);
                      
                  });
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
            }else{
                return false;
            }
        
    }
    function editar(){

    }


</script>

@endsection
