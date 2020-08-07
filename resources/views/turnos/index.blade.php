@extends("layouts.plantilla")

@section("script")
<script>
        $( function() {
            
            
         var nombre=<?php echo $horarios ?>;
         //     //console.log(nombre);
             var salas=["0","1","2","3","4","5","6"];
             

             for(let i=0; i<nombre.length;i++){
                 switch(nombre[i].fechas){
                    case "lunes":
                     if($.inArray("1",salas)>=0){
                     	salas.splice(salas.indexOf("1"),1);
                	 }
                     break;
                    case "martes": 
                    if($.inArray("2",salas)>=0){
                     	salas.splice(salas.indexOf("2"),1);
                	 }
                    break;
                    case "miercoles": 
                    if($.inArray("3",salas)>=0){
                     	salas.splice(salas.indexOf("3"),1);
                	 }
                    break;
                    case "jueves": 
                    if($.inArray("4",salas)>=0){
                     	salas.splice(salas.indexOf("4"),1);
                	 }
                    break;
                    case "viernes": 
                   
                    if($.inArray("5",salas)>=0){
                     	salas.splice(salas.indexOf("5"),1);
                	 }
                    break;
                    case "sabado": 
                   
                    if($.inArray("6",salas)>=0){
                     	salas.splice(salas.indexOf("6"),1);
                	 }
                    break;
                    case "domingo": 
                    if($.inArray("0",salas)>=0){
                     	salas.splice(salas.indexOf("0"),1);
                	 }
                    break;
                   

   
               }
                
           
            
           };
            //console.log(salas);
                $( ".datepicker" ).datepicker({
                    format: "yyyy/mm/dd",
                   
                    daysOfWeekDisabled: salas,
                    
                });
             
         });
        
</script>
@endsection

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class=" text-left">
	@foreach($esp_sala as $sala)
		<h3> Sala a dirigir: <?php echo $sala->nombre ?> </h3>
	@endforeach
</div>


<form method="GET" action="/turnos">
	   			@csrf
	   			<input type="hidden" name="atencion" value="<?php echo $id_atencion ?>">
	   			<input type="hidden" name="protocolo" value="<?php echo $id_protocolo ?>">
	   			<div class="form-row">
	   				 <div class="col-md-4 mb-3">
     				 	<div class="input-group date jsdate">
						  <input class="form-control datepicker" value='<?php echo $day ?>'  id="date" name="date" type="text"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
      					
   					 	</div>
   					 </div>
				     <div class="col-md-14 mb-3">
				     	
				  		<input type="submit" name="enviar" class="btn btn-dark" value="Enviar">
				  
				     </div>	
				</div>
				
				
				
			</form>
		
			<form method="GET" action='/turnos'>
				@csrf
				<input type="hidden" name="atencion" value="<?php echo $id_atencion ?>">
				<input type="hidden" name="protocolo" value="<?php echo $id_protocolo ?>">
				<label>Filtros por horarios</label>
				<br>
				   <input type="hidden" name="new_date" id="new_date" value='<?php echo $day ?>'> 
				   <input type="hidden" name="new_date2" id="new_date" value='<?php echo $day ?>'> 
			       <select  class="form-control col-md-3" name="seleccionado" id="seleccionado" >
			       		@if($day!="")

			       			
			       			@foreach($medicos as $medico)

			     	
				        <option >Medico: {{$medico->id }} Desde: {{ $medico->horaInicio }} Hasta {{ $medico->horaFin }}</option>
				 			@endforeach
			       		@endif
			     		
				 	</select>
				 	<input type="submit" id="Seleccionar" name="Seleccionar" value="Seleccionar" class="btn btn-dark"> 
			</form>
		
			<br>
			<form method="POST" action="/turnos">
				@csrf
			
				<input type="hidden" name="atencion" value="<?php echo $id_atencion ?>">
				
				<input type="hidden" name="day_aux" value="<?php echo $day ?>">
				<input type="hidden" name="seleccion" value='<?php echo $seleccionar ?>'>
				<div style="text-align: right;">
					<input type="submit" name="enviar" value="Agregar" class="btn btn-dark">
				</div>
			</form>
			<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Turnos</th>
		      <th scope="col">Nombre Medico</th>
		      <th scope="col">Apellido Paciente</th>
		      <th scope="col">Dni Paciente</th>
		      <th scope="col">Nombre Paciente</th>
		      <th scope="col">Apellido Paciente</th>
		      <th scope="col">Sala</th>
		      
		    </tr>
		  </thead>
		  <tbody>
		  	@if($turnos != '')
		  		@foreach($turnos as $turno)
		  			<tr>
		  				<th scope="row">{{ $turno->start }}</th>
					    <td>{{ $turno->nombre_med }}</td>
					    <td>{{ $turno->apellido_med }}</td>
					    <td>{{ $turno->dni }}</td>
					    <td>{{ $turno->nombre }}</td>
					    <td>{{ $turno->apellido }}</td>
					    <td> {{ $turno->tipo_dato}}:{{ $turno->id_salas}}</td>
					    

		  			</tr>

		  		@endforeach
		  	@endif
		    <tr>
		     
		  </tbody>
		</table>

@endsection