

<div class="form-row">
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-dark btn-sm " id="btn_tabla3"data-toggle="modal" data-target="#exampleModalCenter{{$usuario->id}}">Ver</button>
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="exampleModalLongTitle">Datos de Usuario</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					@if($usuario->profesional)
					<div class="row">
						<div class="text-md-right col-md-4">
							<h6>Nombre:</h6>			
						</div>
						<div class="col-md-4">
							<h6>{{$usuario->profesional->nombre}}</h6>			
						</div>
					</div>
					<div class="row">
						<div class="text-md-right col-md-4">
							<h6>Apellido:</h6>			
						</div>
						<div class="col-md-4">
							<h6>{{$usuario->profesional->apellido}}</h6>			
						</div>
					</div>
					<div class="row">
						<div class="text-md-right col-md-4">
							<h6>Domicilio:</h6>			
						</div>
						<div class="col-md-4">
							<h6>{{$usuario->profesional->domicilio}}</h6>			
						</div>
					</div>
					<div class="row">
						<div class="text-md-right col-md-4">
							<h6>Matrícula:</h6>			
						</div>
						<div class="col-md-4">
							<h6>{{$usuario->profesional->matricula}}</h6>			
						</div>
					</div>
					<div class="row">
						<div class="text-md-right col-md-4">
							<h6>Especialidades:</h6>			
						</div>
						<div class="col-md-4">
							@foreach($usuario->profesional->detalleProfesional as $esp)
								<h6><li> {{$esp->especialidad->nombre}}</li></h6>
							@endforeach			
						</div>
					</div>
					@else
					<h6>No hay más datos para este usuario</h6>
					@endif
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary " data-dismiss="modal">Cerrar</button>
		</div>
	</div>
	<form id="a2" name="{{$usuario->username}}" action="usuarios/{{$usuario->id}}" method="post">
		@csrf
		{{method_field('DELETE')}}
		@if(Auth::id()==$usuario->id)
			<button type="submit" class="btn btn-danger btn-sm ml-1" id="btn_tabla1"value="{{$usuario->id}}" disabled>Eliminar</button>
		@else
			<button type="submit" class="btn_tabla btn btn-danger btn-sm ml-1" id="btn_tabla2" value="{{$usuario->id}}">Eliminar</button>
		@endif
	</form>
</div>


<script type="text/javascript">

	{{-- Continuar... --}}
function eliminar(id){

  $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });
  $.ajax({

            type:'DELETE',
            url:"/usuarios/"+id,
            dataType:"json",
            data:{
                id:id,
            },
            success: function(response){
                var table=$("#myTable").DataTable();
                table.draw();

                },
            error:function(err){
        //        if (err.status == 422) { // when status code is 422, it's a validation issue
        //     console.log(err.responseJSON);
        //     $('#success_message').fadeIn().html(err.responseJSON.message);

            
        //     $.each(err.responseJSON.errors, function (i, error) {
                
        //         alert(error[0])
        //     });
        // }
               
            }
        });
}

</script>