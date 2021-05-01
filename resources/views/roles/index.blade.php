@extends('triagepreguntas.test')

@section('css')
<style type="text/css">
	.btn{
		/*min-width: 30px;
		max-width: 100%;*/

		width: 100%;
		margin-right: 2px;
	}
</style>

@endsection

@section("cuerpo")
<div id="alerta"></div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4 class="h4">Roles</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        @canany(['RegistrarRol','FullRoles'])
        <a type="button" class="btn btn-sm btn-outline-secondary" href="{{ route('roles.create') }}">Agregar Rol</a>
        @endcanany
      </div>
    </div>
</div>

<div class="table-responsive">
	<table  class="table table-bordered table-sm table-striped table-hover" id="tabla_rol">
		<thead >
		<tr>
			<th scope="col" >Nº</th>
			<th scope="col" >Nombre</th>
			<th scope="col" width="40%" >Accion</th>
			{{-- <th scope="col" >Acción</th> --}}
		</tr>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>


@endsection

@section('scripts')
@parent
<script type="text/javascript">
  
  $(document).ready(function() {
    
    $('#tabla_rol').DataTable({
      "responsive": true,
      "processing":true,
          "serverSide":true,
           "ajax":{url:"{{ url('api/rolesApi/'.Auth::id()) }}",
              
         },
           "columns":[
            {data:'id'},
            {data:'name'},
            {data:'btnAccion'},
           
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

  function eliminar(id){
    $('#modalEliminar'+id).modal('hide');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            type:'DELETE',
            url:"/roles/"+id,
            dataType:"json",
            data:{
            },
            success: function(response){
                $('#tabla_rol tbody').ready(function(){
                        $('#bn'+id).closest('tr').remove();
                    });
                let alert = document.getElementById("alerta");
                alert.classList.add('alert');
                alert.classList.add('alert-success');
                alert.innerHTML=`<button type="button" class="close" data-dismiss="alert">x</button><strong>Exito! </strong>Los datos fueron eliminados exitosamente`;
                $("#alerta").fadeTo(3000, 500).slideUp(500, function(){
                $("#alerta").slideUp(500);});
                },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
    
                  console.log(err.responseJSON);
                  let alert = document.getElementById("alerta");
                    alert.classList.add('alert');
                    alert.classList.add('alert-success');
                    alert.innerHTML=`<button type="button" class="close" data-dismiss="alert">x</button><strong>Eror! </strong>No ha sido posible borrar estos datos.`;
                    $("#alerta").fadeTo(3000, 500).slideUp(500, function(){
                    $("#alerta").slideUp(500);});
                    
                }
            }
    });

  }

  function VerPermisos(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
            type:'GET',
            url:"/api/permisos_roles",
            dataType:"json",
            data:{
                id:id
            },
            success: function(response){
                let lista = response.permisos;
                let lista_string='<ul>';
                for(let i=0;i< lista.length;i++){
                    lista_string=lista_string+'<li>'+lista[i].name+'</li>';
                }
                lista_string=lista_string+'</ul>';
                $('#modal-body'+id).html(lista_string);
                $('#VerPermiso'+id).modal('show');

                },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
    
                  console.log(err.responseJSON);
                  let alert = document.getElementById("alerta");
                    alert.classList.add('alert');
                    alert.classList.add('alert-success');
                    alert.innerHTML=`<button type="button" class="close" data-dismiss="alert">x</button><strong>Error! </strong>`;
                    $("#alerta").fadeTo(3000, 500).slideUp(500, function(){
                    $("#alerta").slideUp(500);});
                    
                }
            }
    });
    

    
  }
</script>



@endsection