<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
</head>
<body>
  
  <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
  <script type="module">
    import {pacientes} from '/js/pacientes.js'
    console.log(pacientes.DatosPacientes)
    console.log("asdfasd")
    let ps = pacientes.DatosPacientes
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type:'POST',
      url:"/datosPacientes",
      dataType:"json",
      data:{
        pacientes:ps,
      },
      success:function(data){
        alert("asdfadf");
      }
    });
  </script>
  

</body>
</html>
