@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
<!-- Para Modal -->
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
<div class="card">
	<div class="card-header">Usuarios Pendientes</div>
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
				<a class="btn btn-dark" href="{{ route('usuarios.index') }}">Volver</a>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-2">
				<input class="form-control" type="text" name="usuario" id="myInput" onkeyup="myFunction()" placeholder="Usuario" value="{{ old('busqueda') }}">
			</div>
		</div>
		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:20%">Usuario</th>
						<th scope="col" style="width:40%">Email</th>
						<th scope="col" style="width:20%">Rol</th>
						<th scope="col" style="width:20%">Acción<nav></nav></th>
					</tr>
				</thead>
				<tbody id="tabla">
					@foreach($usuarios as $usuario)
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

@endsection

@section("pie")
    
@endsection