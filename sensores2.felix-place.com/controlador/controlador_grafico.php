<?php
    require '../modelo/estadisticaM.php';

    
    $MG = new estadisticaM();

    if(isset($_GET['TraerTemperatura']))
   {
        $consulta = $MG -> TraerDatosActualesTemperatura();
        echo  json_encode($consulta);
    }
    if(isset($_GET['TraerPh']))
    {
         $consulta = $MG -> TraerDatosActualesPh();
         echo  json_encode($consulta);
     }
     if(isset($_GET['TraerSaturacionOxigeno']))
     {
          $consulta = $MG -> TraerDatosActualesSaturacionOxigeno();
          echo  json_encode($consulta);
      }
      if(isset($_GET['TraerMiligramos']))
      {
           $consulta = $MG -> TraerDatosActualesMiligramos();
           echo  json_encode($consulta);
       }
    if(isset($_GET['sensorescombo']))
    {
         $sensor= $MG-> TraerSensor();
         echo  json_encode($sensor);
     }
     if(isset($_GET['cargarmeses']))
     {
          $consulta =$MG->MesActual();
          echo  json_encode($consulta);
      }
     if(isset($_GET['PhByConsulta']))
     {
        $parametros = $_POST['parametros'];
        $sensor= $parametros['sensor'];
        $anio= $parametros['anio'];
        $mes= $parametros['mes'];
        
        $consulta= $MG-> TraerDatosByConsultaPh($sensor, $anio, $mes);
        echo  json_encode($consulta);
      }
      if(isset($_GET['TemperaturaByConsulta']))
      {
         $parametros = $_POST['parametros'];
         $sensor= $parametros['sensor'];
         $anio= $parametros['anio'];
         $mes= $parametros['mes'];
         
         $consulta= $MG-> TraerDatosByConsultaTemperatura($sensor, $anio, $mes);
         echo  json_encode($consulta);
       }

       if(isset($_GET['OxigenoByConsulta']))
       {
          $parametros = $_POST['parametros'];
          $sensor= $parametros['sensor'];
          $anio= $parametros['anio'];
          $mes= $parametros['mes'];
          
          $consulta= $MG-> TraerDatosByConsultaOxigeno($sensor, $anio, $mes);
          echo  json_encode($consulta);
        }

        if(isset($_GET['MiligramosByConsulta']))
        {
           $parametros = $_POST['parametros'];
           $sensor= $parametros['sensor'];
           $anio= $parametros['anio'];
           $mes= $parametros['mes'];
           
           $consulta= $MG-> TraerDatosByConsultaMiligramos($sensor, $anio, $mes);
           echo  json_encode($consulta);
         }

         if(isset($_GET['BuscarDatosTemperaturaFirst']))
         {
            $parametros = $_POST['parametros'];
            $sensor= $parametros['sensor'];
            $anio= $parametros['anio'];
            $mes= $parametros['mes'];
            $consulta= $MG-> TraerDatosTerperaturaFirst($sensor, $anio, $mes);
            echo  json_encode($consulta);
          }

          if(isset($_GET['BuscarDatosTemperaturaAnother']))
          {
             $parametros = $_POST['parametros'];
             $sensor= $parametros['sensor'];
             $anio= $parametros['anio'];
             $mes= $parametros['mes'];
             $dia= $parametros['day'];
             $consulta= $MG-> TraerDatosTerperaturaAnother($sensor, $anio, $mes, $dia);
             echo  json_encode($consulta);
           }

           if(isset($_GET['BuscarDatosPhAguaFirst']))
           {
              $parametros = $_POST['parametros'];
              $sensor= $parametros['sensor'];
              $anio= $parametros['anio'];
              $mes= $parametros['mes'];
              $consulta= $MG-> TraerDatosPhAguaFirst($sensor, $anio, $mes);
              echo  json_encode($consulta);
            }

            if(isset($_GET['BuscarDatosPhAguaAnother']))
            {
               $parametros = $_POST['parametros'];
               $sensor= $parametros['sensor'];
               $anio= $parametros['anio'];
               $mes= $parametros['mes'];
               $dia= $parametros['day'];
               $consulta= $MG-> TraerDatosPhAguaAnother($sensor, $anio, $mes, $dia);
               echo  json_encode($consulta);
             }
             
           if(isset($_GET['BuscarDatosSaturacionFirst']))
           {
              $parametros = $_POST['parametros'];
              $sensor= $parametros['sensor'];
              $anio= $parametros['anio'];
              $mes= $parametros['mes'];
              $consulta= $MG-> TraerDatosSaturacionFirst($sensor, $anio, $mes);
              echo  json_encode($consulta);
            }

            if(isset($_GET['BuscarDatosSaturacionAnother']))
            {
               $parametros = $_POST['parametros'];
               $sensor= $parametros['sensor'];
               $anio= $parametros['anio'];
               $mes= $parametros['mes'];
               $dia= $parametros['day'];
               $consulta= $MG-> TraerDatosSaturacionAnother($sensor, $anio, $mes, $dia);
               echo  json_encode($consulta);
             }
             if(isset($_GET['BuscarDatosMiligramosFirst']))
             {
                $parametros = $_POST['parametros'];
                $sensor= $parametros['sensor'];
                $anio= $parametros['anio'];
                $mes= $parametros['mes'];
                $consulta= $MG-> TraerDatosMiligramosFirst($sensor, $anio, $mes);
                echo  json_encode($consulta);
              }
              if(isset($_GET['BuscarDatosMiligramosAnother']))
              {
                 $parametros = $_POST['parametros'];
                 $sensor= $parametros['sensor'];
                 $anio= $parametros['anio'];
                 $mes= $parametros['mes'];
                 $dia= $parametros['day'];
                 $consulta= $MG-> TraerDatosMiligramosAnother($sensor, $anio, $mes, $dia);
                 echo  json_encode($consulta);
               }


        class controlador_grafico
        {



        }


?>