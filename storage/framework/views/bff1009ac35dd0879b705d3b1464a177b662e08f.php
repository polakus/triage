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
					<h5>Nombre de usuario:</h5>			
				</div>
				<div class="col-md-6">
					<h5><?php echo e($usuario->username); ?></h5>		
				</div>
				<div class="col-md-6 text-md-right">
					<h5>Email:</h5>			
				</div>
				<div class="col-md-6">
					<h5><?php echo e($usuario->email); ?></h5>		
				</div>
				<div class="col-md-6 text-md-right">
					<h5>Rol:</h5>			
				</div>
				<div class="col-md-6">
					<h5><?php echo e($usuario->rol->nombre); ?></h5>		
				</div>
				<?php if($usuario->profesional): ?>
					<div class="col-md-6 text-md-right">
						<h5>Nombre:</h5>			
					</div>
					<div class="col-md-6">
						<h5><?php echo e($usuario->profesional->nombre); ?></h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Apellido:</h5>			
					</div>
					<div class="col-md-6">
						<h5><?php echo e($usuario->profesional->apellido); ?></h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Domicilio:</h5>			
					</div>
					<div class="col-md-6">
						<h5><?php echo e($usuario->profesional->domicilio); ?></h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Matrícula:</h5>			
					</div>
					<div class="col-md-6">
						<h5><?php echo e($usuario->profesional->matricula); ?></h5>		
					</div>
					<div class="col-md-6 text-md-right">
						<h5>Especialidades:</h5>			
					</div>					
					<div class="col-md-6">
						<?php $__currentLoopData = $usuario->profesional->detalleProfesional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<h5><li> <?php echo e($esp->especialidad->nombre); ?></li></h5>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
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
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/profesionales/index.blade.php ENDPATH**/ ?>