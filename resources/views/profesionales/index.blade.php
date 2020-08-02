@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="card">
	<div class="card-header">Profesional</div>
		<div class="card-body">
			<div class="flash-message">
			    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
			      @if(Session::has('alert-' . $msg))

			      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			      @endif
			    @endforeach
			</div>


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
				@if($usuario->profesional)
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
					<div class="col-md-6 text-md-right">
						<a class="btn btn-primary" disabled>{{ __('Completar') }}</a>			
					</div>
					<div class="col-md-6">
						<a class="btn btn-default btn-close" href="javascript:history.back()">Volver</a>
					</div>
				@else

					<br><br><br><br>
					<div class="col-md-6 text-md-right">
						<a class="btn btn-primary" href="{{route('profesionales.create')}}">{{ __('Completar') }}</a>
					</div>
					<div class="col-md-6">
						<a class="btn btn-default btn-dark" href="javascript:history.back()">Volver</a>
					</div>
				@endif
			</div>

		</div>
	</div>

@endsection

@section("pie")
    
@endsection