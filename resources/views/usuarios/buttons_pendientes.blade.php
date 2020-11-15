

<div class="form-row">
	<form id="f1" name="{{$usuario->username}}" class= "form-inline" method="GET" action="/usuarios/pendientes/{{$usuario->id}}/edit">
	@csrf
		<button type="submit" class="btn btn-success btn-sm ml-1 mb-1">Aceptar</button>
	</form>
	<form id="f2" name="{{$usuario->username}}" class= "form-inline" method="POST" action="/usuarios/pendientes/{{$usuario->id}}">
	@csrf
		{{ method_field('DELETE') }}
		<button type="submit" class="btn btn-secondary btn-sm ml-1 mb-1">Rechazar</button>
	</form>
</div>