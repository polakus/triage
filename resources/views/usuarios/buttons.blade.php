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
	<a class="btn btn-outline-secondary btn-sm" href="/rolusuario/{{$usuario->id}}" >Modificar Roles</a>
	<button class="btn btn-outline-secondary btn-sm" onclick="eliminar({{ $usuario->id }},'{{ $usuario->username }}')"> Eliminar</button>
</div>





<!-- Modal Ver -->
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
					    Nombre:			
				    </div>
            <div class="col-md-4">
              {{$usuario->profesional->nombre}}			
            </div>
          </div>
          <div class="form-group row">
            <div class="text-md-right col-md-4">
					    Apellido:				
				    </div>
				    <div class="col-md-4">
					    {{$usuario->profesional->apellido}}				
				    </div>
          </div>
          <div class="form-group row">
            <div class="text-md-right col-md-4">
              Domicilio:			
            </div>
				    <div class="col-md-4">
					    {{$usuario->profesional->domicilio}}					
				    </div>
          </div>
          <div class="form-group row">
            <div class="text-md-right col-md-4">
					    Matrícula:				
				    </div>
            <div class="col-md-4">
					    {{$usuario->profesional->matricula}}		
				    </div>
          </div>
          <div class="form-group row">
            <div class="text-md-right col-md-4">
					    Especialidades:			
            </div>
            <div class="col-md-4">
					    <ul class="ul"> 
                @foreach($usuario->profesional->detalleProfesional as $esp)
                  <li> {{$esp->especialidad->nombre}}</li>
                @endforeach
					    </ul>		
				    </div>
          </div>
        @else
        	No se encontraron datos de este usario
        @endif
        <hr>
          <strong>Roles de {{$usuario->name}}</strong>
          @foreach($usuario->getRoleNames() as $roles)
            <div>
              <li>{{$roles}}</li>
            </div>
          @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-mod" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>