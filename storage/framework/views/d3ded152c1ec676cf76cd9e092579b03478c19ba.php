<?php $__env->startSection("cuerpo"); ?>
<div class="card">
  <div class="card-header"> Pacientes para Atender </div>
    <div class="card-body">
      <div class="form-group" style="margin-right: 10px;">
      
         <h6><?php echo e($mensaje); ?></h6>
     
      <a href="<?php echo e(route('atencionclinica.index')); ?>"class="btn btn-dark btn-sm">Cambiar ubicacion</a>
    
       
  </div>
      <div class="form-row">
        <div class="form-group col-md-2">
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
          <div class="form-group col-md-2">
              <label for="inputState">Especialidades</label>
              <select name="esp" id="esp" class="form-control">
                <option value="Todas" selected>Todas</option>
                    <?php $__currentLoopData = $especialidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $esp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($esp->nombre == $val2): ?>
                        <option value="<?php echo e($esp->nombre); ?>" selected><?php echo e($esp->nombre); ?></option>
                      <?php else: ?>
                        <option value="<?php echo e($esp->nombre); ?>"><?php echo e($esp->nombre); ?></option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
          </div>
      </div>


          
          <table class="table table-bordered table-sm table-hover table-responsive-sm" id="table_id">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Area</th>
                <th scope="col">Accion</th>
                
              </tr>
            </thead>
            <tbody id="tabla">
              <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if($paciente->color == "verde"): ?>
                  <tr class="table-success">
                <?php elseif($paciente->color== "amarillo"): ?>
                  <tr class="table-warning">
                <?php elseif($paciente->color=="rojo"): ?>
                  <tr class="table-danger">
                <?php endif; ?>
                <td><?php echo e($paciente->nombre); ?></td>
                <td> <?php echo e($paciente->apellido); ?></td>
               
                <td><?php echo e($paciente->fecha); ?></td>
                <td> <?php echo e($paciente->especialidad); ?></td>
                <td><?php echo e($paciente->tipo_dato); ?></td>
                <td>
                <div class="form-row">
                   <form class= "form-inline" action="<?php echo e(route('atencionclinica.show',$paciente->id_atencion)); ?>" method="GET">
                      <?php if($paciente->id_atencion != $id): ?>
                        <input type="hidden" name="detalleatencion" value="<?php echo e($paciente->id); ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Triaje</button>
                      <?php else: ?>
                        <button type="submit" class="btn btn-primary btn-sm ml-1" disabled>Triaje</button>
                      <?php endif; ?>
                   </form>
                   <button type="submit" class="btn btn-primary btn-sm ml-1">Editar</button>
                </div>
               
                
                </td>
              </tr>
              
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
    </div>
  </div>
<script>
  $('select').on('change', function() {
    if($('#esp').val() == 'Todas' && $('#area').val()=='Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) == -1 &&
           $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1 )
        });
    }else if($('#esp').val() != 'Todas' && $('#area').val() == 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) > -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) == -1
            )
        });
    }else if($('#esp').val() == 'Todas' && $('#area').val() != 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) == -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1
            )
        });
    }else if($('#esp').val() != 'Todas' && $('#area').val() != 'Todas'){
      $("#tabla tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf($('#esp').val().toLowerCase()) > -1 &&
            $(this).text().toLowerCase().indexOf($('#area').val().toLowerCase()) > -1
            )
        });
    }
    
    
    

    }).trigger('change');

  $("#name").change(function(){
    if($("#name").val()=="basic")
      $("#area option").not("[value^='basic']").hide();
    else
      $("#subscription_interval option").not("[value^='basic']").show();
    });

</script>


<?php $__env->stopSection(); ?>
<?php $__env->startSection("pie"); ?>

