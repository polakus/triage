@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
<!-- Para Modal -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
<div class="card">
	<div class="card-header"> Usuarios </div>
	   <div class="card-body">
		<div class="flash-message">
		    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
		      @if(Session::has('alert-' . $msg))

		      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		      @endif
		    @endforeach
		</div>

		<div class="form-row">
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="{{ route('usuarios.create') }}">Registrar Usuario</a>
			</div>
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="/usuarios/pendientes">Usuarios Pendientes</a>
			</div>
		</div>
		{{-- <div class="form-row">
			<div class="form-group col-md-2">
				<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre">
			</div>
		</div> --}}
		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:20%">Usuario</th>
						<th scope="col" style="width:15%">Estado</th>
						<th scope="col" style="width:30%">Email</th>
						<th scope="col" style="width:20%">Rol</th>
						<th scope="col" style="width:15%">Acción<nav></nav></th>
					</tr>
				</thead>
				<tbody id="tabla">
					@foreach($usuarios as $usuario)
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
										<button type="submit" class="btn btn-danger btn-sm" value="{{$usuario->id}}" disabled>Eliminar</button>
									@else
										<button type="submit" class="btn btn-danger btn-sm" value="{{$usuario->id}}">Eliminar</button>
									@endif
								</form>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>

	</div>
</div>





<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  

$(document).ready(function() {
    $('#myTable').DataTable();
} );
</script>
@endsection

@section("pie")
    
@endsection