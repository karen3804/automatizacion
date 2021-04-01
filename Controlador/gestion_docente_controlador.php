<?php
require_once "../Modelos/gestion_docente_modelo.php";

$id_persona = $_POST['id_persona'];
$eliminar_actividad = isset($_POST["eliminar_actividad"]) ? limpiarCadena1($_POST["eliminar_actividad"]) : "";
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
    

 }


?>
