

<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<div class="card">
  <div class="card-header"> Editar Paciente </div>
    <div class="card-body">
          <div class="row">
            <div class="col">
               <button class="btn btn-dark" id="btnver" onclick="ver()">Cargar datos NN</button>
               <button class="btn btn-dark" id="btnocultar" onclick="ocultar()">Ocultar datos nn</button>
            </div>
           
          </div>
          <br>
          <div class="row" id="historial">
            <div class="col">
              <table class="table table-bordered table-responsive" id="tablann">
                  <thead>
                    <tr>
                      <th>
                        Fecha y Horario
                      </th>
                      <th>
                        Historial
                      </th>
                      <th>
                        Accion
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $nn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e($n->fechaNac); ?></td>
                        <td><?php echo e($n->descripcion); ?></td>
                        <td>
                          <form method="POST" action="/pacientes/<?php echo e($n->id_atencion); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id_paciente" value="<?php echo e($id); ?>">
                            <?php echo e(method_field('PUT')); ?>

                            <button type="submit"class="btn btn-success">Seleccionar</button>
                          </form>
                          
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
              </table>
            </div>
          </div>

          <br>
          <form method="POST" action="/pacientes/<?php echo e($id); ?>">
            <?php echo csrf_field(); ?>
            <?php echo e(method_field('PUT')); ?>

            <input type="hidden" name="comprobador" value="1">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo e($paciente->nombre); ?>" >
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Apellido</label>
                <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="<?php echo e($paciente->apellido); ?>">
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmail4">Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Teléfono" value="<?php echo e($paciente->telefono); ?>">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-2">
                <label for="inputEmail4">Fecha de Nacimiento</label>
                <input type="text" name="fechaNac" class="form-control" id="inputEmail4" placeholder="dd/mm/aaaa" value="<?php echo e($paciente->fechaNac); ?>">
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">Sexo</label>
                <select name="sexo" id="inputState" class="form-control">
                  <option value="Masculino">Masculino</option>
                  <option value="Femenino">Femenino</option>
                </select>
              </div>
              <div class="form-group col-md-8">
                <label for="inputAddress">Dirección</label>
                <input type="text" name="direccion" class="form-control" id="inputAddress" placeholder="Dirección" value="<?php echo e($paciente->domicilio); ?>">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputZip">Documento</label>
                <input type="number" max="99999999" min="1000000" name="dni" class="form-control" id="inputZip" placeholder="Número de Documento" value="<?php echo e($paciente->dni); ?>">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="<?php echo e(route('pacientes.index')); ?>" class="btn btn-primary">Volver</a>
          </form>
        </div>
      </div>




<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#tablann').DataTable({
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


<script>
  document.getElementById('historial').style.display = 'none';
  document.getElementById('btnocultar').style.display = 'none';
function ver() {
     document.getElementById('historial').style.display = 'block';
     document.getElementById('btnver').style.display = 'none';
      document.getElementById('btnocultar').style.display = 'block';
}
function ocultar(){
  document.getElementById('historial').style.display = 'none';
     document.getElementById('btnver').style.display = 'block';
      document.getElementById('btnocultar').style.display = 'none';
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/pacientes/edit.blade.php ENDPATH**/ ?>