<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
<div class="card">
	<div class="card-header"> Protocolos </div>
	  <div class="card-body">
		<div class="form-row">
			<div class="form-group col-md-2">
				<a class="btn btn-dark" href="<?php echo e(route('protocolos.create')); ?>">Agregar Protocolo</a>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-2">
				<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre">
			</div>
		</div>
		<table id="myTable" class="table table-bordered table-hover table-striped table-sm" cellspacing="0" width="100%">
			<thead class="thead-dark">
				<tr>
					<th scope="col" style="width:20%">Nombre</th>
					<th scope="col" style="width:30%">Código</th>
					<th scope="col" style="width:15%">Acción</th>
				</tr>
			</thead>
			<tbody id="tabla">
			<?php $__currentLoopData = $protocolos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $protocolo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<tr>
						<td><?php echo e($protocolo->descripcion); ?></td>
						<td><?php echo e($protocolo->codigo->color); ?></td>
						<td>
							<div class="form-row">
								<form id="a1" class= "form-inline" action="/protocolos/<?php echo e($protocolo->id); ?>" method="get">
									<button type="submit" class="btn btn-dark btn-sm ml-1">Ver</button>
								</form>

								<form id="a2" name="<?php echo e($protocolo->descripcion); ?>" action="/protocolos/<?php echo e($protocolo->id); ?>" method="post">
									<?php echo csrf_field(); ?>
									<?php echo e(method_field('DELETE')); ?>

									<button type="submit" class="btn btn-danger btn-sm ml-1" value="<?php echo e($protocolo->descripcion); ?>">Eliminar</button>
								</form>
							</div>
						</td>
					</tr>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
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
	if (confirm('Por favor, confirme que desea eliminar el protocolo '.concat($(this).attr('name')))) {
		return true;
	}else{
		return false;
	}
});
</script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/protocolos/index.blade.php ENDPATH**/ ?>