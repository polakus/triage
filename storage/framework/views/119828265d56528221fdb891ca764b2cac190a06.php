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
  </style>

  <?php echo $__env->yieldContent("estilos"); ?>
</head>
<body>

<header>
  <nav class="navbar navbar-dark navbar-expand-sm bg-dark">
  >
  <a class="navbar-brand"  href="<?php echo e(route('pacientes.index')); ?>" style="color: #eee; ">Hospital San Bernardo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li id="pacientes" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('pacientes.index')); ?>" style="color: #eee; ">Pacientes <span class="sr-only">(current)</span></a>
            </li>
            

            <li id="turnos" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('mostrar')); ?>" style="color: #eee; ">Turnos <span class="sr-only">(current)</span></a>
            </li>
            <li id="sintomas" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('sintomas.index')); ?>" style="color: #eee;">Sintomas <span class="sr-only">(current)</span></a>
            </li>
            <li id="tc" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('atencionclinica.index')); ?>" style="color:#eee; ">Triaje Clinico <span class="sr-only">(current)</span></a>
            </li>
            <li id="salas" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('salas.index')); ?>" style="color: #eee; ">Salas<span class="sr-only">(current)</span></a>
            </li>
            <li id="protocolos" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('protocolos.index')); ?>" style="color: #eee; ">Protocolos<span class="sr-only">(current)</span></a>
            </li>
            <li id="cie" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('cie.index')); ?>" style="color: #eee; ">CIE<span class="sr-only">(current)</span></a>
            </li>
            <li id="usuarios" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('especialidades.index')); ?>" style="color: #eee; ">Especialidades<span class="sr-only">(current)</span></a>
            </li>
            
            <li id="usuarios" class="nav-item">
                <a class="nav-link" href="<?php echo e(route('usuarios.index')); ?>" style="color: #eee; ">Usuarios<span class="sr-only">(current)</span></a>
            </li>
    </ul>
    
  </div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-sm-2">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo e(Auth::user()->name); ?>

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
                    <a class="dropdown-item" href="<?php echo e(route('profesionales.index')); ?>"><?php echo e(__('Perfil')); ?></a>
                </div>
            </li>
        </ul>
    </div>
</nav>
</header>

<?php echo $__env->yieldContent("cabecera"); ?>
<div class="container-fluid">
    
            
                      <?php echo $__env->yieldContent("cuerpo"); ?>            
                   
                    
                  
           
</div>
<?php echo $__env->yieldContent("pie"); ?>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>





</body>
</html><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/layouts/plantillaTest.blade.php ENDPATH**/ ?>