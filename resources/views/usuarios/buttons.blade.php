<style type="text/css">
	.form-row .btn-outline-secondary{
		width: 40%;
		margin-right: 3px;
		flex-grow: 1;
	}
	#btn_tabla3{
		flex-shrink: 3;
	}
	@media only screen and (max-width: 710px){
		.form-row .btn-outline-secondary{
			width: 100%;
			margin-bottom:3px;
			
		}
	}
</style>

<div class="form-row">
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="#userModal{{ $usuario->id }}">Ver</button>
	<button href="/usuario/rol/{{$usuario->id}}" type="button" class="btn btn-outline-secondary btn-sm" data-toggle="modal" data-target="">Ver Roles</button>
	<button class="btn btn-outline-secondary btn-sm" onclick="eliminar({{ $usuario->id }},'{{ $usuario->username }}')"> Eliminar</button>
</div>





<!-- Modal -->
<div class="modal fade" id="userModal{{ $usuario->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if($usuario->profesional)
        	<div class="form-group row">
                <div class="text-md-right col-md-4">
					<h6>Nombre:</h6>			
				</div>
				<div class="col-md-4">
					<h6>{{$usuario->profesional->nombre}}</h6>			
				</div>
            </div>
            <div class="form-group row">
                <div class="text-md-right col-md-4">
					<h6>Apellido:</h6>				
				</div>
				<div class="col-md-4">
					<h6>{{$usuario->profesional->apellido}}</h6>				
				</div>
            </div>
            <div class="form-group row">
                <div class="text-md-right col-md-4">
					<h6>Domicilio:</h6>			
				</div>
				<div class="col-md-4">
					<h6>{{$usuario->profesional->domicilio}}</h6>					
				</div>
            </div>
            <div class="form-group row">
                <div class="text-md-right col-md-4">
					<h6>Matrícula:</h6>				
				</div>
				<div class="col-md-4">
					<h6>{{$usuario->profesional->matricula}}</h6>		
				</div>
            </div>
            <div class="form-group row">
                <div class="text-md-right col-md-4">
					<h6>Especialidades:</h6>			
				</div>
				<div class="col-md-4">
					<ul class="ul"> 
						@foreach($usuario->profesional->detalleProfesional as $esp)
							<h6><li> {{$esp->especialidad->nombre}}</li></h6>
						@endforeach
					</ul>		
				</div>
            </div>
        @else
        	<h6>No se encontraron datos de este usario</h6>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-mod" data-dismiss="modal">Cerrar</button>
   
      </div>
    </div>
  </div>
</div>