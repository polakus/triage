@extends("triagepreguntas.test")

@section("cabecera")
    
@endsection

@section("cuerpo")
<div class="card">
  <div class="card-header">Registracion de Area </div>
  {{--Mensaje--}}
    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="{{ route('salas.index') }}" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
      @endforeach
    </div>
    <div class="card-body">
      <!-- <form method="POST" action="/areas">
        @csrf -->
        <div id="alerta"></div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" " placeholder="Nombre">
            <div id="error_nombre"></div>
            <!-- @error('nombre')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror -->
          </div>
        </div>

        <button id="guardar"class="btn btn-primary">Registrar</button>
        <a class="btn btn-default btn-close" href="{{ route('salas.index') }}">Volver</a>
      <!-- </form> -->
    </div>
  </div>
</div>

@endsection
@section("scripts")
<script type="text/javascript">
$('#guardar').click(function(){
  let nombre = document.getElementById('nombre').value;

  $.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
    $.ajax({
            type:'POST',
            url:"/areas",
            dataType:"json",
            data:{
                nombre: nombre,
            },
            success: function(response){
              let alert = document.getElementById("alerta");
							alert.classList.add('alert');
							alert.classList.add('alert-success');
							alert.innerHTML=`<button type="button" class="close" data-dismiss="alert">x</button><strong>El area fue agregado exitosamen!</strong>`;
		          $("#alerta").fadeTo(2000, 500).slideUp(500, function(){
						    $("#alerta").slideUp(900);
							});
                // $('#exampleModal').modal('hide');
                // var table = $('#myTable').DataTable();
                //         table.draw();
            },
            error:function(err){
                if (err.status == 422) { // when status code is 422, it's a validation issue
                
                  // $('#success_message').fadeIn().html(err.responseJSON.message);
                  $.each(err.responseJSON.errors, function (i, error) {
                    console.log(error[0]);
                    $('#error_nombre').html('<span style="color: red;">'+error[0]+'</span>');
                  //   switch( i ){
                  //     case "nombre":
                  //       
                  //     break;
                  //     case "camas":
                  //       $('#error_camas').html('<span style="color: red;">'+error[0]+'</span>');
                  //     break;
                  //     case "area":
                  //       $('#error_area').html('<span style="color: red;">'+error[0]+'</span>');
                  //     break;
                  //     default:
                  //       alert("Ocurrió un error en la función de error de ajax");
                  //   }
                  });
                }
            }
        });
});

</script>

@endsection