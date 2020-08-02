@extends("layouts.plantillaTest")
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="{{ asset('js/jquery.js') }}"></script>

@section("cuerpo")
<h1>Preguntas del triaje</h1>
<h3>¿Que le sucede?</h3>

<div class="row col-md-10">
	<form method='POST' action='/triagepreguntas'>
		@csrf
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<div class="form-group">
			
				<div class="table-responsive">
					<table class="table table-bordered"  id=tabla_sintomas>
						<tr>
							
							<td><input type="text" name="respuestas[]" class="form-control" id="tags"></td>
							
							<td><button type="button" id="add" name="add" class="btn btn-dark">Agregar filas</button></td>
						</tr>
						
					</table>
					
				</div>
				
			
		</div>
		<div class="form-group">
			<h3>¿Por cuanto tiempo permanece asi?</h3>
			<input type="text" name="duracion" class="form-control">
		</div>
		<button type="submit" class="btn btn-success">Analizar</button>
		<a class="btn btn-dark btn-close ml-4" href="{{ route('pacientes.index') }}">Cancelar</a>
	</form>
	
</div>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script >
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;

		$('#tabla_sintomas').append('<tr id="row'+i+'">'+
						'<td><input type="text" name="respuestas[]" class="form-control nombreje" id="tags'+i+'"></td>'+
						'<td><button type="button" id="'+i+'" name="remove" class="btn btn-danger btn_remove">Quitar</button></td>'+
					'</tr>');
	});

	$(document).on('click','.btn_remove',function(){
		var id= $(this).attr('id');

		$('#row'+id).remove();
	});

	

})
</script>
<script>
  $( function() {
  	sintomas=<?php echo $sintomas ?>;
  	var availableTags=[];
  	for(let i=0; i<sintomas.length;i++){
  		availableTags.push(sintomas[i].descripcion);
  	}
  	
    $( "#tags" ).autocomplete({
      source: availableTags
    });
   
 	$(document).on('click','.nombreje',function(){
 		var id= $(this).attr('id');
 		$( "#"+id ).autocomplete({
     		 source: availableTags
   		});
 	});

  } );
 
 	
 </script>



  
@endsection