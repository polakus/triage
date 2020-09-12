<?php $__env->startSection("cuerpo"); ?>
<div class="card"> 
  <div class="card-header" style="font-size: 20px;">Pacientes para atender</div>
    <div class="card-body">
    <?php if($mensaje==""): ?> 
      <div id="Salas">
        <form method="POST" action="/atencionclinica/sala">
          <?php echo csrf_field(); ?>
        <h5>Indicar en que sala se encuentra situado</h5>
        <div class="form-row">
        
          <div class="form-group col-md-4" style="font-size: 17px;">
              <label for="inputState">Sala</label>
              <select name="sala" id="sala" class="form-control">
                
                    <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <option value="<?php echo e($s->id); ?>-<?php echo e($s->tipo_dato); ?> <?php echo e($s->nombre); ?> "><?php echo e($s->tipo_dato); ?> <?php echo e($s->nombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>

      </div>
      <div class="row">
        <div class="col">
          <button  type="submit" class="btn btn-success btn-sm">Listo</button>
        </div>
        
      </div>
      </form>
      </div>
  <?php else: ?>
  <div class="form-group">
      
         <h6><?php echo e($mensaje); ?></h6>
     
      <a href="<?php echo e(route('atencionclinica.edit', Auth::id() )); ?>"class="btn btn-dark btn-sm" style="width:220px;">Cambiar ubicacion</a>
      
     
  </div>
      <div class="form-row" id="seccionRecargar">
        <div class="form-group col-md-2" style="font-size: 17px;">
              <label for="inputState">Área</label>
              <select name="area" id="area" class="form-control">
                <option value="Todas" selected>Todas</option>

                    <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($area->tipo_dato == $val1): ?>
                        <option value="<?php echo e($area->tipo_dato); ?>" selected><?php echo e($area->tipo_dato); ?></option>
                      <?php else: ?>
                        <option value="<?php echo e($area->tipo_dato); ?>"><?php echo e($area->tipo_dato); ?></option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>
          <div class="form-group col-md-2" style="font-size: 17px;">
              <label for="inputState">Especialidades</label>
              <select name="esp" id="esp" class="form-control">
                <option value="Todas" selected>Todas</option>
                    <?php $__currentLoopData = $especialidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($esp->nombre == $val2): ?>
                        <option value="<?php echo e($esp->nombre); ?>" selected><?php echo e($esp->nombre); ?></option>
                      <?php else: ?>
                        <option value="<?php echo e($esp->nombre); ?>"><?php echo e($esp->nombre); ?></option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>

      </div>



        
          <table class="table table-bordered  table-sm table-hover table-responsive-sm" id="table_id">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Area</th>
                <th scope="col">Accion</th>
                
              </tr>
            </thead>
            <tbody id="tabla">
              <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($paciente->color == "verde"): ?>
                  <tr class="table-success">
                <?php elseif($paciente->color== "amarillo"): ?>
                  <tr class="table-warning">
                <?php elseif($paciente->color=="rojo"): ?>
                  <tr class="table-danger">
                <?php endif; ?>
              
                <td><?php echo e($paciente->nombre); ?></td>
                <td> <?php echo e($paciente->apellido); ?></td>
               
                <td><?php echo e($paciente->fecha); ?></td>
                <td> <?php echo e($paciente->especialidad); ?></td>
                <td><?php echo e($paciente->tipo_dato); ?></td>
                <td>
                <div class="form-row">
                   <form id="frm1" class= "form-inline" action="<?php echo e(route('atencionclinica.show',$paciente->id_atencion)); ?>" method="GET">
                      <input type="hidden" name="detalleatencion" value="<?php echo e($paciente->id); ?>">
                      <input type="hidden" name="mensaje" value="<?php echo e($mensaje); ?>">

                      <button type="submit" class="btn btn-primary btn-sm ml-1">Triaje</button>
                   </form>
                   <button type="submit" class="btn btn-primary btn-sm ml-1">Editar</button>
                </div>
               
                
                </td>
              </tr>
              
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           

            </tbody>
          </table>
      <?php endif; ?>
      
    </div>
  </div>

    


<script>
  $('select').on('change', function() {
    if($('#esp').val() == 'Todas' && $('#area').val()=='Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) == -1 &&
           $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1 )
        });
    }else if($('#esp').val() != 'Todas' && $('#area').val() == 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) > -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1
            )
        });
    }else if($('#esp').val() == 'Todas' && $('#area').val() != 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) == -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1
            )
        });
    }else if($('#esp').val() != 'Todas' && $('#area').val() != 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) > -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1
            )
        });
    }
    
    
    

    }).trigger('change');

  $("#name").change(function(){
    if($("#name").val()=="basic")
      $("#area option").not("[value^='basic']").hide();
    else
      $("#subscription_interval option").not("[value^='basic']").show();
    });

</script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {
    $('#table_id').DataTable({
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
        "searchPlaceholder": "Término de búsqueda",
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

<script type="text/javascript">
  
    
    var x = document.crearInputs('input');
    x.setAttribute('type','text');
    x.setAttribute('name','val1');
    x.setAttribute('value',"probando");

    document.getElementById("frm1").appendChild(x);
  
</script>
<script>
  $('form[id^="frm1"').submit( function() {
    
      $("<input />").attr("type", "hidden")
        .attr("name", "val1")
        .attr("value",$('#area').val())
        .appendTo("form");
      $("<input />").attr("type", "hidden")
        .attr("name", "val2")
        .attr("value", $('#esp').val())
        .appendTo("form");
      return true;
   
  });
</script>






<?php $__env->stopSection(); ?>


<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/atencionclinica/index.blade.php ENDPATH**/ ?>