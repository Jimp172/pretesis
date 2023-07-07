<?php
include('../db/db.php');
/**
 * 
 */
class loginM
{
	private $db;
	function __construct()
	{
		// $this->db = new db();
		$this->db = new db();
	}

	// function insertar($tabla,$datos)
	// {
	// 	return $this->db->inserts($tabla,$datos);
	// }
	// function update($tabla,$datos,$where)
	// {
	// 	return $this->db->update($tabla,$datos,$where);
	// }
	// function eliminar($id)
	// {
	// 	$sql='DELETE FROM sensor where id_sensor='.$id;
	// 	return $this->db->sql_string($sql);
	// }
	function login_user($nick,$pass)
	{
		$sql = "SELECT * FROM usuario WHERE nick='".$nick."' AND pass='".$pass."'";
		return $this->db->datos($sql);

	}


	
	
	
}


?>