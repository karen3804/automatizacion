<?php
require_once ('../clases/conexion_mantenimientos.php');

$instancia_conexion = new conexion();

class modelo_gestion_docente
{


  
//   public function eliminar($id_persona)
// 	{
//         global $instancia_conexion;
// 		$sql="DELETE proc_gestion_docente  WHERE id_persona='$id_persona' ";
// 		return $instancia_conexion->ejecutarConsulta($sql);
// 	}  

     function listar(){
     global $instancia_conexion;
		$sql="call proc_gestion_docente()";
    $arreglo = array();
    if ($consulta = $instancia_conexion->ejecutarConsulta($sql)) {
      while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
        $arreglo["data"][] = $consulta_VU;
      }
      return $arreglo;
    }


}
  function Actividades($id_persona)
  {
    global $instancia_conexion;
    $consulta = $instancia_conexion->ejecutarConsulta("SELECT ACTP.id_act_persona, COM.comision, ACT.actividad  FROM tbl_actividades ACT
                JOIN tbl_actividades_persona ACTP ON ACT.id_actividad= ACTP.id_actividad
                JOIN tbl_comisiones COM ON COM.id_comisiones = ACT.id_comisiones
                WHERE ACTP.id_persona = $id_persona
        ");
  
    $actividades = array();
    

    while ($row = $consulta->fetch_assoc()) {

      $actividades['actividades'][] = $row;
    }

    //echo '<pre>';print_r($actividades);echo'</pre>';
    return $actividades;
  }
  function EliminarTelefono($eliminar_actividad)
  {
    global $instancia_conexion;
    $consulta = $instancia_conexion->ejecutarConsulta("DELETE FROM tbl_actividades_persona WHERE id_act_persona='$eliminar_actividad';");

    return $consulta;
  }

}



?>
