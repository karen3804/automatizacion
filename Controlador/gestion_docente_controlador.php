<?php
require_once "../Modelos/gestion_docente_modelo.php";

$id_persona = isset($_POST["id_persona"]) ? limpiarCadena1($_POST["id_persona"]) : "";
$eliminar_actividad = isset($_POST["eliminar_actividad"]) ? limpiarCadena1($_POST["eliminar_actividad"]) : "";
$id_persona_ = isset($_POST["id_persona_"]) ? limpiarCadena1($_POST["id_persona_"]) : "";
$Estado = isset($_POST["Estado"]) ? limpiarCadena1($_POST["Estado"]) : "";
$id_persona1 = isset($_POST["id_persona1"]) ? limpiarCadena1($_POST["id_persona1"]) : "";
$id_actividad = isset($_POST["id_actividad"]) ? limpiarCadena1($_POST["id_actividad"]) : "";

$instancia_modelo=new modelo_gestion_docente();

switch ($_GET["op"])
{
   
  
  case 'Actividades':

    $rspta = $instancia_modelo->Actividades($id_persona);
    echo json_encode($rspta);

    break;
  case 'eliminar_actividad':


    $rspta = $instancia_modelo->EliminarTelefono($eliminar_actividad);

  break;
  case 'estado':


    $rspta = $instancia_modelo->actualizarestado( $Estado, $id_persona_);

  break;
  case 'existe_actividad':
    $rspta = $instancia_modelo->existe_actividad($id_persona1, $id_actividad);
    //Codificar el resultado utilizando json
    echo json_encode($rspta);
    break;
  case 'insertar_actividades':

    $rspta = $instancia_modelo->insertar_actividades($id_actividad, $id_persona1);
    echo json_encode($rspta);

    break;

 }


?>
