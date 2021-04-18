@extends("triagepreguntas.test")


@section("cuerpo")

<div class="flash-message" id="alerta">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('salas.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4>Registrar un nuevo Paciente</h4>
</div>
<form method="POST" action="/pacientes">
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
    <div class="form-group col-md-4">
      <label for="inputEmail4">Apellido</label>
      <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" placeholder="Apellido">
      @error('apellido')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Teléfono</label>
      <input type="number" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" placeholder="Teléfono">
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
      <input type="date" name="fechaNac" class="form-control @error('fechaNac') is-invalid @enderror" value="{{ old('fechaNac') }}" id="inputEmail4" min="1850-01-01">
      @error('fechaNac')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="form-group col-md-2">
      <label for="inputState">Sexo</label>
      <select name="sexo" id="inputState" class="form-control @error('sexo') is-invalid @enderror" >
        <option value=""></option>
        <option value="Masculino" {{ (collect(old('sexo'))->contains('Masculino')) ? 'selected':'' }}>Masculino</option>
        <option value="Femenino" {{ (collect(old('sexo'))->contains('Femenino')) ? 'selected':'' }}>Femenino</option>
      </select>
      @error('sexo')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
    <div class="form-group col-md-8">
      <label for="inputAddress">Dirección</label>
      <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}" id="inputAddress" placeholder="Dirección">
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
      <input type="number" max="99999999" min="1000000" name="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni') }}" id="inputZip" placeholder="Número de Documento">
      @error('dni')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>
  </div>
  <div style="display:flex;width: 300px;">
      <button type="submit" class="btn btn-primary">Registrar</button>
  <a href="{{route('pacientes.index')}}" class="btn btn-primary">Volver</a>
  </div>

  
</form>

@endsection
@section("scripts")
@parent
<script type="text/javascript">
  $("document").ready(function(){

   $("#alerta").fadeTo(2000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);
              });

});
</script>

@endsection