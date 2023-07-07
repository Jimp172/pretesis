<?php
if(!class_exists('db'))
{
include('../db/db.php');
}
/**
 * 
 */
class nuevo_sensorM
{
	private $db;
	function __construct()
	{
		// $this->db = new db();
		$this->db = new db();
	}

	function insertar($tabla,$datos)
	{
		return $this->db->inserts($tabla,$datos);
	}
	function update($tabla,$datos,$where)
	{
		return $this->db->update($tabla,$datos,$where);
	}
	function eliminar($id)
	{
		$sql='DELETE FROM sensor where id_sensor='.$id;
		return $this->db->sql_string($sql);
	}

	function buscar_sensores($id=false,$nombre=false,$codigo=false,$codigo_exacto=false)
	{
		$sql = "SELECT id_sensor as 'id',nombre,codigo FROM sensor Where 1=1 ";
		if($id)
		{
			$sql.=" AND id_sensor= ".$id;
		}
		if($codigo)
		{
			$sql.=" AND codigo like '".$codigo."%'";
		}
		if($codigo_exacto)
		{
			$sql.=" AND codigo='".$codigo_exacto."'";
		}
		return $this->db->datos($sql);

	}

	function datos_sensores_historial($id=false)
	{
		$sql = "SELECT * FROM historial H 
				LEFT JOIN sensor S ON H.id_sensor = S.id_sensor 
				WHERE 1 = 1 ";
		if($id)
		{
		  $sql.=" AND H.id_sensor = '".$id."'";
		}
		$sql.="ORDER BY fecha,hora DESC";
		return $this->db->datos($sql);
	}

	function datos_estadisticos($id=false,$temp=false,$ph=false,$oxi=false,$limite=false)
	{
		$sql = "SELECT CONCAT(fecha,' ',hora) as 'fecha'";
		if($temp)
		{
			$sql.=",temperatura ";
		}
		if($ph)
		{
			$sql.=",ph ";
		}
		if($oxi)
		{
			$sql.=",oxigeno ";
		}
		$sql.=" FROM historial H 
				LEFT JOIN sensor S ON H.id_sensor = S.id_sensor 
				WHERE 1 = 1 ";
		if($id)
		{
		  $sql.=" AND H.id_sensor = '".$id."'";
		}
		$sql.="ORDER BY fecha DESC ,hora DESC ";
		if($limite)
		{
			$sql.=" LIMIT ".$limite;
		}

		// print_r($sql);die();
		return $this->db->datos($sql);
	}


	
	
	
}


?>