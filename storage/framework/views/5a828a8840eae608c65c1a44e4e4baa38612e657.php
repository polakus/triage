




<?php $__env->startSection("cuerpo"); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4>Atenciones</h4>
</div>

<div class="form-row">


  <div class="form-group col-md-2">
      <label for="inputState">Condicion</label>
      <select name="cod" id="cod" class="form-control form-control-sm">
        <option value="Todas" selected>Todas</option>
        <option value="Operar">Operar</option>
        <option value="Internar" >Internar</option>
        <option value="Shock Room">Shoock Room</option>
        <option value="consulta" >Consulta</option>

        <option value="Internado">Internado</option>

        <option value="Operado" >Operado</option>
        <option value="alta"> Alta</option>

      </select>
  </div>

  <div class="form-group col-md-2">
      <label for="inputState">Fecha</label>
      <input type="date" class="form-control form-control-sm" data-date-format="DD-MMMM-YYYY" name="fecha" id="fecha">
  </div>
</div>

<div class="table-responsive">
        <table class="table table-striped table-bordered table-sm" id="example" >
          <thead>
            <tr>
              <th>Nombre y Apellido</th>
              <th>Fecha y hora</th>
              <th>Areas</th>
              <th>Especialidades</th>
              <th>Condicion</th>
              <th>Observacion</th>
              <th >Sala de internacion</th>
              <th >Sala de operacion</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody id="tabla">
           <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($p->color == "verde"): ?>
              <tr class="table-success">
            <?php elseif($p->color== "amarillo"): ?>
              <tr class="table-warning">
            <?php elseif($p->color=="rojo"): ?>
              <tr class="table-danger">
            <?php endif; ?>
              <td> <?php echo e($p->nombre); ?> <?php echo e($p->apellido); ?></td>
              <td> <?php echo e($p->fecha); ?> <?php echo e($p->hora); ?></td>
              <td> <?php echo e($p->tipo_dato); ?></td>
              <td> <?php echo e($p->especialidad); ?> </td>
              <td> <?php echo e($p->estado); ?></td>
              <td>
                <?php $__currentLoopData = $historial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($h->id_detalle_atencion == $p->id): ?>
                    CIE:<?php echo e($h->codigo); ?>-<?php echo e($h->descripcion); ?>

                    <br>
                    <?php echo e($h->observacion); ?>


                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </td>
               <td>
                <?php if($p->estado != "consulta" && $p->estado!= "alta" && $p->estado !="Internado" && $p->estado != "Operado" && $p->estado != "Operar"): ?>
                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo e($p->id); ?>" id="button1">

                      Asignar sala
                    </button>


                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal<?php echo e($p->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Salas</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container col-md-12">
                              
                              <?php if($p->estado == "Internar"): ?>
                                <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($s->tipo_dato == "Internacion"): ?>
                                    <div class="row border">
                                      <div class="col border">
                                       <label><?php echo e($s->nombre); ?></label> 
                                      </div>

                                      <?php if($s->disponibilidad == 1): ?>
                                          <div class="col">
                                              <label>Disponible</label>
                                          </div>
                                          <div class="col border">
                                              <form method="POST" action="/turnos">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="sala" value="<?php echo e($s->nombre); ?>">
                                                <input type="hidden" name="detalleatencion" value="<?php echo e($p->id); ?>">
                                                <input type="hidden" name="id_sala" value=<?php echo e($s->id); ?>>
                                                <input type="hidden" name="tipo" value="Internado">
                                                <button type="submit" id="add" name="add" class="btn btn-success btn-sm">Asignar esta sala</button>
                                              </form>
                                          </div>
                                      <?php else: ?>
                                          <div class="col border">
                                            <label>No disponible</label>
                                          </div>
                                           <div class="col border">
                                            <button type="submit" id="add" name="add" class="btn btn-success btn-sm" disabled>Asignar esta sala</button>
                                          </div>
                                      <?php endif; ?>
                                    </div>

                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                          </div> 
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                <?php else: ?>
                  <?php if($p->estado != "consulta" && $p->estado != "Operado"): ?>
                    <?php echo e($p->sala); ?>

                  <?php endif; ?>

                <?php endif; ?>
              </td>

              <td>
                <?php if($p->operar == 1 || $p->estado == "Operar" ): ?>
                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#modal<?php echo e($p->id); ?>" id="button1">
                      Quirofano
                    </button>


                  <!-- Modal -->
                  <div class="modal fade" id="modal<?php echo e($p->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title" id="exampleModalLabel">Salas de Quirofanos</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="container col-md-12">

                             <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if($s->tipo_dato == "Quirofano"): ?>
                                     <div class="row border">
                                        <div class="col border">
                                          <label><?php echo e($s->nombre); ?></label> 
                                        </div>
                                        <?php if($s->disponibilidad == 1): ?>
                                          <div class="col border">
                                              <label>Disponible</label>
                                          </div>
                                          <div class="col border">
                                              <form method="POST" action="/turnos">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="sala" value="<?php echo e($s->nombre); ?>">
                                                <input type="hidden" name="detalleatencion" value="<?php echo e($p->id); ?>">
                                                <input type="hidden" name="id_sala" value=<?php echo e($s->id); ?>>
                                                <input type="hidden" name="tipo" value="Operado">
                                                <button type="submit" id="add" name="add" class="btn btn-success">Asignar esta sala</button>
                                              </form>
                                            </div>
                                        <?php else: ?>
                                            <div class="col border">
                                              <label>No disponible</label>
                                            </div>
                                             <div class="col border">
                                              <button type="submit" id="add" name="add" class="btn btn-success" disabled>Asignar esta sala</button>
                                            </div>
                                        <?php endif; ?>
                                     </div>
                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                <?php else: ?>
                  <?php if($p->estado =="Operado"): ?>
                    <?php echo e($p->sala); ?>

                  <?php endif; ?>

                <?php endif; ?>
              </td> 
              <td>
                <?php if($p->estado == "Internado"): ?>
                  <a href="<?php echo e(route('turnos.edit',$p->id)); ?>" class="btn btn-success btn-sm">Dar de alta</a>
                <?php endif; ?>
              </td>  
              </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
</div>











<?php $__env->stopSection(); ?>
<?php $__env->startSection("scripts"); ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
  $('select').on('change', function() {
    if($('#cod').val() == 'Todas'){
     
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#cod').val().toLowerCase()) == -1)
        });
    }else{
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#cod').val().toLowerCase()) > -1)
        });
    }
    
    }).trigger('change');

</script>
<script type="text/javascript">
  var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('fecha').value=ano+"-"+mes+"-"+dia;
  $('input').on('change', function() {
   
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#fecha').val().toLowerCase()) > -1)
        });
    
    
    }).trigger('change');
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
      "iDisplayLength": 100,
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






<?php $__env->stopSection(); ?>
<?php echo $__env->make("triagepreguntas.test", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/turnos/mostrar.blade.php ENDPATH**/ ?>