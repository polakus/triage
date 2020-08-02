@extends("layouts.plantilla")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="row ml-2">
    <form  class="form-inline my-2 my-lg-0" method="GET" action="/pacientes/shows">
    	@csrf
      <input class="form-control mr-sm-2" name="doc"  value="<?php echo $documento ?>" type="search"  aria-label="Search">
      <button type="submit" class="btn  btn-secondary mr-2">Buscar</button>
    </form>

    <a href="{{route('pacientes.create')}}"> 
        <button type="button" class="btn btn-success">Registrar</button>
    </a>
</div>
<br>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nro.</th>
      <th scope="col">DNI</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Telefono</th>
      <th scope="col">Fecha Nacimiento</th>
      <th scope="col">Sexo</th>      
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>
      @foreach($pacientes as $paciente)
        <tr>
          <th scope="row">{{ $paciente->Paciente_id }}</th>
          <td>{{ $paciente->dni }}</td>
          <td>{{ $paciente->nombre }}</td>
          <td>{{ $paciente->apellido }}</td>
          <td>{{ $paciente->telefono }}</td>
          <td>{{ $paciente->fechaNac }}</td>
          <td>{{ $paciente->sexo }}</td>
          <td>
            <div class="form-row">
             <form class= "form-inline" action="{{route('triagepreguntas.show',$paciente->Paciente_id)}}" method="GET">
                <button type="submit" class="btn btn-primary btn-sm">Triaje</button>
              </form>
              <form class= "form-inline"  method="get">
                <button type="button" class="btn btn-warning btn-sm">Editar</button>
              </form>
              <form class= "form-inline"  method="get">
                <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
              </form>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table> 



@endsection

@section("pie")
    
@endsection