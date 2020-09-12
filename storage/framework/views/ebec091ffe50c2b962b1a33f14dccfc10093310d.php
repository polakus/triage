<?php $__env->startSection('cuerpo'); ?>

<div class="card">
	<div class="card-header">Analisis de acuerdo a los Sintomas descriptos</div>
		<div class="card-body">
			<?php if($bandera==""): ?>
			  <?php if($disponibles_salas != ""): ?>

			  	<?php if($color == "verde"): ?>
				  	<div class="alert alert-success" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	<?php $__currentLoopData = $disponibles_salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 				 	<p><?php echo e($dis->tipo_dato); ?> Sala Nº: <?php echo e($dis->nombre); ?></p>
				 				 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-success btn-close ml-4" href="<?php echo e(route('pacientes.index')); ?>">Listo!</a>

			  	<?php elseif($color == "amarillo"): ?>
			  		<div class="alert alert-warning" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	<?php $__currentLoopData = $disponibles_salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 				 	<p><?php echo e($dis->tipo_dato); ?> Sala Nº: <?php echo e($dis->nombre); ?></p>
				 				 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-warning btn-close ml-4" href="<?php echo e(route('pacientes.index')); ?>">Listo!</a>

			  	<?php else: ?>
			  		<div class="alert alert-danger" role="alert">
				 				 <h4 class="alert-heading">Nota del paciente!</h4>
				 				 	<p>El paciente debe ser atendido con un profesional con especialidad en <?php echo $especialidad ?> </p> 
				 				 	<p> En estos momentos se encuentran disponible medicos en:</p>
				 				 	<?php $__currentLoopData = $disponibles_salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				 				 	<p><?php echo e($dis->tipo_dato); ?> Sala Nº: <?php echo e($dis->nombre); ?></p>
				 				 	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				 				
				 				 	
				 	</div>
				 	<a class="btn btn-danger btn-close ml-4" href="<?php echo e(route('pacientes.index')); ?>">Listo!</a>

			  	<?php endif; ?>
			 <?php else: ?>

			 	<?php if($color == "verde"): ?>
				 		<div class="alert alert-success" role="alert">
				 			<?php if($respuesta==""): ?>
				 				<?php if($disponibles==0): ?>
					 				<p>En estos momentos no se encuentra un medico disponible para <?php echo e($especialidad); ?>...</p>
					 			<?php else: ?> 
					 				<p>En estos momentos se encuentran <?php echo e($disponibles); ?> medicos disponibles para <?php echo e($especialidad); ?>, pero desconocemos en que sala estan situados...</p>
					 			<?php endif; ?>
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
					 		<form class= "form-inline" method="POST" action="/turnos/<?php echo e($id_detalle_atencion); ?> ">
					       			<?php echo csrf_field(); ?>
					       			<?php echo e(method_field('DELETE')); ?>

					       			<a class="btn btn-success btn-close ml-4 " href="<?php echo e(route('pacientes.index')); ?>"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
					 				
					 			</form>
					 		
					 		<?php else: ?>
					 		<p><?php echo e($respuesta); ?></p>
					 			<?php if($disponibles==0): ?>
					 				<p>En estos momentos no se encuentran un medicos disponible...</p>
					 			<?php else: ?>
					 				<p>En estos momentos se encuentran <?php echo e($disponibles); ?> medicos disponibles, pero desconocemos en que sala estan situados...</p>
					 			<?php endif; ?>

					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
				 			<form class= "form-inline" method="POST" action="/turnos/<?php echo e($id_detalle_atencion); ?> ">
					       			<?php echo csrf_field(); ?>
					       			<?php echo e(method_field('DELETE')); ?>

					       			<a class="btn btn-warning btn-close ml-4 " href="<?php echo e(route('pacientes.index')); ?>"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			<?php endif; ?>
				 		</div>

			 	<?php elseif($color == "amarillo"): ?>
						<div class="alert alert-warning" role="alert">
							<?php if($respuesta==""): ?>
								<?php if($disponibles==0): ?>
									<p>En estos momentos no se encuentra un medico disponible para <?php echo e($especialidad); ?>...</p>
								<?php else: ?>
									<p>En estos momentos se encuentran <?php echo e($disponibles); ?> medicos disponibles para <?php echo e($especialidad); ?>, pero desconocemos en que sala estan situados...</p>
								<?php endif; ?>
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
					 		<form class= "form-inline" method="POST" action="/turnos/<?php echo e($id_detalle_atencion); ?> ">
					       			<?php echo csrf_field(); ?>
					       			<?php echo e(method_field('DELETE')); ?>

					       			<a class="btn btn-warning btn-close ml-4 " href="<?php echo e(route('pacientes.index')); ?>"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			
				 			<?php else: ?>
				 			<p><?php echo e($respuesta); ?></p>
				 			<?php if($disponibles==0): ?>
					 				<p>En estos momentos no se encuentran un medicos disponible...</p>
					 			<?php else: ?>
					 				<p>En estos momentos se encuentran <?php echo e($disponibles); ?> medicos disponibles, pero desconocemos en que sala estan situados...</p>
					 			<?php endif; ?>
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
				 			<form class= "form-inline" method="POST" action="/turnos/<?php echo e($id_detalle_atencion); ?> ">
					       			<?php echo csrf_field(); ?>
					       			<?php echo e(method_field('DELETE')); ?>

					       			<a class="btn btn-warning btn-close ml-4 " href="<?php echo e(route('pacientes.index')); ?>"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			<?php endif; ?>
						</div>
			 	<?php else: ?>
						<div class="alert alert-danger" role="alert">
							<?php if($respuesta==""): ?>
								<?php if($disponibles==0): ?>
									<p>En estos momentos no se encuentra un medico disponible para <?php echo e($especialidad); ?>...</p>
								<?php else: ?>
									<p>En estos momentos se encuentran <?php echo e($disponibles); ?> medicos disponibles para <?php echo e($especialidad); ?>, pero desconocemos en que sala estan situados...</p>
								<?php endif; ?>
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
					 		<form class= "form-inline" method="POST" action="/turnos/<?php echo e($id_detalle_atencion); ?> ">
					       			<?php echo csrf_field(); ?>
					       			<?php echo e(method_field('DELETE')); ?>

					       			<a class="btn btn-success btn-close ml-4 " href="<?php echo e(route('pacientes.index')); ?>"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
					 				
					 			</form>
					 		
				 			<?php else: ?>
				 			<p><?php echo e($respuesta); ?></p>
				 			<?php if($disponibles==0): ?>
					 				<p>En estos momentos no se encuentran un medicos disponible...</p>
					 			<?php else: ?>
					 				<p>En estos momentos se encuentran <?php echo e($disponibles); ?> medicos disponibles, pero desconocemos en que sala estan situados...</p>
					 			<?php endif; ?>
					 			<p>Desea hacerlo esperar hasta que llegue un medico ?</p>
					 			<br>
				 			<form class= "form-inline" method="POST" action="/turnos/<?php echo e($id_detalle_atencion); ?> ">
					       			<?php echo csrf_field(); ?>
					       			<?php echo e(method_field('DELETE')); ?>

					       			<a class="btn btn-warning btn-close ml-4 " href="<?php echo e(route('pacientes.index')); ?>"> Si </a>  
					       			 &nbsp;  &nbsp;
					       			<button type="submit" class="btn btn-danger "> No </button>
				 				
				 				</form>
				 			<?php endif; ?>
				 		</div>
			 	<?php endif; ?>

			 <?php endif; ?>
		<?php else: ?>
			
			<div class="alert alert-secondary" role="alert">
				<h4>Nota para el personal</h4>
  				<p><?php echo e($bandera); ?></p>
  				<p>Seleccione la especialidad del medico que desea que lo atiendan y que codigo de triage corresponde</p>
  				<form method="POST" action="/turnos/cargarsinprotocolo">
  					<?php echo csrf_field(); ?>
  					<input type="hidden" name="atencion" value="<?php echo e($atencion); ?>">
	  				<div class="form-row">
							<div class="form-group col-md-2">
								<label>Especialidad</label>
			  				<select class="form-control form-control-sm" name="esp">
			  					<?php $__currentLoopData = $especialidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <option value="<?php echo e($esp->id); ?>"><?php echo e($esp->nombre); ?></option>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>

							</div>
							<div class="form-group col-md-2">
								<label>Codigo de triaje</label>
							<select class="form-control form-control-sm" name="color">
								<?php $__currentLoopData = $codigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <option value="<?php echo e($c->id); ?>"><?php echo e($c->color); ?></option>
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-sm">Aceptar</button>
						<a href="<?php echo e(route('pacientes.index')); ?>" class="btn btn-danger btn-sm">Cancelar</a>
					</div>
				</form>
			</div>

		<?php endif; ?>
	</div>
</div>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.plantillaTest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/turnos/respuesta.blade.php ENDPATH**/ ?>