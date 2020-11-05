<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Template · Bootstrap</title>

    {{-- CSS --}}
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS  DASHBOARD -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <!-- Custom styles for this template DASHBOARD -->
    <link href="../assets/dashboard.css" rel="stylesheet">

    {{-- DataTable --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">

    {{-- Autocompletar --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}">
 
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
      {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div> --}}

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

      @yield("cuerpo")
     <!--  <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
      @yield("pie")
    </main>
  </div>
</div>

{{-- Scripts --}}

{{-- JQUERY --}}
<script src='{{ asset('js/jquery.js') }}'></script>

{{-- js del dash board --}}
<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.slim.min.js') }}"></script>
<script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
{{-- <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
{{-- <script src="{{ asset('js/feather.min.js') }}"></script> --}} {{-- Sale advertencia de la url --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> --}}
<script src="../assets/dashboard.js"></script>

 {{-- DataTable --}}
<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>

{{-- Boostrap --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}} {{-- Este tmb tira advertencia
 --}}
{{-- Autocompletar --}}

<script src="{{ asset('js/jquery-ui.js') }}"></script>

@yield("scripts")

</body>
</html>
