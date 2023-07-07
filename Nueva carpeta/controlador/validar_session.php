<?php 
@session_start();
if(!isset($_SESSION['SENSORES']))
{
	header("Location: ../vista/login.php");
}
?>