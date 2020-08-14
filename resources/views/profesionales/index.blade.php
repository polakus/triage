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
					<h5>Nombre de usuario:</h5>			
				</div>
				<div class="col-md-6">
					<h5>{{$usuario->username}}</h5>		
				</div>
				<div class="col-md-6 text-md-right">
					<h5>Email:</h5>			
				</div>
				<div class="col-md-6">
					<h5>{{$usuario->email}}</h5>		
				</div>
				<div class="col-md-6 text-md-right">
					<h5>Rol:</h5>			
				</div>
				<div class="col-md-6">
					<h5>{{$usuario->rol->nombre}}</h5>		
				</div>
				@if($usuario->profesional)
					<div class="col-md-6 text-md-right">
						<h5>Nombre:</h5>			
					</div>
					<div class="col-md-6">
						<h5>{{$usuario->profesional->nombre}}</h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Apellido:</h5>			
					</div>
					<div class="col-md-6">
						<h5>{{$usuario->profesional->apellido}}</h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Domicilio:</h5>			
					</div>
					<div class="col-md-6">
						<h5>{{$usuario->profesional->domicilio}}</h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Matrícula:</h5>			
					</div>
					<div class="col-md-6">
						<h5>{{$usuario->profesional->matricula}}</h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Especialidades:</h5>			
					</div>					
					<div class="col-md-6">
						@foreach($usuario->profesional->detalleProfesional as $esp)
							<h5><li> {{$esp->especialidad->nombre}}</li></h5>
						@endforeach		
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