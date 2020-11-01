@extends("triagepreguntas.test")


@section("cuerpo")
<div class="card">
	<div class="card-header">Detalles de Protocolo</div>
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-2">
					<a class="btn btn-dark" href="{{ route('protocolos.index') }}">Volver</a>
				</div>
			</div>
			<h4>{{ $protocolo->descripcion }}</h4>
			<h5>Detalles:</h5>
			<table id="dtBasicExample" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Código</th>
						<th scope="col">Especialidad</th>
					</tr>
				</thead>
				<tbody id="tabla">
				@foreach($sintomas_protocolo as $sp)
					<tr>
						<td>{{ $sp->descripcion }}</td>
						<td>
							@foreach($especialidad_protocolo as $esp)
							{{ $esp->nombre }}
							@endforeach
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection

@section("pie")
    
@endsection