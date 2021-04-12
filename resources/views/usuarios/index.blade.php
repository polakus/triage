@extends("triagepreguntas.test")

@section("cuerpo")
<div id="alert" role="alert"> </div>
	   	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Usuarios</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          	<!-- Button trigger modal -->
			{{-- <a type="button" class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#modalUsuario">
			Registrar Usuario
			</a> --}}
           <a class="btn btn-outline-secondary btn-sm ml-1" href="{{ route('usuarios.create') }}">Registrar Usuario</a>
            <a class="btn btn-outline-secondary btn-sm ml-1" href="/usuarios/pendientes">Usuarios Pendientes</a>
          </div>
        </div>
      </div>
		<div class="flash-message">
		    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
		      @if(Session::has('alert-' . $msg))

		      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		      @endif
		    @endforeach
		</div>

		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
				<thead >
					<tr>
            <th scope="col">Estado</th>
						<th scope="col">Usuario</th>
						<th scope="col">Nombre</th>
						<th scope="col">Email</th>
						<th scope="col">Rol</th>
						<th scope="col">Acción<nav></nav></th>
					</tr>
				</thead>
				<tbody id="tabla">

				</tbody>
			</table>
		</div>

@endsection
@section("scripts")
@parent


{{-- <script>
$('form[id^="a2"').submit( function() {
	if (confirm('Por favor, confirme que desea eliminar al usuario '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script> --}}
{{-- JS Datatables --}}

<script type="text/javascript">


$(document).ready(function() {
    $('#myTable').DataTable({
      "processing":true,
        "responsive":true,
          "serverSide":true,
      // "iDisplayLength": 50,
      "ajax":{url:"{{ url('api/tablausuario') }}",
         },
         "columns":[
            {data:'estado'},
            {data:'username'},
            {data:'name'},
            {data:'email'},
            {data:'buttons'}
           ],
           "columnDefs": [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 4 },
            { responsivePriority: 3, targets: 1 }
          
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


function eliminar(id,username){
  if (confirm('¿Esta seguro de eliminar a '+username+'? Tenga en cuenta que se eliminara todos los datos relacionados a este usuario.')) {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'DELETE',
      url:"/usuarios/"+id,
      data:{
          id:id,
      },
      dataType:"json",
      success: function(response){
        // document.getElementById('alert').style.display = 'block';  
        $('#alert').addClass('alert '+response.tipo);
        $('#alert').html('<b>'+response.mensaje+'</b>');
        $("#alert").fadeTo(4000, 500).slideUp(500, function(){
          $("#alert").slideUp(500);
		    });  
	      var table=$("#myTable").DataTable();
	      table.draw();
	    },
      error:function(err){
        alert('Ocurrio un error');          
	    }
    });
	  $("#alert").removeClass('alert'); 
	}
}

</script>
@endsection

@section("pie")
    
@endsection