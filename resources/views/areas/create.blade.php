@extends("triagepreguntas.test")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="card">
  <div class="card-header">Registracion de Area </div>
    <div class="card-body">
      <form method="POST" action="/areas">
        @csrf

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nombre</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Nombre">
            @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a class="btn btn-default btn-close" href="{{ route('salas.index') }}">Volver</a>


        {{--Mensaje--}}
        

        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('salas.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>

      </form>
    </div>
  </div>
</div>

@endsection
