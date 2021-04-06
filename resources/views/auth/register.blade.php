<!DOCTYPE html>
<html>
<head>
  <title>Hospital San Bernardo</title>
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
         width: 40%;
        margin: 5px 0 25px;
      }
      
      .form-group input{
          font-size: 17px;
          border-radius: 5px;
          padding-left: 54px;
          box-shadow: 0px 0px 3px #848484;
          width: 300px;
      }

      .form-group::before{
          font-family: "Font Awesome\ 5 Free";
          position: absolute;
          left: 28px;
          font-size: 22px;
          padding-top:4px;
      }

      /*.form-group#user-group::before{
          content: "\f007";
      }

      .form-group#contrasena-group::before{
          content: "\f023";
      }*/
      .forgot{
          margin-top: -5px;
      }

      .forgot a{
          color: #848484;
      }

    </style>
</head>
<body>
<div class="container">
    <div class="card">
      <div class="card-header">Registración de Usuario</div>
        <div class="card-body text-center">
          <div class="flash-message">
              @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                  @if(Session::has('alert-' . $msg))
                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('usuarios.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                  @endif
              @endforeach
          </div>

        </div>
        <div class="modal-dialog">
          <div class="col-sm-12 main-section">
            <div class="modal-content" style="border:0px;">
         <form class="col-12"  method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="id_rol">Rol</label>
                            <div class="col-md-6">
                                <select name="id_rol" id="id_rol" class="form-control @error('id_rol') is-invalid @enderror">
                                    <option value=""></option>
                                    @foreach($roles as $rol)
                                    <option value="{{$rol->id}}" {{ old('id_rol')==$rol->id ? 'selected': '' }}>{{$rol->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('id_rol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-9 offset-md-3">
                                
                                 <button type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i>  Registrarse </button>
                                  <a href="{{ route('login') }}" type="submit" class="btn btn-dark"><i class="fas fa-sign-in-alt"></i>  Volver </a>
                            </div>
                        </div>
                        
                  </div>
                </div>
              </div>
    </div>
</body>
</html>


