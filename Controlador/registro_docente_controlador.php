<?php
require_once "../Modelos/registro_docente_modelo.php";

$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$identidad=isset($_POST["identidad"])? limpiarCadena($_POST["identidad"]):"";
$nacionalidad=isset($_POST["nacionalidad"])? limpiarCadena($_POST["nacionalidad"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
$nempleado=isset($_POST["nempleado"])? limpiarCadena($_POST["nempleado"]):"";
$fecha_ingreso=isset($_POST["fecha_ingreso"])? limpiarCadena($_POST["fecha_ingreso"]):"";
$idjornada=isset($_POST["idjornada"])? limpiarCadena($_POST["idjornada"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";




$hi=isset($_POST["hi"])? limpiarCadena($_POST["hi"]):"";
$hf=isset($_POST["hf"])? limpiarCadena($_POST["hf"]):"";




$instancia_modelo = new modelo_registro_docentes();




switch ($_GET["op"]){
    
 
  //case 'registrar_atributos':
    //$respuesta1=$instancia_modelo->traerdatos_idpersona($identidad1);
   // while ($res=$respuesta1->fetch_object()){
   //   $id_persona=$res->id_persona;
     
   // }
   // $insertar_nempleado=$instancia_modelo->registrar_atributo_nempleado($id_persona, $nempleado);
   // $insertar_fecha_ingreso=$instancia_modelo->registrar_atributo_fecha_ingreso($id_persona, $fecha_ingreso);
    //$insertar_curriculum=$instancia_modelo->registrar_atributo_curriculum($id_persona, $curriculum);
   // $insertar_foto=$instancia_modelo->registrar_atributo_foto($id_persona, $foto);
   

//break;




  case 'selectGRA':
    if (isset($_POST['activar'])) {
        $data=array();
        $respuesta=$instancia_modelo->listar_selectGRA();
       
          while ($r=$respuesta->fetch_object()) {
       
             
               # code...
               echo "<option value='". $r->id_grado_academico."'> ".$r->grado_academico." </option>";
               
           }
       
        
         }
         else{
           echo 'No hay informacion';
         }
       
break;




    case 'selectCAT':
        if (isset($_POST['activar'])) {
            $data=array();
            $respuesta=$instancia_modelo->listar_selectCAT();
           
              while ($r=$respuesta->fetch_object()) {
           
                 
                   # code...
                   echo "<option value='". $r->id_categoria."'> ".$r->categoria." </option>";
                   
               }
           
            
             }
             else{
               echo 'No hay informacion';
             }
           
    break;

    case 'selectJOR':
        if (isset($_POST['activar'])) {
            $data=array();
            $respuesta=$instancia_modelo->listar_selectJOR();
           
              while ($r=$respuesta->fetch_object()) {
           
                 
                   # code...
                   echo "<option value='". $r->id_jornada."'> ".$r->jornada." </option>";
                   
               }
           
            
             }
             else{
               echo 'No hay informacion';
             }
           
    break;
    case 'selectGEN':
        if (isset($_POST['activar'])) {
            $data=array();
            $respuesta=$instancia_modelo->listar_selectGEN();
           
              while ($r=$respuesta->fetch_object()) {
           
                 
                   # code...
                   echo "<option value='". $r->genero."'> ".$r->genero." </option>";
                   
               }
           
            
             }
             else{
               echo 'No hay informacion';
             }
           
    break;
      
  //   case 'listar_persona':
  //       if (isset($_POST['activar'])) {
  //           $data=array();
  //           $respuesta=$instancia_modelo->listar_persona();
           
  //             while ($r=$respuesta->fetch_object()) {
           
                 
  //                  # code...
  //                  echo "<option value='". $r->id_tipo_persona."'> ".$r->tipo_persona." </option>";
                   
  //              }
      
            
  //            }
  //            else{
  //              echo 'No hay informacion';
  //            }
           
  //   break;

  //   case 'listar_comision':
  //     if (isset($_POST['activar'])) {
  //         $data=array();
  //         $respuesta=$instancia_modelo->listar_comision();
         
  //           while ($r=$respuesta->fetch_object()) {
         
               
  //                # code...
  //                echo "<option value='". $r->id_comisiones."'> ".$r->comision." </option>";
                 
  //            }
    
          
  //          }
  //          else{
  //            echo 'No hay informacion';
  //          }
         
  // break;

    case 'selectEST':
      if (isset($_POST['activar'])) {
          $data=array();
          $respuesta=$instancia_modelo->listar_selectEST();
         
            while ($r=$respuesta->fetch_object()) {
         
               
                 # code...
                 echo "<option value='". $r->estado_civil."'> ".$r->estado_civil." </option>";
                 
             }
         
          
           }
           else{
             echo 'No hay informacion';
           }
         
  break;
  
  case 'selectNAC':
    if (isset($_POST['activar'])) {
        $data=array();
        $respuesta=$instancia_modelo->listar_selectNAC();
       
          while ($r=$respuesta->fetch_object()) {
       
             
               # code...
               echo "<option value='". $r->nacionalidad."'> ".$r->nacionalidad." </option>";
               
           }
       
        
         }
         else{
           echo 'No hay informacion';
         }
       
break;




case 'selectHEN':
  if (isset($_POST['activar'])) {
      $data=array();
      $respuesta=$instancia_modelo->listar_selectHOR();
     
        while ($r=$respuesta->fetch_object()) {
     
           
             # code...
             echo "<option value='". $r->hora."'> ".$r->hora." </option>";
             
         }
     
      
       }
       else{
         echo 'No hay informacion';
       }
     
break;

case 'selectHSAL':
  if (isset($_POST['activar'])) {
      $data=array();
      $respuesta=$instancia_modelo->listar_selectHOR();
     
        while ($r=$respuesta->fetch_object()) {
     
           
             # code...
             echo "<option value='". $r->hora."'> ".$r->hora." </option>";
             
         }
     
      
       }
       else{
         echo 'No hay informacion';
       }
     
break;

case 'ExisteIdentidad':
  $respuesta=$instancia_modelo->ExisteIdentidad($identidad);
  echo json_encode($respuesta);
  
break;

    case 'registar':
      $respuesta=$instancia_modelo->registar($nombre,$apellidos, $sexo, $identidad, $nacionalidad, $estado, $fecha_nacimiento, $hi, $hf, $nempleado, $fecha_ingreso, $idjornada, $idcategoria);
      
    break;


  //   case 'TipoContacto':
           
           
  //     $data=array();
  //     $respuesta=$instancia_modelo->TipoContacto();
  //    // echo '<pre>';print_r($respuesta);echo'</pre>';
  //       while ($r=$respuesta->fetch_object()) {


  //            # code...
  //           echo "<option value='". $r->id_tipo_contacto."'> ".$r->descripcion." </option>";
  //           // echo "<option value='1'> 1 </option>";
  //        }
      
  // break;

  case 'mayoria_edad':
    $rspta = $instancia_modelo->mayoria_edad();
    //Codificar el resultado utilizando json
    echo json_encode($rspta);
    break;
  }

  
  ?>