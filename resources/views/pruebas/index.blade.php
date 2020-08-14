@extends("layouts.plantillaTest")

@section("cabecera")
    
@endsection

@section("cuerpo")
	<ul id="pruebalist">    
	@foreach ($pruebas as $prueba)  
		<li> {{$prueba->atributo}}</li>
	@endforeach
	</ul>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
   $(document).ready(function(){
		setInterval(function(){
			$.ajax({
				url:'/pruebas',
				type:'GET',
				dataType:'json',
				success:function(response){
					if(response.pruebas.length>0){
						var pruebas ='';
						for(var i=0;i<response.pruebas.length;i++){
							pruebas=pruebas+'<li>'+response.pruebas[i]['body']+'</li>';
						}
						$('#pruebalist').empty();
						$('#pruebalist').append(pruebas);
					}
				},error:function(err){

				}
			})
		}, 5000);
   });
</script>
@endsection

@section("pie")
    
@endsection