<?php
    
require_once ('../clases/Conexion.php');

    if(isset($_POST['txt_nombre']) && $_POST['txt_nombre']!==""  && $_POST['txt_cuenta']!=="" && $_POST['txt_correo']!=="" 
        && isset($_POST['txt_codigo']) && $_POST['txt_codigo']!==""){
        
        $cuenta= $_POST['txt_cuenta'];
        $correo = $_POST['txt_correo'];
        $verificado = $_POST['txt_verificado'];

        $sql="select * from tbl_personas where documento = $cuenta";
        $resultado = $mysqli->query($sql);

        if($resultado->num_rows>=1){
            if($_FILES['txt_solicitud']['name']!=null && $_FILES['txt_historial']['name']!=null){
                $documento_nombre[] = $_FILES['txt_solicitud']['name'];
                $documento_nombre[] = $_FILES['txt_historial']['name'];

                $documento_nombre_temporal[] = $_FILES['txt_solicitud']['tmp_name'];
                $documento_nombre_temporal[] = $_FILES['txt_historial']['tmp_name'];
                
                
                $micarpeta = '../archivos/equivalencias/codigo/'.$cuenta;
                if (!file_exists($micarpeta)) {
                     mkdir($micarpeta, 0777, true);
                    }else{
                        $documento = glob('../archivos/equivalencias/codigo/'.$cuenta.'/*'); // obtiene los documentos
                        foreach($documento as $documento){ // itera los documentos
                        if(is_file($documento)) 
                        unlink($documento); // borra los documentos
                        } 
                    }
                for ($i = 0; $i <=count($documento_nombre_temporal)-1 ; $i++) {
                    
                    move_uploaded_file($documento_nombre_temporal[$i],"$micarpeta/$documento_nombre[$i]");
                    $ruta= '../archivos/equivalencias/codigo/'.$cuenta."/".$documento_nombre[$i];
                    $direccion[]= $ruta;
                }
                $documento = json_encode($direccion);

                if($verificado!==""){
                    $insertanombre ="call upd_nombre('$cuenta','$verificado')";
                    $resultadon = $mysqli->query($insertanombre);
                }

                $sqlp = "call ins_equivalencias('$cuenta','$documento','CODIGO','$correo')";
                $resultadop = $mysqli->query($sqlp);
                if($resultadop == true){
                    echo '<script type="text/javascript">
                            swal({
                                title:"",
                                text:"Solicitud enviada...",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1500
                                });
                                $(".FormularioAjax")[0].reset();
                            </script>'; 
                        } 
                    else {
                        echo "Error: " . $sql ;
                        }
            }else{
                echo '<script type="text/javascript">
                        swal({
                        title:"",
                        text:"Faltan documentos por subir....",
                        type: "error",
                        showConfirmButton: false,
                        timer: 1500
                        });
                        $(".FormularioAjax")[0];
                    </script>';
            }
        }else{
            echo '<script type="text/javascript">
                        swal({
                                title:"",
                                text:"El numero de cuenta es incorrecto....",
                                type: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $(".FormularioAjax")[0];
                      </script>';
        }

    }elseif(isset($_POST['txt_contenido']) && $_POST['txt_contenido']!=="" && $_POST['txt_nombre']!=="" 
     && $_POST['txt_cuenta']!=="" && $_POST['txt_correo']!==""){
        $cuenta=$_POST['txt_cuenta'];
        $verificado = $_POST['txt_verificado'];
        $correo = $_POST['txt_correo'];

        $sql="select * from tbl_personas where documento = $cuenta";
        $resultado = $mysqli->query($sql);

        if($resultado->num_rows>=1){

            if($_FILES['txt_solicitud']['name']!=null && $_FILES['txt_historial']['name']!=null){
                $documento_nombre[] = $_FILES['txt_solicitud']['name'];
                $documento_nombre[] = $_FILES['txt_historial']['name'];
    
                $documento_nombre_temporal[] = $_FILES['txt_solicitud']['tmp_name'];
                $documento_nombre_temporal[] = $_FILES['txt_historial']['tmp_name'];
                
                $micarpeta = '../archivos/equivalencias/contenido/'.$cuenta;
                if (!file_exists($micarpeta)) {
                     mkdir($micarpeta, 0777, true);
                    }else{
                        $documento = glob('../archivos/equivalencias/contenido/'.$cuenta.'/*'); // obtiene los documentos
                        foreach($documento as $documento){ // itera los documentos
                        if(is_file($documento)) 
                        unlink($documento); // borra los documentos
                        }
                    }
                for ($i = 0; $i <=count($documento_nombre_temporal)-1 ; $i++) {
                    
                    move_uploaded_file($documento_nombre_temporal[$i],"$micarpeta/$documento_nombre[$i]");
                    $ruta= '../archivos/equivalencias/contenido/'.$cuenta."/".$documento_nombre[$i];
                    $direccion[]= $ruta;
                }
                $documento = json_encode($direccion);

                if($verificado!==""){
                    $insertanombre ="call upd_nombre('$cuenta','$verificado')";
                    $resultadon = $mysqli->query($insertanombre);
                }
    
                $sqlp = "call ins_equivalencias('$cuenta','$documento','CONTENIDO','$correo')";
                $resultadop = $mysqli->query($sqlp);
                if($resultadop == true){
                    echo '<script type="text/javascript">
                            swal({
                                title:"",
                                text:"Solicitud enviada...",
                                type: "success",
                                showConfirmButton: false,
                                timer: 1500
                                });
                                $(".FormularioAjax")[0].reset();
                            </script>'; 
                        } 
                    else {
                        echo "Error: " . $sql ;
                        }
            }else{
                echo '<script type="text/javascript">
                            swal({
                            title:"",
                            text:"Faltan documentos por subir....",
                            type: "error",
                            showConfirmButton: false,
                            timer: 1500
                            });
                            $(".FormularioAjax")[0];
                        </script>';
            }

        }else{
                echo '<script type="text/javascript">
                        swal({
                                title:"",
                                text:"El numero de cuenta es incorrecto....",
                                type: "error",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $(".FormularioAjax")[0];
                      </script>'; 
            }

    }else if(isset($_POST['aprobado']) && $_POST['aprobado']!==""){
        $aprobado = $_POST['aprobado'];
        $cuenta = $_POST['txt_cuenta1'];
        $observacion = $_POST['txt_observacion'];
        $tipo = $_POST['txt_tipo'];

        $sql=$mysqli->prepare("select * from tbl_personas where documento= ?");
        $sql->bind_param("i",$cuenta);
        $sql->execute();
        $resultado = $sql->get_result();
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
        $id = $row['id_persona'];

        if($observacion!==""){
           
            $sqlp = "UPDATE `tbl_equivalencias` 
            SET `aprobado` = '$aprobado', `fecha_creacion` = now(),
            observacion = '$observacion'
            WHERE id_persona = '$id'
            AND tipo = '$tipo'";
            $resultadop = $mysqli->query($sqlp);
            if($resultadop >= 1){
                echo '<script type="text/javascript">
                        swal({
                            title:"",
                            text:"Solicitud enviada...",
                            type: "success",
                            allowOutsideClick:false,
                            showConfirmButton: true,
                            }).then(function () {
                            window.location.href = "menu_revison_equivalencias.php";
                            });
                            $(".FormularioAjax")[0].reset();
                        </script>'; 
                 } 
            else {
                echo "Error: " . $sqlp ;
                }

        }else{
            
            $sqlp = "UPDATE `tbl_equivalencias` 
                    SET `aprobado` = '$aprobado', `fecha_creacion` = now()
                    WHERE id_persona = '$id'
                    AND tipo = '$tipo'";
            $resultadop = $mysqli->query($sqlp);
            if($resultadop >= 1){
                echo '<script type="text/javascript">
                        swal({
                            title:"",
                            text:"Solicitud enviada...",
                            type: "success",
                            allowOutsideClick:false,
                            showConfirmButton: true,
                            }).then(function () {
                            window.location.href = "menu_revison_equivalencias.php";
                            });
                            $(".FormularioAjax")[0].reset();
                        </script>'; 
                 } 
            else {
                echo "Error: " . $sqlp ;
                }
        }

    }
    else{
        echo '<script type="text/javascript">
                swal({
                        title:"",
                        text:"Faltan campos por llenar....",
                        type: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $(".FormularioAjax")[0];
              </script>'; 
    }

?>

