<?php

$servidor= "localhost";
$usuario= "informat_admin";
$password = "HLo{Q3e{)II^";
$base= "informat_automatizacion";

$mysqli = new mysqli($servidor, $usuario,$password,$base);
$conexion = mysqli_connect($servidor, $usuario,$password,$base) or die("Error " . mysqli_error($conexion));

class conexion{
    function ejecutarConsulta($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);
		return $query;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		$row = $query->fetch_assoc();
		return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		global $conexion;
		$query = $conexion->query($sql);		
		return $conexion->insert_id;			
	}

	

 }
 function limpiarCadena($str)
	{
		global $conexion;
		$str = mysqli_real_escape_string($conexion,trim($str));
		return htmlspecialchars($str);
	}
 ?>