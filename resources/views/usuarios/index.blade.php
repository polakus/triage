@extends("triagepreguntas.test")

@section("cuerpo")
<!-- Para Modal -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
{{-- <div class="card">
	<div class="card-header"> Usuarios </div>
	   <div class="card-body"> --}}
	   	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Usuarios</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
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

		{{-- <div class="form-row">
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="{{ route('usuarios.create') }}">Registrar Usuario</a>
			</div>
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="/usuarios/pendientes">Usuarios Pendientes</a>
			</div>
		</div> --}}
		
		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
				<thead >
					<tr>
						<th scope="col" style="width:20%">Usuario</th>
						<th scope="col" style="width:15%">Estado</th>
						<th scope="col" style="width:30%">Email</th>
						<th scope="col" style="width:20%">Rol</th>
						<th scope="col" style="width:15%">Acción<nav></nav></th>
					</tr>
				</thead>
				<tbody id="tabla">
				{{-- 	@foreach($usuarios as $usuario)
					<tr>
						<td>{{ $usuario->username }}</td>
						<td>
						@if( $usuario->isOnline() )
							<li class="text-success">Online</li>
						@else
							<li class="text-muted">Offline</li>
						@endif
						</td>				
						<td>{{ $usuario->email }}</td>
						<td>{{ $usuario->rol->nombre }}</td>
						<td>
							<div class="form-row">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{$usuario->id}}">Ver</button>
								<!-- Modal -->
								<div class="modal fade" id="exampleModalCenter{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h6 class="modal-title" id="exampleModalLongTitle">Datos de Usuario</h6>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												@if($usuario->profesional)
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Nombre:</h6>			
													</div>
													<div class="col-md-4">
														<h6>{{$usuario->profesional->nombre}}</h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Apellido:</h6>			
													</div>
													<div class="col-md-4">
														<h6>{{$usuario->profesional->apellido}}</h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Domicilio:</h6>			
													</div>
													<div class="col-md-4">
														<h6>{{$usuario->profesional->domicilio}}</h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Matrícula:</h6>			
													</div>
													<div class="col-md-4">
														<h6>{{$usuario->profesional->matricula}}</h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Especialidades:</h6>			
													</div>
													<div class="col-md-4">
														@foreach($usuario->profesional->detalleProfesional as $esp)
															<h6><li> {{$esp->especialidad->nombre}}</li></h6>
														@endforeach			
													</div>
												</div>
												@else
												<h6>No hay más datos para este usuario</h6>
												@endif
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
								<form id="a2" name="{{$usuario->username}}" action="usuarios/{{$usuario->id}}" method="post">
									@csrf
									{{method_field('DELETE')}}
									@if(Auth::id()==$usuario->id)
										<button type="submit" class="btn btn-danger btn-sm ml-1" value="{{$usuario->id}}" disabled>Eliminar</button>
									@else
										<button type="submit" class="btn btn-danger btn-sm ml-1" value="{{$usuario->id}}">Eliminar</button>
									@endif
								</form>
							</div>
						</td>
					</tr>
					@endforeach --}}
				</tbody>
			</table>
		</div>

	{{-- </div>
</div>
 --}}
@endsection
@section("scripts")



<script>
$('form[id^="a2"').submit( function() {
	if (confirm('Por favor, confirme que desea eliminar al usuario '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>
{{-- JS Datatables --}}

<script type="text/javascript">
  

$(document).ready(function() {
    $('#myTable').DataTable({
      "responsive":true,
      "iDisplayLength": 50,
      "ajax":{url:"{{ url('api/tablausuario') }}",
         },
         "columns":[
            {data:'username'},
            {data:'name'},
            {data:'email'},
            {data:'rol'},
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