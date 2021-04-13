@extends('triagepreguntas.test')

@section('cuerpo')
<div id='alerta'></div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Crear Rol</h4>
</div>
<div class="form-row">
    <div id="div_nombre" class="form-group col-md-4">
      <label for="inputEmail4">Nombre del Rol</label>
      <input type="text" id="nombre_rol" name="nombre_rol" class="form-control form-control-sm" placeholder="Nombre">
    </div>
 </div>
 <label for="inputEmail4">Buscar Permisos</label>
  <div class="form-row">
    <div id="div_buscar" class="form-group col-md-4">
        <input placeholder="Buscar aqui" type="text" id="buscar" class="input form-control"/>
        <listgroup class="is-visible list-group" id="searchList"></listgroup>
    </div>
    <div class="form-group col-md-4">
      <button type="button" id="btn_agregar" onclick="addRow()" class="btn btn-mod">Agregar</button>    
    </div>
  </div>
 
<div class="table-responsive mt-3">
    <table id ="myTable" class="table table-hover table-bordered table-sm">
      <thead> 
        <tr>
          <th>Permisos</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
</div>

<button type="button" id="btn_perm" onclick=registrar() class="btn btn-mod">Registrar</button>
<a class="btn btn-outline-secondary btn-close" href="{{ route('roles.index') }}">Volver</a>
@endsection

@section('scripts')
@parent
<script type="text/javascript" src="../js/buscador.js"></script>

<script type="text/javascript">
  function addRow(){
    // var ind = estaEn(document.getElementById("tags").value);
    
    let input = document.getElementById('buscar');
    let ind = estaEn(input.value);
    if(ind!=-1){
      if(chequeaRepetido(permisos[ind].id)){
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
        ele.setAttribute('value', permisos[ind].id);
        ele.setAttribute('name', 'perm[]');
        td.appendChild(ele);
        let newText  = document.createTextNode(input.value);
        let button = document.createElement('input');
        // set input attributes.
        button.setAttribute('type', 'button');
        button.setAttribute('value', 'Quitar');
        button.setAttribute('class', 'btn btn-mod')
        // add button's 'onclick' event.
        button.setAttribute('onclick', 'removeRow(this)');
        td.appendChild(newText);
        
        td = tr.insertCell(1);
        

        td.appendChild(button);
        input.value = "";
      }
      
    }
    else{
      alert("Este permiso no se encuentra almacenado");
    }
    
  }
  function removeRow(oButton) {
      var empTab = document.getElementById('myTable');
      empTab.deleteRow(oButton.parentNode.parentNode.rowIndex); // button -> td -> tr.
  }
  
</script>

<script type="text/javascript">
  permisos=<?php echo $permisos ?>;
  var availableTags=[];
    for(let i=0; i<permisos.length;i++){
      availableTags.push(permisos[i].name);
    }
  let buscador = new Search('buscar','searchList',availableTags);
  function updateInput(texto){
      $('#searchList').empty();
      let input = document.getElementById('buscar');
      input.value = texto;
    }
  function chequeaRepetido(id){
    var s = document.getElementsByName('perm[]')
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
    while(ind==-1 && i<permisos.length){
      if (permisos[i].name.toUpperCase() == st.toUpperCase()){
        ind = i;
      }
      i+= 1;
    }
    return ind;
  }
  function chequeaRepetido(id){
    var s = document.getElementsByName('perm[]')
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

  function registrar(){
    let permObjs = document.getElementsByName('perm[]');
    let permisos = [];
    for (let i = 0; i< permObjs.length; i++) {
      permisos[i] = permObjs[i].value;
    }
    let nombre_rol= document.getElementById('nombre_rol').value;
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
            type:'POST',
            url:"/roles",
            dataType:"json",
            data:{
                permisos:permisos,
                nombre_rol:nombre_rol
            },
            success: function(response){
                let alert = document.getElementById("alerta");
                alert.classList.add('alert');
                alert.classList.add('alert-success');
                alert.innerHTML=`<button type="button" class="close" data-dismiss="alert">x</button><strongExito! </strong>Los datos fueron guardados exitosamente`;
                $("#alerta").fadeTo(3000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);window.location.replace('/roles');});
                },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
    
                  console.log(err.responseJSON);
                  if(err.responseJSON.errors.nombre_rol){
                    document.getElementById('nombre_rol').classList.add('is-invalid');
                    var ele_span = document.createElement('span');
                    ele_span.setAttribute('class', 'invalid-feedback');
                    ele_span.setAttribute('role', 'alert');
                    ele_span.innerHTML = "<strong>" + err.responseJSON.errors.nombre_rol + "</strong>";
                    document.getElementById('div_nombre').appendChild(ele_span);
                  }
                  if(err.responseJSON.errors.permisos){
                    document.getElementById('buscar').classList.add('is-invalid');
                    var ele_span = document.createElement('span');
                    ele_span.setAttribute('class', 'invalid-feedback');
                    ele_span.setAttribute('role', 'alert');
                    ele_span.innerHTML = "<strong>" + err.responseJSON.errors.permisos+ "</strong>";
                    document.getElementById('div_buscar').appendChild(ele_span);
                  }
                  // $('#success_message').fadeIn().html(err.responseJSON.message);

                  // // you can loop through the errors object and show it to the user
                  // console.warn(err.responseJSON.errors);
                  // // display errors on each form field
                  $.each(err.responseJSON.errors, function (i, error) {
                      if(i=='ciess'){
                        // $('#error_modal_cie').html('<span style="color: red;">'+error[0]+'</span>');
                      }
                      else{
                        // $('#error_modal_observacion').html('<span style="color: red;">'+error[0]+'</span>');
                      }
                  //     var el = $(document).find('[name="'+i+'"]');
                  //     el.after($('<span style="color: red;">'+error[0]+'</span>'));
                  });
                }
            }
    });
  }
</script>
@endsection