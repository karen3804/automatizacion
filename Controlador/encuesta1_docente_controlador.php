<?php
require_once('../clases/Conexion.php');

// $id_area = $_POST['id_area'];
//$id_persona = $_POST['id_persona'];



$data = json_decode($_POST['array']);
//$data1 = json_decode($_POST['array1']);

//var_dump($data);
var_dump($data);

 foreach ($data as $item) {
    $sql = "CALL proc_insertar_pref_area_docen(:id_area)";
    $stmt =  $connect->prepare($sql);
    $stmt->bindParam(":id_area", $item['id_area'], PDO::PARAM_INT);


    $stmt->execute();

    $idTask = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['id_pref_area_doce'];
    array_push($info, $idTask);
    // echo '<br>';
// echo $item;
}
// //var_dump($item);


 



