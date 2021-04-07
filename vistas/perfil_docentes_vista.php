<?php

ob_start();

session_start();

require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');



$Id_objeto = 54;
$visualizacion = permiso_ver($Id_objeto);
$usuario = $_SESSION['id_persona'];


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

    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A Gestion de Roles');


    // if (permisos::permiso_modificar($Id_objeto) == '1') {
    //     $_SESSION['btn_modificar_roles'] = "";
    // } else {
    //     $_SESSION['btn_modificar_roles'] = "disabled";
    // }
}

ob_end_flush();




/* para las areas */
$sql1 = "SELECT * FROM tbl_areas";
$consulta1 = $mysqli->query($sql1);
$row1 = $consulta1->fetch_all(MYSQLI_ASSOC);
//var_dump($row1);

/* para las asignaturas */
$sql = "SELECT * FROM tbl_asignaturas";
$consulta = $mysqli->query($sql);
$row = $consulta->fetch_all(MYSQLI_ASSOC);
//var_dump($row);


$sql2 = "SELECT id_pref_area_doce,
(SELECT a.area FROM tbl_areas AS a WHERE a.id_area = tbl_pref_area_docen.id_area LIMIT 8) area_docente
FROM tbl_pref_area_docen
WHERE id_persona = '$usuario'";
$consulta2 = $mysqli->query($sql2);
$row2 = $consulta2->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title></title>
</head>

