<?php


session_start();

require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');


$identidad_estudiante=strtoupper ($_POST['txt_identidad']);
$nacimiento_estudiante=strtoupper ($_POST['txt_fecha_nacimiento']);
$telefono_estudiante=strtoupper ($_POST['txt_telefono_solicitud']);
$celular_estudiante=strtoupper ($_POST['txt_celular_solicitud']);
$direccion_estudiante=strtoupper ($_POST['txt_direccion_solicitud']);
$labora_empresa=strtoupper ($_POST['cb_trabaja']);
$tipo_empresa=strtoupper ($_POST['cb_tipo_empresa']);
$fecha_final_estimada=strtoupper ($_POST['txt_fecha_final_estimada']);
$fecha_inicio_estimada=strtoupper ($_POST['txt_fecha_inicio_estimada']);

$sql_guardar_solicitud_practica = "Call proc_guardar_solicitud_practica (".$_SESSION['id_usuario'].",".$_SESSION['id_persona'].",'".$telefono_estudiante."' ,'".$celular_estudiante."','".$direccion_estudiante."','".$nacimiento_estudiante."','".$tipo_empresa."','".$labora_empresa."','".$fecha_inicio_estimada."','".$fecha_final_estimada."'); ";
$resultado = $mysqli->query($sql_guardar_solicitud_practica);


       if($resultado === TRUE /*and $resultado_estudiante===TRUE*/)
                         {


                         	$Id_objeto=39; 
                          bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'INSERTO' , 'DATOSDEL ESTUDIANTE '.$identidad_estudiante.'');

                          /*header('location: ../contenidos/crearPregunta-view.php?msj=1');*/
                          echo '<script type="text/javascript">
                          swal({
                           title:"",
                           text:"Los datos  se almacenaron correctamente",
                           type: "success",
                           showConfirmButton: false,
                           timer: 3000
                           });
                           $(".FormularioAjax")[0].reset();
                           </script>'; 
                         } 
                         else 
                         {
                          echo '<script type="text/javascript">
                          swal({
                           title:"",
                           text:"Lo sentimos los datos no fueron guardados correctamente",
                           type: "error",
                           showConfirmButton: false,
                           timer: 3000
                           });
                           $(".FormularioAjax")[0].reset();
                           </script>'; 
                         }
                     


}

else
{
  /*echo '<script> alert("Lo sentimos tiene campos por rellenar ")</script>';*/
  echo '<script type="text/javascript">
  swal({
   title:"",
   text:"Lo sentimos tiene campos por rellenar",
   type: "error",
   showConfirmButton: false,
   timer: 3000
   });
   </script>';
 }


?>