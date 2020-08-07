@extends('layouts.plantillaTest')


@section('cuerpo')

<div class="card">
	<div class="card-header">Analisis de acuerdo a los Sintomas descriptos</div>
		<div class="card-body">
			@if($bandera=="")
			  @if($disponibles_salas != "")

			  	@if($color == "verde")
				  	<div class="alert alert-success" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	@foreach($disponibles_salas as $dis)
				 				 	<p>{{ $dis->tipo_dato }} Sala Nº: {{ $dis->nombre }}</p>
				 				 	@endforeach
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-success btn-close ml-4" href="{{ route('pacientes.index') }}">Listo!</a>

			  	@elseif($color == "amarillo")
			  		<div class="alert alert-warning" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	@foreach($disponibles_salas as $dis)
				 				 	<p>{{ $dis->tipo_dato }} Sala Nº: {{ $dis->nombre }}</p>
				 				 	@endforeach
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-warning btn-close ml-4" href="{{ route('pacientes.index') }}">Listo!</a>

			  	@else
			  		<div class="alert alert-danger" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	@foreach($disponibles_salas as $dis)
				 				 	<p>{{ $dis->tipo_dato }} Sala Nº: {{ $dis->nombre }}</p>
				 				 	@endforeach
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-danger btn-close ml-4" href="{{ route('pacientes.index') }}">Listo!</a>

			  	@endif
			 @else

			 	@if($color == "verde")
				 		<div class="alert alert-success" role="alert">
				 			@if($respuesta=="")
				 				@if($disponibles==0)
					 				<p>En estos momentos no se encuentra un medico disponible para {{ $especialidad }}...</p>
					 			@else 
					 				<p>En estos momentos se encuentran {{ $disponibles }} medicos disponibles para {{ $especialidad }}, pero desconocemos en que sala estan situados...</p>
					 			@endif
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
					 		<form class= "form-inline" method="POST" action="/turnos/{{ $id_detalle_atencion }} ">
					       			@csrf
					       			{{ method_field('DELETE') }}
					       			<a class="btn btn-success btn-close ml-4 " href="{{ route('pacientes.index') }}"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
					 				
					 			</form>
					 		
					 		@else
					 		<p>{{ $respuesta }}</p>
					 			@if($disponibles==0)
					 				<p>En estos momentos no se encuentran un medicos disponible...</p>
					 			@else
					 				<p>En estos momentos se encuentran {{ $disponibles }} medicos disponibles, pero desconocemos en que sala estan situados...</p>
					 			@endif

					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
				 			<form class= "form-inline" method="POST" action="/turnos/{{ $id_detalle_atencion }} ">
					       			@csrf
					       			{{ method_field('DELETE') }}
					       			<a class="btn btn-warning btn-close ml-4 " href="{{ route('pacientes.index') }}"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			@endif
				 		</div>

			 	@elseif($color == "amarillo")
						<div class="alert alert-warning" role="alert">
							@if($respuesta=="")
								@if($disponibles==0)
									<p>En estos momentos no se encuentra un medico disponible para {{ $especialidad }}...</p>
								@else
									<p>En estos momentos se encuentran {{ $disponibles }} medicos disponibles para {{ $especialidad }}, pero desconocemos en que sala estan situados...</p>
								@endif
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
					 		<form class= "form-inline" method="POST" action="/turnos/{{ $id_detalle_atencion }} ">
					       			@csrf
					       			{{ method_field('DELETE') }}
					       			<a class="btn btn-warning btn-close ml-4 " href="{{ route('pacientes.index') }}"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			
				 			@else
				 			<p>{{ $respuesta }}</p>
				 			@if($disponibles==0)
					 				<p>En estos momentos no se encuentran un medicos disponible...</p>
					 			@else
					 				<p>En estos momentos se encuentran {{ $disponibles }} medicos disponibles, pero desconocemos en que sala estan situados...</p>
					 			@endif
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
				 			<form class= "form-inline" method="POST" action="/turnos/{{ $id_detalle_atencion }} ">
					       			@csrf
					       			{{ method_field('DELETE') }}
					       			<a class="btn btn-warning btn-close ml-4 " href="{{ route('pacientes.index') }}"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			@endif
						</div>
			 	@else
						<div class="alert alert-danger" role="alert">
							@if($respuesta=="")
								@if($disponibles==0)
									<p>En estos momentos no se encuentra un medico disponible para {{ $especialidad }}...</p>
								@else
									<p>En estos momentos se encuentran {{ $disponibles }} medicos disponibles para {{ $especialidad }}, pero desconocemos en que sala estan situados...</p>
								@endif
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
					 		<form class= "form-inline" method="POST" action="/turnos/{{ $id_detalle_atencion }} ">
					       			@csrf
					       			{{ method_field('DELETE') }}
					       			<a class="btn btn-success btn-close ml-4 " href="{{ route('pacientes.index') }}"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
					 				
					 			</form>
					 		
				 			@else
				 			<p>{{ $respuesta }}</p>
				 			@if($disponibles==0)
					 				<p>En estos momentos no se encuentran un medicos disponible...</p>
					 			@else
					 				<p>En estos momentos se encuentran {{ $disponibles }} medicos disponibles, pero desconocemos en que sala estan situados...</p>
					 			@endif
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
				 			<form class= "form-inline" method="POST" action="/turnos/{{ $id_detalle_atencion }} ">
					       			@csrf
					       			{{ method_field('DELETE') }}
					       			<a class="btn btn-warning btn-close ml-4 " href="{{ route('pacientes.index') }}"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			@endif
				 		</div>
			 	@endif

			 @endif
		@else
			
			<div class="alert alert-secondary" role="alert">
				<h4>Nota para el personal</h4>
  				<p>{{ $bandera }}</p>
  				<p>Seleccione la especialidad del medico que desea que lo atiendan y que codigo de triage corresponde</p>
  				<form method="POST" action="/turnos/cargarsinprotocolo">
  					@csrf
  					<input type="hidden" name="atencion" value="{{ $atencion }}">
	  				<div class="form-row">
							<div class="form-group col-md-2">
								<label>Especialidad</label>
			  				<select class="form-control form-control-sm" name="esp">
			  					@foreach($especialidades as $esp)
							  <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
							  @endforeach
							</select>

							</div>
							<div class="form-group col-md-2">
								<label>Codigo de triaje</label>
							<select class="form-control form-control-sm" name="color">
								@foreach($codigos as $c)
							  <option value="{{ $c->id }}">{{ $c->color }}</option>
							  @endforeach
							</select>
							</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-sm">Aceptar</button>
						<a href="{{ route('pacientes.index') }}" class="btn btn-danger btn-sm">Cancelar</a>
					</div>
				</form>
			</div>

		@endif
	</div>
</div>





@endsection