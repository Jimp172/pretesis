<?php include('header.php'); ?>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" >
    
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header" style="background-color:#069A8E;">                                       
                        <div class="row">
                            <div class="col-sm-2">
                            <label for="lblsensor" style="color:white;">SENSOR</label> 
                            <select name="sensor" id="sensor" onchange="BuscarDatos()">
                            
                            </select>                                    
                            </div>
                            <div class="col-sm-2">
                            <label for="lblanio" style="color:white;">AÑO:</label>
                            <select name="anio" id="anio" onchange="BuscarDatos()">
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>                                  
                            </div>
                            <div class="col-sm-2">
                                <label for="lblmes" style="color:white;" >MES:</label>
                            <select name="mes" id="mes" onchange="BuscarDatos()">
                            </select>                                 
                            </div>
                            <div class="col-sm-6">
                                    <label for="lblmes" style="color:white;" >DATOS ESTADÍSTICOS MENSUALES POR SENSOR </label>
                            </div>

                        </div>
                    </div>
                    <div class="card-body" style="background-color:#FFFBE7;">
                                               
                                <div class="row">
                                <div class="col-sm-6" >
                                        <div class="row" >

                                                <div class="col-sm-12">
                                                      
                                                        <button type="button"  class="btn btn-info btn-sm" onclick="BuscarDatosTemperaturaFirst()" data-toggle="modal" data-target="#modaltemperatura">MAS INFORMACIÓN <i class="fa fa-info-circle"></i></button>
                                                </div>
                                                <div class="col-sm-12" id="divtemperatura">
                                                         <canvas id="myChart" ></canvas>
                                                </div>
                                        </div>                                       
                                      
                                </div>
                                <div class="col-sm-6">
                                       <div class="row">

                                                <div class="col-sm-12">
                                                       
                                                        <button type="button"  class="btn btn-info btn-sm" data-toggle="modal" onclick="BuscarDatosPhAguaFirst()" data-target="#modaltemperatura">MAS INFORMACIÓN <i class="fa fa-info-circle"></i></button> 
                                                </div>
                                                <div class="col-sm-12" id="divph">
                                                    <canvas id="myChart1" ></canvas>
                                                </div>
                                        </div>      
                                    
                                </div>

                                <div class="col-sm-6">
                                        <div class="row">
                                                <div class="col-sm-12">
                                                        <button type="button"   class="btn btn-info btn-sm" data-toggle="modal" onclick="BuscarDatosSatruracionFirst()" data-target="#modaltemperatura">MAS INFORMACIÓN <i class="fa fa-info-circle"></i></button> 
                                                </div>
                                                <div class="col-sm-12" id="divsaturacion">
                                                      <canvas id="myChart2" ></canvas>
                                                </div>
                                        </div>     
                                    
                                </div>
                                <div class="col-sm-6">
                                       <div class="row">
                                                <div class="col-sm-12">
                                                       <button type="button"  class="btn btn-info btn-sm" data-toggle="modal"  onclick="BuscarDatosMiligramosFirst()" data-target="#modaltemperatura">MAS INFORMACIÓN <i class="fa fa-info-circle"></i></button> 
                                                </div>
                                                <div class="col-sm-12" id="divmiligramos">
                                                    <canvas id="myChart3" ></canvas> 
                                                </div>
                                        </div>                                 
                                </div>
                                </div>
                    
                    </div>            
                </div>
            </div>
        </section>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" ></script>

   
