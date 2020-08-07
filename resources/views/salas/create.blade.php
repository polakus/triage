@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="card">
  <div class="card-header">Registracion de sala</div>
    <div class="card-body">
      <form method="POST" action="/salas">
        @csrf

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre">
          </div>
          <div class="form-group col-md-3">
            <label for="inputState">Área</label>
            <select name="area" id="inputState" class="form-control">
              @foreach($areas as $area)
                <option value="{{$area->id}}">{{$area->tipo_dato}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nro. Camas</label>
            <input type="number" id="quantity" name="camas" min="0" max="100" placeholder="Nro. Camas" class="form-control">
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a class="btn btn-default btn-dark" href="{{ route('salas.index') }}">Volver</a>


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
