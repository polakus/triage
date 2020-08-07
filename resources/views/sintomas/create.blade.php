@extends("layouts.plantilla")

@section("script")





@endsection


@section("cuerpo")
<h2>Registracion de sintomas</h2>

<div class="row col-md-10">
	<div class="form-group">
		<form method="POST" action="/sintomas">
			@csrf
			<div class="table-responsive">
				<table class="table table-bordered"  id=tabla_sintomas>
					<tr>
						<td><input type="text" name="text_sintomas[]" class="form-control"></td>
						<td><button type="button" id="add" name="add" class="btn btn-dark">Agregar filas</button></td>
					</tr>
				</table>
				
			</div>
			<button type="submit" class="btn btn-success">Agregar sintomas</button>
		</form>
	</div>
	
</div>


<script >
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;

		$('#tabla_sintomas').append('<tr id="row'+i+'">'+
						'<td><input type="text" name="text_sintomas[]" class="form-control"></td>'+
						'<td><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn_remove">Quitar</button></td>'+
					'</tr>');
	});

	$(document).on('click','.btn_remove',function(){
		var id= $(this).attr('id');
		$('#row'+id).remove();
	});

})
</script>



@endsection

