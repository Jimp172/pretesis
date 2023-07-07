<?php 
session_start();
include('../modelo/loginM.php');
/**
 * 
 */
$controlador = new loginC();
if(isset($_GET['login']))
{
	$parametros = $_POST['parametros'];
	$datos = $controlador->login_user($parametros);
	echo json_encode($datos);
}
if(isset($_GET['cerrar']))
{
	$datos = $controlador->logout();
	echo json_encode($datos);
}

class loginC
{
	private $modelo;
	
	function __construct()
	{
		$this->modelo = new loginM();
		
	}
	function login_user($parametros)
	{
		
		$datos = $this->modelo->login_user($parametros['nick'],$parametros['pass']);
		$tele = $this->modelo->validar_reseptor();
		if(count($datos)>0)
		{
			$_SESSION['SENSORES']['TIPO_USER'] = $datos[0]['id_tipo'];
			$_SESSION['SENSORES']['USUARIO'] = $datos[0]['nombre'];
			if(count($tele)>0)
			{
			 $_SESSION['SENSORES']['TELEGRAM_ID'] = $tele[0]['id_telegram'];
			}else
			{
				$_SESSION['SENSORES']['TELEGRAM_ID'] = '';
			}

			// print_r($_SESSION['SENSORES']);die();

			return 1;
		}else
		{
			return -2;
		}
	}

	function logout()
	{
		session_destroy();
		return 1;
	}
}
?>