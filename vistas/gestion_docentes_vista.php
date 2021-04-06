<?php

ob_start();

session_start();


require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');
require_once('../clases/conexion_mantenimientos.php');






$Id_objeto = 51;
$visualizacion = permiso_ver($Id_objeto);



if ($visualizacion == 0) {
    // header('location:  ../vistas/menu_roles_vista.php');
    echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/menu_roles_vista.php";

                            </script>';
} else {


    // $respuesta1=$instancia_modelo->listar_select1();
    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A gestion docentes');




    if (permisos::permiso_modificar($Id_objeto) == '1') {
        $_SESSION['btn_modificar_CA'] = "";
    } else {
        $_SESSION['btn_modificar_CA'] = "disabled";
    }
}

ob_end_flush();



//$nomdocentes = "SELECT id_persona, nombres FROM tbl_personas WHERE id_tipo_persona=1";
//$resultado1 = $mysqli->query($nomdocentes);

?>


<!DOCTYPE html>

<head>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
</head>


<body>

    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">


                        <h1>Gestión Docente</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="../vistas/menu_docentes_vista.php">Menu Docentes</a></li>

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

                <div class="px-1">

                    <a href="../vistas/registro_docentes_vista.php" class="btn btn-warning"><i class="fas fa-arrow"></i>Registrar Nuevo Usuario</a>

                </div>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-footer">



                <div class="card-body">
                    <div class="table-responsive" style="width: 100%;">

                        <table id="tabladocentes" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID PERSONA</th>
                                    <th>N EMPLEADO</th>
                                    <th>NOMBRE</th>
                                    <th>CORREOS</th>
                                    <th>CONTACTOS</th>
                                    <th>COMISIÓN</th>
                                    <th>ACTIVIDAD</th>
                                    <th>FORMACIÓN ACADÉMICA</th>
                                    <th>FOTO</th>
                                    <th>CURRICULUM</th>
                                    <th>ESTADO</th>
                                    <th>ACCIÓN</th>
                                    


                                </tr>
                            </thead>


                        </table>
                        <br>




                    </div>


                </div>

                <!-- modal modificar carga -->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modal_editar" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Datos de Carga</h5>
                                <button onclick="limpiar()" class="close" data-dismiss="modal">
                                    &times;
                                </button>

                            </div>


                            <div class="modal-body">

                                <div class="row">
                                    <input type="hidden">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" id="txt_id_persona" readonly>

                                            <label> Docente: </label>
                                            <input class="form-control" type="text" id="txt_nombre_docente" name="txt_nombre_docente" readonly>


                                        </div>
                                        <div class="col-sm-6">

                                            <p class="" style="margin-top: 10px;">
                                                <button type="submit" class="btn btn-primary btn" data-toggle="modal" data-target="#ModalTask2" id="agregarotra" name="agregarotra" onclick="persona()">
                                                    <i class="zmdi zmdi-floppy"></i>AGREGAR +</button>
                                            </p>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input class="form-control" hidden type="text" id="txt_hidden" name="txt_hidden" value="" readonly>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="card " style="width:600px;border-color:gray;">
                                        <!--comisiones-->
                                        <div class="card-body">
                                            <h4 class="card-title">Comisiones y Actividades</h4>
                                            <div class="card-text">
                                                <table class="table table-bordered table-striped m-0">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Comisión</th>
                                                            <th>Actividad</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbl_comisiones"></tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>




                                    <!--  <div class="col-md-6">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="hidden">
                                                <label> Comisión: </label>
                                                <td> <select class="form-control-lg select2" style="width: 100%;" id="cbm_comision_edita " name="cbm_comision_edita"> </td>
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden">
                                                <label> Actividad: </label>
                                                <td> <select class="form-control-lg select2" style="width: 100%;" id="cbm_actividad_edita" name="cbm_actividad_edita"> </td>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="hidden">

                                            </div>
                                        </div>


                                    </div> -->



                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" id="guardar" name="guardar" onclick="modificar_carga_academica();">Guardar</button>

                                    <button class="btn btn-secondary" data-dismiss="modal" onclick="limpiar();" id="salir">Cancelar</button>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>

                <div class="modal fade" tabindex="-1" role="dialog" id="ModalTask2">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Datos</h5>
                                <button class="close" data-dismiss="modal">
                                    &times;
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="container">
                                    <div class="form-group">
                                        <input type="text" id="txt_id_persona1" readonly>


                                        <label>Comisiones</label>
                                        <select class="form-control" name="comisiones" id="comisiones">

                                        </select>

                                        <label>Actividades</label>
                                        <select class="form-control" name="actividades" id="actividades">

                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" onclick="addTask3(); saveAll3();">Agregar</button>
                                <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>



        <a class="btn btn-success " onclick=" ventana1()">Generar PDF</a>
    </div>
    </div>










</body>
<html>

<script language="javascript">
    function ventana1() {
        window.open("../Controlador/gestion_docente_controlador2.php", "GESTION");
    }
</script>

<script>
    $(document).ready(function() {
        TablaDocente();

    });
</script>

<script type="text/javascript" src="../js/funciones_gestion_docente.js"></script>
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