<body>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Perfil Docente</h1>
                    </div>



                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Seguridad</li>
                        </ol>
                    </div>

                    <div class="RespuestaAjax"></div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- pantalla 1 -->



                <form action="" method="post" role="form" enctype="multipart/form-data" data-form="perfil" autocomplete="off" class="FormularioAjax">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Datos Docente</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>


                        <!-- /.card-header -->

                        <div class="col-sm-12" style="text-align: center">
                            <div class="col-sm-2" style="left: 520px;">
                                <div class="card-body">
                                    <img src="" alt="" class="brand-image img-circle elevation-3" id="foto" height="175" width="175">

                                    <form action="" method="POST" role="form" enctype="multipart/form-data" id="frmimagen">
                                        <div class="form-group">
                                            <!-- FOTOGRAFIA  -->

                                            <input hidden type="file" accept=".png, .jpg, .JPG, .jpeg" maxlength="8388608" name="imagen" id="imagen" style="text-transform: uppercase">
                                        </div>
                                        <button type="button" id="btn_mostrar" class="btn btn-info" onclick="MostrarBoton();"></i>Cambiar foto de Perfil</button>

                                        <button hidden type="submit" id="btn_foto" class="btn btn-dark btn_foto"></i>Guardar
                                            foto de Perfil</button>
                                        <input class="form-control" hidden value="<?php echo $usuario ?>" type="text" name="id_persona" id="id_persona">

                                    </form>

                                </div>
                            </div>



                            <p class="text-center" style="margin-top: 20px;">
                                <button type="button" class="btn btn-info" onclick="habilitar_editar();" id="editar_info" name="editar_info"><i class="fas fa-user-edit"></i>Editar Información</button>

                                <button hidden type="button" class="btn btn-info" onclick="desabilitar();" id="btn_editar" name="btn_editar"><i class="fas fa-user-edit"></i>Editar Información</button>


                            </p>

                            <p class="text-center" style="margin-top: 20px;">
                                <button hidden type="button" class="btn btn-info" id="btn_guardar_edicion" name="btn_guardar_edicion" onclick="EditarPerfil($('#Nombre').val(),$('#txt_apellido').val(),$('#identidad').val(),$('#estado_civil_text').val()); ver_estado_civil();"><i class="fas fa-user-edit"></i>Guardar Información</button>
                            </p>
                            <div class="d-flex justify-content-around flex-row bd-highlight row">

                                <div class="col">
                                    <label for="">Nº Empleado:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user icon"></i></span>
                                            <input disabled name="" type="text" class="form-control" id="empleado">

                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="">Nombre:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                            <input disabled name="" type="text" onkeyup="Mayuscula('Nombre'); MismaLetra('Nombre'); DobleEspacio(this, event);" onkeypress="return sololetras(event)" class="form-control" id="Nombre" required>

                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="">Apellido(s):</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                            <input disabled name="" type="text" onkeyup="Mayuscula('txt_apellido');MismaLetra('txt_apellido'); DobleEspacio(this, event);" onkeypress="return sololetras(event);" class="form-control" id="txt_apellido" required>

                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">Jornada:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user icon"></i></span>
                                            <input disabled name="" type="text" class="form-control" id="jornada">

                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="email">Genero:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>

                                            <input value="" type="text" disabled name="ver_genero" id="ver_genero" class="form-control">

                                            <select hidden class="form-control" onchange="mostrar_genero($('#genero').val());" id="genero" name="">
                                            </select>
                                        </div>
                                    </div>
                                </div>




                            </div>
                            <input type="text" name="mayoria_edad" id="mayoria_edad" hidden readonly onload="mayoria_edad()">
                            <div class="d-flex justify-content-around flex-row bd-highlight row">


                                <div class="col">
                                    <label for="">Nº Identidad:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input disabled name="" type="text" data-inputmask="'mask': '9999-9999-99999'" data-mask class="form-control" id="identidad" required onkeyup="ValidarIdentidad($('#identidad').val());" onblur="ExisteIdentidad();">

                                        </div>
                                    </div>
                                    <p hidden id="TextoIdentidad" style="color:red;">La Identidad Ya existe</p>
                                    <p hidden id="Textomayor" style="color:red;">¡Es menor de edad! </p>

                                </div>


                                <div class="col">
                                    <label for="">Nacionalidad:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                            <input disabled name="" type="text" onkeyup="Mayuscula('nacionalidad');" class="form-control" id="nacionalidad">

                                        </div>
                                    </div>
                                </div>


                                <div class="col">
                                    <label for="">Categoria:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user icon"></i></span>
                                            <input disabled name="" type="text" class="form-control" id="categoria">

                                        </div>
                                    </div>
                                </div>
                                <input class="form-control" readonly hidden id="age" name="age" maxlength="25" value="" required style="text-transform: uppercase">
                                <div class="col">
                                    <label for="">Fecha Nacimiento:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            <input disabled="true" value="" type="date" name="Fecha" id="fecha" class="form-control" onblur="valida_mayoria()" onkeydown="return false">
                                        </div>

                                    </div>
                                    <p hidden id="Textofecha" style="color:red;">¡El docente debe ser mayor de edad! </p>

                                </div>

                                <div class="col">
                                    <label for="">Estado Civil:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user icon"></i></span>

                                            <input value="" type="text" disabled name="ver_estado" id="ver_estado" class="form-control">

                                            <select hidden class="form-control" onchange="mostrar_estado_civil($('#estado_civil').val());" id="estado_civil" name="">
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-around flex-row bd-highlight row">



                                <div class="col-md-20">

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-info " id="" name=""> <a href="" target="_blank" id="curriculum" style="color:white;font-weight: bold;">Curriculum</a></button>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-20">
                                    <div class="form-group">
                                        <div class="input-group-prepend">

                                            <form action="" method="POST" role="form" enctype="multipart/form-data" id="frmimagen">
                                                <button type="button" id="btn_mostrar_curriculum" class="btn btn-info" onclick="MostrarBotonCurriculum();"></i>Actualizar Curriculum</button>

                                                <input hidden class="btn btn-info" type="file" accept=".doc, .docx, .pdf" maxlength="60" id="c_vitae" name="c_vitae" value="" style="text-transform: uppercase">

                                                <button hidden type="submit" id="btn_curriculum" class="btn btn-dark btn_curriculum"></i>Guardar Curriculum</button>
                                                <input class="form-control" hidden value="<?php echo $usuario ?>" type="text" name="id_persona" id="id_persona">
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="d-flex justify-content-around flex-row bd-highlight row">
                            <div class="card " style="width:420px;border-color:gray;">
                                <div class="card-body">
                                    <h4 class="card-title">Contactos</h4>
                                    <div class="form-group card-text">
                                        <!-- TABLA CONTACTOS -->
                                        <button type="button" name="add" id="add" class="btn btn-primary card-title" data-toggle="modal" data-target="#ModalTel">Agregar Telefono</button>

                                        <table class="table table-bordered table-striped m-0">
                                            <thead>
                                                <tr>

                                                    <th>Telefono</th>
                                                    <th>Eliminar</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbData2"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card " style="width:420px;border-color:gray;">
                                <div class="card-body">
                                    <h4 class="card-title">Correo</h4>
                                    <div class="form-group card-text">
                                        <!-- TABLA CORREO -->
                                        <button type="button" name="add_correo" id="add_correo" class="btn btn-primary card-title" data-toggle="modal" data-target="#ModalCorreo">Agregar Correo</button>

                                        <table class="table table-bordered table-striped m-0">
                                            <thead>
                                                <tr>

                                                    <th>Correo</th>
                                                    <th>Eliminar</th>

                                                </tr>
                                            </thead>
                                            <tbody id="tbDataCorreo1"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!---card-->


                            <!--Modal para telefono-->
                            <div class="modal fade" tabindex="-1" role="dialog" id="ModalTel">
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
                                                    <label for="">Teléfono</label>
                                                    <input required type="text" name="tel" id="tel" class="form-control name_list" data-inputmask="'mask': ' 9999-9999'" data-mask required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" onclick="addTel()">Agregar</button>
                                            <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--CERRANDO MODAL TELEFONO-->

                            <!--Modal para correo-->
                            <div class="modal fade" tabindex="-1" role="dialog" id="ModalCorreo">
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
                                                    <label for="">Correo</label>
                                                    <input required type="email" name="correo" id="correo" class="form-control name_list">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" onclick="addCorreo()">Agregar</button>
                                            <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="card " style="width:420px;border-color:gray;">
                                <div class="card-body">
                                    <h4 class="card-title ">Formación Academica</h4>
                                    <button type="button" class="btn btn-primary card-title" data-toggle="modal" data-target="#myModal">Agregar Formación Academica <i class="fa fa-user-plus"></i></button>

                                    <ul class="card-text" id="ulFormacion">

                                    </ul>

                                    <!-- The Modal -->
                                    <div class="modal fade" id="myModal">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Nueva Formación Academica</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <br>
                                                    <label for="">GRADO ACADEMICO:</label>

                                                    <div class="form-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                                                            &nbsp; <select class="form-control" onchange="mostrar($('#id_select').val());" id="id_select" name="">

                                                            </select>


                                                        </div>
                                                    </div>

                                                    <label for="">ESPECIALIDAD:</label>
                                                    <div class="form-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-file-code"></i></span>
                                                            &nbsp;<select hidden id="select_especialidad" class="form-control" name="">
                                                                <input id="especialidad" class="form-control" type="text" onkeyup="Mayuscula('especialidad');">
                                                            </select>


                                                        </div>
                                                    </div>

                                                    <br>

                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" id="guardarFormacion" class="btn btn-primary">Guardar Formación Academica <i class="fa fa-user-plus"></i></button>

                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>

                                            </div>
                                        </div>
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


                            </div><!-- Comisiones-->

                            <div class="card " style="width:600px;border-color:gray;">
                                <!--comisiones-->
                                <div class="card-body">
                                    <h4 class="card-title">Encuesta Docente</h4>
                                    <div class="card-text">
                                        <button type="button" id="btn_modal1" class="btn btn-info " onclick="pregunta1();">Pregunta 1</button>
                                        <button type="button" id="btn_modal2" class="btn btn-info " onclick="pregunta2();">Pregunta 2</button>
                                        <button type="button" id="btn_modal3" class="btn btn-info " onclick="pregunta3();">Pregunta 3</button>
                                    </div>
                                </div>


                            </div><!-- Comisiones-->




                            <!--CONTACTOS-->
                            <!-- <div class="card " style="width:420px;border-color:gray;">
                                    <div class="card-body">
                                        <h4 class="card-title">Contactos</h4>
                                        <div class="form-group card-text"> -->
                            <!-- TABLA CONTACTOS -->
                            <!-- <button type="button" name="add" id="add" class="btn btn-primary card-title"
                                                data-toggle="modal" data-target="#ModalTelefonos">Agregar
                                                Telefono</button>

                                            <table class="table table-bordered table-striped m-0">
                                                <thead>
                                                    <tr>

                                                        <th>Telefono</th>
                                                        <th>Eliminar</th> 

                                                    </tr>
                                                </thead>
                                                <tbody id="tbData2"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> -->
                            <!---card-->


                            <!-- Modal para telefono
                                <div class="modal fade" tabindex="-1" role="dialog" id="ModalTelefonos">
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
                                                        <label for="">Tipo de Contacto</label>
                                                        <select class="form-control"
                                                            onchange="" id="tipo_contacto"
                                                            name="">

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <div class="form-group">
                                                        <label for="" id="lbl_tipo">Contacto</label>
                                                        <input hidden  type="text" name="tel" id="txt_contacto_tel"
                                                            class="form-control name_list"
                                                      data-inputmask="'mask': ' 9999-9999'" data-mask required
                                                            >

                                                            <input required type="text" name="tel" id="txt_contacto"
                                                            class="form-control name_list"
                                                     required
                                                            >
                                                    </div>
                                                </div>
                                            </div>
  
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    onclick="">Agregar</button>
                                                <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                            <!--CERRANDO MODAL TELEFONO-->

                        </div>



                    </div>




            </div>
            </form>




    </div>





    <!-- /.card-body -->
    <div class="card-footer">

    </div>



    <div class="RespuestaAjax"></div>
    </section>

    </div>
    </section>


    </div>

    <script type="text/javascript" src="../js/perfil_docentes.js"></script>
    <script type="text/javascript" src="../js/validar_registrar_docentes.js"></script>
    <script>
        /*
function mascara(){
  let inputs = document.getElementsByTagName("input");
  let cont=0;

  for (let index = 0; index < inputs.length; index++) {
      if($(inputs[index]).attr('type')=="tel"){
      cont++;
      valor = $(inputs[index]).attr('id');
      

        $("#"+valor+"").keypress(function(e) {

        if ((e.which!=127) ) {

        var longitud= inputs[index].value;
        console.log("length "+longitud.length);
        if(longitud.length==4 ){

        inputs[index].value=inputs[index].value+'-';
        } 
        }


        });//function
      }//if
  }//for
}//function

*/
    </script>

    <!-- modal encuesta -->
    <div class="modal fade" id="modalencuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalencuesta">Pregunta 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <!--  <div class="card " style="width:420px;border-color:gray;"> -->

                    <div style="text-align:left">


                        <h5 style="font-weight: bold; font-size: 15px"> 1. ¿En que áreas de la Carrera imparte clases?</h5>
                        <div class="form-check">
                            <?php

                            if ($row1 = $row2) {
                                // echo '<input type="checkbox"  name="" value="' . $id["id_pref_area_doce"] . '">' . $id["area_docente"];

                                foreach ($row2 as $id) {
                                    echo '<br>';
                                    echo '<input class="pregunta1" type="checkbox" checked = "checked" name="areas[]" value="' . $id["id_pref_area_doce"] . '">' . $id["area_docente"];
                                }
                            } else {
                                foreach ($row1 as $id) {
                                    echo '<br>';
                                    echo '<input  class="pregunta1" type="checkbox" name="areas[]" value="' . $id["id_area"] . '">' . $id["area"];
                                }
                            };

                            ?>
                        </div>


                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" value="pregunta1" class="btn btn-primary" onclick="enviarpregunta1()">Guardar</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalencuesta2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalencuesta">Pregunta 2</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div style="text-align:left">
                        <h5 style="font-weight: bold; font-size: 15px">2. ¿Seleccione una o dos áreas de la informática en la que tiene mayor experiencia y se siente más cómodo en la docencia?</h5>
                        <div class="form-check">
                            <?php
                            foreach ($row1 as $id) {
                                echo '<br>';
                                echo '<input class="pregunta2" type="checkbox" name="areas2[]" value="' . $id["id_area"] . '">' . $id["area"];
                            }

                            ?>

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="enviarpregunta2();">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalencuesta3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalencuesta">Pregunta 3</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!--  <div class="card " style="width:420px;border-color:gray;"> -->

                    <div style="text-align:left">

                        <h5 style="font-weight: bold; font-size: 15px">3. Basado en la respuesta de la pregunta anterior ¿Selecciones la(s) Asignatura(s)
                            en la que tiene mayor experiencia?</h5>
                        <div class="form-check">
                            <?php
                            foreach ($row as $id) {
                                echo '<br>';
                                echo '<input  required class="pregunta3" type="checkbox" name="asignatura3[]" value="' . $id["Id_asignatura"] . '">' . $id["asignatura"];
                            }

                            ?>
                        </div>
                        <br><br>

                        <h5 style="font-weight: bold; font-size: 15px"> 4. ¿Selecciones la(s) Asignatura(s) en la que desea de impartir? </h5>
                        <div class="form-check">

                            <?php
                            foreach ($row as $id) {
                                echo '<br>';
                                echo '<input required class="pregunta4" type="checkbox" name="asignatura4[]" value="' . $id["Id_asignatura"] . '">' . $id["asignatura"];
                            }

                            ?>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="enviarpregunta3();">Guardar</button>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>
<!-- para seleccionar limite de checkbox -->
<script>
    var limite = 2;
    $(".pregunta2").change(function() {
        if ($("input:checked").length > limite) {
            alert("solo puedes seleccionar un maximo de dos");
            this.checked = false;
        }
    });
</script>