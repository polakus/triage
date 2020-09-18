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
          <div id="chartContainerMes" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-x1-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div id="chartContainerAnio" style="height: 300px; width: 100%;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
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
                <th scope="row">{{$sala->area->tipo_dato}}</th>
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

  <div class="col-x1-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
        <table class="tabs" data-min="0" data-max="2">
          <tr>
              <th class="tabcks">&nbsp;</th>
              <th class="tabck" id="tabck-0" onclick="activarTab(this)">Primera</th>
              <th class="tabcks">&nbsp;</th>
              <th class="tabck" id="tabck-1" onclick="activarTab(this)">Segunda</th>
              <th class="tabcks">&nbsp;</th>
              <th class="tabck" id="tabck-2" onclick="activarTab(this)">Tercera</th>
          </tr>
          <tr class="filadiv">
              <td colspan="6" id="tab-0">
                  <div class="tabdiv" id="tabdiv-0">
                      <p>id=tabdiv-0</p>...
                  </div>
                  <div class="tabdiv" id="tabdiv-1">
                      <p>id=tabdiv-1</p>...
                  </div>
                  <div class="tabdiv" id="tabdiv-2">
                      <p>id=tabdiv-2</p>...
                  </div>
              </td>
          </tr>
      </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
  window.onload = function() {
  var t = "Porcentaje de Códigos ";
  var textoMes = <?php echo json_encode("(".strtoupper($mes).")"); ?>;
  var textoAnio = <?php echo json_encode("(".strval($anio).")"); ?>;
  var dataMes = <?php echo $dataMes; ?>;
  var dataAnio = <?php echo $dataAnio; ?>;
  var chartMes = new CanvasJS.Chart("chartContainerMes", {
    animationEnabled: true,
    theme: "theme3",
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
  chartMes.render();
  chartAnio.render();
  }

  function activarTab(unTab) {
      try {
          //Los elementos div de todas las pestañas están todos juntos en una
          //única celda de la segunda fila de la tabla de estructura de pestañas.
          //Hemos de buscar la seleccionada, ponerle display block y al resto
          //ponerle display none.
          var id = unTab.id;
          if (id){
              var tr = unTab.parentNode || unTab.parentElement;
              var tbody = tr.parentNode || tr.parentElement;
              var table = tbody.parentNode || tbody.parentElement;
              //Pestañas en varias filas
              if (table.getAttribute("data-filas")!=null){
                  var filas = tbody.getElementsByTagName("tr");
                  var filaDiv = filas[filas.length-1];
                  tbody.insertBefore(tr, filaDiv);
              }
              //Para compatibilizar con la versión anterior, si la tabla no tiene los
              //atributos data-min y data-max le ponemos los valores que tenían antes del
              //cambio de versión.
              var desde = table.getAttribute("data-min");
              if (desde==null) desde = 0;
              var hasta = table.getAttribute("data-max");
              if (hasta==null) hasta = MAXTABS;
              var idTab = id.split("tabck-");
              var numTab = parseInt(idTab[1]);
              //Las "tabdiv" son los bloques interiores mientras que los "tabck"
              //son las pestañas.
              var esteTabDiv = document.getElementById("tabdiv-" + numTab);
              for (var i=desde; i<=hasta; i++) {
                  var tabdiv = document.getElementById("tabdiv-" + i);
                  if (tabdiv) {
                      var tabck = document.getElementById("tabck-" + i);
                      if (tabdiv.id == esteTabDiv.id) {
                          tabdiv.style.display = "block";
                          tabck.style.color = "slategrey";
                          tabck.style.backgroundColor = "rgb(235, 235, 225)";
                          tabck.style.borderBottomColor = "rgb(235, 235, 225)";
                      } else {
                          tabdiv.style.display = "none";
                          tabck.style.color = "white";
                          tabck.style.backgroundColor = "gray";
                          tabck.style.borderBottomColor = "gray";
                      }
                  }
              }
          }
      } catch (e) {
          alert("Error al activar una pestaña. " + e.message);
      }
  }
</script>
  @endsection
          