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
<div class="form-row">
	<div class="form-group col-md-2">
		<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre">
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
	if (confirm('Por favor, confirme que desea eliminar el protocolo '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>
@endsection
{{-- 
@section("cuerpo")
<div class="card">
	<div class="card-header"> Protocolos </div>
	  <div class="card-body">
		<div class="form-row">
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="{{ route('protocolos.create') }}">Agregar Protocolo</a>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-2">
				<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre">
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
	if (confirm('Por favor, confirme que desea eliminar el protocolo '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>

@endsection

@section("pie")
    
@endsection --}}