@extends("triagepreguntas.test")

@section("css")
  <style type="text/css">
    .select2-choices {
      min-height: 150px !important;
      max-height: 150px;
      overflow-y: auto;
    }
    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }
    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff; 
      border-bottom: 1px solid #d4d4d4; 
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
      background-color: #e9e9e9; 
    }
    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
      background-color: DodgerBlue !important; 
      color: #ffffff; 
    }
    #myTable .btn{
      width: 50% !important;
      margin: auto;
    }
    #myTable{
      text-align: center;
    }

  </style>
@endsection

@section("cuerpo")
<div id="alerta"></div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h5 class="h5">Registracion de un nuevo protocolo</h5>
</div>


  <div class="form-row">
    <div id="div_desc" class="form-group col-md-4">
      <label for="inputEmail4">Descripción</label>
      <input type="text" id="desc" name="desc" class="form-control form-control-sm" value="{{ old('desc') }}" placeholder="Nombre">
    </div>
    <div class="form-group col-md-2" id="div_codigo">
      <label for="codigo">Código</label>
      <select name="codigo" id="codigo" class="form-control select">
        @foreach($codigos as $codigo)
          <option value="{{$codigo->id}}">{{$codigo->color}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-2" id="div_especialidad">
      <label for="inputEsp">Especialidad</label>
      <select name="especialidad" id="esp" class="form-control form-control-sm select">
        @foreach($especialidades as $esp)
          <option value="{{$esp->id}}">{{$esp->nombre}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <label for="inputEmail4">Buscar Síntomas</label>
  <div class="form-row">
    <div id="div_busc" class="form-group col-md-4">
        <input id="tags" type="text" name="buscador" value="{{old('buscador')}}" class="form-control form-control-sm " placeholder="Síntoma" autocomplete="off">
    </div>
    <div class="form-group col-md-4">
      <button type="button" id="btn_agregar" onclick="addRow()" class="btn btn-mod" style="width: 50%!important">Agregar</button>    
    </div>
  </div>

  <div class="table-responsive">
    <table id ="myTable" class="table table-hover table-bordered table-sm">
      <thead> 
        <tr>
          <th>Síntomas</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
<div class="w-25 d-flex">
    <button type="button" id="reg_id" class="btn btn-mod">Registrar</button>
  <a class="btn btn-outline-secondary btn-close ml-1" href="{{ route('protocolos.index') }}">Volver</a>
</div>



@endsection
@section("scripts")

<script type="text/javascript" src="{{ asset('js/autocompletar.js') }}"></script>
<script>
  function addRow() {   // PARA AGREGAR NUEVA FILA A LA TABLA
      // alert(document.getElementById("btn_agregar").value);
      var ind = estaEn(document.getElementById("tags").value);
      if(document.getElementById("tags").value=='')
        alert("Para agregar un síntoma debe ingresar su nombre")
      else{
        if(ind!=-1){
          if(chequeaRepetido(sintomas[ind].id)){
            alert("Este síntoma ya está agregado");
          }else{
            var empTab = document.getElementById('myTable');
            var tbodyRef = empTab.getElementsByTagName('tbody')[0];

            var rowCnt = tbodyRef.rows.length;   // table row count.
            var tr = tbodyRef.insertRow(rowCnt); // the table row.

            var td = document.createElement('td'); // table definition.
            td = tr.insertCell(0);

            var ele = document.createElement('input');
            ele.setAttribute('type', 'hidden');
            ele.setAttribute('value', sintomas[ind].id);
            ele.setAttribute('name', 'sint[]');
            td.appendChild(ele);
            
            var p = document.createElement('p');
            var node = document.createTextNode(document.getElementById('tags').value);
            p.appendChild(node);
            td.appendChild(p);
            
            td = tr.insertCell(1);
            var button = document.createElement('input');

            // set input attributes.
            button.setAttribute('type', 'button');
            button.setAttribute('value', 'Quitar');
            button.setAttribute('class', 'btn btn-mod')
            // add button's 'onclick' event.
            button.setAttribute('onclick', 'removeRow(this)');

            td.appendChild(button);
            // VACIA EL INPUT PARA DEJAR QUE EL USUARIO AGREGUE OTRO SINTOMA
            document.getElementById('tags').value = '';
            // alert('se agrego el síntoma '+document.getElementById('sint'+document.getElementById('btn_agregar').value).value);
          }
        }else{
          if (window.confirm('El síntoma ingresado no se encuentra registrado.\n¿Desea registrarlo?'))
            window.location = '/sintomas';
        }
      }
  }
// PARA VER SI EL VALOR DEL INPUT ES UN SÍNTOMA Y DEVOLVER LA POSICIÓN
  function estaEn(st){
    var i = 0;
    var ind = -1;
    while(ind==-1 && i<sintomas.length){
      if (sintomas[i].descripcion.toUpperCase() == st.toUpperCase()){
        ind = i;
      }
      i+= 1;
    }
    return ind;
  }

  function chequeaRepetido(id){
    var s = document.getElementsByName('sint[]')
    var b = false;
    var i = 0;
    while(!b && i<s.length){
      if (s[i].value==id)
        b = true;
      i += 1;
    }
    if(b)
      return true;
    else
      return false;
  }

  function removeRow(oButton) {
      var empTab = document.getElementById('myTable');
      empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
  }

  document.getElementById("reg_id").addEventListener("click", function(){
    var descripcion = document.getElementById('desc').value;
    var codigo = document.getElementById('codigo').value;
    var especialidad = document.getElementById('esp').value;
    var sintObjs = document.getElementsByName('sint[]');
    var sint = [];
    for (let i = 0; i< sintObjs.length; i++) {
      sint[i] = sintObjs[i].value;
    }
    
    quitaSpans();
    
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        type:'POST',
        url:"/protocolos",
        dataType:"json",
        data:{
            desc:descripcion,
            codigo:codigo,
            especialidad:especialidad,
            sint:sint,
        },
        success: function(response){
            console.log(response.responseJSON);
            let alert = document.getElementById("alerta");
              alert.classList.add('alert');
              alert.classList.add('alert-success');
              alert.innerHTML=`<button type="button" class="close" data-dismiss="alert">x</button><strong>Exito! </strong>El protocolo fue almacenado exitosamente`;
                    $("#alerta").fadeTo(2000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);
              });
        },
        error:function(err){
            if (err.status == 422) { // when status code is 422, it's a validation issue
              // alert("hubo un error");
              // console.log(err.responseJSON.errors);
              if(err.responseJSON.errors.codigo){
                document.getElementById('codigo').classList.add('is-invalid');
                var ele_span = document.createElement('span');
                ele_span.setAttribute('class', 'invalid-feedback');
                ele_span.setAttribute('role', 'alert');
                ele_span.innerHTML = "<strong>" + err.responseJSON.errors.codigo + "</strong>";
                document.getElementById('div_codigo').appendChild(ele_span);
              }
              if(err.responseJSON.errors.especialidad){
                document.getElementById('especialidad').classList.add('is-invalid');
                var ele_span = document.createElement('span');
                ele_span.setAttribute('class', 'invalid-feedback');
                ele_span.setAttribute('role', 'alert');
                ele_span.innerHTML = "<strong>" + err.responseJSON.errors.especialidad + "</strong>";
                document.getElementById('div_especialidad').appendChild(ele_span);
              }
              if(err.responseJSON.errors.desc){
                document.getElementById('desc').classList.add('is-invalid');
                var ele_span = document.createElement('span');
                ele_span.setAttribute('class', 'invalid-feedback');
                ele_span.setAttribute('role', 'alert');
                ele_span.innerHTML = "<strong>" + err.responseJSON.errors.desc + "</strong>";
                document.getElementById('div_desc').appendChild(ele_span);
              }
              if(err.responseJSON.errors.sint){
                document.getElementById('tags').classList.add('is-invalid');
                var ele_span = document.createElement('span');
                ele_span.setAttribute('class', 'invalid-feedback');
                ele_span.setAttribute('role', 'alert');
                ele_span.innerHTML = "<strong>" + err.responseJSON.errors.sint + "</strong>";
                document.getElementById('div_busc').appendChild(ele_span);
              }
              
            }
        }
      });
  });

  function quitaSpans(){
    var spans = document.getElementsByClassName('invalid-feedback');
    var inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
      inputs[i].classList.remove('is-invalid');
    }
    while(spans.length>0)
      spans[0].remove();
  }

  sintomas=<?php echo $sintomas ?>;
  var listasintomas=[];
  var listaids=[];
  for(let i=0; i<sintomas.length;i++){
    listasintomas.push(sintomas[i].descripcion);
    listaids.push(sintomas[i].id);
  }
  autocomplete(document.getElementById("tags"), listasintomas, listaids);

</script>

@endsection
