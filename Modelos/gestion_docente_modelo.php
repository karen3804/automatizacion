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

     public function listar(){
        global $instancia_conexion;
		$sql="call proc_gestion_docente()";
		return $instancia_conexion->ejecutarConsulta($sql);
    }


}



?>
