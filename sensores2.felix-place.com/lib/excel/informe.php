<?php 
/**
 * 
 */

	include('../../db/db.php');
include('../../modelo/inicioM.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
$informe = new informe();
if(isset($_GET['excel']))
{
	$id = $_GET['id'];
	$desde = $_GET['desde'];
	$hasta = $_GET['hasta'];
	$informe->informe($id,$desde,$hasta);
}


class informe
{
	private $inicio;
	
	function __construct()
	{
		$this->inicio = new inicioM();
	}

	function download_file($archivo, $downloadfilename = null) 
	{

	    if (file_exists($archivo)) {
	        $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
			
	        header('Content-Description: File Transfer');
	        header('Content-Type: application/octet-stream');
	        header('Content-Disposition: attachment; filename=' . $downloadfilename);
	        header('Content-Transfer-Encoding: binary');
	        header('Expires: 0');
	        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	        header('Pragma: public');
	        header('Content-Length: ' . filesize($archivo));
			
	        ob_clean();
	        flush();
	        readfile($archivo);
			
	        exit;
	    }

	}

	function informe($id,$desde,$hasta)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		//$sheet->setCellValue('A1', 'Hello World !');

		// Set document properties
		$spreadsheet->getProperties()->setCreator('Maarten Balliauw')
		    ->setLastModifiedBy('Maarten Balliauw')
		    ->setTitle('Office 2007 XLSX Test Document')
		    ->setSubject('Office 2007 XLSX Test Document')
		    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
		    ->setKeywords('office 2007 openxml php')
		    ->setCategory('Test result file');

		$datos= $this->inicio->buscar_historial($id,$desde,$hasta);
		$spreadsheet->setActiveSheetIndex(0)
		    ->setCellValue('A1', 'Temperatura')
		    ->setCellValue('B1', 'Ph')
		    ->setCellValue('C1', 'Oxigeno')
		    ->setCellValue('D1', 'Fecha')
		    ->setCellValue('E1', 'hora');

		foreach ($datos as $key => $value) {
			$pos =$key+2;
			$spreadsheet->setActiveSheetIndex(0)
		    ->setCellValue('A'.$pos, $value['temperatura'])
		    ->setCellValue('B'.$pos, $value['ph'])
		    ->setCellValue('C'.$pos, $value['oxigeno'])
		    ->setCellValue('D'.$pos, $value['fecha'])
		    ->setCellValue('E'.$pos, $value['hora']);

		}
		$writer = new Xlsx($spreadsheet);
		$writer->save('historial del '.$desde.' al '.$hasta.'.xlsx');

		$this->download_file('historial del '.$desde.' al '.$hasta.'.xlsx','historial del '.$desde.' al '.$hasta.'.xlsx');
	}


}

?>