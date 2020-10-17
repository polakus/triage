@extends("triagepreguntas.test")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h5 class="h5">Registracion de un nuevo protocolo</h5>
</div>
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
              <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('protocolos.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div>
          <form method="POST" action="/protocolos">
            @csrf

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Descripción</label>
                <input type="text" name="desc"  class="form-control @error('desc') is-invalid @enderror" value="{{ old('desc') }}" placeholder="Nombre">
                @error('desc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">Código</label>
                <select name="codigo" id="inputState" class="form-control">
                  @foreach($codigos as $codigo)
                    <option value="{{$codigo->id}}">{{$codigo->color}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputEsp">Especialidad</label>
                <select name="especialidad" id="esp" class="form-control">
                  @foreach($especialidades as $esp)
                    <option value="{{$esp->id}}">{{$esp->nombre}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <label for="inputEmail4">Síntomas</label>
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Descripción</th>
                <th class="th-sm">Acción</th>
              </tr>
            </thead>
            <tbody>
              @foreach($sintomas as $sintoma)
              <tr>
                <td>{{$sintoma->descripcion}}</td>
                <td> <input class="form-check-input position-static" type="checkbox" name="cbs[]" value="{{$sintoma->id}}" ></td>
              </tr>
              @endforeach
            </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Registrar</button>
            <a class="btn btn-default btn-close" href="{{ route('protocolos.index') }}">Volver</a>

      </form>
   {{--  </div>
  </div> --}}
@endsection
