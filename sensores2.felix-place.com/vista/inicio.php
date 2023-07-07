<?php include('header.php'); ?>
<script type="text/javascript">
  function enviar_mensaje()
  {
     // var parametros = {
     //    'id':id,
     //  }
      $.ajax({
          // data:  {parametros:parametros},
          url:   '../controlador/inicioC.php?enviar_mensaje=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) {       
          // console.log(response);
          // $('#tem').text(response[0].temperatura)
          // $('#ph').text(response[0].ph)
          // $('#oxi').text(response[0].oxigeno)     
          // $('#nom').text(response[0].nombre)
          // $('#cod').text(response[0].codigo)  
              // $('#tbl_sensores').html(response);
            }               
           });
  }

  function enviar_datos()
  {
     // var parametros = {
     //    'id':id,
     //  }
     var t = Math.random() * (21 - 4) + 4;
     var p = Math.random() * (13 - 0) +0;
     var o = Math.random() * (11 - 0) + 0;
      $.ajax({
          // data:  {parametros:parametros},
          url:   '../controlador/nuevo_sensorC.php?sensorData=true&CODIGO=NR2&T='+t+'&P='+p+'&O='+o,
          type:  'post',
          dataType: 'json',
          success:  function (response) {       
          
            }               
           });
  }

</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sensores</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sensores</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4">
            <input type="text" name="txt_query" id="txt_query" class="form-control" placeholder="Codigo de sensor" onkeyup="lista_sensor();">
             <!-- <button class="btn btn-sm" onclick="enviar_mensaje()">envair bot</button> -->
             <!-- <button class="btn btn-sm btn-primary" onclick="enviar_datos()">envair datos aleatorios</button> -->
             <!-- <button class="btn btn-sm btn-primary" onclick="lista_sensor()">consultar reglas</button> -->
          </div>          
        </div>
        <!-- Small boxes (Stat box) -->
        <div class="row" id="tbl_sensores">
          
        
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
        
         
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript">
  $(document).ready(function () {
      lista_sensor();
      setInterval(lista_sensor,3000);
     });


     function lista_sensor(){
      var parametros = {
        'query':$('#txt_query').val(),
      }
      $.ajax({
          data:  {parametros:parametros},
          url:   '../controlador/inicioC.php?lista_sensor=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) {       
          console.log(response);       
              $('#tbl_sensores').html(response);
            }               
           });

    }
   </script>
<?php include('footer.php'); ?>

