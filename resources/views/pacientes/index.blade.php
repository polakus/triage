@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection




@section("estilos")
  {{-- <style type="text/css">
    .btn{
      display: inline-block;
      transition: .3s;
      border:solid 1.5px;
    }
    .btn-black{
      
      border-color: #2D2C31;
      color: #2D2C31;
      background-color: #eee;
      text-decoration: none;
      
    }
    .btn-black:hover{
      border:solid 1px;
      border-color: #eee;
      color: #eee;
      background-color: #2D2C31;
      text-decoration: none;
    }
  </style> --}}
@endsection

@section("cuerpo")
@if (Session::has('success'))
  <div class="alert alert-success" role="alert">
  <strong>{{ Session::get('success') }}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

@endif



<div class="card">
  <div class="card-header"> Pacientes </div>
    <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-2">
            <form class= "form-inline" method="get" action="/pacientes/create ">
              <button type="submit" class="btn btn-success">Registrar</button>
            </form>
          </div>
          <div class="form-group col-md-2">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
                      Cargar paciente NN
            </button>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Cargar paciente de urgencias</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="/pacientes/nn">
                      @csrf
                      <div class="form-group col-md-10 op">
                        <label>Para:</label>
                        <select class="form-control" name="condicion">
                          <option value="Operar">Operar</option>      
                          <option value="Internar">Internar</option>               
                        </select>
                      </div>
                      <div class="form-group col-md-10 " id="operar">
                        <label>Luego para operar?:</label>
                        <select class="form-control" name="selectop">
                          <option value="si">Si</option>      
                          <option value="no">No</option>               
                        </select>
                      </div>
                      <div class="form-group col-md-10 ">
                        <label>Color:</label>
                        <select class="form-control" name="id_color">
                          @foreach($colores as $color)
                          <option value="{{ $color->id }}">{{ $color->color }}</option>
                         
                          @endforeach         
                        </select>
                      </div>

                      <div class="form-group col-md-10 ">
                        <label>CIE:</label>

                        <div class="table-responsive">
                          <input type="text" name="searchcie" id="searchcie" class="form-control" placeholder="Buscar por cie" onkeyup="myFunctioncie()">
                          <table class="table table-bordered"  id=TablaCie>
                            @foreach($cie as $ci)
                              <tr>
                                <td>{{ $ci->codigo }}-{{ $ci->descripcion }}</td>
                                
                                <td>
                                  <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio{{ $ci->id }}" name="radiocie" class="custom-control-input" value="{{ $ci->id }}" >
                                    <label class="custom-control-label" for="customRadio{{$ci->id }}"> </label>
                                  </div>

                                </td>
                              </tr>
                            @endforeach
                            
                            
                          </table>
                  
                           </div>
                   
                      </div>
                      
                      <div class="form-group col-md-10 ">
                      
                        <label for="exampleFormControlTextarea1">Observacion</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="observacion"></textarea>
                      </div>
                      
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <br>

        <table id="myTable" class="table table-striped table-hover table-sm table-bordered  table-responsive-sm">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Apellido</th>
              <th scope="col" >Nombre</th>
              <th scope="col">DNI</th>
              <th scope="col">Telefono</th>
              <th scope="col">Fecha Nacimiento</th>
              <th scope="col">Sexo</th>      
              <th scope="col" width="170" >Acción</th>
            </tr>
          </thead>
          <tbody>
              @foreach($pacientes as $paciente)
                <tr>
                  <td><strong>{{ $paciente->apellido }}</strong></td>
                  <td>{{ $paciente->nombre }}</td>
                  <td>{{ $paciente->dni }}</td>
                  <td>{{ $paciente->telefono }}</td>
                  <td>{{ $paciente->fechaNac }}</td>
                  <td>{{ $paciente->sexo }}</td>
                  <td>
                    <div class="form-row">
                     <form class= "form-inline" action="{{route('triagepreguntas.show',$paciente->Paciente_id)}}" method="GET">
                        <button type="submit" class="btn btn-primary btn-sm ml-1">Triaje</button>
                      </form>
                      <form class= "form-inline"  method="get">
                        <button type="button" class="btn btn-warning btn-sm ml-1">Urgencia</button>
                      </form>

                      <a href="{{ route('pacientes.edit', $paciente->Paciente_id) }}"  class="btn btn-dark btn-sm ml-1" >Editar</a>
                      
                      
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table> 
      
      </div>
    </div>


     


  
{{-- <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("auto");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[parseInt($('#picker').val())];
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

</script> --}}

<script>
function myFunctioncie() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchcie");
  if(input.value.length==0){
    
    document.getElementById('TablaCie').style.display ="none";
  }
  filter = input.value.toUpperCase();
  table = document.getElementById("TablaCie");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1 && input.value.length>0) {
        tr[i].style.display = "";
        
        document.getElementById('TablaCie').style.display = 'block';
      } else {

        tr[i].style.display = "none";
      }
    }       
  }
}

</script>

<script >
  document.getElementById('operar').style.display = 'none';
  document.getElementById('TablaCie').style.display = 'none';
  $('.op').change(function (e) {
    if(e.target.value == "Internar"){
      document.getElementById('operar').style.display = 'block';
    }
    else{
      document.getElementById('operar').style.display = 'none';
    }
    
});
</script>

{{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable();
} );
</script>


{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}







@endsection

@section("pie")
  
@endsection