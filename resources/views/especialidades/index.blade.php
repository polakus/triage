@extends("triagepreguntas.test")




@section("cuerpo")
{{-- <div class="card">
<div class="card-header">Especialidades</div>
<div class="card-body"> --}}
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Protolocos</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
              Agregar un protocolo
            </button>
          </div>
        </div>
</div>
	{{-- <div class="form-row">
		<div class="form-group col-md-2">
			<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
              Agregar
            </button>
		</div>
	</div> --}}
	
	<div class="form-row">
		<div class="form-group col-md-2">
			<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre" >

		</div>
	</div>


	<div class="table-responsive">
	    <table class="table table-bordered table-hover table-sm table-striped" id="myTable">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Nombre</th>
		      <th scope="col">Descripcion</th>
		      <th scope="col">Areas</th>
		      <th scope="col">Accion</th>
		    </tr>
		  </thead>
		  <tbody id="tabla" >
		   	@foreach($especialidades as $e)
		   		<tr>
		   			<td>{{ $e->nombre }}</td>
		   			<td>{{ $e->descripcion }}</td>
		   			<td>{{ $e->tipo_dato }}</td>
		   			<td>
		   			<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar{{ $e->id }}">
		              Editar
		            </button>
		            <div class="modal fade" id="editar{{ $e->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			            <div class="modal-dialog">
			              <div class="modal-content">
			                <div class="modal-header">
			                  <h3 class="modal-title" id="exampleModalLabel">Editar especialidad</h3>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                  </button>
			                </div>
			                <form method="POST" action="/especialidades/{{ $e->id }}">
							@csrf
			                <div class="modal-body">
			                   <div class="container col-md-12">
								<div class="form-group">
									
										{{ method_field('PUT') }}
										<div class="form-row">
											<div class="form-group">
												<label>Nombre</label>
												<input type="text" name="editarnom" class="form-control" placeholder="Cod" value="{{ $e->nombre }}">
											</div>

										</div>
										<div class="form-row">
											<div class="form-group col-md-10">
												<label>Descripcion </label>
												<textarea class="form-control" id="d" name="des" rows="3">{{ $e->descripcion }}</textarea>
											</div>
										</div>
										
										
										
									
								</div>
								
							</div>
			                  
			                  
			                 
			                  
			                </div>
			                <div class="modal-footer">
			                	<button type="submit" class="btn btn-dark">Editar</button>
			                	
			                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			                
			                </div>
			                </form>
			              </div>
			            </div>
			          </div>
			          </td>

		   		</tr>

		   	@endforeach
		  </tbody>
		</table>
</div>


<!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Registracion de Especialidad</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form method="POST" action="/especialidades">
					@csrf
                <div class="modal-body">
                   <div class="container">
					<div class="form-group">
						
							<div class="form-row">
									<div class="form-group">
											<label>Nombre</label>
											<input type="text" name="esp_nombre" class="form-control" placeholder="Nombre">
									</div>

							</div>
							<div class="form-row">
									<div class="form-group col-md-10">
										<label>Descripcion </label>
										<textarea class="form-control" name="descripcion" rows="3" placeholder="Descripcion"></textarea>
									</div>
							</div>
								<div class="form-row">
									<div class="form-group">
										<label>Area </label>
										<select class="form-control">
											@foreach($areas as $a)
												<option value="{{ $a->id }}">{{ $a->tipo_dato }} </option>

											@endforeach
										</select>
									</div>
							</div>

						
					</div>
					
				</div>
                  
                  
                 
                  
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-dark">Guardar</button>
                  
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                
                </div>
                </form>
              </div>
            </div>
          </div>

@endsection
@section("scripts")
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>





@endsection