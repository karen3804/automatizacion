<?php
if (isset($_GET['term'])){
	# conectare la base de datos
 include('db_datos_controlador.php');
$db_handle = new DBController();

$return_arr = array();

$sqlc = "SELECT  id_persona, nombres FROM tbl_personas WHERE  nombres like '%".$_GET['term']."%' LIMIT 5";

$faq = $db_handle->runQuery($sqlc);

foreach($faq as $k=>$v) {
/* Recuperar y almacenar en conjunto los resultados de la consulta.*/		
	$row_array['value'] = $faq[$k]['nombres'];
	$row_array['nombres']=$faq[$k]['nombres'];
	
	$row_array['txt_id']=$faq[$k]['id_persona'];
	$row_array['txt_nombre']=$faq[$k]['nombres'];


	
	array_push($return_arr,$row_array);
}
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>