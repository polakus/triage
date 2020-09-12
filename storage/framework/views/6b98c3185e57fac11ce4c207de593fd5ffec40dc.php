<?php $__env->startSection("cabecera"); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection("cuerpo"); ?>
	<ul id="pruebalist">    
	<?php $__currentLoopData = $pruebas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prueba): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
		<li> <?php echo e($prueba->atributo); ?></li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>


<script>
   $(document).ready(function(){
		setInterval(function(){
			$.ajax({
				url:'/pruebas',
				type:'GET',
				dataType:'json',
				success:function(response){
					if(response.pruebas.length>0){
						var pruebas ='';
						for(var i=0;i<response.pruebas.length;i++){
							pruebas=pruebas+'<li>'+response.pruebas[i]['body']+'</li>';
						}
						$('#pruebalist').empty();
						$('#pruebalist').append(pruebas);
					}
				},error:function(err){

				}
			})
		}, 5000);
   });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("pie"); ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/triage/resources/views/pruebas/index.blade.php ENDPATH**/ ?>