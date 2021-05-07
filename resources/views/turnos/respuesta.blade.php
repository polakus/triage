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
			<div class="form-group w-25 d-flex">
				<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
				<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm ml-1">Cancelar</a>
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
	  				<select class="form-control form-control-sm select" name="esp">
	  					@foreach($especialidades as $esp)
						  <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
						 @endforeach
					</select>
					</div>
			</div>
			<div class="form-group w-25 d-flex">
				<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
				<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm ml-1">Cancelar</a>
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
	  				<select class="form-control form-control-sm select" name="esp">
	  					@foreach($especialidades as $esp)
					  <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
					  @endforeach
					</select>

					</div>
					<div class="form-group col-md-2">
						<label>Codigo de triaje</label>
					<select class="form-control form-control-sm select" name="color">
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
		
		<div class="form-group w-25 d-flex">
			<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
			<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm ml-1">Cancelar</a>
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
	  				<select class="form-control form-control-sm select" name="esp">
	  					@foreach($especialidades as $esp)
					  <option value="{{ $esp->id }}">{{ $esp->nombre }}</option>
					  @endforeach
					</select>

					</div>
					<div class="form-group col-md-2">
						<label>Codigo de triaje</label>
					<select class="form-control form-control-sm select" name="color">
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
		
		<div class="form-group w-25 d-flex">
			<button type="submit" class="btn btn-dark btn-sm">Aceptar</button>
			<a href="{{ route('pacientes.index') }}" class="btn btn-dark btn-sm ml-1">Cancelar</a>
		</div>
	</form>
	</div>
	@break

@endswitch

@endsection

