<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<!-- Para Modal -->

<div class="card">
	<div class="card-header"> Usuarios </div>
	   <div class="card-body">
		<div class="flash-message">
		    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		      <?php if(Session::has('alert-' . $msg)): ?>

		      <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		      <?php endif; ?>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>

		<div class="form-row">
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="<?php echo e(route('usuarios.create')); ?>">Registrar Usuario</a>
			</div>
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="/usuarios/pendientes">Usuarios Pendientes</a>
			</div>
		</div>
		
		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:20%">Usuario</th>
						<th scope="col" style="width:15%">Estado</th>
						<th scope="col" style="width:30%">Email</th>
						<th scope="col" style="width:20%">Rol</th>
						<th scope="col" style="width:15%">Acción<nav></nav></th>
					</tr>
				</thead>
				<tbody id="tabla">
					<?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($usuario->username); ?></td>
						<td>
						<?php if( $usuario->isOnline() ): ?>
							<li class="text-success">Online</li>
						<?php else: ?>
							<li class="text-muted">Offline</li>
						<?php endif; ?>
						</td>				
						<td><?php echo e($usuario->email); ?></td>
						<td><?php echo e($usuario->rol->nombre); ?></td>
						<td>
							<div class="form-row">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModalCenter<?php echo e($usuario->id); ?>">Ver</button>
								<!-- Modal -->
								<div class="modal fade" id="exampleModalCenter<?php echo e($usuario->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLongTitle">Datos de Usuario</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php if($usuario->profesional): ?>
													
													<div class="col">
														<h5>Nombre: <?php echo e($usuario->profesional->nombre); ?></h5>			
													</div>
													
													<div class="col">
														<h5>Apellido: <?php echo e($usuario->profesional->apellido); ?></h5>			
													</div>
													
													<div class="col">
														<h5>Domicilio: <?php echo e($usuario->profesional->domicilio); ?></h5>			
													</div>
													
												<?php else: ?>
												<h5>No hay más datos para este usuario</h5>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									</div>
								</div>
								<form id="a2" name="<?php echo e($usuario->username); ?>" action="usuarios/<?php echo e($usuario->id); ?>" method="post">
									<?php echo csrf_field(); ?>
									<?php echo e(method_field('DELETE')); ?>

									<?php if(Auth::id()==$usuario->id): ?>
										<button type="submit" class="btn btn-danger btn-sm" value="<?php echo e($usuario->id); ?>" disabled>Eliminar</button>
									<?php else: ?>
										<button type="submit" class="btn btn-danger btn-sm" value="<?php echo e($usuario->id); ?>">Eliminar</button>
									<?php endif; ?>
								</form>
							</div>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>

	</div>
</div>





<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
<script>
$('form[id^="a2"').submit( function() {
	if (confirm('Por favor, confirme que desea eliminar al usuario '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  

$(document).ready(function() {
    $('#myTable').DataTable();
} );
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/usuarios/index.blade.php ENDPATH**/ ?>