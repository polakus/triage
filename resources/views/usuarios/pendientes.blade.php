@extends("triagepreguntas.test")

@section("cabecera")
    
@endsection

@section("cuerpo")
<!-- Para Modal -->
{{-- <div class="card">
	<div class="card-header">Usuarios Pendientes</div>
	  <div class="card-body"> --}}
	  	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Usuarios pendiente</h4>
    </div>
		<div class="flash-message">
		    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
		      @if(Session::has('alert-' . $msg))

		      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		      @endif
		    @endforeach
		</div>

		<div class="form-row">
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="{{ route('usuarios.index') }}">Volver</a>
			</div>
		</div>
		
		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:20%">Usuario</th>
						<th scope="col" style="width:40%">Email</th>
						{{-- <th scope="col" style="width:20%">Rol</th> --}}
						<th scope="col" style="width:20%">Acción<nav></nav></th>
					</tr>
				</thead>
				<tbody id="tabla">
					{{-- @foreach($usuarios as $usuario)
					<tr>
						<td>{{ $usuario->username }}</td>
						<td>{{ $usuario->email }}</td>
						<td>{{ $usuario->rol->nombre }}</td>
						<td>
							<div class="form-row">
								<form id="f1" name="{{$usuario->username}}" class= "form-inline" method="GET" action="/usuarios/pendientes/{{$usuario->id}}/edit">
								@csrf
									<button type="submit" class="btn btn-success btn-sm">Aceptar</button>
								</form>
								<form id="f2" name="{{$usuario->username}}" class= "form-inline" method="POST" action="/usuarios/pendientes/{{$usuario->id}}">
								@csrf
									{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-secondary btn-sm">Rechazar</button>
								</form>
							</div>
						</td>
					</tr>
					@endforeach --}}
				</tbody>
			</table>
		</div>
	{{-- </div>
</div> --}}
@endsection
@section("scripts")


<script>
$('form[id^="f1"').submit( function() {
	if (confirm('Por favor, confirme que desea ACEPTAR la solicitud del usuario '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
$('form[id^="f2"').submit( function() {
	if (confirm('Por favor, confirme que desea RECHAZAR la solicitud del usuario '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>

<script>
	$('form[id^="f"').submit( function() {
		$("<input />").attr("type", "hidden")
			.attr("name", "busqueda")
			.attr("value", $('#myInput').val())
			.appendTo("form");
		return true;
	});
</script>


<script type="text/javascript">
  

$(document).ready(function() {
    $('#myTable').DataTable({
      "responsive":true,
      "iDisplayLength": 50,
      "ajax":{url:"{{ url('api/usuariospendientes') }}",
         },
         "columns":[
            {data:'username'},
         
            {data:'email'},
            // {data:'rol'},
            {data:'buttons'}
            
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




@endsection

@section("pie")
    
@endsection