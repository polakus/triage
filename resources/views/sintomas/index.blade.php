@extends("triagepreguntas.test")

@section('css')
<style type="text/css">
    .contenido{
        display: block;
        padding: 10px;
        width:400px;
    
        flex-wrap: wrap;

    }
    .botones{
        
        display: flex;
        
        
    }
    .botones input{
        flex-grow: 1;
        width:60% !important;
    }
    .botones button{
        width: 40% !important;
        flex-grow: 1;
    }
    .error div{
        margin-left: 10px;
        
    }

    @media only screen and (max-width: 390px){
        .botones{
            display: block;

        }
        .botones input{
            width: 100%;
            margin-bottom: 3px;
        }
        .botones button{
            width: 100%;
        }
    }
   

</style>

@endsection
@section("cuerpo")
<div id="alerta"></div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Sintomas</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            @canany(['FullSintomas','RegistrarSintoma'])
            <button type="button" id="btnCreateModal" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#createModal">Agregar Síntoma</button>
            @endcan
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="myTable" class="table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr>
            <th scope="col">Sintomas</th>
            <th scope="col">Dias</th>
            <th scope="col">Horas</th>
            <th scope="col" >Accion</th>
            </tr>
        </thead>
        <tbody>
        
        </tbody>
    </table>
</div>
<!-- Modal Create Síntoma-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Registracion de Síntoma</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="error_nombre" class="form-group">
                    <label for="nombre_sintoma">Nombre del Síntoma</label>
                    <input type="text" id="nombre_sintoma" name="nombre_sintoma" class="form-control" placeholder="Síntoma">
                </div>
                <div class="form-row">
                    <div id="error_dias" class="form-group col-md-4">
                        <label for="dias">Días</label>
                        <input type="number" id="dias" name="dias" class="form-control" min="0" max="100" placeholder="Días">
                    </div>
                    <div id="error_horas" class="form-group col-md-4">
                        <label for="horas">Horas</label>
                        <input type="number" id="horas" name="horas" class="form-control" min="0" max="24" placeholder="Horas">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="guardar()" type="button" class="btn btn-dark">Guardar</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- fin Modal -->

<!-- Modal Edit Síntoma-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Editar síntoma</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
                <h6><strong style="color:red;">¡Cuidado! </strong>Si edita este síntoma el protocolo asociado al mismo se verá afectado también.</h6>
                <hr>
                <input type="hidden" id="edit_id_sintoma">
                <div id="div_nombre" class="form-group">
                    <label for="edit_nombre_sintoma">Nombre del Síntoma</label>
                    <input type="text" id="edit_nombre_sintoma" name="edit_nombre_sintoma" class="form-control" placeholder="Nombre" >
                </div>
                <div class="form-row">
                    <div id="div_dias" class="form-group col-md-4">
                        <label for="edit_dias">Días</label>
                        <input type="number" id="edit_dias" name="edit_dias" class="form-control" min="0" max="100" placeholder="Dias">
                    </div>
                    <div id="div_horas" class="form-group col-md-4">
                        <label for="edit_horas">Horas</label>
                        <input type="number" id="edit_horas" name="edit_horas" class="form-control" min="0" max="24" placeholder="Horas">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="editarbtn" onclick="editar()" type="button" class="btn btn-dark">Editar</button>
                <button  type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
            </div>
		</div>
	</div>
</div>
<!-- fin Modal -->
@endsection
@section("scripts")
@parent

{{-- JS Datatables --}}

<script type="text/javascript">
  $(document).ready(function() {
    var us = <?php echo Auth::id(); ?>;
    var table= $('#myTable').DataTable({
        "processing":true,
        "responsive":true,
          "serverSide":true,
           "ajax":{
              url:"api/sintomas_cargar/"+us
         },
           "columns":[
            {data:'descripcion'},
            {data:'dias'},
            {data:'horas'},
            {data:'button'},
           ],
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
        "processing": '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> ',
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

    
});
function guardar() {
    var nombre_sintoma = document.getElementById("nombre_sintoma").value;
    var dias = document.getElementById("dias").value;
    var horas = document.getElementById("horas").value;
    if (! (dias)) dias = 0;
    if (! (horas)) horas = 0;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        url:"/sintomas",
        dataType:"json",
        data:{
            nombre_sintoma: nombre_sintoma,
            dias: dias,
            horas: horas,
        },
        success: function(response){
            $('#createModal').modal('hide');
            var table=$("#myTable").DataTable();
            table.draw();

            $('#alerta').addClass('alert '+response.tipo);
            $('#alerta').html('<b>'+response.mensaje+'</b>');
            $("#alerta").fadeTo(2000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);
            });
            reset_error_msj();
        },
        error:function(err){
            if (err.status == 422) { // when status code is 422, it's a validation issue
                $.each(err.responseJSON.errors, function (i, error) {
                    switch( i ){
                        case "nombre_sintoma":
                            // document.getElementById('error_nombre').classList.add('is-invalid');
                            // parentNode.appendChild(a)
                            var ele_span = document.createElement('span');
                            ele_span.setAttribute('style', 'color:#e74a3b');
                            ele_span.setAttribute('role', 'alert');
                            ele_span.innerHTML = "<strong>" + error[0] + "</strong>";
                            document.getElementById('error_nombre').appendChild(ele_span);
                            document.getElementById("nombre_sintoma").classList.add("is-invalid");							    
                            break;
                        case "dias":
                            var ele_span = document.createElement('span');
                            ele_span.setAttribute('style', 'color:#e74a3b');
                            ele_span.setAttribute('role', 'alert');
                            ele_span.innerHTML = "<strong>" + error[0] + "</strong>";
                            document.getElementById('error_dias').appendChild(ele_span);
                            document.getElementById("dias").classList.add("is-invalid");							    
                            break;
                        case "horas":
                            var ele_span = document.createElement('span');
                            ele_span.setAttribute('style', 'color:#e74a3b');
                            ele_span.setAttribute('role', 'alert');
                            ele_span.innerHTML = "<strong>" + error[0] + "</strong>";
                            document.getElementById('error_horas').appendChild(ele_span);
                            document.getElementById("horas").classList.add("is-invalid");
                            break;
                        default:
                            alert("Ocurrió un error en la función de error de ajax");
                    }
                });
            }
        }
    });
}

