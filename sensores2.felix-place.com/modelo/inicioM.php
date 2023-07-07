<?php
if(!class_exists('db')){
	include('../db/db.php');
}
/**
 * 
 */
class inicioM
{
	private $db;
	function __construct()
	{
		// $this->db = new db();
		$this->db = new db();
	}

	function buscar_historial($id=false,$desde=false,$hasta=false)
	{
		$sql = "SELECT id_historial as 'id',temperatura,ph,oxigeno,fecha,hora 
		FROM historial 
		WHERE 1=1 ";
		if($id)
		{
			$sql.=" AND id_sensor = '".$id."' ";
		}
		if($desde !=false && $hasta !=false)
		{
			$sql.=" AND fecha BETWEEN '".$desde."' AND '".$hasta."'";
		}
		$sql.=" ORDER BY fecha DESC,hora DESC";
		
		// print_r($sql);die();
		return $this->db->datos($sql);
	}
	function buscar_sensores($id)
	{
		$sql = "SELECT id_sensor as 'id',nombre,codigo FROM sensor Where 1=1 ";
		if($id)
		{
			$sql.=" AND id_sensor= ".$id;
		}
		return $this->db->datos($sql);

	}

	function validar_reseptor()
	{
		$sql="SELECT * FROM usuario WHERE canal_telegram = '1'";
		return $this->db->datos($sql);
	}


	
	
	
}


?>