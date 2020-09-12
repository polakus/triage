<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<div class="card">
	<div class="card-header">Profesional</div>
		<div class="card-body">
			<div class="flash-message">
			    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			      <?php if(Session::has('alert-' . $msg)): ?>

			      <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
			      <?php endif; ?>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>


			<div class="form-group row">

				<div class="col-md-6 text-md-right">
					<h4>Nombre de usuario:</h4>			
				</div>
				<div class="col-md-6">
					<h4><?php echo e($usuario->username); ?></h4>		
				</div>
				<div class="col-md-6 text-md-right">
					<h4>Email:</h4>			
				</div>
				<div class="col-md-6">
					<h4><?php echo e($usuario->email); ?></h4>		
				</div>
				<div class="col-md-6 text-md-right">
					<h4>Rol:</h4>			
				</div>
				<div class="col-md-6">
					<h4><?php echo e($usuario->rol->nombre); ?></h4>		
				</div>
				<?php if($usuario->profesional): ?>
					<div class="col-md-6 text-md-right">
						<h4>Nombre:</h4>			
					</div>
					<div class="col-md-6">
						<h4><?php echo e($usuario->profesional->nombre); ?></h4>		
					</div>
					<div class="col-md-6 text-md-right">
						<h4>Apellido:</h4>			
					</div>
					<div class="col-md-6">
						<h4><?php echo e($usuario->profesional->apellido); ?></h4>		
					</div>
					<div class="col-md-6 text-md-right">
						<h4>Domicilio:</h4>			
					</div>
					<div class="col-md-6">
						<h4><?php echo e($usuario->profesional->domicilio); ?></h4>		
					</div>
					<div class="col-md-6 text-md-right">
						<h4>Matrícula:</h4>			
					</div>
					<div class="col-md-6">
						<h4><?php echo e($usuario->profesional->matricula); ?></h4>		
					</div>

					<br><br><br><br>
					<div class="col-md-6 text-md-right">
						<a class="btn btn-primary" disabled><?php echo e(__('Completar')); ?></a>			
					</div>
					<div class="col-md-6">
						<a class="btn btn-default btn-close" href="javascript:history.back()">Volver</a>
					</div>
				<?php else: ?>

					<br><br><br><br>
					<div class="col-md-6 text-md-right">
						<a class="btn btn-primary" href="<?php echo e(route('profesionales.create')); ?>"><?php echo e(__('Completar')); ?></a>
					</div>
					<div class="col-md-6">
						<a class="btn btn-default btn-dark" href="javascript:history.back()">Volver</a>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/profesionales/index.blade.php ENDPATH**/ ?>