function iniEditModal(id, descripcion, dias, horas){
    reset_error_msj();
    document.getElementById('edit_id_sintoma').value = id;
    document.getElementById('edit_nombre_sintoma').value = descripcion;
    document.getElementById('edit_dias').value = dias;
    document.getElementById('edit_horas').value = horas;
}
document.getElementById("btnCreateModal").onclick = function (){
    iniCreateModal();
}
function iniCreateModal(){
    reset_error_msj();
    document.getElementById('nombre_sintoma').value = "";
    document.getElementById('dias').value = "";
    document.getElementById('horas').value = "";
}

function eliminar(id,sintoma){
    $('#modalEliminar'+id).modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'DELETE',
        url:"/sintomas/"+id,
        dataType:"json",
        data:{
            id:id,
        },
        success: function(response){
            var table=$("#myTable").DataTable();
            table.draw();

            $('#alerta').addClass('alert '+response.tipo);
            $('#alerta').html('<b>'+response.mensaje+'</b>');
            $("#alerta").fadeTo(2000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);
            });  
        },
        error:function(err){
            if (err.status == 422) { // when status code is 422, it's a validation issue
                // console.log(err.responseJSON);
            }
                    
        }
    });
}
function editar() {
    var id = document.getElementById("edit_id_sintoma").value;
    var nombre_sintoma = document.getElementById("edit_nombre_sintoma").value;
    var dias = document.getElementById("edit_dias").value;
    var horas = document.getElementById("edit_horas").value;
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
        type:'PUT',
        url:"/sintomas/"+id,
        dataType:"json",
        data:{
            nombre_sintoma:nombre_sintoma,
            dias:dias,
            horas:horas,
        },
        success: function(response){
            $('#modalEditar').modal('hide');
            //ACTUALIZA TABLA
            var table = $('#myTable').DataTable();
            table.draw();
            //MUESTRA ALERTA
            $('#alerta').addClass('alert '+response.tipo);
            $('#alerta').html('<b>'+response.mensaje+'</b>');
            $("#alerta").fadeTo(4000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);
            });  
        },
        error:function(err){
            if (err.status == 422) { // when status code is 422, it's a validation issue
                $.each(err.responseJSON.errors, function (i, error) {
                    switch( i ){
                        case "nombre_sintoma":
                            // document.getElementById('error_nombre').classList.add('is-invalid');
                            // parentNode.appendChild(a)
                            var ele_span = document.createElement('span');
                            ele_span.setAttribute('style', 'color:#e74a3b');
                            ele_span.setAttribute('role', 'alert');
                            ele_span.innerHTML = "<strong>" + error[0] + "</strong>";
                            document.getElementById('div_nombre').appendChild(ele_span);
                            document.getElementById("edit_nombre_sintoma").classList.add("is-invalid");							    
                            break;
                        case "dias":
                            var ele_span = document.createElement('span');
                            ele_span.setAttribute('style', 'color:#e74a3b');
                            ele_span.setAttribute('role', 'alert');
                            ele_span.innerHTML = "<strong>" + error[0] + "</strong>";
                            document.getElementById('div_dias').appendChild(ele_span);
                            document.getElementById("edit_dias").classList.add("is-invalid");							    
                            break;
                        case "horas":
                            var ele_span = document.createElement('span');
                            ele_span.setAttribute('style', 'color:#e74a3b');
                            ele_span.setAttribute('role', 'alert');
                            ele_span.innerHTML = "<strong>" + error[0] + "</strong>";
                            document.getElementById('div_horas').appendChild(ele_span);
                            document.getElementById("edit_horas").classList.add("is-invalid");
                            break;
                        default:
                            alert("Ocurrió un error en la función de error de ajax");
                    }
                });
            }
        }
    });
}

function reset_error_msj(){
    // let invalid_inputs = document.getElementsByClassName('is-invalid');
    let invalid_inputs = document.querySelectorAll('.is-invalid')
    // console.log(invalid_inputs);
    for (let i = 0; i < invalid_inputs.length; i++) {
        invalid_inputs[i].classList.remove('is-invalid');
    }
    let spans = document.getElementsByTagName('span');
    while(spans.length>0){
        spans[0].remove();
    }
}

</script>


@endsection
