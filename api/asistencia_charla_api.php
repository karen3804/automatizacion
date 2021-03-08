<?php

header("Content-Type:application/json");

require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/Conexion.php');

        $result = [];
//Verificacion de control de asistencia


if (isset($_GET["control"])) {


if ($R = $mysqli->query("select p.id_persona, cp.Id_charla, p.nombre  , p.documento from tbl_personas p, tbl_charla_practica cp where p.id_persona=cp.id_persona and jornada='$_GET[control]'")) {
            $items = [];

            while ($row = $R->fetch_assoc()) {

                array_push($items, $row);
            }
            $R->close();
            $result["ROWS"] = $items;
        }
        echo json_encode($result);
        
}
///Actualizacion
elseif (isset($_GET["asistencia"])) 
{
	$asistencia=$_POST["asistencia"];
	$fecharecibida=$_POST["txt_fecha_impartida"];
	$jornada=$_GET["asistencia"];
	$estado="";
	if (isset($fecharecibida) and isset($jornada) )
	 {

		if (empty($fecharecibida))
		 {

     header("location:../vistas/gestion_asistencia_charla_vista.php?msj=1"); 

	/*echo '<script> alert("  '.$identificador.'  ")</script>';*/

	}	
			

		
	else
	{
		if (empty($asistencia))
		{
		  header("location:../vistas/gestion_asistencia_charla_vista.php?msj=4"); 

		}
			foreach ($asistencia as $key => $idcharla) 
					{

 	if ($asistencia>=1) {
			$estado=1;
			 	}
			else
			{
				$estado=0;

			} 

										
			$sql = "call proc_actualizar_asistencia_charla($idcharla,'$jornada' ,'$estado','$fecharecibida')" ;

			$resultado = $mysqli->query($sql);

			if($resultado === TRUE)
			 {
		 bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'ACTUALIZO' , 'LA ASISTENCIA CHARLA.');
     header("location:../vistas/gestion_asistencia_charla_vista.php?msj=2"); 

			}	
			else
			{
				     header("location:../vistas/gestion_asistencia_charla_vista.php?msj=3"); 

			}

						}	
	}


		}
}
else
{
	if ($R = $mysqli->query("select p.id_persona, cp.Id_charla, p.nombre  , p.documento from tbl_personas p, tbl_charla_practica cp where p.id_persona=cp.id_persona and jornada='0' ")) {
            $items = [];

            while ($row = $R->fetch_assoc()) {

                array_push($items, $row);
            }
            $R->close();
            $result["ROWS"] = $items;
        }
        echo json_encode($result);
}

//*********************************Actualizar Gestion
/*
elseif (isset($_GET["id_egresadoa"]) )
     {
session_start();

$id_egresado_modificacion=$_GET["id_egresadoa"];
$nombre_egresado=strtoupper ($_POST['txt_nombre_egresado']);
$tel_fijo_personal=strtoupper ($_POST['txt_telefono_fijo']);
$celular_personal=strtoupper ($_POST['txt_telefono_celular']);
$correo_personal=strtoupper ($_POST['txt_correo_personal']);
$posee_maestria=strtoupper ($_POST['cb_maestria']);
$posee_certificado=strtoupper ($_POST['cb_certificado']);
$labora=strtoupper ($_POST['cb_labora']);
$nombre_empresa=strtoupper ($_POST['txt_nombre_empresa']);
$departamento=strtoupper ($_POST['txt_departamento']);
$direccion_empresa=strtoupper ($_POST['txt_direccion_empresa']);
$telefono_empresa=strtoupper ($_POST['txt_telefono_empresa']);
$correo_profesional=strtoupper ($_POST['txt_correo_profesional']);
$certificadov=strtoupper($_POST['txtcertificado']);
$maestriav=strtoupper($_POST['txtmaestria']);
//Validacion de los combobox
if (($posee_maestria=="SI" and ($maestriav=="N/A" or empty($maestriav))) or ($posee_certificado=="SI" and ($certificadov=="N/A" or empty($certificadov))) or ($labora=="SI" and ($nombre_empresa=="N/A" or empty($nombre_empresa) or ($departamento=="N/A" or empty($departamento)) )  )) {
              header("location:../vistas/gestion_egresados_vista.php?msj=3");
          }
          else
          {
    
            $Id_objeto=23 ; 


    $sql = "call proc_actulizar_egresado('$tel_fijo_personal','$celular_personal','$correo_personal','$posee_maestria','$maestriav','$posee_certificado','$certificadov','$labora','$nombre_empresa','$departamento','$direccion_empresa','$telefono_empresa','$correo_profesional','$nombre_egresado','$id_egresado_modificacion') ";

  $resultado = $mysqli->query($sql);


                if ($resultado==true) {
                              bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'MODIFICO' , 'LOS DATOS DEL EGRESADO '.$nombre_egresado.'');

                         header("location:../vistas/gestion_egresados_vista.php?msj=1"); 


                }
                else
                {
                           header("location:../vistas/gestion_egresados_vista.php?msj=2"); 

                }

            }


}*/

  //************************Carga la tabla en gestion
   

    

                          
           

        
?>