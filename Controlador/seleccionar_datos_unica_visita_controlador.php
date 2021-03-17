<?php

//Unica visita visita conecta con la funcion jquery que se encuentra en la vista de la unica visita
if (isset($_GET['term'])){
	# conectare la base de datos
 include('./db_datos_controlador.php');
$db_handle = new DBController();

$return_arr = array();

$sqlc = "SELECT  *
            FROM tbl_personas_extendidas ext, tbl_empresas_practica ep, tbl_personas p
					    WHERE  valor like '%".$_GET['term']."%' LIMIT 5 
						   ";

$faq = $db_handle->runQuery($sqlc);

foreach($faq as $k=>$v) {
/* Recuperar y almacenar en conjunto los resultados de la consulta.*/		
	$row_array['value'] = $faq[$k]['valor'];
	$row_array['valor']=$faq[$k]['valor'];

	$row_array['cuenta_uv']=$faq[$k]['valor'];
	$row_array['empresa_uv']=$faq[$k]['nombre_empresa'];
	$row_array['jefe_uv']=$faq[$k]['jefe_inmediato'];
	$row_array['titulo_uv']=$faq[$k]['titulo_jefe_inmediato'];
	$row_array['correo_uv']=$faq[$k]['correo_jefe_inmediato'];
	$row_array['telefono_uv']=$faq[$k]['telefono_jefe_inmediato'];
	$row_array['estudiante_uv']=$faq[$k]['nombres'];


	
	array_push($return_arr,$row_array);
}
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}

?>