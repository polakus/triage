@extends("layouts.plantilla")

@section("cabecera")
    
@endsection

@section("cuerpo")

<div class="form-group row">

	<div class="col-md-6 text-md-right">
		<h4>Nombre de usuario:</h4>			
	</div>
	<div class="col-md-6">
		<h4>{{$usuario->username}}</h4>		
	</div>
	<div class="col-md-6 text-md-right">
		<h4>Email:</h4>			
	</div>
	<div class="col-md-6">
		<h4>{{$usuario->email}}</h4>		
	</div>
	<div class="col-md-6 text-md-right">
		<h4>Rol:</h4>			
	</div>
	<div class="col-md-6">
		<h4>{{$usuario->rol->nombre}}</h4>		
	</div>


	<div class="col-md-6 text-md-right">
		<h4>Nombre:</h4>			
	</div>
	<div class="col-md-6">
		<h4>{{$usuario->profesional->nombre}}</h4>		
	</div>
	<div class="col-md-6 text-md-right">
		<h4>Apellido:</h4>			
	</div>
	<div class="col-md-6">
		<h4>{{$usuario->profesional->apellido}}</h4>		
	</div>
	<div class="col-md-6 text-md-right">
		<h4>Domicilio:</h4>			
	</div>
	<div class="col-md-6">
		<h4>{{$usuario->profesional->domicilio}}</h4>		
	</div>
	<div class="col-md-6 text-md-right">
		<h4>Matrícula:</h4>			
	</div>
	<div class="col-md-6">
		<h4>{{$usuario->profesional->matricula}}</h4>		
	</div>

	<br><br><br><br>
	<div class="col-md-6">
		<a class="btn btn-default btn-close" href="javascript:history.back()">Volver</a>
	</div>
</div>

@endsection

@section("pie")
    
@endsection