<script>
                $.ajax({
                    url:'../controlador/controlador_grafico.php?TraerTemperatura=true',
                    type: 'post'
                }).done(function(resp){

                    var data = JSON.parse(resp);
                    var dias =[];
                    var temperaturas=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            temperaturas.push(parseFloat(arr[0][1]));
                            dias.push(parseInt(arr[1][1]));
                    }
                    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels:dias, 
            datasets: [{
                label: 'Temperatura',
                data: temperaturas,                           
                title:'hola',
                backgroundColor: [
                    'rgb(221,160,221)'
                ],
                borderColor: [
                    'rgb(153,50,204)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
                  
                })
</script>
<script>
                $.ajax({
                    url:'../controlador/controlador_grafico.php?TraerPh=true',
                    type: 'post'
                }).done(function(resp){

                    var data = JSON.parse(resp);
                    var dias =[];
                    var phs=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            phs.push(parseFloat(arr[0][1]));
                            dias.push(parseInt(arr[1][1]));
                    }
                                var ctx = document.getElementById('myChart1');
                var myChart1 = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels:dias,
                        datasets: [{
                            label: 'PH AGUA',
                            data: phs,
                            backgroundColor: [
                                'rgb(255,218,185)'
                            ],
                            borderColor: [
                                'rgb(255,140,0)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                  
                })
</script>
<script>
                $.ajax({
                    url:'../controlador/controlador_grafico.php?TraerSaturacionOxigeno=true',
                    type: 'post'
                }).done(function(resp){

                    var data = JSON.parse(resp);
                    var dias =[];
                    var oxigenos=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            oxigenos.push(parseFloat(arr[0][1]));
                            dias.push(parseInt(arr[1][1]));
                    }
                    var ctx = document.getElementById('myChart2');
    var myChart2 = new Chart(ctx, {
        type: 'line',
        data: {
            labels:dias,
            datasets: [{
                label: 'SATURACIÓN OXIGENO',
                data: oxigenos,
                backgroundColor: [
                    'rgb(176,224,230)'
                ],
                borderColor: [
                    'rgb(30,144,255)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
                  
                })
</script>

<script>
                $.ajax({
                    url:'../controlador/controlador_grafico.php?TraerMiligramos=true',
                    type: 'post'
                }).done(function(resp){

                    var data = JSON.parse(resp);
                    var dias =[];
                    var oxigenos=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            oxigenos.push(parseFloat(arr[0][1]));
                            dias.push(parseInt(arr[1][1]));
                    }
                    var ctx = document.getElementById('myChart3');
    var myChart3 = new Chart(ctx, {
        type: 'line',
        data: {
            labels:dias,
            datasets: [{
                label: 'MILIGRAMOS/LITRO',
                data: oxigenos,
                backgroundColor: [
                    '#dbeddc'
                ],
                borderColor: [
                    '#008f39'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
                  
                })
</script>
<script type="text/javascript">
        //Cargar Datos de Combos Meses y Sensores
                $.ajax({
                    url:'../controlador/controlador_grafico.php?sensorescombo=true',
                    type: 'post'
                }).done(function(resp){
                    var data = JSON.parse(resp);

                     for (var i = 0; i < data.length; i++) {
                        var combo = document.getElementById("sensor");
                       var option = document.createElement('option');
                            var arr = Object.entries(data[i]);
                            combo.options.add(option, i);
                            combo.options[i].value = arr[0][1];
                            combo.options[i].innerText = arr[2][1];
                           
                    }
                })
                //CARGAR MESES
                $.ajax({
                    url:'../controlador/controlador_grafico.php?cargarmeses=true',
                    type: 'post'
                }).done(function(resp){
                    var fecha =JSON.parse(resp);
                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    // añadir el elemento option y sus valores
                    combo.options.add(option, 0);
                    combo.options[0].value = fecha[0];
                    combo.options[0].innerText = fecha[1];

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 1);
                    combo.options[1].value = "01";
                    combo.options[1].innerText = "Enero";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 2);
                    combo.options[2].value = "02";
                    combo.options[2].innerText = "Febrero";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 3);
                    combo.options[3].value = "03";
                    combo.options[3].innerText = "Marzo";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 4);
                    combo.options[4].value = "04";
                    combo.options[4].innerText = "Abril";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 5);
                    combo.options[5].value = "05";
                    combo.options[5].innerText = "Mayo";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 6);
                    combo.options[6].value = "06";
                    combo.options[6].innerText = "Junio";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 7);
                    combo.options[7].value = "07";
                    combo.options[7].innerText = "Julio";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 8);
                    combo.options[8].value = "08";
                    combo.options[8].innerText = "Agosto";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 9);
                    combo.options[9].value = "09";
                    combo.options[9].innerText = "Septiembre";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 10);
                    combo.options[10].value = "10";
                    combo.options[10].innerText = "Octubre";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 11);
                    combo.options[11].value = "11";
                    combo.options[11].innerText = "Noviembre";

                    var combo = document.getElementById("mes");
                    var option = document.createElement('option');
                    combo.options.add(option, 12);
                    combo.options[12].value = "12";
                    combo.options[12].innerText = "Diciembre";

                    


                })
    </script>

<script type="text/javascript">
    function BuscarDatos() 
    { 
        document.getElementById("myChart").remove(); //canvas
        var  div = document.querySelector("#divtemperatura"); //canvas parent element
        div.insertAdjacentHTML("afterbegin", "<canvas id='myChart'></canvas>");

        document.getElementById("myChart1").remove(); //canvas
        var  div = document.querySelector("#divph"); //canvas parent element
        div.insertAdjacentHTML("afterbegin", "<canvas id='myChart1'></canvas>");
        
        document.getElementById("myChart2").remove(); //canvas
        var  div = document.querySelector("#divsaturacion"); //canvas parent element
        div.insertAdjacentHTML("afterbegin", "<canvas id='myChart2'></canvas>");

        document.getElementById("myChart3").remove(); //canvas
        var  div = document.querySelector("#divmiligramos"); //canvas parent element
        div.insertAdjacentHTML("afterbegin", "<canvas id='myChart3'></canvas>");

        var mes = document.getElementById("mes").value;
        var anio = document.getElementById("anio").value;
        var sensor = document.getElementById("sensor").value;
       
        var parametros ={
            'mes': mes,
            'anio' : anio,
            'sensor' : sensor,        
        };
        $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?PhByConsulta=true',
                    type: 'post'
                }).done(function(resp){

                var datos = JSON.parse(resp);
                var dias =[];
                var phs=[];
                for (var i = 0; i < datos.length; i++) {
                        var arr = Object.entries(datos[i]);
                        phs.push(parseFloat(arr[0][1]));
                        dias.push(parseInt(arr[1][1]));
                }
                var ctx = document.getElementById('myChart1');
                var myChart1 = new Chart(ctx, {
                type: 'line',
                data: {
                    labels:dias,
                    datasets: [{
                        label: 'PH AGUA',
                        data: phs,
                        backgroundColor: [
                            'rgb(255,218,185)'
                        ],
                        borderColor: [
                            'rgb(255,140,0)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
                });

                })



                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?TemperaturaByConsulta=true',
                    type: 'post'
                }).done(function(resp){

                    var datos = JSON.parse(resp);
                    var dias =[];
                    var temperaturas=[];
                     for (var i = 0; i < datos.length; i++) {
                            var arr = Object.entries(datos[i]);
                            temperaturas.push(parseFloat(arr[0][1]));
                            dias.push(parseInt(arr[1][1]));
                    }
                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:dias,
                            datasets: [{
                                label: 'Temperatura',
                                data: temperaturas,
                                backgroundColor: [
                                    'rgb(221,160,221)'
                                ],
                                borderColor: [
                                    'rgb(153,50,204)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                })



                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?OxigenoByConsulta=true',
                    type: 'post'
                }).done(function(resp){

                    var datos = JSON.parse(resp);
                    var dias =[];
                    var oxigenos=[];
                     for (var i = 0; i < datos.length; i++) {
                            var arr = Object.entries(datos[i]);
                            oxigenos.push(parseFloat(arr[0][1]));
                            dias.push(parseInt(arr[1][1]));
                    }
                    var ctx = document.getElementById('myChart2');
    var myChart2 = new Chart(ctx, {
        type: 'line',
        data: {
            labels:dias,
            datasets: [{
                label: 'SATURACIÓN OXIGENO',
                data: oxigenos,
                backgroundColor: [
                    'rgb(176,224,230)'
                ],
                borderColor: [
                    'rgb(30,144,255)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
                })



                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?MiligramosByConsulta=true',
                    type: 'post'
                }).done(function(resp){
                    var datos = JSON.parse(resp);
                    var dias =[];
                    var oxigenos=[];
                     for (var i = 0; i < datos.length; i++) {
                            var arr = Object.entries(datos[i]);
                            oxigenos.push(parseFloat(arr[0][1]));
                            dias.push(parseInt(arr[1][1]));
                    }
                    var ctx = document.getElementById('myChart3');
    var myChart3 = new Chart(ctx, {
        type: 'line',
        data: {
            labels:dias,
            datasets: [{
                label: 'MILIGRAMOS/LITRO',
                data: oxigenos,
                backgroundColor: [
                    '#dbeddc'
                ],
                borderColor: [
                    '#008f39'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
                })
    }
    
  </script>

<script type="text/javascript">
    //TRAER DATOS TEMPERATURA FIRST
    function BuscarDatosTemperaturaFirst() 
    {
                ///SCRIPT PRUEBA
                    var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,        
                    };
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosTemperaturaFirst=true',
                    type: 'post'
                }).done(function(resp){
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' TEMPERATURA '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'temperatura';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var temperaturas=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            temperaturas.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");

                    var ctx = document.getElementById('myChart4');
                    var myCharta = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: 'Temperatura/Hora',
                                data: temperaturas,
                                backgroundColor: [
                                    'rgb(221,160,221)'
                                ],
                                borderColor: [
                                    'rgb(153,50,204)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    var diasmes=new Date(anio, mesid, 0).getDate();
                    var today = ""+anio+"-"+mesid+"-01";
                    var todaymax = ""+anio+"-"+mesid+"-"+diasmes;                     
                    $('#fechabusqueda').val(today);
                    document.getElementById("fechabusqueda").setAttribute("min", today);
                    document.getElementById("fechabusqueda").setAttribute("max", todaymax);            
                })

    }
</script>


<script type="text/javascript">
    //TRAER DATOS TEMPERATURA ANOTHER
    function Case(){
        var tipobusqueda = document.getElementById('labelcase');
        
        if(tipobusqueda.textContent=="temperatura"){
            BuscarDatosTemperaturaAnother();
        }else if(tipobusqueda.textContent=="ph"){
            BuscarDatosPhAguaAnother();
           
        }else if(tipobusqueda.textContent=="saturacion"){
            BuscarDatosSaturacionAnother();
           
        }
        else if(tipobusqueda.textContent=="miligramos"){
            BuscarDatosMiligramosAnother();
           
        }
        else{
            alert("Ningun Sensor Seleccionado");
        }

    }

    function BuscarDatosTemperaturaAnother() 
    {
        var day;
        var date = $('#fechabusqueda').val().split("-");
        day = date[2];
          ///SCRIPT PRUEBA
          var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,
                     'day' : day,       
                    };
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosTemperaturaAnother=true',
                    type: 'post'
                }).done(function(resp){
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' TEMPERATURA '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'temperatura';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var temperaturas=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            temperaturas.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");

                    var ctx = document.getElementById('myChart4');
                    var myChartb = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: 'Temperatura/Hora',
                                data: temperaturas,
                                backgroundColor: [
                                    'rgb(221,160,221)'
                                ],
                                borderColor: [
                                    'rgb(153,50,204)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });           
                })
     

    }
</script>

<script type="text/javascript">
    //TRAER DATOS PH AGUA FIRTS FIRST
    function BuscarDatosPhAguaFirst() 
    {
        
                    var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,        
                    };
                    
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosPhAguaFirst=true',
                    type: 'post'
                }).done(function(resp){
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' PH AGUA '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'ph';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var phs=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            phs.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");
                    var ctx = document.getElementById('myChart4');
                    var myChartc = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: 'PH AGUA/horas',
                                data: phs,
                                backgroundColor: [
                                    'rgb(255,218,185)'
                                ],
                                borderColor: [
                                    'rgb(255,140,0)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    var diasmes=new Date(anio, mesid, 0).getDate();
                    var today = ""+anio+"-"+mesid+"-01";
                    var todaymax = ""+anio+"-"+mesid+"-"+diasmes;                     
                    $('#fechabusqueda').val(today);
                    document.getElementById("fechabusqueda").setAttribute("min", today);
                    document.getElementById("fechabusqueda").setAttribute("max", todaymax);            
                })

    }

//BUSCAR PH ANOTHER 

function BuscarDatosPhAguaAnother() 
    {
        var day;
        var date = $('#fechabusqueda').val().split("-");
        day = date[2];
          ///SCRIPT PRUEBA
          var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,
                     'day' : day,       
                    };
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosPhAguaAnother=true',
                    type: 'post'
                }).done(function(resp){
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' PH AGUA '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'ph';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var phs=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            phs.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");
                    var ctx = document.getElementById('myChart4');
                    var myChartd = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: 'PH AGUA/horas',
                                data: phs,
                                backgroundColor: [
                                    'rgb(255,218,185)'
                                ],
                                borderColor: [
                                    'rgb(255,140,0)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
     

    }
</script>

<script>
  function BuscarDatosSatruracionFirst() 
    {
               
        
                    var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,        
                    };
                    
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosSaturacionFirst=true',
                    type: 'post'
                }).done(function(resp){
                    
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' SATURACIÓN OXIGENO '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'saturacion';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var saturaciones=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            saturaciones.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");
                    var ctx = document.getElementById('myChart4');
                    var myChart4 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: 'SATURACIÓN OXIGENO/HORA',
                                data: saturaciones,
                                backgroundColor: [
                                    'rgb(176,224,230)'
                                ],
                                borderColor: [
                                    'rgb(30,144,255)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    var diasmes=new Date(anio, mesid, 0).getDate();
                    var today = ""+anio+"-"+mesid+"-01";
                    var todaymax = ""+anio+"-"+mesid+"-"+diasmes;                     
                    $('#fechabusqueda').val(today);
                    document.getElementById("fechabusqueda").setAttribute("min", today);
                    document.getElementById("fechabusqueda").setAttribute("max", todaymax);            
                })

    }

//BUSCAR SATURACION ANOTHER 

function BuscarDatosSaturacionAnother() 
    {
       
        var day;
        var date = $('#fechabusqueda').val().split("-");
        day = date[2];
          var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,
                     'day' : day,       
                    };
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosSaturacionAnother=true',
                    type: 'post',
                }).done(function(resp){
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' SATURACIÓN OXIGENO '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'saturacion';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var saturaciones=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            saturaciones.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");
                    var ctx = document.getElementById('myChart4');
                    var myChart4 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: 'SATURACIÓN OXIGENO/HORA',
                                data: saturaciones,
                                backgroundColor: [
                                    'rgb(176,224,230)'
                                ],
                                borderColor: [
                                    'rgb(30,144,255)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
     

    }
</script>

<script>
    //MILIGRAMOS MODAL
  function BuscarDatosMiligramosFirst() 
    {
               
        
                    var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,        
                    };
                   
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosMiligramosFirst=true',
                    type: 'post'
                }).done(function(resp){
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' MILIGRAMOS/LITRO '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'miligramos';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var miligramos=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            miligramos.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");
                    var ctx = document.getElementById('myChart4');
                    var myChart4 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: '(MILIGRAMOS/LITRO)/HORA',
                                data: miligramos,
                                backgroundColor: [
                                    '#dbeddc'
                                ],
                                borderColor: [
                                    '#008f39'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                    var diasmes=new Date(anio, mesid, 0).getDate();
                    var today = ""+anio+"-"+mesid+"-01";
                    var todaymax = ""+anio+"-"+mesid+"-"+diasmes;                     
                    $('#fechabusqueda').val(today);
                    document.getElementById("fechabusqueda").setAttribute("min", today);
                    document.getElementById("fechabusqueda").setAttribute("max", todaymax);            
                })

    }

//BUSCAR SATURACION ANOTHER 

function BuscarDatosMiligramosAnother() 
    {
       
        var day;
        var date = $('#fechabusqueda').val().split("-");
        day = date[2];
          var sensorget = document.getElementById("sensor");
                    var sensor = sensorget.options[sensorget.selectedIndex].text;
                    var mesget = document.getElementById("mes");
                    var mes = mesget.options[mesget.selectedIndex].text;
                    var anioget = document.getElementById("anio");
                    var anio = anioget.options[anioget.selectedIndex].text;
                    var sensorid= sensorget.value;
                    var anioid = anioget.value;
                    var mesid = mesget.value;
                    var parametros ={
                     'mes': mesid,
                     'anio' : anioid,
                     'sensor' : sensorid,
                     'day' : day,       
                    };
                $.ajax({
                    data:  {parametros:parametros},
                    url:'../controlador/controlador_grafico.php?BuscarDatosMiligramosAnother=true',
                    type: 'post',
                }).done(function(resp){
                    document.getElementById('labeltexto').innerHTML= 'SENSOR '+sensor+' MILIGRAMOS/LITRO '+ mes+' '+anio;
                    document.getElementById('labelcase').innerHTML= 'miligramos';
                    var data = JSON.parse(resp);
                    var horas =[];
                    var miligramos=[];
                     for (var i = 0; i < data.length; i++) {
                            var arr = Object.entries(data[i]);
                            miligramos.push(parseFloat(arr[0][1]));
                            horas.push(parseInt(arr[1][1]));
                    }
                    document.getElementById("myChart4").remove(); //canvas
                    var  div = document.querySelector("#divbody"); //canvas parent element
                    div.insertAdjacentHTML("afterbegin", "<canvas id='myChart4'></canvas>");
                    var ctx = document.getElementById('myChart4');
                    var myChart4 = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:horas,
                            datasets: [{
                                label: '(MILIGRAMOS/LITRO)/HORA',
                                data: miligramos,
                                backgroundColor: [
                                    '#dbeddc'
                                ],
                                borderColor: [
                                    '#008f39'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                })
     

    }
</script>




<!-- Modal Temperatura-->
<div class="modal fade" id="modaltemperatura" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header " >
        <h5 class="modal-title " id="exampleModalLongTitle">Información diaria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="divbody">
      <center> <label for="labeltexto" id="labeltexto" styly="background-color: #0480be;"> </label></center>
            <div class="row">
                     <div class="col-sm-4">
                             <input type="date" id="fechabusqueda" name="fechabusqueda" onchange="Case()">                            
                    </div>
                    <div  class="col-sm-4">
                             <label for="">Seleccione Día</label>
                             <label for="" hidden="hidden" id="labelcase"></label>
                    </div>
                    <div  class="col-sm-4">
                        
                    </div>
                    <div class="col-sm-12">    
                        <canvas id="myChart4" ></canvas>
                    </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>


<?php include('footer.php'); ?>