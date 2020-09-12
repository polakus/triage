<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<div class="card">
  <div class="card-header"> Registracion de un nuevo Protoloco </div>
    <div class="card-body">

          <form method="POST" action="/protocolos">
            <?php echo csrf_field(); ?>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmail4">Descripción</label>
                <input type="text" autocomplete="on" name="desc"  class="form-control" placeholder="Nombre">
              </div>
              <div class="form-group col-md-2">
                <label for="inputState">Código</label>
                <select name="codigo" id="inputState" class="form-control">
                  <?php $__currentLoopData = $codigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codigo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($codigo->id); ?>"><?php echo e($codigo->color); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="form-group col-md-2">
                <label for="inputEsp">Especialidad</label>
                <select name="especialidad" id="esp" class="form-control">
                  <?php $__currentLoopData = $especialidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($esp->id); ?>"><?php echo e($esp->nombre); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
            </div>
            <label for="inputEmail4">Síntomas</label>
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="th-sm">Descripción</th>
                <th class="th-sm">Acción</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $sintomas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sintoma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($sintoma->descripcion); ?></td>
                <td><input class="form-check-input position-static" type="checkbox" name="cbs[]" value="<?php echo e($sintoma->id); ?>"></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Registrar</button>
            <a class="btn btn-default btn-close" href="<?php echo e(route('protocolos.index')); ?>">Volver</a>


        
        

        <div class="flash-message">
          <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(Session::has('alert-' . $msg)): ?>
              <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="<?php echo e(route('protocolos.index')); ?>" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

      </form>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/protocolos/create.blade.php ENDPATH**/ ?>