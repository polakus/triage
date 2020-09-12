<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<div class="card">
	<div class="card-header">Detalles de Protocolo</div>
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-2">
					<a class="btn btn-dark" href="<?php echo e(route('protocolos.index')); ?>">Volver</a>
				</div>
			</div>
			<table id="dtBasicExample" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:20%">Protocolo</th>
						<th scope="col" style="width:30%">Código</th>
						<th scope="col" style="width:30%">Especialidad</th>
					</tr>
				</thead>
				<tbody id="tabla">
				<?php $__currentLoopData = $sintomas_protocolo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($protocolo->descripcion); ?></td>
						<td><?php echo e($sp->descripcion); ?></td>
						<td>
							<?php $__currentLoopData = $especialidad_protocolo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php echo e($esp->nombre); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/protocolos/show.blade.php ENDPATH**/ ?>