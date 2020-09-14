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
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>

<script>
  window.onload = function() {
  var t = "Porcentaje de Códigos ";
  var texto = <?php echo json_encode("(".strtoupper($mes).")"); ?>;
  var data = <?php echo $data; ?>;
  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    title: {
      text: "Porcentaje de Códigos "+texto
    },
    data: [{
      indexLabelPlacement: "inside",
      type: "pie",
      startAngle: 240,
      yValueFormatString: "##0.00\"%\"",
      indexLabel: "{label} {y}",
      dataPoints: data
    }]
  });
  chart.render();

  }
</script>
  @endsection
          