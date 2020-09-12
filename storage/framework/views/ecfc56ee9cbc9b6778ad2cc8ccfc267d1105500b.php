

<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<div class="card">
  <div class="card-header">Registracion de sala</div>
    <div class="card-body">
      <form method="POST" action="/salas">
        <?php echo csrf_field(); ?>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre">
          </div>
          <div class="form-group col-md-3">
            <label for="inputState">Área</label>
            <select name="area" id="inputState" class="form-control">
              <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($area->id); ?>"><?php echo e($area->tipo_dato); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nro. Camas</label>
            <input type="number" id="quantity" name="camas" min="0" max="100" placeholder="Nro. Camas" class="form-control">
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a class="btn btn-default btn-dark" href="<?php echo e(route('salas.index')); ?>">Volver</a>


        
        

        <div class="flash-message">
          <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(Session::has('alert-' . $msg)): ?>

            <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="<?php echo e(route('salas.index')); ?>" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

      </form>
    </div>
  </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("triagepreguntas.test", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/salas/create.blade.php ENDPATH**/ ?>