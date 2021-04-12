@extends("triagepreguntas.test")


@section("cuerpo")
{{HOLA MUNDO}}
{{--<div id="alerta"></div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><h5>Salas</h5></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><h5>Áreas</h5></a>
	</li>
</ul>
<div class="tab-content" id="myTabContent">
<!-- TAB SALAS -->
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<div class="btn-toolbar mb-2 mb-md-0">
			<div class="btn-group mr-2">
				@canany(['RegistrarSala','FullSalas'])
				<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">Agregar Sala</button>
				@endcan
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table  class="table table-bordered table-sm table-striped table-hover" id="tableSalas">
			<thead >
				<tr>
					<th scope="col" >Nombre</th>
					<th scope="col" >Área</th>
					<th scope="col" >Estado</th>
					<th scope="col" >Acción</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
	<!-- Modal Create  Sala-->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLabel">Registracion de Sala</h3>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="inputEmail4">Nombre</label>
						<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
						<div id="error_nombre"></div>
					</div>
					<div class="form-group">
						<label for="inputState">Área</label>
						<select name="areac" id="areac" class="form-control select" style="width: 100%;">
							<option value="" selected disabled hidden>Seleccione</option>
						@foreach($areas as $area)
							<option value="{{$area->id}}" {{old('area') == $area->id ? 'selected':''}}>{{$area->nombre}}</option>
						@endforeach
						</select>
						<div id="error_area"></div>
					</div>
					<div class="form-group">
						<label for="inputEmail4">Nro. Camas</label>
						<input type="number" id="camas" name="camas" min="0" max="200" placeholder="Nro. Camas" class="form-control">
						<div id="error_camas"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button id="guardar" type="button" class="btn btn-dark">Guardar</button>
					<button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!-- fin modal -->
  </div>
  <!-- TAB AREA -->
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<div class="btn-toolbar mb-2 mb-md-0">
				<div class="btn-group mr-2">
					@canany(['RegistrarArea','FullSalas'])
					<button type="button"  class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#crear_area" >Agregar Área</button>
					@endcanany
				</div>
			</div>
		</div>

		<div class="table-responsive">
			<table  class="table table-bordered table-sm table-striped table-hover" id="tableAreas">
				<thead >
					<tr>
						<th scope="col" >Nombre</th>
						<th scope="col" >Acción</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>

		<!-- Modal Create Area -->
    <div class="modal fade" id="crear_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Registracion de Área</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="div_crear_area" class="form-group">
              <label for="inputEmail4">Nombre</label>
              <input type="text" id="nombre_area" name="nombre_area" class="form-control" placeholder="Nombre">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" onclick="crearea()" class="btn btn-dark">Guardar</button>
            <button id="cerrar_crear_btn" type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- fin modal crear area-->
  </div>
</div>
--}}
@endsection

@section("scripts")
@parent


@endsection



@section("pie")
    
@endsection