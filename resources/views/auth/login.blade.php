


<!DOCTYPE html>
<html>
<head>
  <title>Login de Usuario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <!-- FRAMEWORK BOOTSTRAP para el estilo de la pagina-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <!-- Los iconos tipo Solid de Fontawesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>


  <style type="text/css">
      .container{
        margin-top: 50px;

      }
      .card{
        box-shadow: 0px 0px 3px #848484;
      }

      .card-header{
        text-align: center;
        font-size: 20px;
        background-color: #3b4652;
        color: #eee;
        box-shadow: 0px 0px 3px #848484;
        
      }

      .user-img{
        margin-top: -15px;
        margin-bottom: 20px;

      }
      .user-img img{
        width: 200px;
        height: 200px;

      }
      .btn{
        box-shadow: 0px 0px 3px #848484;
        width: 45%;
        margin: 5px 0 25px;
      }
      
      .form-group input{
          font-size: 17px;
          border-radius: 5px;
          padding-left: 54px;
          box-shadow: 0px 0px 3px #848484;
      }

      .form-group::before{
          font-family: "Font Awesome\ 5 Free";
          position: absolute;
          left: 28px;
          font-size: 22px;
          padding-top:4px;
      }

      .form-group#user-group::before{
          content: "\f007";
      }

      .form-group#contrasena-group::before{
          content: "\f023";
      }
      .forgot{
          margin-top: -5px;
      }

      .forgot a{
          color: #848484;
      }
      @media only screen and (max-width: 375px){
        .btn{
          width: 100%;
          margin-bottom: 5px;
        }
      }

    </style>
    
</head>
<body>
<div class="container">
  <div class="card">
    <div class="card-header">Acceso al sistema</div>
      <div class="card-body text-center">
        <div class="flash-message">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
              {{ session('status') }}
          </div>
        @else
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
              @if(Session::has('alert-' . $msg))
                  <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('usuarios.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
              @endif
          @endforeach
        @endif
        </div>
        <div class="modal-dialog">
          <div class="col-sm-12 main-section">
            <div class="modal-content" style="border:0px;">
              <div class="col-12 user-img">
                <img src="imagenes/doctor.png"class="img-fluid">  
              </div> 
              <form class="col-12" action="{{ route('login') }}" method="POST">
                @csrf
                  <div class="form-group" id="user-group">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Nombre de usuario" required autofocus>
                      @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="form-group" id="contrasena-group">
                    <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  {{--
                   <div class="col-12 text-left">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">{{ __('Recordarme') }}</label>
                      </div>
                  </div>
                  --}}
                  <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i>  Ingresar </button>
                  <a href="{{ route('register') }}" type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i>  Registrarse</a>
              </form>
              <div class="col-12 forgot">
                @if (Route::has('password.request'))
                <a  href="{{ route('password.request') }}">
                  {{ __('Recordar contraseña?') }}
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>