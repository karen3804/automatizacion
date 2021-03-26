<?php
require_once "../Modelos/gestion_docente_modelo.php";

$id_persona = $_POST['id_persona'];
$instancia_modelo=new modelo_gestion_docente();

switch ($_GET["op"])
{
   
  
  case 'Actividades':

    $rspta = $instancia_modelo->Actividades($id_persona);
    echo json_encode($rspta);

    break;
    

 }


?>
