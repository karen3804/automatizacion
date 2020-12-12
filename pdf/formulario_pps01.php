<?php 

	 session_start();

require 'fpdf/fpdf.php';
require_once ('../clases/Conexion.php');

$sql = "select ep.nombre_empresa, ep.jefe_inmediato, ep.titulo_jefe_inmediato, ep.cargo_jefe_inmediato, ep.direccion_empresa, ep.correo_jefe_inmediato, ep.tipo_empresa, ep.labora_dentro, p.nombre, p.documento, p.identidad, p.telefono, p.direccion, p.celular,p.fecha_nacimiento,p.Correo_electronico ,pe.fecha_finaliza, pe.fecha_inicio from tbl_empresas_practica ep, tbl_personas p , tbl_practica_estudiantes pe where ep.id_persona=p.id_persona and pe.id_persona=p.id_persona and p.id_persona=$_SESSION[id_persona] ";

class PDF extends FPDF
	{
		function Header()
		{
			//date_default_timezone_get('America/Tegucigalpa');
		$this->Image('../dist/img/logo_ia.jpg', 12,8,30);
			$this->Image('../dist/img/logo-unah.jpg', 172,8, 22 );


		}
function Footer()
		{
			$fecha_actual=date("Y-m-d H:i:s");
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
		}	

}
//date_default_timezone_get('America/Tegucigalpa');

$resultado = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($resultado);

	

	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',15);
	$pdf->cell(0,6,utf8_decode('Universidad Nacional Autónoma de Honduras'),0,1,'C');
	$pdf->ln(2);
	$pdf->cell(0,6,utf8_decode('Facultad de Ciencias Economicas'),0,1,'C');
	$pdf->ln(2);
	$pdf->cell(0,6,utf8_decode('Departamento de Informática Administrativa'),0,1,'C');
	$pdf->ln();
	$pdf->SetFont('Arial','B',15);
	$pdf->cell(0,6,utf8_decode('Informacion del solicitante de práctica profesional'),0,1,'C');
	$pdf->ln(2);
	$pdf->SetFont('Arial','', 10);
	$pdf->ln(5);
    $pdf->Cell(0,5,utf8_decode('IA-PPS-01'),0,1,'C');
    $pdf->ln(10);
    
    $pdf->SetFont('Arial','BU',12);
	$pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('DATOS PERSONALES '),0);
	$pdf->SetX(20);
    $pdf->ln(2);

    $pdf->SetFont('Arial','',12);
	$pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Numero de cuenta: '.$row['documento'].''),0);
	$pdf->SetX(20);
    $pdf->ln(2);
	$pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Identidad: '.$row['identidad'].''),0);
	$pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Nombre del Alumno: '.$row['nombre'].''),0);
	$pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Fecha de nacimiento: '.$row['fecha_nacimiento'].' Tel. Fijo: '.$row['telefono'].'   Tel. Celular: '.$row['celular'].''),0);
	$pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Dirección: '.$row['direccion'].''),0);
	$pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Correo electrónico: '.$row['Correo_electronico'].''),0);
	$pdf->SetX(20);
    $pdf->ln(10);

    $pdf->SetFont('Arial','BU',12);
	$pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('DATOS PRACTICA PROFESIONAL '),0);
	$pdf->SetX(20);
    $pdf->ln(2);
    $pdf->SetFont('Arial','',12);
	$pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Nombre de la institución: '.$row['nombre_empresa'].''),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
    $pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Tipo de empresa: '.$row['tipo_empresa'].' '),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Dirección: '.$row['direccion_empresa'].''),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Trabaja en la empresa: '.$row['labora_dentro'].' '),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Nombre del jefe inmediato: '.$row['jefe_inmediato'].' '),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Nombre del puesto: '.$row['cargo_jefe_inmediato'].' '),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Titulo profesional: '.$row['titulo_jefe_inmediato'].' '),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Correo electronico: '.$row['correo_jefe_inmediato'].' '),0);
    $pdf->SetX(20);
    $pdf->ln(2);
    $pdf->ln(2);
	$pdf->SetX(20);
	$pdf->multicell(170,5,utf8_decode('Fecha estimanda  de inicio de práctica: '.$row['fecha_inicio'].'     Fecha estimanda fin de práctica: '.$row['fecha_finaliza'].' '),0);

   
    
    
	
	
	
    

    
	

	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','I',12);
	$pdf->SetX(20);
	$pdf->SetX(20);


	$pdf->ln(30);
	$pdf->SetFont('Arial','I',10);
	$pdf->SetX(20);
    $pdf->multicell(0,5,utf8_decode('Comité de Vinculación Universidad Sociedad'),0,1,'C');
	$pdf->SetX(20);
    $pdf->multicell(0,5,utf8_decode('Práctica Profesional Supervisada'),0,1,'C');
	$pdf->Output();
	





	$pdf->Output();

?>