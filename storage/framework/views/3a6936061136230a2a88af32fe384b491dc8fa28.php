<?php $__env->startSection("cuerpo"); ?>
<div class="card">
<div class="card-header">Especialidades</div>
<div class="card-body">
	
	<div class="form-row">
		<div class="form-group col-md-2">
			<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
              Agregar
            </button>
		</div>
	</div>
	
	<div class="form-row">
		<div class="form-group col-md-2">
			<input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Nombre" >

		</div>
	</div>



	    <table class="table table-bordered table-hover table-sm table-striped" id="myTable">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Nombre</th>
		      <th scope="col">Descripcion</th>
		      <th scope="col">Areas</th>
		      <th scope="col">Accion</th>
		    </tr>
		  </thead>
		  <tbody id="tabla" >
		   	<?php $__currentLoopData = $especialidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		   		<tr>
		   			<td><?php echo e($e->nombre); ?></td>
		   			<td><?php echo e($e->descripcion); ?></td>
		   			<td><?php echo e($e->tipo_dato); ?></td>
		   			<td>
		   			<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#editar<?php echo e($e->id); ?>">
		              Editar
		            </button>
		            <div class="modal fade" id="editar<?php echo e($e->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			            <div class="modal-dialog">
			              <div class="modal-content">
			                <div class="modal-header">
			                  <h3 class="modal-title" id="exampleModalLabel">Editar especialidad</h3>
			                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                  </button>
			                </div>
			                <div class="modal-body">
			                   <div class="container col-md-12">
								<div class="form-group">
									<form method="POST" action="/especialidades/<?php echo e($e->id); ?>">
										<?php echo csrf_field(); ?>
										<?php echo e(method_field('PUT')); ?>

										<div class="form-row">
											<div class="form-group">
												<label>Nombre</label>
												<input type="text" name="editarnom" class="form-control" placeholder="Cod" value="<?php echo e($e->nombre); ?>">
											</div>

										</div>
										<div class="form-row">
											<div class="form-group col-md-10">
												<label>Descripcion </label>
												<textarea class="form-control" id="d" name="des" rows="3"><?php echo e($e->descripcion); ?></textarea>
											</div>
										</div>
										
										
										
									
								</div>
								
							</div>
			                  
			                  
			                 
			                  
			                </div>
			                <div class="modal-footer">
			                	<button type="submit" class="btn btn-dark">Editar</button>
			                	</form>
			                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
			                
			                </div>
			              </div>
			            </div>
			          </div>
			          </td>

		   		</tr>

		   	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  </tbody>
		</table>
</div>


<!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Registracion de Especialidad</h3>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                   <div class="container">
					<div class="form-group">
						<form method="POST" action="/especialidades">
							<?php echo csrf_field(); ?>
							<div class="form-row">
									<div class="form-group">
											<label>Nombre</label>
											<input type="text" name="esp_nombre" class="form-control" placeholder="Nombre">
									</div>

							</div>
							<div class="form-row">
									<div class="form-group col-md-10">
										<label>Descripcion </label>
										<textarea class="form-control" name="descripcion" rows="3" placeholder="Descripcion"></textarea>
									</div>
							</div>
								<div class="form-row">
									<div class="form-group">
										<label>Area </label>
										<select class="form-control">
											<?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($a->id); ?>"><?php echo e($a->tipo_dato); ?> </option>

											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>
									</div>
							</div>



							
							
							
						
					</div>
					
				</div>
                  
                  
                 
                  
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-dark">Guardar</button>
                  </form>
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
                
                </div>
              </div>
            </div>
          </div>



</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

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





<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/especialidades/index.blade.php ENDPATH**/ ?>