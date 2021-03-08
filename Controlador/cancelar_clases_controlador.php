<?php
	
    require_once ('../clases/Conexion.php');

    if(isset($_POST['txt_nombre']) && $_POST['txt_nombre']!=="" && $_POST['txt_cuenta']!==""
        && $_POST['txt_correo']!=="" && $_POST['txt_razon']!==""){
            $cuenta = $_POST['txt_cuenta'];
            $razon = $_POST['txt_razon'];
            $correo = $_POST['txt_correo'];
            $verificado = $_POST['txt_verificado'];

            $sql="select * from tbl_personas where documento = $cuenta";
            $resultado = $mysqli->query($sql);

            if($resultado->num_rows>=1){
                if($_FILES['txt_solicitud']['name']!=null && $_FILES['txt_constancia']['name']!=null && $_FILES['txt_identidad']['name']!=null
                && $_FILES['txt_forma']['name']!=null){

                    $documento_nombre[] = $_FILES['txt_solicitud']['name'];
                    $documento_nombre[] = $_FILES['txt_constancia']['name'];
                    $documento_nombre[] = $_FILES['txt_identidad']['name'];
                    $documento_nombre[] = $_FILES['txt_forma']['name'];

                    $documento_nombre_temporal[] = $_FILES['txt_solicitud']['tmp_name'];
                    $documento_nombre_temporal[] = $_FILES['txt_constancia']['tmp_name'];
                    $documento_nombre_temporal[] = $_FILES['txt_identidad']['tmp_name'];
                    $documento_nombre_temporal[] = $_FILES['txt_forma']['tmp_name'];

                    $micarpeta = '../archivos/cancelar_clases/'.$cuenta;
                    if (!file_exists($micarpeta)) {
                         mkdir($micarpeta, 0777, true);
                        }else{
                            $documento = glob('../archivos/cancelar_clases/'.$cuenta.'/*'); // obtiene los documentos
                            foreach($documento as $documento){ // itera los documentos
                            if(is_file($documento)) 
                            unlink($documento); // borra los documentos
                        }
                    }
                    for ($i = 0; $i <=count($documento_nombre_temporal)-1 ; $i++) {
                        
                        move_uploaded_file($documento_nombre_temporal[$i],"$micarpeta/$documento_nombre[$i]");
                        $ruta= "../archivos/cancelar_clases/$cuenta/".$documento_nombre[$i];
                        $direccion[]= $ruta;
                    }
                    $documento = json_encode($direccion);

                    if($verificado!==""){
                        $insertanombre ="call upd_nombre('$cuenta','$verificado')";
                        $resultadon = $mysqli->query($insertanombre);
                    }

                    $sqlp = "call ins_cancelar_clases('$cuenta','$razon','$documento','$correo')";
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

    }elseif(isset($_POST['aprobado']) && $_POST['aprobado']!==""){

        $cuenta= $_POST['txt_cuenta1'];
        $aprobado = $_POST['aprobado'];
        $observacion = $_POST['txt_observacion'];

        if($observacion!==""){
            $sqlu = "call upd_cancelar_clases_observacion('$aprobado','$observacion','$cuenta')";
            $resultadou = $mysqli->query($sqlu);
            if($resultadou == true){
                echo '<script type="text/javascript">
                        swal({
                            title:"",
                            text:"Solicitud enviada...",
                            type: "success",
                            allowOutsideClick:false,
                            showConfirmButton: true,
                            }).then(function () {
                            window.location.href = "revision_cancelar_clases.php";
                            });
                            $(".FormularioAjax")[0].reset();
                        </script>'; 
            }
            else {
                echo "Error: " . $sql ;
                }

        }else{
            $sqlu = "call upd_cancelar_clases('$aprobado','$cuenta')";
            $resultadou = $mysqli->query($sqlu);
            if($resultadou == true){
                echo '<script type="text/javascript">
                        swal({
                            title:"",
                            text:"Solicitud enviada...",
                            type: "success",
                            allowOutsideClick:false,
                            showConfirmButton: true,
                            }).then(function () {
                            window.location.href = "revision_cancelar_clases.php";
                            });
                            $(".FormularioAjax")[0].reset();
                        </script>'; 
            } 
            else {
                echo "Error: " . $sql ;
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