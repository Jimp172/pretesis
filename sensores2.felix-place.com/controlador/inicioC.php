<?php
if(!class_exists('nuevo_sensorM'))
{
include('../modelo/nuevo_sensorM.php');
}include('../modelo/inicioM.php');
include('telegram.php');
/**
 * 
 */
$controlador = new inicioC();
if(isset($_GET['nuevo']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->nuevo($parametros);
	echo json_encode($datos);
}

if(isset($_GET['lista_sensor']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->lista_sensores($parametros);
	echo json_encode($datos);
}
if(isset($_GET['datos_sensor']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->datos_sensor($parametros);
	echo json_encode($datos);
}
if(isset($_GET['datos_temperatura']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->datos_pintar($parametros);
	echo json_encode($datos);
}
if(isset($_GET['editar']))
{
	$id = $_POST['id'];
	$datos = $controlador->editar($id);
	echo json_encode($datos);
}
if(isset($_GET['eliminar']))
{
	$id = $_POST['id'];
	$datos = $controlador->eliminar($id);
	echo json_encode($datos);
}
if(isset($_GET['enviar_mensaje']))
{
	$datos = $controlador->enviar_mensaje();
	echo json_encode($datos);
}

class inicioC
{
	private $modelo;
	private $sensor;
	private $telegram;

	function __construct()
	{
		$this->modelo = new inicioM();
		$this->sensor = new nuevo_sensorM();
		$this->telegram = new telegram();
	}

	function nuevo($parametros)
	{
		// print_r($parametros);die();
		$datos[0]['campo'] = 'nombre';
		$datos[0]['dato'] = $parametros['nom'];
		$datos[1]['campo'] = 'codigo';
		$datos[1]['dato'] = $parametros['cod'];

		if($parametros['id']=='')
		{
			return $this->modelo->insertar('sensor',$datos);			
		}else
		{
			$where[0]['campo'] = 'id_sensor';
			$where[0]['dato'] = $parametros['id'];
			return $this->modelo->update('sensor',$datos,$where);
		}

	}

	function puntos_mapa(){
		$datos = $this->rutas->rutas_optima();		
		return $datos;
	}

	function lista_sensores($parametros){
		$datos = $this->sensor->buscar_sensores(false,false,$parametros['query']);
		$tr = '';
		foreach ($datos as $key => $value) {
		$temp = 0;	$ph = 0; $oxi=0; $mo=0;
			// print_r($value);die();
			$historia = $this->modelo->buscar_historial($value['id']);
			if(count($historia)>0)
			{
				$temp = $historia[0]['temperatura'];	$ph = $historia[0]['ph']; $oxi=$historia[0]['oxigeno']; $mo=($historia[0]['oxigeno']/100)*11.027;
			}
			$respuesta = $this->reglas($temp,$ph,$oxi,$value['nombre']);	

			$tr.='<div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
              <div class="inner">
                <h3>'.$value['codigo'].'</h3>
                <p>'.$value['nombre'].'</p>
              </div>
              <div class="icon">
                <i class="ion ion-wifi"></i>
              </div>
               <div class="row">
                  <div class="col-3 text-center">
                    <input type="text" class="knob" value="'.round($temp,2,PHP_ROUND_HALF_EVEN).'" data-width="90" data-height="90" data-fgColor="#932ab6" data-readonly="true" style="border:none;background:transparent" >
                    <div class="text-black">Temperatura</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-3 text-center">                   
                    <input type="text" class="knob" value="'.round($ph,2,PHP_ROUND_HALF_EVEN).'" data-width="90" data-height="90" data-fgColor="#f56954" data-readonly="true" style="border:none;background:transparent" >
                    <div class="text-black">PH del agua</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-3 text-center">
                     <input type="text" class="knob" value="'.round($oxi,2,PHP_ROUND_HALF_EVEN).'" data-width="90" data-height="90" data-fgColor="#3c8dbc" data-readonly="true" style="border:none;background:transparent" >
                    <div class="text-black">Saturacion de oxigeno</div>
                  </div>
                  <!-- ./col -->
				  <div class="col-3 text-center">
				  <input type="text" class="knob" value="'.round($mo,2,PHP_ROUND_HALF_EVEN).'" data-width="90" data-height="90" data-fgColor="#52BE80" data-readonly="true" style="border:none;background:transparent" >
				 <div class="text-black">mg/L</div>
			   </div>
			   <!-- ./col -->
                </div>
                <div class="col-sm-12">
                '.$respuesta.'
                </div>
              <a href="detalle_sensor.php?id='.$value['id'].'" class="small-box-footer bg-primary">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>';
		}
		
			$tr.='<script src="../dist/js/pages/dashboard.js"></script>';
		
		return $tr;
	}


	function editar($id)
	{
		return $this->modelo->buscar_sensores($id);
	}
	function eliminar($id)
	{
		return $this->modelo->eliminar($id);
	}
	function datos_sensor($parametros)
	{
		$datos = $this->sensor->datos_sensores_historial($parametros['id']);
		return $datos;
	}

	function datos_pintar($parametros)
	{
		$limite = 10;
		$datos = $this->sensor->datos_estadisticos($parametros['id'],$parametros['temp'],$parametros['ph'],$parametros['oxi'],$limite);
		$d = array();
		foreach ($datos as $key => $value) {
			// print_r($value);die();
			$d[] = array('fecha'=>strtotime($value['fecha']." UTC") ,'temp'=>$value['temperatura'],'ph'=>$value['ph'],'oxi'=>$value['oxigeno']);
		}
		// print_r($datos);die();
		return $d;
	}

	function enviar_mensaje()
	{
		$parametros = 'hola alerta';
		$this->telegram->enviar_mensaje($parametros);
	}

	function reglas($TEM,$PH,$OXI,$codigo)
	{
		// print_r($TEM.'-'.$PH.'-'.$OXI.'-'.$codigo);
		
    	$sms1 = false;$sms2=false;$sms3=false;
    	$mensaje ='';

		if ($TEM <= 7.00 && $PH <= 6.3 && $OXI <= 58.00)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA,  NIVEL DE PH ACIDO Y OXIGENO CRITICO 1<br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;

		}else if($TEM <= 7.0 && $PH <= 6.3 && $OXI <= 68.00)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA Y NIVEL DE PH ACIDO 2';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;

		}else if($TEM <= 7.00 && $PH <= 6.3 && $OXI <= 100.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA,  NIVEL DE PH ACIDO 3 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 7.00 && $PH <= 7.99 && $OXI <= 58.00)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA Y OXIGENO CRITICO 4 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 7.00 && $PH <= 7.99 && $OXI <= 68.00)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA 5  <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms2=true;
		}else if($TEM <= 7.00 && $PH <= 7.99 && $OXI <= 100.00)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA 6 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms2=true;
		}else if($TEM <= 7.00 && $PH <= 12.00 && $OXI <= 58.00)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA, NIVEL DE PH ALCALINO Y OXIGENO CRITICO 7 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 7.00 && $PH <= 12.00 && $OXI <= 68.00)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA, NIVEL DE PH ALCALINO 8 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 7.00 && $PH <= 12 && $OXI <= 100)
		{
			$mensaje.='ESTADO DE TEMPERATURA BAJA, NIVEL DE PH ALCALINO 9  <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 12.5 && $PH <= 6.3 && $OXI <= 58.00)
		{
			$mensaje.='ESTADO DE PH ACCIDO Y OXIGENO CRITICO 10 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 12.5 &&$PH <= '6.3' && $OXI <= 68.00)
		{
			$mensaje.='ESTADO DE PH ACCIDO 11 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 12.5 &&$PH <= '6.3' && $OXI <= 100.0)
		{
			$mensaje.='ESTADO DE PH ACCIDO 12.00 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 12.5 &&$PH <= 7.99 && $OXI <= 58.0)
		{
			$mensaje.='ESTADO DE OXIGENO POBRE 13 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 12.5 &&$PH <= 7.9 && $OXI <= 68.0)
		{
			$mensaje.='PARAMETROS OPTIMOS 14 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms1 = true;
		}else if($TEM <= 12.5 &&$PH <= 7.9 && $OXI <= 100.0)
		{
			$mensaje.='PARAMETROS OPTIMOS 15 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms1 = true;
		}else if($TEM <= 12.5 &&$PH <= 12.00 && $OXI <= 58.0)
		{
			$mensaje.='ESTADO DE PH ALCALINO Y OXIGENO POBRE 16  <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 12.5 &&$PH <= 12.00 && $OXI <= 68.0)
		{
			$mensaje.='ESTADO DE PH ALCALINO Y OXIGENO ACEPTABLE 17  <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';;
			$sms3=true;
		}else if($TEM <= 12.5 &&$PH <= 12.00 && $OXI <= 100.0)
		{
			$mensaje.='ESTADO DE PH ALCALINO 18  <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 20.00 &&$PH <= '6.3' && $OXI <= 58.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA, NIVEL DE PH ACIDO Y OXIGENO POBRE 19  <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 20.00 &&$PH <= '6.3' && $OXI <= 68.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA Y NIVEL DE PH ACIDO 20 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 20.00 &&$PH <= '6.3' && $OXI <= 100.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA Y NIVEL DE PH ACIDO 21 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 20.00 &&$PH <= 7.9 && $OXI <= 58.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA Y OXIGENO POBRE 22 <br> ';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 20.00 &&$PH <= 7.9 && $OXI <= 68.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA 23<br> ';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms2=true;
		}else if($TEM <= 20.00 &&$PH <= 7.9 && $OXI <= 100.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA 24 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms2=true;
		}else if($TEM <= 20.00 &&$PH <= 12.00 && $OXI <= 58.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA, PH ALCALINO, OXIGENO PROBE 25 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 20.00 &&$PH <= 12.00 && $OXI <= 68.0)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA Y PH ALCALINO 26  <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}else if($TEM <= 20 &&$PH <= 12 && $OXI <= 100)
		{
			$mensaje.='ESTADO DE TEMPERATURA ALTA Y PH ALCALINO 27 <br>';
			$mensaje.=' TEMPERATURA:  '.$TEM.' °C <br>';
			$mensaje.='	NIVEL PH: '.$PH.'<br>';
			$mensaje.='% OXIGENO: '.$OXI.' % <br>';
			$sms3=true;
		}

	  $alerta='';$mensaje_tel='';
		if($sms1==false && $sms2==false && $sms3==true)
				{
					 $alerta.='<div class="alert alert-danger alert-dismissible">
		                  <b style="font-size:14px"><i class="icon fas fa-ban"></i>NOTIFICACIÓN  DE ALERTA: '.$codigo.'</p>
		                  SE ENCUENTRA EN ESTADO CRITICO</b>
		                  <br>
		                 <p style="font-size:12px">'.$mensaje.'</p>
		                </div>';
		       $mensaje_tel = str_replace('<br>','', $mensaje);
		        $mensaje_tel= 'NOTIFICACION  DE ALERTA: '.$codigo.', '.$mensaje_tel;
				}else if($sms1==false && $sms2 ==true && $sms3==false)
				{
					$alerta.='<div class="alert alert-warning alert-dismissible">
		                  <b style="font-size:14px"><i class="icon fas fa-ban"></i> NOTIFICACION  DE ALERTA: '.$codigo.'</p>  
		                  SE ENCUENTRA EN ESTADO MODERADO</b>
		                  <br>
		                  <p style="font-size:12px">'.$mensaje.'</p>
		                </div>';
		      $mensaje_tel = str_replace('<br>','', $mensaje);
		      $mensaje_tel= 'NOTIFICACION  DE ALERTA: '.$codigo.', '.$mensaje_tel;
				}else
				{
					$alerta.='';
				}
				if($mensaje_tel!='')
				{
					$id = $this->modelo->validar_reseptor()	;			
		  		$this->telegram->enviar_mensaje($mensaje_tel,$id[0]['id_telegram']);
		  	}

		return $alerta;

	}
	
}

?>