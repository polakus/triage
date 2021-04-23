@extends("triagepreguntas.test")

@section("cuerpo")
<style type="text/css">
  #myTable .btn{
    width: 30% !important;
    margin: auto;
  }
</style>
<div id='alerta'></div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Modificar Roles de {{$usuario->name}}</h4>
</div>

  <label>Buscar Roles</label>
  <div class="form-row">
    <div id="div_buscar" class="form-group col-md-4">
        <input placeholder="Buscar aqui" type="text" id="buscar" class="input form-control" autocomplete="off"/>
        <listgroup class="is-visible list-group" id="searchList"></listgroup>
    </div>
    <div class="form-group col-md-2">
      <button type="button" id="btn_agregar" onclick="addRow()" class="btn btn-mod btn-sm">Agregar</button>
    </div>
  </div>
<div class="row no-gutters align-items-center table-wrapper-scroll-y my-custom-scrollbar">
  <div class="table-responsive mt-3">
    <table id ="myTable" class="table table-hover table-bordered table-sm">
      <thead>
        <tr>
          <th>Roles</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
      @foreach($useroles as $userol)
        <tr>
          <td>
            <input type="hidden" value="{{$userol}}" name="ur[]">
            <p>{{$userol}}</p>
          </td>
          <td>
            <input type="button" value="Quitar" class="btn btn-mod" onclick="removeRow(this)">
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="d-flex w-25">

  <button type="button" id="btn_guardar" onclick="registrar(),limpiaSpans()" class="btn btn-mod btn-sm">Guardar</button>
  <a class="btn btn-outline-secondary btn-close btn-sm ml-1" href="{{ route('usuarios.index') }}">Volver</a>

</div>

@endsection

@section("scripts")
@parent
<script type="text/javascript" src="{{ asset('/js/buscador.js') }}"></script>
<script type="text/javascript">
  var aux=<?php echo $roles ?>;
  var roles = [];
  for (let i = 0; i < aux.length; i++) {
    roles[i] = aux[i].name;
  }
  // console.log(roles);
  var availableTags=[];

  for(let i=0; i<roles.length;i++){
    availableTags.push(roles[i]);
  }
  let buscador = new Search('buscar','searchList',availableTags);

  function updateInput(texto){
    $('#searchList').empty();
    let input = document.getElementById('buscar');
    input.value = texto;
  }
  function chequeaRepetido(id){
    var s = document.getElementsByName('ur[]')
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
  function estaEn(st){
    var i = 0;
    var ind = -1;
    while(ind==-1 && i<roles.length){
      if (roles[i].toUpperCase() == st.toUpperCase()){
        ind = i;
      }
      i+= 1;
    }
    return ind;
  }
  function addRow(){
    // var ind = estaEn(document.getElementById("tags").value);

    let input = document.getElementById('buscar');
    let ind = estaEn(input.value);
    if(ind!=-1){
      if(chequeaRepetido(roles[ind])){
            alert("Este permiso ya está agregado");
      }else{
        let empTab = document.getElementById('myTable');
        let tbodyRef = empTab.getElementsByTagName('tbody')[0];

        let rowCnt = tbodyRef.rows.length;   // table row count.
        let tr = tbodyRef.insertRow(rowCnt); // the table row.

        let td = document.createElement('td'); // table definition.
        td = tr.insertCell(0);
        var ele = document.createElement('input');
        ele.setAttribute('type', 'hidden');
        ele.setAttribute('value', roles[ind]);
        ele.setAttribute('name', 'ur[]');
        td.appendChild(ele);
        let newText  = document.createTextNode(input.value);
        let button = document.createElement('input');
        // set input attributes.
        button.setAttribute('type', 'button');
        button.setAttribute('value', 'Quitar');
        button.setAttribute('class', 'btn btn-mod btn-sm')
        // add button's 'onclick' event.
        button.setAttribute('onclick', 'removeRow(this)');
        td.appendChild(newText);

        td = tr.insertCell(1);
        td.appendChild(button);
        input.value = "";
      }
    }else{
      alert("Este rol no se encuentra almacenado");
    }

  }
  function removeRow(oButton) {
      var empTab = document.getElementById('myTable');
      empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
  }
  function registrar(){
    let id = <?php echo $usuario->id ?>;
    let urObjs = document.getElementsByName('ur[]');
    let useroles = [];
    for (let i = 0; i< urObjs.length; i++) {
      useroles[i] = urObjs[i].value;
    }
    // let nombre_rol= document.getElementById('nombre_rol').value;
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
            type:'PUT',
            url:"/usuarios/rolusuario/"+id,
            dataType:"json",
            data:{
                useroles:useroles,
            },
            success: function(response){
                let alert = document.getElementById("alerta");
                alert.classList.add('alert');
                alert.classList.add(response.tipo);
                alert.innerHTML='<button type="button" class="close" data-dismiss="alert">x</button><b>'+response.mensaje+'</b>';
                $("#alerta").fadeTo(4000, 500).slideUp(500, function(){
                  $("#alerta").slideUp(500);
                  // window.location.replace('/roles');
                });
                // $('#alerta').addClass('alert '+response.tipo);
                // $('#alerta').html('<b>'+response.mensaje+'</b>');
                // $("#alerta").fadeTo(4000, 500).slideUp(500, function(){
                //     $("#alerta").slideUp(500);
                // });
            },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue

                  console.log(err.responseJSON);
                  // if(err.responseJSON.errors.nombre_rol){
                  //   document.getElementById('nombre_rol').classList.add('is-invalid');
                  //   var ele_span = document.createElement('span');
                  //   ele_span.setAttribute('class', 'invalid-feedback');
                  //   ele_span.setAttribute('role', 'alert');
                  //   ele_span.innerHTML = "<strong>" + err.responseJSON.errors.nombre_rol + "</strong>";
                  //   document.getElementById('div_nombre').appendChild(ele_span);
                  // }
                  if(err.responseJSON.errors.useroles){
                    document.getElementById('buscar').classList.add('is-invalid');
                    var ele_span = document.createElement('span');
                    ele_span.setAttribute('class', 'invalid-feedback');
                    ele_span.setAttribute('role', 'alert');
                    ele_span.innerHTML = "<strong>" + err.responseJSON.errors.useroles+ "</strong>";
                    document.getElementById('div_buscar').appendChild(ele_span);
                  }
                  // // $('#success_message').fadeIn().html(err.responseJSON.message);

                  // // // you can loop through the errors object and show it to the user
                  // // console.warn(err.responseJSON.errors);
                  // // // display errors on each form field
                  // $.each(err.responseJSON.errors, function (i, error) {
                  //     if(i=='ciess'){
                  //       // $('#error_modal_cie').html('<span style="color: red;">'+error[0]+'</span>');
                  //     }
                  //     else{
                  //       // $('#error_modal_observacion').html('<span style="color: red;">'+error[0]+'</span>');
                  //     }
                  // //     var el = $(document).find('[name="'+i+'"]');
                  // //     el.after($('<span style="color: red;">'+error[0]+'</span>'));
                  // });
                }
            }
    });
  }
  function limpiaSpans(){
    document.getElementById('buscar').classList.remove('is-invalid');
    let spans = document.getElementsByClassName('invalid-feedback');
    while(spans.length>0){
      spans[0].remove();
    }
  }
</script>



@endsection



@section("pie")

@endsection