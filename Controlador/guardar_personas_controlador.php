<?php
require_once "../Modelos/personas_modelo.php";

$modelo=new personas();


$nombre=isset($_POST["nombre_persona"])? ($_POST["nombre_persona"]):"";
$apellido=isset($_POST["apellido_persona"])? ($_POST["apellido_persona"]):"";
$identidad=isset($_POST["identidad_persona"])? ($_POST["identidad_persona"]):"";
$nacionalidad=isset($_POST["nacionalidad_persona"])? ($_POST["nacionalidad_persona"]):"";
$fecha=isset($_POST["fecha_persona"])? ($_POST["fecha_persona"]):"";
$estado=isset($_POST["estado_civil_persona"])? ($_POST["estado_civil_persona"]):"";
$genero=isset($_POST["genero_persona"])? ($_POST["genero_persona"]):"";
$telefono=isset($_POST["telefono_persona"])? ($_POST["telefono_persona"]):"";
$direccion=isset($_POST["direccion_persona"])? ($_POST["direccion_persona"]):"";
$correo=isset($_POST["correo_persona"])? ($_POST["correo_persona"]):"";
$tipo=isset($_POST["tipo_persona"])? ($_POST["tipo_persona"]):"";


switch ($_GET["op"]){
	case 'guardar':
		
            $rspta=$modelo->insertar($nombre,$apellido,$identidad,$nacionalidad,$fecha,$estado
                                   ,$genero,$telefono,$direccion,$correo,$tipo);
			echo $rspta ? "Persona registrada con exito" : "No se puedo llevar a cabo el registro de la persona";
		
	break;

	case 'listar':
		$rspta=$instancia_modelo->listar();
		 //Vamos a declarar un array
		 $data= Array();
		 
		 while ($reg=$rspta->fetch_object()){
		  
  
  
		   $data[]=array(
			"0"=>$reg->id_persona,
			"1"=>$reg->nombres,
			"2"=>$reg->apellidos,
			"3"=>$reg->sexo,
			"4"=>$reg->identidad,
			"5"=>$reg->nacionalidad,
			"6"=>$reg->estado_civil,
			"7"=>$reg->fecha_nacimiento

			 );
		 } 
		 
		 $results = array(
		   "sEcho"=>1, //Información para el datatables
		   "iTotalRecords"=>count($data), //enviamos el total registros al datatable
		   "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		   "aaData"=>$data);
		 echo json_encode($results);
		 
	
	  break;

	
}


?>




