<style type="text/css">
    @media only screen and (max-width: 615px){
       /* .btn{
            width: 100% !important;
        }*/
    }
</style>

<button type="button" id="bh{{$sala->id}}" onclick="habilita({{$sala->id}})" style="width:90%;" class="btn {{$sala->disponibilidad==0 ? 'btn-danger': 'btn-success'}} btn-sm">{{$sala->disponibilidad==0 ? 'F. de Servicio': 'Disponible'}}</button>

<script>
    function habilita(id){
        if (confirm('¿Desea cambiar el estado del Quirófano?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'PUT',
                url:"/salas/"+id,
                dataType:"json",
                success: function(response){
                    if (response.disp==0){
                        $('#bh'+id).removeClass('btn-success');
                        $('#bh'+id).addClass('btn-danger');
                        $('#bh'+id).text('F. de Servicio');
                    }else{
                        $('#bh'+id).removeClass('btn-danger');
                        $('#bh'+id).addClass('btn-success');
                        $('#bh'+id).text('Disponible');
                    }
            },
            error:function(err){
                alert("No se pudo cambiar la disponibilidad de la sala");
            }
        });
        }else{
            return false;
        }
        
   		
    }
</script>