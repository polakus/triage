<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">

    <!-- Bootstrap core CSS  Esto es del DASHBOARD -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
   <!-- Custom styles for this template -->
    <link href="../assets/dashboard.css" rel="stylesheet">
 <!-- <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet"> -->

    
    
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <?php echo $__env->yieldContent("css"); ?>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
   
  </head>
  <body>
    <?php
  // echo $request->input('a');
  $url_array =  explode('/', URL::current()) ;
  // echo $url_array[3];
  $usuario = Auth::user();
?>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Hopistal San Bernardo</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->

  
    <div class="dropdown" >
    <a class="btn btn-dark dropdown-toggle" style="background-color: transparent;"href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php echo e($usuario->name); ?>

    </a>

    <div class="dropdown-menu dropdown-menu-lg-right">
      <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
          <?php echo e(__('Logout')); ?>

      </a>
      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
          <?php echo csrf_field(); ?>
      </form>
      <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modalPerfil<?php echo e($usuario->id); ?>">Perfil</button>
     
    </div>
  </div>


</nav>


<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo e(route('inicio')); ?>">
              <span data-feather="home"></span>
              Inicio <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a id="pacientes" class="nav-link <?php  if ($url_array[3] == "pacientes"){ echo "active";} ?>" href="<?php echo e(route('pacientes.index')); ?>">
              <span data-feather="users"></span>
              Pacientes
            </a>
          </li>
          <li class="nav-item">
            <a  id="turnos" class="nav-link  <?php  if ($url_array[3] == "turnos"){ echo "active";} ?>" href="<?php echo e(route('mostrar')); ?>">
              <span data-feather="calendar"></span>
              Atenciones
            </a>
          </li>
          <li class="nav-item">
            <a id="sintomas"class="nav-link <?php  if ($url_array[3] == "sintomas"){ echo "active";} ?>" href="<?php echo e(route('sintomas.index')); ?>">
              <span data-feather="users"></span>
              Sintomas
            </a>
          </li>
          <li class="nav-item">
            <a id="atencionclinica"class="nav-link <?php  if ($url_array[3] == "atencionclinica"){ echo "active";} ?>" href="<?php echo e(route('atencionclinica.index')); ?>">
              <span data-feather="bar-chart-2"></span>
              Triaje Clinico
            </a>
          </li>
          <li class="nav-item">
            <a id="salas"class="nav-link <?php  if ($url_array[3] == "salas"){ echo "active";} ?>" href="<?php echo e(route('salas.index')); ?>">
              <span data-feather="layers"></span>
              Salas
            </a>
          </li>
          <li class="nav-item">
            <a id="protocolos" class="nav-link <?php  if ($url_array[3] == "protocolos"){ echo "active";} ?>" href="<?php echo e(route('protocolos.index')); ?>">
              <span data-feather="layers"></span>
              Protocolos
            </a>
          </li>
          <li class="nav-item">
            <a id="cie "class="nav-link <?php  if ($url_array[3] == "cie"){ echo "active";} ?>" href="<?php echo e(route('cie.index')); ?>">
              <span data-feather="layers"></span>
              CIE
            </a>
          </li>
          <li class="nav-item">
            <a id="especialidades" class="nav-link <?php  if ($url_array[3] == "especialidades"){ echo "active";} ?>" href="<?php echo e(route('especialidades.index')); ?>">
              <span data-feather="layers"></span>
              Especialidades
            </a>
          </li>
          <li class="nav-item">
            <a id="usuarios"class="nav-link <?php  if ($url_array[3] == "usuarios"){ echo "active";} ?>"  href="<?php echo e(route('usuarios.index')); ?>">
              <span data-feather="users"></span>
              Usuarios
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      

<!-- Modal -->
<div class="modal fade" id="modalPerfil<?php echo e($usuario->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de Usuario</h5>
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

      <?php echo $__env->yieldContent("cuerpo"); ?>
     <!--  <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
      <?php echo $__env->yieldContent("pie"); ?>
    </main>
  </div>
</div>
<script src='<?php echo e(asset('js/jquery.js')); ?>'></script>


      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        
        <script src="../assets/dashboard.js"></script>
<?php echo $__env->yieldContent("scripts"); ?>

</body>
</html>
<?php /**PATH /home/vagrant/code/triage/resources/views/triagepreguntas/test.blade.php ENDPATH**/ ?>