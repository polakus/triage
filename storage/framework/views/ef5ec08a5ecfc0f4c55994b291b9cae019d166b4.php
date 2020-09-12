<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<div class="card">
  <div class="card-header">Registracion de Area </div>
    <div class="card-body">
      <form method="POST" action="/salas/areas">
        <?php echo csrf_field(); ?>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputEmail4">Nombre</label>
            <input type="text" name="nombre" class="form-control" placeholder="Nombre">
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a class="btn btn-default btn-close" href="<?php echo e(route('salas.index')); ?>">Volver</a>


        
        

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

<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/areas/create.blade.php ENDPATH**/ ?>