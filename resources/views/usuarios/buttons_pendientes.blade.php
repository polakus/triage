<div style="display:flex; width:100%;">
	<button id="ace{{ $usuario->id }}" type="button" onclick="aceptar({{ $usuario->id }},'{{ $usuario->username }}')" class="btn btn-outline-secondary btn-sm ml-1 mb-1">Aceptar</button>
	<button id="eli{{ $usuario->id }}" type="button" onclick="eliminar({{ $usuario->id }},'{{ $usuario->username }}')" class="btn btn-outline-secondary btn-sm ml-1 mb-1">Rechazar</button>
</div>

<script type="text/javascript">
function eliminar(id,username){
  if (confirm('¿Esta seguro de rechazar la solicitud de '+username+'?')) {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'DELETE',
      url:"/usuarios/pendientes/"+id,
      dataType:"json",
      success: function(response){  
	      var table = $('#tpend').DataTable();
	      table.draw();
        // $('#tpend tbody').ready(function(){
        //   $('#eli'+id).closest('tr').remove();
        // });
        $('#alert').addClass('alert '+response.tipo);
        $('#alert').html('<b>'+response.mensaje+'</b>');
        $("#alert").fadeTo(4000, 500).slideUp(500, function(){
          $("#alert").slideUp(500);
	    	});  
	    },
      error:function(err){
        alert('Ocurrio un error');          
	    }
    });
 	  $("#alert").removeClass('alert'); 
	}
}

function aceptar(id,username){
  if (confirm('¿Esta seguro de aceptar la solicitud de '+username+'?')) {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'GET',
      url:"/usuarios/pendientes/"+id+"/edit",
      dataType:"json",
      success: function(response){  
	      var table=$('#tpend').DataTable();
	      table.draw();
        // $('#tpend tbody').ready(function(){
        //   $('#ace'+id).closest('tr').remove();
        // });
        $('#alert').addClass('alert '+response.tipo);
        $('#alert').html('<b>'+response.mensaje+'</b>');
        $("#alert").fadeTo(4000, 500).slideUp(500, function(){
          $("#alert").slideUp(500);
	    	});  
	    },
      error:function(err){
        alert('Ocurrio un error');          
	    }
    });
	  $("#alert").removeClass('alert'); 
	}
}
</script>