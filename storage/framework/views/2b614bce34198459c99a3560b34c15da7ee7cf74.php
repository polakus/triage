<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<!-- Para Modal -->

<div class="card">
	<div class="card-header">Usuarios Pendientes</div>
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
				<a class="btn btn-dark" href="<?php echo e(route('usuarios.index')); ?>">Volver</a>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-2">
				<input class="form-control" type="text" name="usuario" id="myInput" onkeyup="myFunction()" placeholder="Usuario" value="<?php echo e(old('busqueda')); ?>">
			</div>
		</div>
		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-sm table-hover" cellspacing="0" width="100%">
				<thead class="thead-dark">
					<tr>
						<th scope="col" style="width:20%">Usuario</th>
						<th scope="col" style="width:40%">Email</th>
						<th scope="col" style="width:20%">Rol</th>
						<th scope="col" style="width:20%">Acción<nav></nav></th>
					</tr>
				</thead>
				<tbody id="tabla">
					<?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($usuario->username); ?></td>
						<td><?php echo e($usuario->email); ?></td>
						<td><?php echo e($usuario->rol->nombre); ?></td>
						<td>
							<div class="form-row">
								<form id="f1" name="<?php echo e($usuario->username); ?>" class= "form-inline" method="GET" action="/usuarios/pendientes/<?php echo e($usuario->id); ?>/edit">
								<?php echo csrf_field(); ?>
									<button type="submit" class="btn btn-success btn-sm">Aceptar</button>
								</form>
								<form id="f2" name="<?php echo e($usuario->username); ?>" class= "form-inline" method="POST" action="/usuarios/pendientes/<?php echo e($usuario->id); ?>">
								<?php echo csrf_field(); ?>
									<?php echo e(method_field('DELETE')); ?>

									<button type="submit" class="btn btn-secondary btn-sm">Rechazar</button>
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
$('form[id^="f1"').submit( function() {
	if (confirm('Por favor, confirme que desea ACEPTAR la solicitud del usuario '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
$('form[id^="f2"').submit( function() {
	if (confirm('Por favor, confirme que desea RECHAZAR la solicitud del usuario '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>

<script>
	$('form[id^="f"').submit( function() {
		$("<input />").attr("type", "hidden")
			.attr("name", "busqueda")
			.attr("value", $('#myInput').val())
			.appendTo("form");
		return true;
	});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/usuarios/pendientes.blade.php ENDPATH**/ ?>