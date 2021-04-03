@extends('triagepreguntas.test')

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Analisis de acuerdo a los sintomas descriptos</h4>
</div>
@switch($casos)
	@case("disponibles")
	<div @if($color=="verde") class="alert alert-success" @elseif($color=="amarillo") class="alert alert-warning" @else class="alert alert-danger" @endif  role="alert">
		<h5 class="alert-heading">Resultados obtenidos</h5>
		<hr>
		<p>En estos momentos contamos con los siguientes especialistas disponibles para atender al paciente de acuerdo a los sintomas descriptos:</p>
		<ul>
		@foreach($msj_especialidades as $msj)
			<li>{{ $msj }}</li>
		@endforeach
		</ul>
		<hr>
		<p class="mb-0"><b>Si desea que el paciente sea atendido este dia, porfavor complete los siguientes datos:</b></p>
		<br>
		<form method="POST"  action="/turnos/cargaratencion">
		@csrf
		<input type="hidden" name="atencion" value="{{ $atencion }}">
		<input type="hidden" name="color" value="{{ $color }}">
		<input type="hidden" name="casos" value="{{ $casos }}">
			<div class="form-row">
					<div class="form-group col-md-4">
						<label>Elija que especialidad desea que lo atiendan:</label>
	  				<select class="form-control form-control-sm" name="esp">
	  					@foreach($especialidades as $esp)
						  <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
						 @endforeach
					</select>
					</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
				<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm">Cancelar</a>
			</div>
		</form>
	</div>
	@break
	@case("no disponibles")
	<div @if($color=="verde") class="alert alert-success" @elseif($color=="amarillo") class="alert alert-warning" @else class="alert alert-danger" @endif  role="alert">
		<h5 class="alert-heading">Resultados obtenidos</h5>
		<hr>
		<p>En estos momentos no se encuentran disponibles medicos para atender al paciente.</p>
		<p>Los especialistas capaces de atender al paciente son:</p>
		<ul>
		@foreach($nombres_especialidades as $nombre)
			<li>{{ $nombre }}</li>
		@endforeach
		</ul>
		<hr>
		<p class="mb-0"><b>Si desea hacer esperar al paciente hasta que venga un medico, entonces complete los siguientes campos:</b></p>
		<br>
		<form method="POST"  action="/turnos/cargaratencion">
		@csrf
		<input type="hidden" name="atencion" value="{{ $atencion }}">
		<input type="hidden" name="color" value="{{ $color }}">
		<input type="hidden" name="casos" value="{{ $casos }}">
			<div class="form-row">
					<div class="form-group col-md-4">
						<label>Elija que especialidad desea que lo atiendan:</label>
	  				<select class="form-control form-control-sm" name="esp">
	  					@foreach($especialidades as $esp)
						  <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
						 @endforeach
					</select>
					</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
				<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm">Cancelar</a>
			</div>
		</form>
	</div>
	@break
	@case("probabilidades")
	<div class="alert alert-secondary" role="alert">
		<h4 class="alert-heading">Coincidencias obtenidas!</h4>
		<hr>
		<p>Lo sentimos mucho, no se encontro algun protocolo pero si coincidencias con los que estan almacenados. </p>
		<ul>
		@foreach($msj_especialidades as $msj)
			<li>{{ $msj }}</li>
		@endforeach
		</ul>
		<hr>
		<p class="mb-0"><b>Si desea que el paciente sea atendido este dia, porfavor complete los siguientes datos:</b></p>
		<br>
		<form method="POST" action="/turnos/cargaratencion">
		@csrf
		<input type="hidden" name="atencion" value="{{ $atencion }}">
		<input type="hidden" name="casos" value="{{ $casos }}">
		<input type="hidden" name="sintomas" value="{{ json_encode($sintomas,TRUE)}}">
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
					<div class="form-group col-md-4">
						<label>Desea guardar este nuevo protocolo?</label>
						<br>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="radios" id="radioSi" value="si">
						  <label class="form-check-label">
						   Si
						  </label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="radios" id="radioNo" value="no">
						  <label class="form-check-label">
						   No
						  </label>
						</div>
					</div>
			</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
			<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm">Cancelar</a>
		</div>
	</form>
	</div>
	@break
	@case("no protocolo")
		<div class="alert alert-secondary" role="alert">
		<h4 class="alert-heading">Resultado obtenido</h4>
		<hr>
		<p><b>Lo sentimos mucho, no se encontro algun protocolo o coincidencia con los sintomas que fueron descriptos.</b></p>
		<hr>
		<p class="mb-0"><b>Si desea que el paciente sea atendido, porfavor complete los siguientes datos:</b></p>
		<br>
		<form method="POST" action="/turnos/cargaratencion">
		@csrf
		<input type="hidden" name="atencion" value="{{ $atencion }}">
		<input type="hidden" name="casos" value="{{ $casos }}">
		<input type="hidden" name="sintomas" value="{{ json_encode($sintomas,TRUE)}}">
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
					<div class="form-group col-md-4">
						<label>Desea guardar este nuevo protocolo?</label>
						<br>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="radios" id="radioSi" value="si">
						  <label class="form-check-label">
						   Si
						  </label>
						</div>
						<div class="form-check form-check-inline">
						  <input class="form-check-input" type="radio" name="radios" id="radioNo" value="no">
						  <label class="form-check-label">
						   No
						  </label>
						</div>
					</div>
			</div>
		
		<div class="form-group">
			<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
			<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm">Cancelar</a>
		</div>
	</form>
	</div>
	@break

@endswitch

@endsection




{{-- @extends('triagepreguntas.test')

@section('cuerpo')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Analisis de acuerdo a los sintomas descriptos</h1>
</div>
<div class="card">
	<div class="card-header">Resultado</div>
		<div class="card-body">
			@if($bandera=="")
			  @if($disponibles_salas != "")

			  	@if($color == "verde")
				  	<div class="alert alert-success" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	@foreach($disponibles_salas as $dis)
				 				 	<p>{{ $dis->nombre }} Sala Nº: {{ $dis->nombre }}</p>
				 				 	@endforeach
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-success btn-close ml-4" href="{{ route('pacientes.index') }}">Listo!</a>

			  	@elseif($color == "amarillo")
			  		<div class="alert alert-warning" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	@foreach($disponibles_salas as $dis)
				 				 	<p>{{ $dis->nombre }} Sala Nº: {{ $dis->nombre }}</p>
				 				 	@endforeach
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-warning btn-close ml-4" href="{{ route('pacientes.index') }}">Listo!</a>

			  	@else
			  		<div class="alert alert-danger" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	@foreach($disponibles_salas as $dis)
				 				 	<p>{{ $dis->nombre }} Sala Nº: {{ $dis->nombre }}</p>
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
  					<input type="hidden" name="sintomas" value="{{ json_encode($sintomas,TRUE)}}">
  					<ul>
  						@foreach($sintomas as $s)
  							<li>{{ $s }}</li>
  						@endforeach

  					</ul>
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
							<div class="form-group col-md-4">
								<label>Desea guardar este nuevo protocolo?</label>
								<br>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="radios" id="radioSi" value="si">
								  <label class="form-check-label">
								   Si
								  </label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="radios" id="radioNo" value="no">
								  <label class="form-check-label">
								   No
								  </label>
								</div>
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





@endsection --}}