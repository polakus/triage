@extends("layouts.plantillaSalas")

@section("cabecera")
    
@endsection

@section("cuerpo")

	<div class="form-row">
    
	    <div class="form-group col-md-2">
			<a class="btn btn-dark" href="{{ route('salas.create') }}">Agregar Sala</a>
		</div>
	    <div class="form-group col-md-2">
			<a class="btn btn-dark" href="{{ route('areas.create') }}">Agregar Área</a>
    	</div>
    </div>
	<form class="form-row" action="{{route('salas.filtro')}}" method="post">
		@csrf
	    <div class="form-group col-md-2">
	      	<label for="inputState">Nombre</label>
	      	<select name="nombre" id="inputState" class="form-control">
	        	<option value="Todos"           	>Todos	          	</option>
	        	<option value="Quirófano"           >Quirófano          </option>
	        	<option value="Consultorio Externo" >Consultorio Externo</option>
	        	<option value="Oftalmología"        >Oftalmología       </option>
	      	</select>
	    </div>
	    <div class="form-group col-md-2">
	      	<label for="inputState">Área</label>
	      	<select name="area" id="inputState" class="form-control">
	         	<option value="Todas" selected>Todas</option>
			@foreach($areas as $area)
	          	<option value="{{$area->id}}">{{$area->tipo_dato}}</option>
	        @endforeach
	      	</select>
	    </div>
	    <div class="form-group col-md-2">
			<button type="submit" class="btn btn-dark">Filtrar</button>
    	</div>
	</form>
    <table class="table table-bordered">
    	<thead class="thead-dark">
        	<tr>
          		<th scope="col" class="col-md-2">Nombre</th>
          		<th scope="col" class="col-md-2">Área</th>
          		<th scope="col" class="col-md-1" >Acción</th>
        	</tr>
      	</thead>
      	<tbody>
       @foreach($salas as $sala)
       		<tr>
       			<form class= "form-inline" method="POST" action="{{route('salas.update', $sala->id)}}">
       				@csrf
       				{{ method_field('PUT') }}
	       			<td>{{ $sala->nombre }}</td>
	       			<td>{{ $sala->area->tipo_dato }}</td>
       			@if($sala->estado == 0)
       				<td><button type="submit" class="btn btn-danger btn-block">Ocupado</button></td>
   				@else
   					<td><button type="submit" class="btn btn-success btn-block">Libre</button></td>
   				@endif
       			</form>
       		</tr>
       @endforeach
      	</tbody>
    </table>
@endsection

@section("pie")
    
@endsection