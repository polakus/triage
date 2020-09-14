@extends("triagepreguntas.test")

@section("cuerpo")

<script>
window.onload = function() {
var b = []
b.push(<?php foreach($a as $p) echo $p;?>) ;
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Desktop Search Engine Market Share - 2016"
	},
	data: [{
		type: "pie",
		startAngle: 240,
		yValueFormatString: "##0.00\"%\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: b["Google"], label: "Google"},
			{y: b["Bing"], label: "Bing"},
			{y: b["Baidu"], label: "Baidu"},
			{y: b["Yahoo"], label: "Yahoo"},
			{y: b["Others"], label: "Others"}
			// {y: 79.45, label: "Google"},
			// {y: 7.31, label: "Bing"},
			// {y: 7.06, label: "Baidu"},
			// {y: 4.91, label: "Yahoo"},
			// {y: 1.26, label: "Others"}
		]
	}]
});
chart.render();

}
</script>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


@endsection
     
{{--
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
</script>--}}