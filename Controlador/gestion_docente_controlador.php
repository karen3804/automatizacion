<?php
require_once "../Modelos/gestion_docente_modelo.php";

$id_persona=isset($_POST["id_persona"])? limpiarCadena($_POST["id_persona"]):"";
// $foto=isset($_FILES["foto"]["name"])? limpiarCadena($_FILES["foto"]["name"]):"";
// $path_foto=isset($_FILES["foto"]["tmp_name"])?$_FILES["foto"]["tmp_name"]:"";
// $ruta_p="../dis/img/".$foto;
// $ruta_guardar="../".$ruta_p;

// if (!empty($path_foto)) {
//   move_uploaded_file($path_foto,$ruta_guardar);
//   # code...
// }

$instancia_modelo=new modelo_gestion_docente();

switch ($_GET["op"])
{
   
  // case 'editar':
    
  //     $rspta=$instancia_modelo->editar($nombre_empleado,$identidad,$telefono,$id_jornada,$usuario,$contra,$correo,$tipo_usuario,$ruta_p);
  //     echo $rspta ? "Asignatura actualizada con exito" : "Asignatura no se pudo actualizar";
  // break;

  // case 'eliminar':
  //   $rspta=$instancia_modelo->eliminar($id_persona);
  //    echo $rspta ? "docente eliminado con exito" : "docente no se puede eliminar";
  //    break;

     case 'listar':
      $rspta=$instancia_modelo->listar();
       //Vamos a declarar un array
       $data= Array();
       
       while ($reg=$rspta->fetch_object()){
        $botones=" ";
        

        $botones= '<div class="input-group mr-2" ><form action= "registro_docentes_vista.php" method="post"><input name="id_persona" hidden value="'.$reg->id_persona.'"><button class="btn btn-primary btn-raised btn-xs" name="id_persona" value="'.$reg->id_persona.'"> <i class="fa fa-edit"></i> </button></form>&nbsp&nbsp&nbsp&nbsp<button class="btn btn-danger btn-raised btn-xs" name="id_persona" value="'.$reg->id_persona.' " onclick ="('.$reg->id_persona.')"> <i class="fa fa-window-close"></i> </button> </div>';

         $data[]=array(
         "0"=>$botones,
          "1"=>$reg->numero_empleado,
          "2"=>$reg->nombre,
          "3"=>$reg->correos,
          "4"=>$reg->contactos,
          "5"=>$reg->comision,
          "6"=>$reg->actividad,
          "7"=>$reg->formacion_academica,
          "8"=>$reg->foto,
          "9"=>$reg->curriculum,


  
           );
       } 
       
       $results = array(
         "sEcho"=>1, //Información para el datatables
         "iTotalRecords"=>count($data), //enviamos el total registros al datatable
         "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
         "aaData"=>$data);
       echo json_encode($results);
       
  
    break;
    

 }


?>
