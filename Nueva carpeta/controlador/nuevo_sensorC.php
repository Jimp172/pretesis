<?php
include('../modelo/nuevo_sensorM.php');
date_default_timezone_set('America/Guayaquil'); 
/**
 * 
 */
$controlador = new nuevo_sensorC();
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

if(isset($_GET['sensorData']))
{
	$data = $_GET;
	// print_r($data);die();
	$parametros = array(
		'CODIGO'=>$data['S'],
		'T'=>$data['T'],
		'P'=>$data['P'],
		'O'=>$data['O']);
	// print_r($parametros);die();
	$datos = $controlador->sensordata($parametros);
	echo json_encode($datos);
}




class nuevo_sensorC
{
	private $modelo;

	function __construct()
	{
		$this->modelo = new nuevo_sensorM();
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
		$datos = $this->modelo->buscar_sensores(false,false,$parametros['query']);
		$tr = '';
		foreach ($datos as $key => $value) {
			$tr.='<tr>
			<td>'.$value['codigo'].'</td>
			<td>'.$value['nombre'].'</td>
			<td><button class="btn btn btn-sm btn-primary" onclick="editar(\''.$value["id"].'\')"><i class="fa fa-fw fa-pen"></i></button>
			<button class="btn btn btn-sm btn-danger" onclick="delete_sensor(\''.$value["id"].'\')"><i class="fa fa-fw fa-trash"></i></button>
			</td>
			</tr>';
		}
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
	function sensordata($parametros)
	{
		$codigo_exacto = $parametros['CODIGO'];
		$sensor = $this->modelo->buscar_sensores($id=false,$nombre=false,$codigo=false,$codigo_exacto);
		if(count($sensor)>0)
		{
		// print_r($parametros);die();
		$datos[0]['campo'] ='temperatura';
		$datos[0]['dato'] =round($parametros['T'],2,PHP_ROUND_HALF_EVEN);
		$datos[1]['campo'] ='ph';
		$datos[1]['dato'] =round($parametros['P'],2,PHP_ROUND_HALF_EVEN);
		$datos[2]['campo'] ='oxigeno';
		$datos[2]['dato'] =round($parametros['O'],2,PHP_ROUND_HALF_EVEN);
		$datos[3]['campo'] ='id_sensor';
		$datos[3]['dato'] =$sensor[0]['id'];
		$datos[4]['campo'] ='fecha';
		$datos[4]['dato'] =date('Y-m-d');
		$datos[5]['campo'] ='hora';
		$datos[5]['dato'] =date("H:i:sa");
		// print_r($datos);die();
		return $this->modelo->insertar('historial',$datos);
	}else
	{
		return -1;
	}

	}
	
}

?>