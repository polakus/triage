

<?php $__env->startSection("cuerpo"); ?>
<!-- Para Modal -->


	   	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h4 class="h4">Usuarios</h4>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
           <a class="btn btn-outline-secondary btn-sm ml-1" href="<?php echo e(route('usuarios.create')); ?>">Registrar Usuario</a>
            <a class="btn btn-outline-secondary btn-sm ml-1" href="/usuarios/pendientes">Usuarios Pendientes</a>
          </div>
        </div>
      </div>
		<div class="flash-message">
		    <?php $__currentLoopData = ['danger', 'warning', 'success', 'info']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		      <?php if(Session::has('alert-' . $msg)): ?>

		      <p class="alert alert-<?php echo e($msg); ?>"><?php echo e(Session::get('alert-' . $msg)); ?> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
		      <?php endif; ?>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>

		
		
		<div class="table-responsive">
		  
			<table id="myTable" class="table table-bordered table-hover table-sm" cellspacing="0" width="100%">
				<thead >
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
												<h6 class="modal-title" id="exampleModalLongTitle">Datos de Usuario</h6>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<?php if($usuario->profesional): ?>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Nombre:</h6>			
													</div>
													<div class="col-md-4">
														<h6><?php echo e($usuario->profesional->nombre); ?></h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Apellido:</h6>			
													</div>
													<div class="col-md-4">
														<h6><?php echo e($usuario->profesional->apellido); ?></h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Domicilio:</h6>			
													</div>
													<div class="col-md-4">
														<h6><?php echo e($usuario->profesional->domicilio); ?></h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Matrícula:</h6>			
													</div>
													<div class="col-md-4">
														<h6><?php echo e($usuario->profesional->matricula); ?></h6>			
													</div>
												</div>
												<div class="row">
													<div class="text-md-right col-md-4">
														<h6>Especialidades:</h6>			
													</div>
													<div class="col-md-4">
														<?php $__currentLoopData = $usuario->profesional->detalleProfesional; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<h6><li> <?php echo e($esp->especialidad->nombre); ?></li></h6>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>			
													</div>
												</div>
												<?php else: ?>
												<h6>No hay más datos para este usuario</h6>
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
										<button type="submit" class="btn btn-danger btn-sm ml-1" value="<?php echo e($usuario->id); ?>" disabled>Eliminar</button>
									<?php else: ?>
										<button type="submit" class="btn btn-danger btn-sm ml-1" value="<?php echo e($usuario->id); ?>">Eliminar</button>
									<?php endif; ?>
								</form>
							</div>
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>

	
<?php $__env->stopSection(); ?>
<?php $__env->startSection("scripts"); ?>


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
    $('#myTable').DataTable({
      "iDisplayLength": 50,
      "language": {
         "decimal": ",",
        "thousands": ".",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoPostFix": "",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
         "processing": "Procesando...",
        "search": "Buscar:",
        "searchPlaceholder": "",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "aria": {
            "sortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
         "buttons": {
            "create": "Nuevo",
            "edit": "Cambiar",
            "remove": "Borrar",
            "copy": "Copiar",
            "csv": "fichero CSV",
            "excel": "tabla Excel",
            "pdf": "documento PDF",
            "print": "Imprimir",
            "colvis": "Visibilidad columnas",
            "collection": "Colección",
            "upload": "Seleccione fichero...."
        },
        "select": {
            "rows": {
                _: '%d filas seleccionadas',
                0: 'clic fila para seleccionar',
                1: 'una fila seleccionada'
            }
        }
      }
    });
} );
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("triagepreguntas.test", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/usuarios/index.blade.php ENDPATH**/ ?>