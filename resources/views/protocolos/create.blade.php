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

  </style>
@endsection

@section("cuerpo")
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h5 class="h5">Registracion de un nuevo protocolo</h5>
</div>
<div class="flash-message">
  @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('protocolos.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
    @endif
  @endforeach
</div>
<form method="POST" action="/protocolos">
  @csrf

  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Descripción</label>
      <input type="text" name="desc"  class="form-control form-control-sm @error('desc') is-invalid @enderror" value="{{ old('desc') }}" placeholder="Nombre">
      @error('desc')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>
    <div class="form-group col-md-2">
      <label for="inputState">Código</label>
      <select name="codigo" id="inputState" class="form-control select" >
        @foreach($codigos as $codigo)
          <option value="{{$codigo->id}}">{{$codigo->color}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-2">
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
    <div class="form-group col-md-4">
        <input id="tags" type="text" name="buscador" value="{{old('buscador')}}" class="form-control form-control-sm @error('sint') is-invalid @enderror"" placeholder="Síntoma" autocomplete="off">
        @error('sint')
        <span class="invalid-feedback" role="alert">
        <!-- CAMBIAMOS EL MENSAJE PARA ESTE CASO -->
            <strong>Debe agregar al menos un síntoma a la tabla.</strong> 
        </span>
        @enderror
    </div>
    <div class="form-group col-md-4">
      <button type="button" id="btn_agregar" onclick="addRow()" class="btn btn-mod">Agregar</button>    
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

  <button type="submit" class="btn btn-mod">Registrar</button>
  <a class="btn btn-outline-secondary btn-close" href="{{ route('protocolos.index') }}">Volver</a>
</form>
 
@endsection
@section("scripts")

<script>
  function addRow() {   // PARA AGREGAR NUEVA FILA A LA TABLA
      // alert(document.getElementById("btn_agregar").value);
      if(document.getElementById("tags").value=='')
        alert("Para agregar un síntoma debe ingresar su nombre")
      else{
        if(esta(document.getElementById("tags").value)){
          if(chequeaRepetido(document.getElementById('btn_agregar').value)){
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
            ele.setAttribute('value', document.getElementById('btn_agregar').value);
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

  function esta(st){
    var i = 0;
    var b = false;
    while(!b && i<listasintomas.length){
      if (listasintomas[i].toUpperCase() == st.toUpperCase())
        b = true;
      i+= 1;
    }
    if (b)
      return true;
    else
      return false;
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

  function autocomplete(inp, arr, arrid) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            b.innerHTML += "<input type='hidden' value='" + arrid[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              document.getElementById("btn_agregar").value = this.getElementsByTagName("input")[1].value;
              /*close the list of autocompleted values, (or any other open lists of autocompleted values:*/
              closeAllLists();
            });
            a.appendChild(b);
          }
          // else{
          //   document.getElementById("btn_agregar").value = "No";
          // }
        }
    });
    
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
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



<script type="text/javascript">
  $(document).ready(function() {
    $('#dtBasicExample').DataTable({
      
      
       "language": {
        "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        //only works for built-in buttons, not for custom buttons
        "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
    }           
    });
} );
</script>

@endsection
