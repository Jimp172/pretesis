<?php
include('../modelo/usuarioM.php');
/**
 * 
 */
$controlador = new usuarioC();
if(isset($_GET['listar_usuarios']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->listar_usuarios($parametros);
	echo json_encode($datos);
}
if(isset($_GET['editar']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->editar($parametros);
	echo json_encode($datos);
}

if(isset($_GET['eliminar']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->eliminar($parametros);
	echo json_encode($datos);
}
//variable que viene de vista para guardar
if(isset($_GET['guardar']))
{
	//variables que vienen por post de la vista
	$parametros = $_POST;
	$datos = $controlador->guardar($parametros);
	echo json_encode($datos);
}
if(isset($_GET['tipo']))
{
	$datos = $controlador->tipo_usuario();
	echo json_encode($datos);
}

class usuarioC
{
	private $modelo;
	function __construct()
	{
		$this->modelo = new usuarioM();
	}

	function listar_usuarios($parametros)
	{
		$query = $parametros['query'];
		$datos = $this->modelo->listar($query);
		$tr='';
		foreach ($datos as $key => $value) {
			$tr.="<tr>
			<td>
			  <button type='button' class='btn btn-sm btn-primary' onclick='editar(".$value['id'].")'><i class='icon fa fa-pen'></i></button>
			  <button type='button' class='btn btn-sm btn-danger' onclick='eliminar_registro(".$value['id'].")'><i class='icon fa fa-trash'></i></button>
			</td>
			<td>".$value['nombre']."</td>
			<td>".$value['ci_ruc']."</td>
			<td>".$value['nick']."</td>
			<td>".$value['pass']."</td>
			<td>".$value['tipo']."</td>
			<td>".$value['direccion']."</td>			
			</tr>";
		}
		return $tr;
	}

	function editar($parametros)
	{
		return  $this->modelo->listar(false,$parametros['id']);
	}

	function eliminar($parametros)
	{
		return  $this->modelo->eliminar($parametros['id']);
	}

	function tipo_usuario()
	{
		$datos = $this->modelo->tipo_usuario();
		$op='<option value="">Seleccione</option>';
		foreach ($datos as $key => $value) {
			$op.="<option value='".$value['id']."'>".$value['nombre']."</option>";
		}
		return $op;

	}

	//funcion para guarda creando un array 
	 //campo : nombre de la tabla en base de datos
	 //datos : valor a colocar en la base de datos
	function guardar($parametros)
	{
		// print_r($parametros);die();
		$datos[0]['campo'] = 'nombre';
		$datos[0]['dato'] = $parametros['txt_nombre'];
		$datos[1]['campo'] = 'ci_ruc';
		$datos[1]['dato'] = $parametros['txt_ci'];
		$datos[2]['campo'] = 'nick';
		$datos[2]['dato'] = $parametros['txt_nick'];
		$datos[3]['campo'] = 'pass';
		$datos[3]['dato'] = $parametros['txt_pass'];
		$datos[4]['campo'] = 'id_tipo';
		$datos[4]['dato'] = $parametros['ddl_tipo'];
		$datos[5]['campo'] = 'direccion';
		$datos[5]['dato'] = $parametros['txt_dir'];
		$datos[6]['campo'] = 'id_telegram';
		$datos[6]['dato'] = $parametros['txt_telegram'];

		if($parametros['txt_id']!='')
		{
			$where[0]['campo'] = 'id_usuario';
			$where[0]['dato'] = $parametros['txt_id'];
			//funcion que envia a guardar o edita 
			return $this->modelo->editar('usuario',$datos,$where);
		}else{			
			//funcion que envia a guardar o edita 
			return $this->modelo->guardar('usuario',$datos);
		}
		
		

	}	
	
}

?>