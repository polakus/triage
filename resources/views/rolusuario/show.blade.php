@extends("triagepreguntas.test")


@section("cuerpo")
<div id='alerta'></div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Modificar Roles de {{Auth::user()->name}}</h4>
</div>

  <label>Buscar Roles</label>
  <div class="form-row">
    <div id="div_buscar" class="form-group col-md-4">
        <input placeholder="Buscar aqui" type="text" id="buscar" class="input form-control"/>
        <listgroup class="is-visible list-group" id="searchList"></listgroup>
    </div>
    <div class="form-group col-md-4">
      <button type="button" id="btn_agregar" onclick="addRow()" class="btn btn-mod">Agregar</button>    
    </div>
  </div>
 
<div class="table-responsive mt-3">
    <table id ="myTable" class="table table-hover table-bordered table-sm">
      <thead> 
        <tr>
          <th>Permisos</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
</div>

<script type="text/javascript" src="../js/buscador.js">
  roles=<?php echo $userol ?>;
  var availableTags=[];
  for(let i=0; i<roles.length;i++){
    availableTags.push(roles[i].name);
  }
  let buscador = new Search('buscar','searchList',availableTags);

</script>






{{--
<button type="button" id="btn_perm" onclick=registrar() class="btn btn-mod">Registrar</button>
<a class="btn btn-outline-secondary btn-close" href="{{ route('roles.index') }}">Volver</a>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h4 class="h4">Roles de {{Auth::user()->name}}</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a type="button" class="btn btn-sm btn-outline-secondary" href="">Agregar Rol</a>
      </div>
    </div>
</div>
<div class="card border-left-success shadow h-100 py-2">
  <div class="card-body">
    <div class="form-row">
      <div class="container">
      @foreach($useroles as $userol)
        <div class="row">
          <div class="col">
            <strong>{{$userol}}</strong>
          </div>
          <div class="col">
            <button class="btn btn-outline-secondary btn-sm">Quitar</button>

            <button class="btn btn-outline-secondary btn-sm">Eliminar</button>
          </div>
        </div>
        <div class="w-100"></div>
      @endforeach
      </div>
    </div>
  </div>
</div>
--}}

@endsection

@section("scripts")
@parent


@endsection



@section("pie")
    
@endsection