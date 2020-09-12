<!DOCTYPE html>
<html>
<head>
	<title>Hospital San Bernardo</title>
	
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">






<script src='<?php echo e(asset('js/jquery.js')); ?>'></script>




  <style type="text/css">
    *{
      
    font-family:Arial;
    
    
    }

    header{
      position: sticky;
      top: 0px;
      /*background-color: #2D2C31;*/
      width: 100%;
      z-index: 1000;
      height: 3.3rem;
    }
    .navbar-brand{
      font-size: 15px;
    }
    .nav-item>a{
      /*font-weight: 700;*/

      font-size: 13px;
      transition: .5s;
    }
    .nav-item:hover>a{
      transform: scale(1.1);
    }
    .container-fluid{

      padding: 40px;
      font-size: 13px;
      /*font-weight: bold;*/
    }
    .focus:focus {
      color: red;
    }
    :target {
      color: red;
    }
  </style>

  <?php echo $__env->yieldContent("estilos"); ?>
</head>
<body>

<header>
<?php
  // echo $request->input('a');
  $url_array =  explode('/', URL::current()) ;
  // echo $url_array[3];
  $usuario = Auth::user();
?>
  <nav class="navbar navbar-dark navbar-expand-sm bg-dark">
  
  <a class="navbar-brand"  href="<?php echo e(route('pacientes.index')); ?>" style="color: #eee; ">Hospital San Bernardo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">

            <li id="pacientes" class="nav-item <?php  if ($url_array[3] == "pacientes"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('pacientes.index')); ?>" >Pacientes <span class="sr-only">(current)</span></a>
            </li>
            <li id="turnos" class="nav-item <?php  if ($url_array[3] == "turnos"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('mostrar')); ?>"  >Turnos <span class="sr-only">(current)</span></a>
            </li>
            <li id="sintomas" class="nav-item <?php  if ($url_array[3] == "sintomas"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('sintomas.index')); ?>">Sintomas <span class="sr-only">(current)</span></a>
            </li>
            <li id="tc" class="nav-item <?php  if ($url_array[3] == "atencionclinica"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('atencionclinica.index')); ?>">Triaje Clinico <span class="sr-only">(current)</span></a>
            </li>
            <li id="salas" class="nav-item <?php  if ($url_array[3] == "salas"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('salas.index')); ?>">Salas<span class="sr-only">(current)</span></a>
            </li>
            <li id="protocolos" class="nav-item <?php  if ($url_array[3] == "protocolos"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('protocolos.index')); ?>">Protocolos<span class="sr-only">(current)</span></a>
            </li>
            <li id="cie" class="nav-item <?php  if ($url_array[3] == "cie"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('cie.index')); ?>">CIE<span class="sr-only">(current)</span></a>
            </li>
            <li id="usuarios" class="nav-item <?php  if ($url_array[3] == "especialidades"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('especialidades.index')); ?>">Especialidades<span class="sr-only">(current)</span></a>
            </li>
            <li id="usuarios" class="nav-item <?php  if ($url_array[3] == "usuarios"){ echo "active";} ?>">
                <a class="nav-link" href="<?php echo e(route('usuarios.index')); ?>">Usuarios<span class="sr-only">(current)</span></a>
            </li>
    </ul>
    
  </div>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-sm-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  style="color: #eee; " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo e($usuario->name); ?>

                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <?php echo e(__('Logout')); ?>

                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                  
                    <!-- Button trigger modal -->
                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modalPerfil<?php echo e($usuario->id); ?>">Perfil</button>
                </div>
            </li>
        </ul>
    </div>
</nav>

</header>
<!-- Modal -->
<div class="modal fade" id="modalPerfil<?php echo e($usuario->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modalPerfilTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">Datos de Usuario</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
          <?php else: ?>
            <h5>No hay más datos para este usuario</h5>
          <?php endif; ?>
        </div>
          <?php if($usuario->profesional): ?>
            <div class="text-center">
              <a class="btn btn-primary" disabled><?php echo e(__('Completar')); ?></a>			
            </div>
          <?php else: ?>
            <div class="text-center">
              <a class="btn btn-primary" href="<?php echo e(route('profesionales.create')); ?>"><?php echo e(__('Completar')); ?></a>
            </div>
          <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php echo $__env->yieldContent("cabecera"); ?>
<div class="container-fluid">
    
            
                      <?php echo $__env->yieldContent("cuerpo"); ?>            
                   
                    
                  
           
</div>
<?php echo $__env->yieldContent("pie"); ?>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>





<script>
  // $(".navbar-nav a").on("click", function() {
  //     // alert("algun mensaje");
  //     $("navbar-nav").find(".active").removeClass("active");
  //     $(this).parent().addClass("active");
  // } );
</script>
</body>
</html><?php /**PATH /home/vagrant/code/triage/resources/views/layouts/plantillaTest.blade.php ENDPATH**/ ?>