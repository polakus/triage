@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="card">
  <div class="card-header">Registracion de Area </div>
    <div class="card-body">
      <form method="POST" action="/salas/areas">
        @csrf

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre">
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

@endsection
