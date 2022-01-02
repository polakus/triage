
@extends("triagepreguntas.test")

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Preguntas del Triaje</h1>
        
</div>
<div id="alerta">
</div>
<h3>¿Que le sucede?</h3>
<div class="row col-md-5"  >
	<input type="hidden" name="id" id="id_paciente" value="<?php echo $id ?>">
	<div class="table-responsive">
		<table class="table table-bordered"  id=tabla_sintomas>
			<tr>
				<td><input type="text" name="respuestas[]" class="form-control nombreje" id="tags"></td>
				<td><button type="button" id="add" name="add" class="btn btn-sm btn-outline-dark">Agregar filas</button></td>
			</tr>
		</table>
	</div>
</div>
<h3>¿Por cuanto tiempo permanece asi?</h3>
<div class="form-row" >
	<div class="col-md-1">
		<label  class="form-label">Dias</label>
		<input type="number" value="0" class="form-control form-control-sm " min="0" id="dias" name="dias">
	</div>
	<div class="col-md-1">
		<label  class="form-label">Horas</label>
		<input type="number" value="0" class="form-control form-control-sm " id="horas" name="horas" maxlength="2" max="24" min="0">
	</div>
</div>
<div class="d-flex w-25 mt-2">
	<button class="btn btn-sm btn-outline-dark" id="btn_analizar">Analizar</button>
	<a class="btn btn-sm btn-outline-danger btn-close ml-1" href="{{ route('pacientes.index') }}">Cancelar</a>
</div>


@endsection
@section("scripts")
@parent

<script >
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#tabla_sintomas').append('<tr id="row'+i+'">'+
						'<td><input type="text" name="respuestas[]" class="form-control nombreje" id="tags'+i+'"></td>'+
						'<td><button type="button" id="'+i+'" name="remove" class="btn btn-outline-danger btn_remove">Quitar</button></td>'+
					'</tr>');
	});

	$(document).on('click','.btn_remove',function(){
		var id= $(this).attr('id');
		$('#row'+id).remove();
	});

	// AGREGADO
	$(document).on('click','#btn_analizar',function(){
		let inputs = document.querySelectorAll('.nombreje');
		let sintomas_descriptos = [];
		let dias = document.getElementById('dias').value;
		let horas = document.getElementById('horas').value;
		inputs.forEach(function(sint) {
			if(sint.value.replace(/ /g, "").length >0){
				sintomas_descriptos.push(sint.value);
			}
		});
		if(sintomas_descriptos.length>0){
			let id = document.getElementById('id_paciente').value;
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
	   		});

		    $.ajax({
				type:'POST',
				url:"{{ url('triagepreguntas') }}",
				dataType:"json",
				data:{
					sintomas_descriptos:JSON.stringify(sintomas_descriptos),
					id:id,
					dias:dias,
					horas:horas
				},
				success: function(response){
					if(response.resultado ){
						let url= "{{ url('turnos/respuesta') }}";
						url = url+"?atencion="+response.atencion;
						// let url ="/turnos/respuesta?atencion="+response.atencion;
						for(let i=0;i<response.sintomas.length;i++){
							url=url+"&sintomas%5B"+i+"%5D="+response.sintomas[i];
						}
						window.location.replace(url);
					}
					else{
						let alert = document.getElementById("alerta");
						alert.classList.add('alert');
						alert.classList.add('alert-danger');
						alert.innerHTML=`<button type="button" class="close" data-dismiss="alert">x</button><strong>Error! </strong>Los sintomas mencionados no se encuentran registrados`;
						$("#alerta").fadeTo(2000, 500).slideUp(500, function(){
						$("#alerta").slideUp(500);
						});
					}
					// $('#myModal').modal('hide');
					// alert("El paciente fue cargado exitosamente")
					// var table = $('#myTable').DataTable();
					// table.draw();
					},
				error:function(err){
					// if (err.status == 422) { // when status code is 422, it's a validation issue

					
					//   $.each(err.responseJSON.errors, function (i, error) {
					//       if(i=='ciess'){
					//         $('#error_modal_cie').html('<span style="color: red;">'+error[0]+'</span>');
					//       }
					//       else{
					//         $('#error_modal_observacion').html('<span style="color: red;">'+error[0]+'</span>');
					//       }
					//   });
					// }
				}
		    });
		}
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
    //   source: availableTags
	source: function(request, response) {
        var results = $.ui.autocomplete.filter(availableTags, request.term);

        response(results.slice(0, 6));
    }
    });
   
 	$(document).on('click','.nombreje',function(){
 		var id= $(this).attr('id');
 		$( "#"+id ).autocomplete({
     		//  source: availableTags
			 source: function(request, response) {
        var results = $.ui.autocomplete.filter(availableTags, request.term);

        response(results.slice(0, 6));
    }
   		});
 	});

  } );
 
 
 </script>
@endsection
