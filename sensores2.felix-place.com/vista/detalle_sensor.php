<?php include('header.php'); $id=''; if(isset($_GET['id'])){$id=$_GET['id'];} 
date_default_timezone_set('America/Guayaquil'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.time.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
    var id = '<?php echo $id; ?>';
    if(id!='')
      {
        datos_sensor(id);
        datos_temperatura();
        setInterval(datos_temperatura,2000);   

      }
      // setInterval(lista_sensor,3000);
     });


     function datos_sensor(id){
      var parametros = {
        'id':id,
      }
      $.ajax({
          data:  {parametros:parametros},
          url:   '../controlador/inicioC.php?datos_sensor=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) {       
          console.log(response);
          $('#tem').text(response[0].temperatura)
          $('#ph').text(response[0].ph)
          $('#oxi').text(response[0].oxigeno)     
          $('#nom').text(response[0].nombre)
          $('#cod').text(response[0].codigo)  
              // $('#tbl_sensores').html(response);
            }               
           });
    }

    function datos_temperatura(){
      var parametros = {
        'id':'<?php echo $id; ?>',
        'temp':true,
        'ph':true,
        'oxi':true,
      }
      $.ajax({
          data:  {parametros:parametros},
          url:   '../controlador/inicioC.php?datos_temperatura=true',
          type:  'post',
          dataType: 'json',
          success:  function (response) {       
            // console.log(response);

            var tem = [];var ph = [];var oxi = [];
            for (var i = 10; i > -1; i--) 
            {
              var a = 10-i;
              // console.log(response[i].temperatura);
              if( typeof response[i] !== 'undefined')
              {
                // var d = new Date(response[i].fecha);
                // console.log(d);
                tem.push([response[i].fecha,response[i].temp])
                ph.push([response[i].fecha,response[i].ph])
                oxi.push([response[i].fecha,response[i].oxi])
              }else
              {
                tem.push(['NAN',0])
                ph.push(['NAN',0])
                oxi.push(['NAN',0])
              }
            }            
            var date = new Date();
            console.log(date);

            pintar_puntos(tem);
            pintar_puntos_ph(ph);
            pintar_puntos_oxi(oxi);        
            }               
           });
    }
  function pintar_puntos(data)
  {

     var line_data1 = {
      data : data,
      color: '#fd7e14',
      label: 'temperatura',
    }
    $.plot('#line-chart', [line_data1], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : 'gray',

      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#fd7e14']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true,
        mode : "time",
        tickFormatter:"%h:%M:%S",
        // minTickSize: [15, "second"],
        color:'gray',
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart').bind('plothover', function (event, pos, item) {
      // console.log(item);
      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1];
        var date = new Date(item.datapoint[0]*1000).toUTCString();
        // console.log(date);
        $('#line-chart-tooltip').html(' hora ' + date + ' porcentaje: ' + y +'%')
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })


  }

  function pintar_puntos_ph(data)
  {

     var line_data1 = {
      data : data,
      color: '#6610f2',
      label: 'PH del agua',
    }
    $.plot('#line-chart-ph', [line_data1], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : 'gray',

      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#6610f2']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true,
        mode : "time",
        tickFormatter:"%h:%M:%S",
        // minTickSize: [15, "second"],
        color:'gray',
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-ph').bind('plothover', function (event, pos, item) {
      // console.log(item);
      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1];
        var date = new Date(item.datapoint[0]*1000).toUTCString();
        // console.log(date);
        $('#line-chart-tooltip').html(' hora ' + date + ' porcentaje: ' + y +'%')
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })


  }

    function pintar_puntos_oxi(data)
  {

     var line_data1 = {
      data : data,
      color: '#007bff',
      label: 'PH del agua',
    }
    $.plot('#line-chart-oxi', [line_data1], {
      grid  : {
        hoverable  : true,
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : 'gray',

      },
      series: {
        shadowSize: 0,
        lines     : {
          show: true
        },
        points    : {
          show: true
        }
      },
      lines : {
        fill : false,
        color: ['#007bff']
      },
      yaxis : {
        show: true
      },
      xaxis : {
        show: true,
        mode : "time",
        tickFormatter:"%h:%M:%S",
        // minTickSize: [15, "second"],
        color:'gray',
      }
    })
    //Initialize tooltip on hover
    $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: 'absolute',
      display : 'none',
      opacity : 0.8
    }).appendTo('body')
    $('#line-chart-oxi').bind('plothover', function (event, pos, item) {
      // console.log(item);
      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1];
        var date = new Date(item.datapoint[0]*1000).toUTCString();
        // console.log(date);
        $('#line-chart-tooltip').html(' hora ' + date + ' porcentaje: ' + y +'%')
          .css({
            top : item.pageY + 5,
            left: item.pageX + 5
          })
          .fadeIn(200)
      } else {
        $('#line-chart-tooltip').hide()
      }

    })


  }

  function reporte_excel()
  {
    url = '../lib/excel/test.php';
    sensor = '<?php echo $_GET['id']; ?>';
    desde = $('#txt_desde').val();
    hasta = $('#txt_hasta').val();
    url = '../lib/excel/informe.php?excel=true&id='+sensor+'&desde='+desde+'&hasta='+hasta;
    window.open(url,'_blank');
  }
 
   </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detalle sensor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-2"><br>
            <button type="button" class="btn btn-default btn-sm" onclick="reporte_excel()"><i class="fa fa fa-file" ></i> Informe historial</button>
          </div>
          <div class="col-sm-2">
            <b>Desde</b>
            <input type="date" name="txt_desde" id="txt_desde" class="form-control" value="<?php echo date('Y-m-d') ?>">
          </div>
          <div class="col-sm-2">
            <b>Hasta</b>
            <input type="date" name="txt_hasta" id="txt_hasta" class="form-control" value="<?php echo date('Y-m-d') ?>">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../img/sensor.png"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center" id="nom"></h3>
                <p class="text-muted text-center" id="cod"></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Temperatura</b> <a class="float-right" id="tem"></a>
                  </li>
                  <li class="list-group-item">
                    <b>PH</b> <a class="float-right" id="ph">0</a>
                  </li>
                  <li class="list-group-item">
                    <b>Saturacion de Oxigeno</b> <a class="float-right" id="oxi">0</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Temperatura</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">PH del agua</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">% Saturacion de oxigeno</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                  	 <div class="row">
                       <div class="card card-primary card-outline col-sm-12">
             
                          <div class="card-body">
                            <div id="line-chart" style="height: 300px;"></div>
                          </div>
                          <!-- /.card-body-->
                        </div>
				          
				         
				              </div>
                  
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline"> 
                     <div class="row">
                       <div class="card card-primary card-outline col-sm-12">
             
                          <div class="card-body">
                            <div id="line-chart-ph" style="height: 300px;"></div>
                          </div>
                          <!-- /.card-body-->
                        </div>                  
                 
                      </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">    
                      <div class="row">
                       <div class="card card-primary card-outline col-sm-12">
             
                          <div class="card-body">
                            <div id="line-chart-oxi" style="height: 300px;"></div>
                          </div>
                          <!-- /.card-body-->
                        </div>
                      </div>

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
 <?php include('footer.php'); ?>

<script>


  
</script>
<script src="../dist/js/pages/dashboard.js"></script>
