<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
  <div class="card">
  	<div class="card-header"> Salas </div>
  	<div class="card-body">
	<div class="form-row">
	    <div class="form-group col-md-2">
			<a class="btn btn-dark" href="<?php echo e(route('salas.create')); ?>">Agregar Sala</a>
		</div>
	    <div class="form-group col-md-2">
			<a class="btn btn-dark" href="<?php echo e(route('areas.create')); ?>">Agregar Área</a>
    	</div>
    </div>
    <div class="form-group col-md-3">
      	<label for="inputState">Área</label>
      	<select name="area" id="area" class="form-control">
         	<option value="Todas" selected>Todas</option>
	<?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($area->tipo_dato == $val1): ?>
			<option value="<?php echo e($area->tipo_dato); ?>" selected><?php echo e($area->tipo_dato); ?></option>
		<?php else: ?>
			<option value="<?php echo e($area->tipo_dato); ?>"><?php echo e($area->tipo_dato); ?></option>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      	</select>
    </div>
    <table class="table table-bordered table-sm table-hover table-responsive-sm">
    	<thead class="thead-dark">
        	<tr>
				<th scope="col" style="width:30%">Nombre</th>
          		<th scope="col" style="width:30%">Área</th>
				<th scope="col" style="width:20%">Estado</th>
				<th scope="col" style="width:20%">Acción</th>
        	</tr>
      	</thead>
      	<tbody id="tabla">
        <?php $__currentLoopData = $salas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	       		<tr>
				  	<td><?php echo e($sala->nombre); ?></td>
	       			<td><?php echo e($sala->area->tipo_dato); ?></td>
					<td>
						<form id="f1" class= "form-inline" method="POST" action="<?php echo e(route('salas.update', $sala->id)); ?>">
							<?php echo csrf_field(); ?>
							<?php echo e(method_field('PUT')); ?>

							<?php if($sala->disponibilidad == 0): ?>
								<button type="submit" style="width:100px" class="btn btn-danger btn-sm">F. de Servicio</button>
							<?php else: ?>
								<button type="submit" style="width:100px" class="btn btn-success btn-sm">Disponible</button>
							<?php endif; ?>
						</form>
					</td>
					<td>
						<form id="f2" name="<?php echo e($sala->nombre); ?>" class= "form-inline" method="POST" action="/salas/<?php echo e($sala->id); ?>">
							<?php echo csrf_field(); ?>
							<?php echo e(method_field('DELETE')); ?>

							<button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
						</form>
					</td>
	       		</tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      	</tbody>
	</table>
</div>
</div>

<script>
	$('form[id^="f1"').submit( function() {
	    // $(this).append('<input type="hidden" name="n" value="cualquiercosa"\>');
	    // $(this).append('<input type="hidden" name="a" value="cualquiercosa"\>');
		
		if (confirm('¿Desea cambiar el estado del Quirófano?')) {
			$("<input />").attr("type", "hidden")
				.attr("name", "n")
				.attr("value", $('#area').val())
				.appendTo("form");
			// $("<input />").attr("type", "hidden")
			// 	.attr("name", "a")
			// 	.attr("value", $('#area').val())
			// 	.appendTo("form");
	    	return true;
		}else{
			return false;
		}
	});

</script>
<script>
	$('select').on('change', function() {
		$('#tabla tr').filter(function(){
			if($('#area').val() == 'Todas'){
				$(this).toggle($(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1)
			}else{
				$(this).toggle($(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1)
			}
		});
  	}).trigger('change');

	// $("#name").change(function(){
	// 	if($("#name").val()=="basic")
	// 		$("#area option").not("[value^='basic']").hide();
	// 	else
	// 		$("#subscription_interval option").not("[value^='basic']").show();
  	// });

</script>

<script>
	$('form[id^="f2"').submit( function() {
		if (confirm('Por favor, confirme que desea eliminar la sala '.concat($(this).attr('name')))) {
			$("<input />").attr("type", "hidden")
				.attr("name", "n")
				.attr("value", $('#area').val())
				.appendTo("form");
			$("<input />").attr("type", "hidden")
				.attr("name", "a")
				.attr("value", $('#area').val())
				.appendTo("form");
			return true;
		}else{
			return false;
		}
	});
</script>




<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/salas/index.blade.php ENDPATH**/ ?>