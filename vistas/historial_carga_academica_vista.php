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

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'INGRESO', ' A GESTIONAR CARGA ACADEMICA');

    // if (permisos::permiso_modificar($Id_objeto) == '1') {
    //     $_SESSION['btn_gestionar_guardar_carga'] = "";
    // } else {
    //     $_SESSION['btn_gestionar_guardar_carga'] = "disabled";
    // }
}

$ahora = date("Y-m-d");
$sql2 = $mysqli->prepare("SELECT * FROM tbl_periodo ORDER BY id_periodo DESC LIMIT 1");
$sql2->execute();
$resultado2 = $sql2->get_result();
$row2 = $resultado2->fetch_array(MYSQLI_ASSOC);

ob_end_flush();

?>



<!DOCTYPE html>
<html>

<head>


    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->

</head>

<body>
    <div class="content-wrapper">


        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">


                        <h1>Historial de Carga Académica</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/menu_carga_academica_vista.php">Menu Carga Académica</a></li>
                            <li class="breadcrumb-item">Historial de Carga Académica</li>

                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!--Pantalla 2-->


        <div class="card card-default">
            <div class="card-header">

                <!--COMBOBOX-->

                <div class="row">

                    <input type="text" id="id_periodo_actual" hidden name="id_periodo_actual" value="<?php echo $row2['id_periodo'] ?>" readonly>

                    <div class="col-md-3" style="width:75px">
                        <div class="input-group mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-weight: bold;">Periodo</span>
                            </div>
                            <input class="form-control" type="text" id="txt_periodo" name="txt_periodo" value="<?php echo $row2['num_periodo'] ?>" readonly>
                        </div>

                    </div>

                    <div class="col-md-3" style="width:75px">
                        <div class="input-group mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-weight: bold;">Año Académico</span>
                            </div>
                            <input class="form-control" type="text" id="txt_anno" name="txt_anno" value="<?php echo $row2['num_anno'] ?>" readonly>
                        </div>

                    </div>
                    <div class="col-md-3" style="width:75px">
                        <div class="input-group mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-weight: bold;">Inicia</span>
                            </div>
                            <input class="form-control" type="text" id="inicio_periodo" name="inicio_periodo" value="<?php echo $row2['fecha_inicio'] ?>" readonly>
                        </div>

                    </div>
                    <div class="col-md-3" style="width:75px">
                        <div class="input-group mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-weight: bold;">finaliza</span>
                            </div>
                            <input class="form-control" type="text" id="final_periodo" name="final_periodo" value="<?php echo $row2['fecha_final'] ?>" readonly>
                        </div>

                    </div>

                </div>

            </div>

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-sm-6">


                            <h2>Copiar Carga Académica - Datos</h2>
                        </div>


                        <div class="RespuestaAjax"></div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- /.card-header -->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3" style="width:75px">


                        <div class="input-group mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-weight: bold;">Ingrese Periodo</span>
                            </div>
                            <input type="text" class="form-control" id="txt_num_periodo" name="txt_num_periodo" maxlength="1" onkeypress="return Numeros(event)" onkeyup="Espacio(this, event)">
                        </div>
                    </div>

                    <div class="col-md-3" style="width:75px">

                        <div class="input-group mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="font-weight: bold;">Ingrese Año</span>
                            </div>
                            <input type="text" class="form-control" id="txt_anno1" name="txt_anno1" maxlength="4" onkeypress="return Numeros(event)" onkeyup="Espacio(this, event)">
                        </div>
                    </div>
                    <input type="text" class="form-control" id="txt_id_periodo_busca" name="txt_id_periodo_busca" readonly hidden>

                    <input type="text" class="form-control" id="txt_count" name="txt_count" readonly hidden>
                    <div class="px-1">

                        <button class="btn btn-success " onclick="cargartablaabajo();"><i class="fas fa-search"></i> <a style="font-weight: bold;">Buscar</a></button>

                    </div>
                    <div class="px-1">
                        <button class="btn btn-danger " id="btn_copiar_carga" onclick="copiar_carga();"><i class="fas fa-copy"></i> <a style="font-weight: bold;">Comenzar carga desde</a></button>
                    </div>

                </div>

            </div>
        </div>

        <!-- tabla de ver carga -->
        <div class="card card-default">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="container-fluid" style="width:100%">
                <div class="box-body">

                    <div class="row">

                        <div class="col-md-2">
                            <button class="btn btn-primary " id="limpiar" onclick="limpiar()"><i class="fas fa-sync-alt"></i> <a style="font-weight: bold;">limpiar tabla</a></button>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="width: 98%;">

                            <table id="ver_carga" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th>ID</th>
                                        <th>Empleado</th>
                                        <th>Nombre</th>
                                        <th>contról</th>
                                        <th>Código</th>
                                        <th>Asignatura</th>
                                        <th>sección</th>
                                        <th>Inicio</th>
                                        <th>Final</th>
                                        <th>Aula</th>
                                        <th>Edificio</th>
                                        <th>Alumnos</th>
                                        <th>Dia</th>

                                    </tr>
                                </thead>
                                <tbody id="tabla_carga_historial_ver">

                                </tbody>

                            </table>
                        </div>



                        </table>


                    </div>


                </div>

            </div>
        </div>

    </div>
</body>

</html>



<!-- para datatable -->
<script>
    $(document).ready(function() {
        TablaHistorial();

    });
</script>



<script src="../js/historial.js"></script>

<script>
    var idioma_espanol = {
        select: {
            rows: "%d fila seleccionada"
        },
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "No se encuentra el periodo o año",
        "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
        "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "<b>No se encontraron datos</b>",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
</script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js">