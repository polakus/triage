@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
<form method="POST" action="/pacientes">
  @csrf
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Nombre</label>
      <input type="text" name="nombre" class="form-control" placeholder="Nombre">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Apellido</label>
      <input type="text" name="apellido" class="form-control" placeholder="Apellido">
    </div>
    <div class="form-group col-md-4">
      <label for="inputEmail4">Teléfono</label>
      <input type="text" name="telefono" class="form-control" placeholder="Teléfono">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-2">
      <label for="inputEmail4">Fecha de Nacimiento</label>
      <input type="text" name="fechaNac" class="form-control" id="inputEmail4" placeholder="dd/mm/aaaa">
    </div>
    <div class="form-group col-md-2">
      <label for="inputState">Sexo</label>
      <select name="sexo" id="inputState" class="form-control">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
      </select>
    </div>
    <div class="form-group col-md-8">
      <label for="inputAddress">Dirección</label>
      <input type="text" name="direccion" class="form-control" id="inputAddress" placeholder="Dirección">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputZip">Documento</label>
      <input type="number" max="99999999" min="1000000" name="dni" class="form-control" id="inputZip" placeholder="Número de Documento">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Registrar</button>
  <a href="{{route('pacientes.index')}}" class="btn btn-primary">Volver</a>
  
</form>

@endsection
