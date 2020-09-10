@extends("triagepreguntas.test")

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Sintomas</h4>
</div>
<div class="form-group">
<div class="row">
  <div class="col">
   <input class="form-control col-md-2" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre" >
  </div>
  <div class="col-auto">
    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal">
          Agregar
        </button>
   
  </div>
</div>  
</div>
 <table class="table table-bordered table-striped table-hover table-sm" id="myTable">
  <thead>
    <tr>
      <th scope="col" >#</th>
      <th scope="col">Sintomas</th>
      <th scope="col" >Accion</th>
    </tr>
  </thead>
  <tbody>
   @foreach($sintomas as $sintoma)
      <tr>
        <form class= "form-inline" method="POST" action="/sintomas/{{ $sintoma->id }} ">
          @csrf
          {{ method_field('DELETE') }}
          <td>{{ $sintoma->id }}</td>
          <td>{{ $sintoma->descripcion }}</td>
          <td><button type="submit" class="btn btn-danger btn-sm">Eliminar</button></td>
        </form>
      </tr>


   @endforeach
  </tbody>
</table>

<!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleModalLabel">Registracion de Sintomas</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <div class="row col-md-10">
                  <div class="form-group">
                    <form method="POST" action="/sintomas">
                      @csrf
                      <div class="table-responsive">
                        <table class="table table-sm table-bordered"  id=tabla_sintomas>
                          <tr>
                            <td><input type="text" name="text_sintomas[]" class="form-control" placeholder="Nombre del Sintoma"></td>
                            <td><button type="button" id="add" name="add" class="btn btn-dark btn-sm">Agregar filas</button></td>
                          </tr>
                        </table>
                        
                      </div>
                      <button type="submit" class="btn btn-success btn-sm">Agregar sintomas</button>
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


@endsection
@section("scripts")
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>


<script >
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;

    $('#tabla_sintomas').append('<tr id="row'+i+'">'+
            '<td><input type="text" name="text_sintomas[]" class="form-control" placeholder="Nombre del Sintoma"></td>'+
            '<td><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn-sm btn_remove">Quitar</button></td>'+
          '</tr>');
  });

  $(document).on('click','.btn_remove',function(){
    var id= $(this).attr('id');
    $('#row'+id).remove();
  });

})
</script>

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
@endsection

{{-- @section("cuerpo")

	<div class="card">
    <div class="card-header"> Sintomas </div>
      <div class="card-body">
          <div class="form-group">
          <div class="row">
            <div class="col">
             <input class="form-control col-md-2" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre" >
            </div>
            <div class="col-auto">
              <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
                    Agregar
                  </button>
             
            </div>
          </div>  
        </div>
           <table class="table table-bordered table-striped table-hover table-sm" id="myTable">
            <thead class="thead-dark">
              <tr>
                <th scope="col" >#</th>
                <th scope="col">Sintomas</th>
                <th scope="col" >Accion</th>
              </tr>
            </thead>
            <tbody>
             @foreach($sintomas as $sintoma)
             		<tr>
             			<form class= "form-inline" method="POST" action="/sintomas/{{ $sintoma->id }} ">
             				@csrf
             				{{ method_field('DELETE') }}
      	       			<td>{{ $sintoma->id }}</td>
      	       			<td>{{ $sintoma->descripcion }}</td>
      	       			<td><button type="submit" class="btn btn-danger btn-sm">Eliminar</button></td>
             			</form>
             		</tr>


             @endforeach
            </tbody>
          </table>

          <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">Registracion de Sintomas</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                       <div class="row col-md-10">
                            <div class="form-group">
                              <form method="POST" action="/sintomas">
                                @csrf
                                <div class="table-responsive">
                                  <table class="table table-bordered"  id=tabla_sintomas>
                                    <tr>
                                      <td><input type="text" name="text_sintomas[]" class="form-control" placeholder="Nombre del Sintoma"></td>
                                      <td><button type="button" id="add" name="add" class="btn btn-dark">Agregar filas</button></td>
                                    </tr>
                                  </table>
                                  
                                </div>
                                <button type="submit" class="btn btn-success">Agregar sintomas</button>
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
            </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>


<script >
$(document).ready(function(){
  var i=1;
  $('#add').click(function(){
    i++;

    $('#tabla_sintomas').append('<tr id="row'+i+'">'+
            '<td><input type="text" name="text_sintomas[]" class="form-control" placeholder="Nombre del Sintoma"></td>'+
            '<td><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn_remove">Quitar</button></td>'+
          '</tr>');
  });

  $(document).on('click','.btn_remove',function(){
    var id= $(this).attr('id');
    $('#row'+id).remove();
  });

})
</script>

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

@endsection --}}