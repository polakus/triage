<nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand" href="#">Hospital San Bernardo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li id="pacientes" class="nav-item">
                <a class="nav-link" href="{{route('pacientes.index')}}">Pacientes <span class="sr-only">(current)</span></a>
            </li>
            

            <li id="turnos" class="nav-item">
                <a class="nav-link" href="{{route('mostrar')}}">Turnos <span class="sr-only">(current)</span></a>
            </li>
            <li id="sintomas" class="nav-item">
                <a class="nav-link" href="{{route('sintomas.index')}}">Sintomas <span class="sr-only">(current)</span></a>
            </li>
            <li id="tc" class="nav-item">
                <a class="nav-link" href="{{route('atencionclinica.index')}}">Triaje Clinico <span class="sr-only">(current)</span></a>
            </li>
            <li id="salas" class="nav-item">
                <a class="nav-link" href="{{route('salas.index')}}">Salas<span class="sr-only">(current)</span></a>
            </li>
            <li id="protocolos" class="nav-item">
                <a class="nav-link" href="{{route('protocolos.index')}}">Protocolos<span class="sr-only">(current)</span></a>
            </li>
            <li id="cie" class="nav-item">
                <a class="nav-link" href="{{route('cie.index')}}">CIE<span class="sr-only">(current)</span></a>
            </li>
            <li id="usuarios" class="nav-item">
                <a class="nav-link" href="{{route('especialidades.index')}}">Especialidades<span class="sr-only">(current)</span></a>
            </li>
            
            <li id="usuarios" class="nav-item">
                <a class="nav-link" href="{{route('usuarios.index')}}">Usuarios<span class="sr-only">(current)</span></a>
            </li>
            
            
        </ul>




    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-sm-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
