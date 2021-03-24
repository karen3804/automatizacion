<?php
require_once "../Modelos/perfil_docente_modelo.php";
$id_empleado = isset($_POST["id_empleado"]) ? limpiarCadena1($_POST["id_empleado"]) : "";
$identidad = isset($_POST["identidad"]) ? limpiarCadena1($_POST["identidad"]) : "";
$nombre = isset($_POST["Nombre"]) ? limpiarCadena1($_POST["Nombre"]) : "";
$apellido = isset($_POST["apellido"]) ? limpiarCadena1($_POST["apellido"]) : "";
$correo = isset($_POST["correo"]) ? limpiarCadena1($_POST["correo"]) : "";
$grado = isset($_POST["grado"]) ? limpiarCadena1($_POST["grado"]) : "";
$especialidad = isset($_POST["especialidad"]) ? limpiarCadena1($_POST["especialidad"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena1($_POST["telefono"]) : "";
$eliminar_tel = isset($_POST["eliminar_tel"]) ? limpiarCadena1($_POST["eliminar_tel"]) : "";
$id_persona = isset($_POST["id_persona"]) ? limpiarCadena1($_POST["id_persona"]) : "";
$nacionalidad = isset($_POST["nacionalidad"]) ? limpiarCadena1($_POST["nacionalidad"]) : "";
$estado_civil = isset($_POST["estado_civil"]) ? limpiarCadena1($_POST["estado_civil"]) : "";
$valor = isset($_POST["valor"]) ? limpiarCadena1($_POST["valor"]) : "";

$id_persona_prueba = '10';


$instancia_modelo = new modelo_perfil_docentes();
if (isset($_GET['op'])) {

    switch ($_GET['op']) {
        case 'CargarDatos':
            $rspta = $instancia_modelo->mostrar($id_persona);
            //echo '<pre>';print_r($rspta);echo'</pre>';
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;

        case 'SelectGrado':
            $rspta = $instancia_modelo->mostrarSelect($id_empleado);
            //Codificar el resultado utilizando json
            echo json_encode($rspta);
            break;

        case 'select1':
            $data = array();
            $respuesta = $instancia_modelo->listar_select1();
            // echo '<pre>';print_r($respuesta);echo'</pre>';
            while ($r = $respuesta->fetch_object()) {


                # code...
                echo "<option value='" . $r->id_grado_academico . "'> " . $r->grado_academico . " </option>";
                // echo "<option value='1'> 1 </option>";
            }

            break;

        case 'EditarPerfil':

            $rspta = $instancia_modelo->Actualizar($nombre, $apellido, $identidad, $id_persona, $nacionalidad, $estado_civil);
            break;

        case 'AgregarEpecialidad':


            $rspta = $instancia_modelo->AgregarEspecialidad($grado, $especialidad, $id_persona);
            break;

        case 'MostrarEspecialidad':


            $rspta = $instancia_modelo->MostrarEspecialidad($id_persona);
            echo json_encode($rspta);
            break;

        case 'AgregarTelefono':


            $rspta = $instancia_modelo->AgregarTelefono($telefono, $id_persona);

            break;

        case 'EliminarTelefono':


            $rspta = $instancia_modelo->EliminarTelefono($eliminar_tel);

            break;

            case 'CambiarFoto':


                $ruta_carpeta="../Imagenes_Perfil_Docente/";
                $nombre_archivo = "imagen".date("dHis").".".pathinfo($_FILES["imagen"]["name"],PATHINFO_EXTENSION);
    
    
                $ruta_guardar_archivo = $ruta_carpeta.$nombre_archivo;
                //echo $ruta_guardar_archivo;
                move_uploaded_file($_FILES["imagen"]["tmp_name"],$ruta_guardar_archivo);
                $rspta=$instancia_modelo->CambiarFoto($ruta_guardar_archivo, $id_persona);
                echo json_encode($ruta_guardar_archivo);
    
    
                
            break;

        case 'Actividades':

            $rspta = $instancia_modelo->Actividades($id_persona);
            echo json_encode($rspta);

            break;

        case 'Curriculum':


            $rspta = $instancia_modelo->Curriculum($id_persona);
            echo json_encode($rspta);

            break;

        case 'Num_Empleado':


            $rspta = $instancia_modelo->Num_Empleado($id_persona);
            echo json_encode($rspta);

            break;

        case 'ExisteIdentidad':


            $rspta = $instancia_modelo->ExisteIdentidad($identidad);
            echo json_encode($rspta);

            break;

        case 'TipoContacto':


            $data = array();
            $respuesta = $instancia_modelo->TipoContacto();
            // echo '<pre>';print_r($respuesta);echo'</pre>';
            while ($r = $respuesta->fetch_object()) {


                # code...
                echo "<option value='" . $r->id_tipo_contacto . "'> " . $r->descripcion . " </option>";
                // echo "<option value='1'> 1 </option>";
            }

            break;




        default:
            # code...
            break;
    }


}
