@extends("triagepreguntas.test")

@section("cuerpo")

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
	<div class="btn-toolbar mb-2 mb-md-0">
	  <div class="btn-group mr-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
	    <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
	  </div>
	  <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
	    <span data-feather="calendar"></span>
	    This week
	  </button>
	</div>
</div>	


<div class="row">
  
  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Nuevos Pacientes ({{$mes}})</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantPacientes}}</div>
          </div>
          <div class="col-auto">
            <a href = "{{route('pacientes.index')}}" class="btn"> <i class="fas fa-calendar fa-2x text-gray-300"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Solicitudes de Usuarios</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantUPendientes}}</div>
          </div>
          <div class="col-auto">
            <a href = "usuarios/pendientes" class="btn"><i class="fas fa-comments fa-2x text-gray-300"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Personal</div>
            <div class="row no-gutters align-items-center">
              <div class="col-auto">
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$cantProfesionales}}</div>
              </div>{{--
              <div class="col">
                <div class="progress progress-sm mr-2">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>--}}
            </div>
          </div>
          <div class="col-auto">
            <a href = "{{route('usuarios.index')}}" class="btn"><i class="fas fa-user-md fa-2x text-gray-300"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Usuarios Online</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$cantUOnline}}</div>
          </div>
          <div class="col-auto">
            <a href = "{{route('usuarios.index')}}" class="btn"> <i  class="fas fa-hand-paper fa-2x text-gray-300"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">

 
  <div class="col-x1-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="home-tab" onclick = "chart('dia')" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dia</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="profile-tab" onclick = "chart('mes')" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mes</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="contact-tab" onclick= "chart('anio')" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Año</a>
        </li>
      </ul>
      <div class="card-body">
         <div class="align-items-center" id="chartContainerDia" style="height: 300px; width: 100%;"></div>
         <div class="align-items-center" id="chartContainerMes" style="height: 300px; width: 100%;"></div>
         <div class="align-items-center" id="chartContainerAnio" style="height: 300px; width: 100%;"></div>
      </div>
    </div>
  </div>
{{--  ESTE ES EL BUENO
  <div class="col-x1-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <a class="nav-link active" id="chartContainerDia-tab" onclick = "funcDia()" data-toggle="tab" href="#chartContainerDia" role="tab" aria-controls="chartContainerDia" aria-selected="true">Home</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="chartContainerMes-tab" onclick = "funcMes()" data-toggle="tab" href="#chartContainerMes" role="tab" aria-controls="chartContainerMes" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link" id="chartContainerAnio-tab" onclick = "funcAnio()" data-toggle="tab" href="#chartContainerAnio" role="tab" aria-controls="chartContainerAnio" aria-selected="false">Contact</a>
        </li>
      </ul>
      <div class="card-body">
          <div class="tab-content" id="myTabContent" >
            <div class="tab-pane fade show active" id="chartContainerDia" role="tabpanel" aria-labelledby="chartContainerDia-tab" style="height: 300px; width: 100%;"></div>
            <div class="tab-pane fade" id="chartContainerMes" role="tabpanel" aria-labelledby="chartContainerMes-tab" style="height: 300px; width: 100%;"></div>
            <div class="tab-pane fade" id="chartContainerAnio" role="tabpanel" aria-labelledby="chartContainerAnio-tab" style="height: 300px; width: 100%;"></div>
          </div>
      </div>
    </div>
  </div>
--}}
  <div class="col-x1-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <h4>Salas</h4>
        <div class="row no-gutters align-items-center table-wrapper-scroll-y my-custom-scrollbar">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Area</th>
                <th scope="col">Cantidad Salas</th>
                <th scope="col">Cantidad Disponibles</th>
              </tr>
            </thead>
            <tbody>
              @foreach($salas as $sala)
              <tr>
                <th scope="row">{{$sala->area->nombre}}</th>
                <td>{{$sala->cantidad}}</td>
                <td>{{$sala->disponibles}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
    
</div>



<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
document.getElementById('chartContainerDia').style.display = 'none';
document.getElementById('chartContainerMes').style.display = 'none';
document.getElementById('chartContainerAnio').style.display = 'none';
var t = "Porcentaje de Códigos ";
var textoDia = <?php echo json_encode("(".strtoupper($dia).")"); ?>;
var textoMes = <?php echo json_encode("(".strtoupper($mes).")"); ?>;
var textoAnio = <?php echo json_encode("(".strval($anio).")"); ?>;
var dataDia = <?php echo $dataDia; ?>;
var dataMes = <?php echo $dataMes; ?>;
var dataAnio = <?php echo $dataAnio; ?>;

var chartDia = new CanvasJS.Chart("chartContainerDia", {
  animationEnabled: true,
  theme: "theme3",
  
  axisY: {
    title: "Growth Rate (in %)",
    suffix: "%"
  },
  axisX: {
    title: "Countries"
  },
  title: {
    text: "Porcentaje de Códigos "+textoDia
  },
  // subtitles: [{
  //   text: "Que lindo subtítulo!"
  // }],
  legend: {
    fontStyle: "italic",
  },
  data: [{
    type: "doughnut",// type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"%\"",
    indexLabel: "{label} {y}",
    dataPoints: dataDia
  }]
});

var chartMes = new CanvasJS.Chart("chartContainerMes", {
  animationEnabled: true,
  theme: "theme3",

  axisY: {
    title: "Growth Rate (in %)",
    suffix: "%"
  },
  axisX: {
    title: "Countries"
  },
  title: {
    text: "Porcentaje de Códigos "+textoMes
  },
  // subtitles: [{
  //   text: "Que lindo subtítulo!"
  // }],
  legend: {
    fontStyle: "italic",
  },
  data: [{
    type: "doughnut",// type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"%\"",
    indexLabel: "{label} {y}",
    dataPoints: dataMes
  }]
});
var chartAnio = new CanvasJS.Chart("chartContainerAnio", {
  animationEnabled: true,
  theme: "theme3",
  
  axisY: {
    title: "Growth Rate (in %)",
    suffix: "%"
  },
  axisX: {
    title: "Countries"
  },  
  title: {
    text: "Porcentaje de Códigos "+textoAnio
  },
  // subtitles: [{
  //   text: "Que lindo subtítulo!"
  // }],
  legend: {
    fontStyle: "italic",
  },
  data: [{
    type: "doughnut",// type: "pie",
    startAngle: 240,
    yValueFormatString: "##0.00\"%\"",
    indexLabel: "{label} {y}",
    dataPoints: dataAnio
  }]
});
window.onload = function(){
  chart('dia');
}
function chart(tipo){
  if(tipo == 'dia'){
    document.getElementById('chartContainerDia').style.display = 'block';
    document.getElementById('chartContainerMes').style.display = 'none';
    document.getElementById('chartContainerAnio').style.display = 'none';
    chartDia.render();

  }
  else{
    if(tipo == 'mes'){
      document.getElementById('chartContainerDia').style.display = 'none';
      document.getElementById('chartContainerMes').style.display = 'block';
      document.getElementById('chartContainerAnio').style.display = 'none';
      chartMes.render();
    }
    else{
      document.getElementById('chartContainerDia').style.display = 'none';
      document.getElementById('chartContainerMes').style.display = 'none';
      document.getElementById('chartContainerAnio').style.display = 'block';
      chartAnio.render();
    }
  }
}

  
</script>



{{--
<script>
  window.onload = function() {
  // function func(){
  var t = "Porcentaje de Códigos ";
  var textoDia = <?php echo json_encode("(".strtoupper($dia).")"); ?>;
  var textoMes = <?php echo json_encode("(".strtoupper($mes).")"); ?>;
  var textoAnio = <?php echo json_encode("(".strval($anio).")"); ?>;
  var dataDia = <?php echo $dataDia; ?>;
  var dataMes = <?php echo $dataMes; ?>;
  var dataAnio = <?php echo $dataAnio; ?>;

  var chartDia = new CanvasJS.Chart("chartContainerDia", {
    animationEnabled: true,
    theme: "theme3",
    // width: 500,
    // height: 300,
    axisY: {
      title: "Growth Rate (in %)",
      suffix: "%"
    },
    axisX: {
      title: "Countries"
    },
    title: {
      text: "Porcentaje de Códigos "+textoDia
    },
    // subtitles: [{
    //   text: "Que lindo subtítulo!"
    // }],
    legend: {
      fontStyle: "italic",
    },
    data: [{
      type: "doughnut",// type: "pie",
      startAngle: 240,
      yValueFormatString: "##0.00\"%\"",
      indexLabel: "{label} {y}",
      dataPoints: dataDia
    }]
  });

  var chartMes = new CanvasJS.Chart("chartContainerMes", {
    animationEnabled: true,
    theme: "theme3",
    // width: 500,
    // height: 300,
    axisY: {
      title: "Growth Rate (in %)",
      suffix: "%"
    },
    axisX: {
      title: "Countries"
    },
    title: {
      text: "Porcentaje de Códigos "+textoMes
    },
    // subtitles: [{
    //   text: "Que lindo subtítulo!"
    // }],
    legend: {
      fontStyle: "italic",
    },
    data: [{
      type: "doughnut",// type: "pie",
      startAngle: 240,
      yValueFormatString: "##0.00\"%\"",
      indexLabel: "{label} {y}",
      dataPoints: dataMes
    }]
  });
  var chartAnio = new CanvasJS.Chart("chartContainerAnio", {
    animationEnabled: true,
    theme: "theme3",
    // width: 500,
    // height: 300,
    axisY: {
      title: "Growth Rate (in %)",
      suffix: "%"
    },
    axisX: {
      title: "Countries"
    },  
    title: {
      text: "Porcentaje de Códigos "+textoAnio
    },
    // subtitles: [{
    //   text: "Que lindo subtítulo!"
    // }],
    legend: {
      fontStyle: "italic",
    },
    data: [{
      type: "doughnut",// type: "pie",
      startAngle: 240,
      yValueFormatString: "##0.00\"%\"",
      indexLabel: "{label} {y}",
      dataPoints: dataAnio
    }]
  });
  chartDia.render();
  chartMes.render();
  chartAnio.render();
  }
</script>
--}}
  @endsection
          