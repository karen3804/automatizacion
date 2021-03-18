<?php 
require_once "../Modelos/perfil_docente_modelo.php";
$id_empleado=isset($_POST["id_empleado"])? limpiarCadena($_POST["id_empleado"]):"";
$identidad=isset($_POST["identidad"])? limpiarCadena($_POST["identidad"]):"";
$nombre=isset($_POST["Nombre"])? limpiarCadena($_POST["Nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$grado=isset($_POST["grado"])? limpiarCadena($_POST["grado"]):"";
$especialidad=isset($_POST["especialidad"])? limpiarCadena($_POST["especialidad"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$eliminar_tel=isset($_POST["eliminar_tel"])? limpiarCadena($_POST["eliminar_tel"]):"";




$instancia_modelo = new modelo_perfil_docentes();
if(isset($_GET['op'])){

switch ($_GET['op']) {
    case 'CargarDatos':
            $rspta=$instancia_modelo->mostrar();
            //echo '<pre>';print_r($rspta);echo'</pre>';
            //Codificar el resultado utilizando json
            echo json_encode( $rspta);
        break;
    
        case 'SelectGrado':
            $rspta=$instancia_modelo->mostrarSelect($id_empleado);
       //Codificar el resultado utilizando json
       echo json_encode($rspta);
        break;

        case 'select1':
            $data=array();
            $respuesta=$instancia_modelo->listar_select1();
           // echo '<pre>';print_r($respuesta);echo'</pre>';
              while ($r=$respuesta->fetch_object()) {


                   # code...
                  echo "<option value='". $r->id_grado_academico."'> ".$r->grado_academico." </option>";
                  // echo "<option value='1'> 1 </option>";
               }

        break;

        case 'EditarPerfil':
    
            $rspta=$instancia_modelo->Actualizar($nombre,$apellido,$identidad,$correo);
        break;

        case 'AgregarEpecialidad':
           
       
            $rspta=$instancia_modelo->AgregarEspecialidad($grado,$especialidad);
        break;

        case 'MostrarEspecialidad':
           
           
             $rspta=$instancia_modelo->MostrarEspecialidad();
             echo json_encode($rspta);
         break;

         case 'AgregarTelefono':
           
           
            $rspta=$instancia_modelo->AgregarTelefono($telefono);
            
        break;
         
        case 'EliminarTelefono':
           
           
            $rspta=$instancia_modelo->EliminarTelefono($eliminar_tel);
            
        break;

        case 'CambiarFoto':
            $ruta_carpeta="../Imagenes_Perfil_Docente/";
            $nombre_archivo = "imagen".date("dHis").".".pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);


            $ruta_guardar_archivo = $ruta_carpeta.$nombre_archivo;
            //echo $ruta_guardar_archivo;
            if(move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_guardar_archivo)){
                $rspta=$instancia_modelo->CambiarFoto($ruta_guardar_archivo);
                echo json_encode($ruta_guardar_archivo);
            }else{
             echo "no se pudo cargar";
            }


            
        break;
        case 'Actividades':
           
           
            $rspta=$instancia_modelo->Actividades();
            echo json_encode($rspta);
            
        break;

        case 'Curriculum':
           
           
            $rspta=$instancia_modelo->Curriculum();
            echo json_encode($rspta);
            
        break;

        case 'Num_Empleado':
           
           
            $rspta=$instancia_modelo->Num_Empleado();
            echo json_encode($rspta);
            
        break;

        case 'ExisteIdentidad':
           
           
            $rspta=$instancia_modelo->ExisteIdentidad($identidad);
            echo json_encode($rspta);
            
        break;

        case 'TipoContacto':
           
           
            $data=array();
            $respuesta=$instancia_modelo->TipoContacto();
           // echo '<pre>';print_r($respuesta);echo'</pre>';
              while ($r=$respuesta->fetch_object()) {


                   # code...
                  echo "<option value='". $r->id_tipo_contacto."'> ".$r->descripcion." </option>";
                  // echo "<option value='1'> 1 </option>";
               }
            
        break;
        
        
        
      
    default:
        # code...
        break;
}
    
}
?>