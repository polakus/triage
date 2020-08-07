<!DOCTYPE html>
<html>
<head>
	<title>Hospital San Bernardo</title>
	{{-- Datatables --}}
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  {{-- Boostrap --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">



{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
 --}}


<script src='{{ asset('js/jquery.js') }}'></script>

{{-- <!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> --}}


  <style type="text/css">
    *{
      
    font-family:Arial;
    
    
    }

    header{
      position: sticky;
      top: 0px;
      /*background-color: #2D2C31;*/
      width: 100%;
      z-index: 1000;
      height: 3.3rem;
    }
    .navbar-brand{
      font-size: 15px;
    }
    .nav-item>a{
      /*font-weight: 700;*/

      font-size: 13px;
      transition: .5s;
    }
    .nav-item:hover>a{
      transform: scale(1.1);
    }
    .container-fluid{

      padding: 40px;
      font-size: 13px;
      /*font-weight: bold;*/
    }
    .focus:focus {
      color: red;
    }
    :target {
      color: red;
    }
  </style>

  @yield("estilos")
</head>
<body>

<header>
<?php
  // echo $request->input('a');
  $url_array =  explode('/', URL::current()) ;
  // echo $url_array[3];
  
?>
  <nav class="navbar navbar-dark navbar-expand-sm bg-dark">
 {{--  <nav class="navbar navbar-expand-lg navbar-light " --}} {{-- style="background-color:transparent;" >--}}
  <a class="navbar-brand"  href="{{route('pacientes.index')}}" style="color: #eee; ">Hospital San Bernardo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">

            <li id="pacientes" class="nav-item <?php  if ($url_array[3] == "pacientes"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('pacientes.index')}}" >Pacientes <span class="sr-only">(current)</span></a>
            </li>
            <li id="turnos" class="nav-item <?php  if ($url_array[3] == "turnos"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('mostrar')}}"  >Turnos <span class="sr-only">(current)</span></a>
            </li>
            <li id="sintomas" class="nav-item <?php  if ($url_array[3] == "sintomas"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('sintomas.index')}}">Sintomas <span class="sr-only">(current)</span></a>
            </li>
            <li id="tc" class="nav-item <?php  if ($url_array[3] == "atencionclinica"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('atencionclinica.index')}}">Triaje Clinico <span class="sr-only">(current)</span></a>
            </li>
            <li id="salas" class="nav-item <?php  if ($url_array[3] == "salas"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('salas.index')}}">Salas<span class="sr-only">(current)</span></a>
            </li>
            <li id="protocolos" class="nav-item <?php  if ($url_array[3] == "protocolos"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('protocolos.index')}}">Protocolos<span class="sr-only">(current)</span></a>
            </li>
            <li id="cie" class="nav-item <?php  if ($url_array[3] == "cie"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('cie.index')}}">CIE<span class="sr-only">(current)</span></a>
            </li>
            <li id="usuarios" class="nav-item <?php  if ($url_array[3] == "especialidades"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('especialidades.index')}}">Especialidades<span class="sr-only">(current)</span></a>
            </li>
            <li id="usuarios" class="nav-item <?php  if ($url_array[3] == "usuarios"){ echo "active";} ?>">
                <a class="nav-link" href="{{route('usuarios.index')}}">Usuarios<span class="sr-only">(current)</span></a>
            </li>
    </ul>
    
  </div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-sm-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  style="color: #eee; " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="{{ route('profesionales.index') }}">{{ __('Perfil') }}</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
</header>

@yield("cabecera")
<div class="container-fluid">
    {{-- <div class="row justify-content-center">
        <div class="col-md-12"> --}}
            {{-- <div class="card">
                <div class="card-header">Pacientes</div>
                    <div class="card-body"> --}}
                      @yield("cuerpo")            
                   
                    
                  {{--   </div>
                </div> --}}
           {{--  </div>
        </div> --}}
</div>
@yield("pie")

{{-- JS Boostrap --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


{{-- JS Datatables --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}

<script>
  // $(".navbar-nav a").on("click", function() {
  //     // alert("algun mensaje");
  //     $("navbar-nav").find(".active").removeClass("active");
  //     $(this).parent().addClass("active");
  // } );
</script>
</body>
</html>