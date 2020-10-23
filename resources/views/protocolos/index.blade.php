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

<table id="myTable" class="table table-bordered table-hover table-striped table-sm" cellspacing="0" width="100%">
	<thead class="thead-dark">
		<tr>
			<th scope="col" style="width:20%">Nombre</th>
			<th scope="col" style="width:30%">Código</th>
			<th scope="col" style="width:15%">Acción</th>
		</tr>
	</thead>
	<tbody id="tabla">
	@foreach($protocolos as $protocolo)

			<tr>
				<td>{{ $protocolo->descripcion }}</td>
				<td>{{ $protocolo->codigo->color }}</td>
				<td>
					<div class="form-row">
						<form id="a1" class= "form-inline" action="/protocolos/{{$protocolo->id}}" method="get">
							<button type="submit" class="btn btn-dark btn-sm ml-1">Ver</button>
						</form>

						<form id="a2" name="{{$protocolo->descripcion}}" action="/protocolos/{{$protocolo->id}}" method="post">
							@csrf
							{{method_field('DELETE')}}
							<button type="submit" class="btn btn-danger btn-sm ml-1" value="{{$protocolo->descripcion}}">Eliminar</button>
						</form>
					</div>
				</td>
			</tr>

	@endforeach
	</tbody>
</table>
@endsection

@section("scripts")


<script>
$('form[id^="a2"').submit( function() {
	if (confirm('Por favor, confirme que desea eliminar el protocolo '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable({
      
      
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
@endsection
