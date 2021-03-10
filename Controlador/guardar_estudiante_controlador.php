<?php
require_once "../Modelos/estudiantes_modelo.php";

$modelo=new estudiantes();

$cuenta=isset($_POST["cuenta_estudiante"])? limpiarCadena($_POST["cuenta_estudiante"]):"";
$nombre=isset($_POST["nombre_persona"])? limpiarCadena($_POST["nombre_persona"]):"";
$apellido=isset($_POST["apellido_persona"])? limpiarCadena($_POST["apellido_persona"]):"";
$identidad=isset($_POST["identidad_persona"])? limpiarCadena($_POST["identidad_persona"]):"";
$nacionalidad=isset($_POST["nacionalidad_persona"])? limpiarCadena($_POST["nacionalidad_persona"]):"";
$fecha=isset($_POST["fecha_persona"])? limpiarCadena($_POST["fecha_persona"]):"";
$estado=isset($_POST["estado_civil_persona"])? limpiarCadena($_POST["estado_civil_persona"]):"";
$genero=isset($_POST["genero_persona"])? limpiarCadena($_POST["genero_persona"]):"";
$telefono=isset($_POST["telefono_persona"])? limpiarCadena($_POST["telefono_persona"]):"";
$direccion=isset($_POST["direccion_persona"])? limpiarCadena($_POST["direccion_persona"]):"";
$correo=isset($_POST["correo_persona"])? limpiarCadena($_POST["correo_persona"]):"";

switch ($_GET["op"]){
	case 'guardar':
		
            $rspta=$modelo->insertar($cuenta,$nombre,$apellido,$identidad,$nacionalidad,$fecha,$estado
                                   ,$genero,$telefono,$direccion,$correo);
			echo $rspta ? "Estudiante registrada con exito" : "No se puedo llevar a cabo el registro del estudiante";
		
	break;

}


?>
