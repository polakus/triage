<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS  Esto es del DASHBOARD -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
   <!-- Custom styles for this template -->
    <link href="{{ asset('assets/dashboard.css') }}" rel="stylesheet">
 <!-- <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet"> -->

 {{--   PARA TABS (BORRAR)
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 --}}
    {{-- Data tables --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"> --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    @yield("css")
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .my-custom-scrollbar {
        position: relative;
        height: 300px;
        overflow: auto;
      }
      .table-wrapper-scroll-y {
        display: block;
      }

    </style>
   
  </head>
  <body>
    <?php
  // echo $request->input('a');
  $url_array =  explode('/', URL::current()) ;
  // echo $url_array[3];
  $usuario = Auth::user();
?>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Hopistal San Bernardo</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->

  {{-- <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul> --}}
    <div class="dropdown" >
    <a class="btn btn-dark dropdown-toggle" style="background-color: transparent;"href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{ $usuario->name }}
    </a>

    <div class="dropdown-menu dropdown-menu-lg-right">
      <a class="dropdown-item" href="{{ route('logout') }}"
      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modalPerfil{{$usuario->id}}">Perfil</button>
     
    </div>
  </div>


</nav>


<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a id="inicio" class="nav-link <?php  if ($url_array[3] == "inicio"){ echo "active";} ?>" href="{{ route('inicio') }}">
              <span data-feather="home"></span>
              Inicio <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a id="pacientes" class="nav-link <?php  if ($url_array[3] == "pacientes"){ echo "active";} ?>" href="{{route('pacientes.index')}}">
              <span data-feather="users"></span>
              Pacientes
            </a>
          </li>
          <li class="nav-item">
            <a  id="turnos" class="nav-link  <?php  if ($url_array[3] == "turnos"){ echo "active";} ?>" href="{{route('mostrar')}}">
              <span data-feather="calendar"></span>
              Atenciones
            </a>
          </li>
          <li class="nav-item">
            <a id="sintomas"class="nav-link <?php  if ($url_array[3] == "sintomas"){ echo "active";} ?>" href="{{route('sintomas.index')}}">
              <span data-feather="users"></span>
              Sintomas
            </a>
          </li>
          <li class="nav-item">
            <a id="atencionclinica"class="nav-link <?php  if ($url_array[3] == "atencionclinica"){ echo "active";} ?>" href="{{route('atencionclinica.index')}}">
              <span data-feather="bar-chart-2"></span>
              Triaje Clinico
            </a>
          </li>
          <li class="nav-item">
            <a id="salas"class="nav-link <?php  if ($url_array[3] == "salas"){ echo "active";} ?>" href="{{route('salas.index')}}">
              <span data-feather="layers"></span>
              Salas
            </a>
          </li>
          <li class="nav-item">
            <a id="protocolos" class="nav-link <?php  if ($url_array[3] == "protocolos"){ echo "active";} ?>" href="{{route('protocolos.index')}}">
              <span data-feather="layers"></span>
              Protocolos
            </a>
          </li>
          <li class="nav-item">
            <a id="cie "class="nav-link <?php  if ($url_array[3] == "cie"){ echo "active";} ?>" href="{{route('cie.index')}}">
              <span data-feather="layers"></span>
              CIE
            </a>
          </li>
          <li class="nav-item">
            <a id="especialidades" class="nav-link <?php  if ($url_array[3] == "especialidades"){ echo "active";} ?>" href="{{route('especialidades.index')}}">
              <span data-feather="layers"></span>
              Especialidades
            </a>
          </li>
          <li class="nav-item">
            <a id="especialidades" class="nav-link" href="/profesionales/atenciones">
              <span data-feather="layers"></span>
              Profesionales Atenciones
            </a>
          </li>
          <li class="nav-item">
            <a id="usuarios"class="nav-link <?php  if ($url_array[3] == "usuarios"){ echo "active";} ?>"  href="{{route('usuarios.index')}}">
              <span data-feather="users"></span>
              Usuarios
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
     

<!-- Modal -->
<div class="modal fade" id="modalPerfil{{$usuario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">

          <div class="col-md-6 text-md-right">
            <h5>Nombre de usuario:</h5>     
          </div>
          <div class="col-md-6">
            <h5>{{$usuario->username}}</h5>   
          </div>
          <div class="col-md-6 text-md-right">
            <h5>Email:</h5>     
          </div>
          <div class="col-md-6">
            <h5>{{$usuario->email}}</h5>    
          </div>
          <div class="col-md-6 text-md-right">
            <h5>Rol:</h5>     
          </div>
          <div class="col-md-6">
            <h5>{{$usuario->rol->nombre}}</h5>    
          </div>
          @if($usuario->profesional)
            <div class="col-md-6 text-md-right">
              <h5>Nombre:</h5>      
            </div>
            <div class="col-md-6">
              <h5>{{$usuario->profesional->nombre}}</h5>    
            </div>
            <div class="col-md-6 text-md-right">
              <h5>Apellido:</h5>      
            </div>
            <div class="col-md-6">
              <h5>{{$usuario->profesional->apellido}}</h5>    
            </div>
            <div class="col-md-6 text-md-right">
              <h5>Domicilio:</h5>     
            </div>
            <div class="col-md-6">
              <h5>{{$usuario->profesional->domicilio}}</h5>   
            </div>
            <div class="col-md-6 text-md-right">
              <h5>Matrícula:</h5>     
            </div>
            <div class="col-md-6">
              <h5>{{$usuario->profesional->matricula}}</h5>   
            </div>
            <div class="col-md-6 text-md-right">
              <h5>Especialidades:</h5>      
            </div>          
            <div class="col-md-6">
              @foreach($usuario->profesional->detalleProfesional as $esp)
                <h5><li> {{$esp->especialidad->nombre}}</li></h5>
              @endforeach   
            </div>
          @else
            <h5>No hay más datos para este usuario</h5>
          @endif
        </div>
          @if($usuario->profesional)
            <div class="text-center">
              <a class="btn btn-primary" disabled>{{ __('Completar') }}</a>     
            </div>
          @else
            <div class="text-center">
              <a class="btn btn-primary" href="{{route('profesionales.create')}}">{{ __('Completar') }}</a>
            </div>
          @endif
      </div>
    </div>
  </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Pacientes atendidos</h1>
        
</div>
    <div class="row">
            <div class="col">
               <button class="btn btn-dark" id="btnver" onclick="ver()">Cargar datos NN</button>
               <button class="btn btn-dark" id="btnocultar" onclick="ocultar()">Ocultar datos nn</button>
            </div>
           
          </div>
          <br>
          <div class="row" id="historial">
            <div class="col">
              <div class="table-responsive">
              <table class="table table-bordered table-sm" id="tablann">
                  <thead>
                    <tr>
                      <th>
                        Fecha y Horario
                      </th>
                      <th>
                        Historial
                      </th>
                      <th>
                        Accion
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($nn as $n)
                      <tr>
                        <td>{{ $n->fechaNac }}</td>
                        <td>{{ $n->descripcion }}</td>
                        <td>
                          <form method="POST" action="/pacientes/{{ $n->id_atencion }}">
                            @csrf
                            <input type="hidden" name="id_paciente" value="{{ $id }}">
                            {{ method_field('PUT') }}
                            <button type="submit"class="btn btn-success btn-sm">Seleccionar</button>
                          </form>
                          
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
              </div>
            </div>
          </div>

          <br>
          <form method="POST" action="/pacientes/{{ $id }}">
            @csrf
            {{ method_field('PUT') }}
            <input type="hidden" name="comprobador" value="1">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{count($errors)>0 ? old('nombre'):$paciente->nombre}}" placeholder="Nombre">
                @error('nombre')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Apellido</label>
                <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{count($errors)>0 ? old('apellido'):$paciente->apellido}}" placeholder="Apellido">
                @error('apellido')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Teléfono</label>
                <input type="number" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{count($errors)>0 ? old('telefono'):$paciente->telefono}}" placeholder="Teléfono">
                @error('telefono')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputEmail4">Fecha de Nacimiento</label>
                <input type="date" name="fechaNac" class="form-control @error('fechaNac') is-invalid @enderror" value="{{count($errors)>0 ? old('fechaNac'):$paciente->fechaNac}}" id="inputEmail4">
                @error('fechaNac')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">Sexo</label>
                <select name="sexo" id="inputState" class="form-control @error('sexo') is-invalid @enderror" >
                @if(count($errors)>0)
                  <option value="" ></option>
                  <option value="Masculino" {{ (collect(old('sexo'))->contains('Masculino')) ? 'selected':'' }}>Masculino</option>
                  <option value="Femenino" {{ (collect(old('sexo'))->contains('Femenino')) ? 'selected':'' }}>Femenino</option>
                @else
                  <option value="" ></option>
                  <option value="Masculino" {{ $paciente->sexo == 'Masculino' ? 'selected':'' }}>Masculino</option>
                  <option value="Femenino" {{ $paciente->sexo == 'Femenino' ? 'selected':'' }}>Femenino</option>
                @endif
                </select>
                @error('sexo')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group col-md-8">
                <label for="inputAddress">Dirección</label>
                <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ count($errors)>0 ? old('direccion') : $paciente->domicilio}}" id="inputAddress" placeholder="Dirección">
                @error('direccion')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputZip">Documento</label>
                <input type="number" max="99999999" min="1000000" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{count($errors)>0 ? old('dni'):$paciente->dni}}" id="inputZip" placeholder="Número de Documento">
                @error('dni')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{route('pacientes.index')}}" class="btn btn-primary">Volver</a>
          </form>
      @yield("pie")
    </main>
  </div>
</div>
<script src='{{ asset('js/jquery.js') }}'></script>
{{-- js del dash board --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script> {{-- Este scrip sirve para los modales --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> --}}
        <script src="../assets/dashboard.js"></script>

        {{-- JS Datatables --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#tablann').DataTable({
       "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "Término de búsqueda",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        //only works for built-in buttons, not for custom buttons
        "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
    }           
    });
} );
</script>


<script>
  document.getElementById('historial').style.display = 'none';
  document.getElementById('btnocultar').style.display = 'none';
function ver() {
     document.getElementById('historial').style.display = 'block';
     document.getElementById('btnver').style.display = 'none';
      document.getElementById('btnocultar').style.display = 'block';
}
function ocultar(){
  document.getElementById('historial').style.display = 'none';
     document.getElementById('btnver').style.display = 'block';
      document.getElementById('btnocultar').style.display = 'none';
}
</script>
@yield("scripts")

</body>
</html>








































































