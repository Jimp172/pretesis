<?php
if(!class_exists('db'))
{
include('../db/db.php');
}
/**
 * 
 */
class estadisticaM
{
	private $db;
	function __construct()
	{
		// $this->db = new db();
		$this->db = new db();
	}


	function TraerDatosActualesTemperatura(){
		$Object = new DateTime();  
		$Date = $Object->format("d-m-Y");  
		$anio = $Object->format("Y"); 
		$mes = $Object->format("m");
		
		$sql1 = "SELECT * FROM `sensor` ORDER BY id_sensor ASC LIMIT 1";
		$consulta1 =array();
		$consulta1=$this->db->datos($sql1);	
		$sensor = $consulta1[0]['id_sensor'];

		$sql = "SELECT CAST((SUM(`temperatura`) / COUNT(`temperatura`)) as DECIMAL(8,2)) as terperatura, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
	}
	
	function TraerDatosActualesPh(){
		$Object = new DateTime();  
		$Date = $Object->format("d-m-Y");  
		$anio = $Object->format("Y"); 
		$mes = $Object->format("m");

		$sql1 = "SELECT * FROM `sensor` ORDER BY id_sensor ASC LIMIT 1";
		$consulta1 =array();
		$consulta1=$this->db->datos($sql1);	
		$sensor = $consulta1[0]['id_sensor'];

		$sql = "SELECT CAST((SUM(`ph`) / COUNT(`ph`)) as DECIMAL(8,2)) as ph, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
	}


	function TraerDatosActualesSaturacionOxigeno(){
		$Object = new DateTime();  
		$Date = $Object->format("d-m-Y");  
		$anio = $Object->format("Y"); 
		$mes = $Object->format("m");

		$sql1 = "SELECT * FROM `sensor` ORDER BY id_sensor ASC LIMIT 1";
		$consulta1 =array();
		$consulta1=$this->db->datos($sql1);	
		$sensor = $consulta1[0]['id_sensor'];

		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`)) as DECIMAL(8,2)) as oxigeno, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
	}
	
	function TraerDatosActualesMiligramos(){
		$Object = new DateTime();  
		$Date = $Object->format("d-m-Y");  
		$anio = $Object->format("Y"); 
		$mes = $Object->format("m");

		$sql1 = "SELECT * FROM `sensor` ORDER BY id_sensor ASC LIMIT 1";
		$consulta1 =array();
		$consulta1=$this->db->datos($sql1);	
		$sensor = $consulta1[0]['id_sensor'];

		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`))/100*11.027 as DECIMAL(8,2)) as oxigeno, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
	}
	function TraerSensor(){
		$sql = "SELECT * FROM `sensor` ORDER BY id_sensor ASC";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
	}	

	function MesActual(){
		$Object = new DateTime();  
		$mesNum = $Object->format("m");
		$mesLet = $Object->format("M");
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$i=0;
		foreach ($meses as $mes) {
				if ($i==($mesNum-1)) {
					$mesLet= $mes;
				}
				$i++;
			}
		$consulta = array($mesNum, $mesLet);
		return $consulta;		
	}

	function TraerDatosByConsultaPh($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`ph`) / COUNT(`ph`)) as DECIMAL(8,2)) as ph, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}

	function TraerDatosByConsultaTemperatura($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`temperatura`) / COUNT(`temperatura`)) as DECIMAL(8,2)) as terperatura, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}
	function TraerDatosByConsultaOxigeno($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`)) as DECIMAL(8,2)) as oxigeno, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}

	function TraerDatosByConsultaMiligramos($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`))/100*11.027 as DECIMAL(8,2)) as oxigeno, DAY(fecha) as dia
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio
		GROUP BY fecha 
		ORDER BY fecha;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}
	function TraerDatosTerperaturaFirst($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`temperatura`) / COUNT(`temperatura`)) as DECIMAL(8,2)) as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)='1'
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}

	function TraerDatosTerperaturaAnother($sensor, $anio, $mes, $dia){
	
		$sql = "SELECT CAST((SUM(`temperatura`) / COUNT(`temperatura`)) as DECIMAL(8,2)) as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)=$dia
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}

	function TraerDatosPhAguaFirst($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`ph`) / COUNT(`ph`)) as DECIMAL(8,2)) as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)='1'
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}

	function TraerDatosPhAguaAnother($sensor, $anio, $mes, $dia){
	
		$sql = "SELECT CAST((SUM(`ph`) / COUNT(`ph`)) as DECIMAL(8,2)) as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)=$dia
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}

	function TraerDatosSaturacionFirst($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`)) as DECIMAL(8,2)) as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)='1'
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
	}
	function TraerDatosSaturacionAnother($sensor, $anio, $mes, $dia){
	
		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`)) as DECIMAL(8,2)) as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)=$dia
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}
	function TraerDatosMiligramosFirst($sensor, $anio, $mes){
	
		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`)) as DECIMAL(8,2))/100*11.027 as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)='1'
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
	}

	function TraerDatosMiligramosAnother($sensor, $anio, $mes, $dia){
	
		$sql = "SELECT CAST((SUM(`oxigeno`) / COUNT(`oxigeno`)) as DECIMAL(8,2))/100*11.027 as Porcentaje, HOUR(hora) as hora_only
		FROM `historial`
		WHERE `id_sensor` = $sensor AND MONTH(fecha) = $mes AND YEAR(fecha)=$anio  AND DAY(fecha)=$dia
		GROUP BY hora_only
		ORDER BY hora_only;";
		$consulta =array();
		$consulta=$this->db->datos($sql);
		return $consulta;
		
	}
	


}


?>