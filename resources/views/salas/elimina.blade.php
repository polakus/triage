<button type="button" id="bn{{$sala->id}}" onclick="elimina({{$sala->id}})" class="btn btn-outline-secondary btn-sm">Eliminar</button>

<script>

    function elimina(id) {
         if (confirm('¿Esta seguro de eliminar la sala? Tenga en cuenta que se eliminara todos los datos relacionados a ella.')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'DELETE',
                url:"/salas/"+id,
                dataType:"json",
                success: function(response){
                    $('#myTable tbody').ready(function(){
                        $('#bn'+id).closest('tr').remove();
                    });
                },
                error:function(err){
                    alert("No se pudo eliminar la sala");
                }
            });
        }
        else{return false;}
    }
</script>