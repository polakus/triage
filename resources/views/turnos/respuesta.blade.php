@extends('layouts.plantillaTest')


@section('cuerpo')

<div class="card">
	<div class="card-header">Analisis del sistema</div>
		<div class="card-body">
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
					       			<button type="input" class="btn btn-danger "> No </button>
					 				
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
					       			<button type="input" class="btn btn-danger "> No </button>
				 				
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
					       			<button type="input" class="btn btn-danger "> No </button>
				 				
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
					       			<button type="input" class="btn btn-danger "> No </button>
				 				
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
					       			<button type="input" class="btn btn-danger "> No </button>
					 				
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
					       			<button type="input" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			@endif
				 		</div>
			 	@endif

			 @endif
	</div>
</div>





@endsection