<div class="contenedor container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Formulario</div>
                    <div class="card-body">
                      <H4> Sintomas descripto</H4>
                        <ul class="list-group">
                          <?php $__currentLoopData = $preguntas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pregunta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <li class="list-group-item"><?php echo e($pregunta->descripcion); ?></li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <button class="btn btn-success" id="btnver" onclick="ver()">Ver Historial</button>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-2">
                            <button class="btn btn-success" id="btnocultar" onclick="ocultar()">Ocultar Historial</button>
                          </div>
                        </div>
                          <div class="form-group" id="his">
                            <H4> Historial</H4>

                            <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Filtrar por descripcion" >
                            <div class="table-responsive">
                              <table class="table table-bordered" id="myTable2">
                                <thead class="thead-dark">
                                    <tr>
                                      <th scope="col col-md-2">CIE</th>
                                      <th scope="col col-md-2">Descripcion CIE</th>
                                      <th scope="col">Observacion</th>
                                     
                                      
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $__currentLoopData = $historial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                      <td><?php echo e($h->codigo); ?></td>
                                      <td><?php echo e($h->descripcion); ?></td>
                                      <td><?php echo e($h->observacion); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  </tr>
                                  </tbody>
                                
                              </table>
                            </div>
                              
                            </div>
                         
                       
                        <form id="frm1" method="POST" action="/atencionclinica">
                          <?php echo csrf_field(); ?>
                          
                          <input type="hidden" name="detalleatencion1" value="<?php echo e($detalleatencion); ?>">
                          <input type="hidden" name="atencion" value=<?php echo e($id); ?>>
                          <h4>Preguntas y Analisis</h4>
                          <div class="row">
                            <div class="col">
                              
                              <textarea class="form-control" id="descrito" name="descripto" rows="3"><?php echo e($paciente_seleccionado->respuestas); ?></textarea>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-2">
                              <label for="exampleFormControlTextarea1">CIE</label>
                              
                              <input type="text" name="cieslist" id="cieslist" class="form-control">
                            </div>
                            <div class="col-md-2">
                              <label for="exampleFormControlTextarea1">Codigo del Triaje</label>
                              <select id="inputState" name="color" class="form-control">
                                <?php $__currentLoopData = $codigos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <option value="<?php echo e($c->color); ?>"><?php echo e($c->color); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                
                              </select>
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col">
                              <label for="exampleFormControlTextarea1">Desea agregar alguna observacion?</label>
                              <textarea class="form-control" type="text" id="observacion" name="observacion" rows="3" required></textarea>
                            </div>
                          </div>
                          <br>
                          <label for="exampleFormControlTextarea1">Que desea hacer?</label>
                          <div class="row">
                            <div class="col">
                               <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio1" value="Internar" aria-label="..."> Internarlo</label>
                               <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio2" value="Operar" aria-label="..."> Operar</label>
                               <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio2" value="Shock Room" aria-label="...">Shock Room</label>
                               <label><input class="form-check-input position-static ml-1" type="radio" name="internar" id="blankRadio2" value="alta" aria-label="..."> Dar de alta</label>
                            </div>
                            
                          </div>
                          <div class="row" id="formgruop">
                              <div class="col">
                                <label>Para luego operar?</label>
                                <div class="form-check">
                              <label><input class="form-check-input position-static ml-1" type="radio" name="op" id="op1" value="si" aria-label="..."> Si</label>
                              <label><input class="form-check-input position-static ml-1" type="radio" name="op" id="op2" value="no" aria-label="...">No</label>
                                </div>
                             
                              </div>
                          </div>
                          
                          
                          <input type="hidden" name="mensaje" value="<?php echo e($mensaje); ?>">
                          <br>
                          <button type="submit" class="btn btn-success" name="boton">Finalizar</button>
                          <button type="submit" class="btn btn-success" name="Continuar">Continuar Luego</button>
                          
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="/resources/demos/style.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script>
  $( function() {
    cies=<?php echo $cie ?>;
    var availableTags=[];
    for(let i=0; i<cies.length;i++){
      availableTags.push(cies[i].codigo+"-"+cies[i].descripcion);
    }
   
    $( "#cieslist" ).autocomplete({
      source: availableTags
    });
   
  

  } );
 
  
 </script>

 <script> 
  document.getElementById('his').style.display = 'none';
  document.getElementById('btnocultar').style.display = 'none';
            $(document).ready(function() {
              document.getElementById('formgruop').style.display = 'none'
                $('input[id=blankRadio1]').click(function() {                    
                    document.getElementById('formgruop').style.display = 'block'
                              
                });
                $('input[id=blankRadio2]').click(function() {
                  document.getElementById('formgruop').style.display = 'none'
                });

                

                
            });
</script>


<script>
function ver() {
     document.getElementById('his').style.display = 'block';
     document.getElementById('btnver').style.display = 'none';
      document.getElementById('btnocultar').style.display = 'block';
}
function ocultar(){
  document.getElementById('his').style.display = 'none';
     document.getElementById('btnver').style.display = 'block';
      document.getElementById('btnocultar').style.display = 'none';
}
</script>
 
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
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
  $('form[id^="frm1"').submit( function() {
    
      $("<input />").attr("type", "hidden")
        .attr("name", "val1")
        .attr("value",$('#area').val())
        .appendTo("form");
      $("<input />").attr("type", "hidden")
        .attr("name", "val2")
        .attr("value", $('#esp').val())
        .appendTo("form");
      return true;
   
  });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.plantillaTest", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\master\resources\views/atencionclinica/show.blade.php ENDPATH**/ ?>