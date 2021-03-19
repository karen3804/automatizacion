<?php
ob_start();
session_start();
require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');

require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');



$Id_objeto = 55;

$visualizacion = permiso_ver($Id_objeto);


if ($visualizacion == 0) {
    echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/menu_carga_academica_vista.php";

                            </script>';
} else {

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', ' A MANTENIMIENTO PERIODO');

    if (permisos::permiso_modificar($Id_objeto) == '1') {
        $_SESSION['btn_periodo_guardar_carga'] = "";
    } else {
        $_SESSION['btn_periodo_guardar_carga'] = "disabled";
    }
}

$sql2 = $mysqli->prepare("SELECT tbl_periodo.id_periodo AS id_periodo, tbl_periodo.num_periodo AS num_periodo, tbl_periodo.num_anno AS num_anno, tbl_periodo.fecha_adic_canc AS fecha_adic_canc, tbl_periodo.fecha_inicio as fecha_inicio, tbl_periodo.fecha_final as fecha_final, tbl_periodo.fecha_desbloqueo AS fecha_desbloqueo,
(SELECT tp.descripcion FROM tbl_tipo_periodo AS tp INNER JOIN tbl_periodo AS pdo ON tp.id_tipo_periodo=pdo.id_tipo_periodo
			WHERE tp.id_tipo_periodo= tbl_periodo.id_tipo_periodo LIMIT 1) AS tipo_periodo,
			(SELECT tp.horas_validas FROM tbl_tipo_periodo AS tp INNER JOIN tbl_periodo AS pdo ON tp.id_tipo_periodo=pdo.id_tipo_periodo
			WHERE tp.id_tipo_periodo= tbl_periodo.id_tipo_periodo LIMIT 1) AS horas_validas
FROM tbl_periodo
ORDER BY id_periodo DESC LIMIT 1;");
$sql2->execute();
$resultado2 = $sql2->get_result();
$row2 = $resultado2->fetch_array(MYSQLI_ASSOC);

ob_end_flush();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion de Periodo</title>
</head>

<body onload="blo_desblo_periodo();">
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Mantenimiento del Periodo</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/mantenimiento_crear_periodo_vista.php"> Mantenimiento Periodo</a></li>
                        </ol>
                    </div>


                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="RespuestaAjax"></div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid ">
                <!-- pantalla 1 -->

                <form action="../Controlador/actualizar_periodo_controlador.php" method="post" data-form="save" class="FormularioAjax" autocomplete="off">

                    <div class="card card-default ">
                        <div class="card-header center">
                            <h3 class="card-title">Modificar Periodo</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                            
                        </div>

                        <input hidden class="form-control" type="text" id="fecha_desbloqueo" name="fecha_desbloqueo" value="<?php echo $row2['fecha_desbloqueo'] ?>">

                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group " hidden>
                                        <label>id periodo</label>
                                        <input class="form-control" type="text" id="id_periodo" name="id_periodo" style="text-transform: uppercase" onkeypress="return Numeros(event)" value="<?php echo $row2['id_periodo'] ?>">
                                    </div>

                                    <div class="form-group ">
                                        <label>Periodo Academico</label>
                                        <input class="form-control" type="text" id="num_periodo" name="num_periodo" style="text-transform: uppercase" onkeypress="return Numeros(event)" value="<?php echo $row2['num_periodo'] ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Año Academico</label>
                                        <input class="form-control" type="text" id="num_anno" name="num_anno" style="text-transform: uppercase" onkeypress="return Numeros(event)" value="<?php echo $row2['num_anno'] ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Inicio del Periodo</label>
                                        <input class="form-control" type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $row2['fecha_inicio'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Finalizacion del Periodo</label>
                                        <input class="form-control" type="date" id="fecha_final" name="fecha_final" value="<?php echo $row2['fecha_final'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Adiciones y Cancelaciones</label>
                                        <input class="form-control" type="date" id="fecha_adic_canc" name="fecha_adic_canc" value="<?php echo $row2['fecha_adic_canc'] ?>">
                                    </div>

                                    <!-- <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tipo de Periodo:</label>
                                            <td><select class="form-control" onchange="mostrar_tipo_periodo($('#tipo_periodo').val());" id="tipo_periodo" class="" name="">
                                                    <option value="">Seleccionar</option>
                                                </select></td>

                                        </div>
                                    </div> -->


                                    <p class="text-center" style="margin-top: 20px;">
                                        <button type="submit" class="btn btn-primary" id="btn_guardar_periodo" name="btn_guardar_periodo" <?php echo $_SESSION['btn_guardar_periodo']; ?>><i class="zmdi zmdi-floppy"></i> Guardar</button>
                                    </p>

                                </div>
                            </div>
                        </div>



                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                    </div>



                    <div class="RespuestaAjax"></div>
                </form>

            </div>
        </section>


</body>

</html>

<script type="text/javascript" src="../js/ca2.js"></script>
<script type="text/javascript" src="../js/valida_text.js"></script>
<script type="text/javascript" src="../js/fechas_anteriores.js"></script>