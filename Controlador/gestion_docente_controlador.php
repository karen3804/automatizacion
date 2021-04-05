<?php
require_once "../Modelos/gestion_docente_modelo.php";

$id_persona = $_POST['id_persona'];
$eliminar_actividad = isset($_POST["eliminar_actividad"]) ? limpiarCadena1($_POST["eliminar_actividad"]) : "";
$id_persona_ = isset($_POST["id_persona_"]) ? limpiarCadena1($_POST["id_persona_"]) : "";
$Estado = isset($_POST["Estado"]) ? limpiarCadena1($_POST["Estado"]) : "";
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


    $rspta = $instancia_modelo->actualizarestado($id_persona_, $estado);

  break;
    

 }


?>
