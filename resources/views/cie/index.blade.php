@extends("layouts.plantillaTest")



@section("cuerpo")
<div class="card">
<div class="card-header">Cie</div>
<div class="card-body">
	<div class="form-group">
		<div class="row">
		 {{--  <div class="col">
		   <input class="form-control col-md-2" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre" >
		  </div> --}}
		  <div class="col-auto">
		  	<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
              Agregar
            </button>
		   
		  </div>
		</div>	
	</div>
	<div class="form-row">
		<div class="form-group col-md-2">
			<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre" >

		</div>
	</div>
	    <table class="table table-bordered table-sm table-hover" id="myTable">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Codigo</th>
		      <th scope="col">Descripcion</th>
		      <th scope="col">Accion</th>
		    </tr>
		  </thead>
		  <tbody id="tabla" >
		   	@foreach($cie as $c)
		   		<tr>
		   			<td>{{ $c->codigo }}</td>
		   			<td>{{ $c->descripcion }}</td>
		   			<td>
		   			<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar{{ $c->id }}">
		              Editar
		            </button>
		            <div class="modal fade" id="editar{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			            <div class="modal-dialog">
			              <div class="modal-content">
			                <div class="modal-header">
			                  <h3 class="modal-title" id="exampleModalLabel">Editar cie</h3>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                  </button>
			                </div>
			                <div class="modal-body">
			                  <div class="row col-md-16">
								<div class="form-group">
									<form method="POST" action="/cie/{{ $c->id }}">
										@csrf
										{{ method_field('PUT') }}
										<div class="table-responsive">
											<table class="table table-bordered"  id=tablita>
												<tr>
													<td width="100"><input type="text" name="editarcod" class="form-control" placeholder="Cod" value="{{ $c->codigo }}"></td>
													<td><input type="text" name="editardesc" class="form-control" value="{{ $c->descripcion }}" ></td>
													
												</tr>
											</table>
											
										</div>
										&nbsp 
										<button type="submit" class="btn btn-dark btn-sm">Editar</button>
									</form>
								</div>
								
							</div>
			                  
			                  
			                 
			                  
			                </div>
			                <div class="modal-footer">
			                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			                
			                </div>
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
                  <h3 class="modal-title" id="exampleModalLabel">Registracion de Cie</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row col-md-16">
					<div class="form-group">
						<form method="POST" action="/cie">
							@csrf
							<div class="table-responsive">
								<table class="table table-bordered"  id=tabla_sintomas>
									<tr>
										<td class="col-md-2"><input type="text" name="ciecodigo[]" class="form-control" placeholder="Cod"></td>
										<td><input type="text" name="ciedescripcion[]" class="form-control"placeholder="Nombre"></td>
										<td><button type="button" id="add" name="add" class="btn btn-dark">Agregar filas</button></td>
									</tr>
								</table>
								
							</div>
							&nbsp 
							<button type="submit" class="btn btn-dark">Agregar CIE</button>
						</form>
					</div>
					
				</div>
                  
                  
                 
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                
                </div>
              </div>
            </div>
          </div>


</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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

<script >
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
	
		$('#tabla_sintomas').append('<tr id="row'+i+'">'+
						'<td><input type="text" name="ciecodigo[]" class="form-control"placeholder="Cod"></td>'+
						'<td><input type="text" name="ciedescripcion[]" class="form-control"placeholder="Nombre"></td>'+
						'<td><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn_remove">Quitar</button></td>'+
					'</tr>');
	});

	$(document).on('click','.btn_remove',function(){
		var id= $(this).attr('id');
		$('#row'+id).remove();
	});

})
</script>



@endsection

