<?php

ob_start();

session_start();

require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');



$Id_objeto=54; 
$visualizacion= permiso_ver($Id_objeto);



if ($visualizacion==0)
 {
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
}

else

{
  
bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'Ingreso' , 'A Gestion de Roles');


if (permisos::permiso_modificar($Id_objeto)=='1')
 {
  $_SESSION['btn_modificar_roles']="";

}
else
{
    $_SESSION['btn_modificar_roles']="disabled";
 
}
}

ob_end_flush();


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



                <form action="" method="post" role="form" enctype="multipart/form-data" data-form="perfil"
                    autocomplete="off" class="FormularioAjax">

                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Datos Docente</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>


                        <!-- /.card-header -->

                        <div class="col-sm-12" style= "text-align: center">
                  <div class="col-sm-2" style="left: 520px;">
                        <div class="card-body">
                            <img src="" alt="" class="brand-image img-circle elevation-3" id="foto" height="175"
                                width="175">

                            <form action="" method="POST" role="form" enctype="multipart/form-data" id="frmimagen">
                                <div class="form-group">
                                    <!-- FOTOGRAFIA  -->

                                    <input hidden class="form-control" type="file" accept="image/*" maxlength="8388608"
                                        name="imagen" id="imagen" style="text-transform: uppercase" higth=>
                                </div>
                                <button type="button" id="btn_mostrar" class="btn btn-link btn_mostrar"
                                    onclick="MostrarBoton();"></i>Cambiar foto de Perfil</button>

                                <button hidden type="submit" id="btn_foto" class="btn btn-dark btn_foto"></i>Guardar
                                    foto de Perfil</button>

                            </form>

                        </div>
                        </div>



                            <p class="text-center" style="margin-top: 20px;">
                                <button type="button" class="btn btn-info" id="btn_editar" name="btn_editar"><i
                                        class="fas fa-user-edit"></i>Editar Información</button>
                            </p>

                            <p class="text-center" style="margin-top: 20px;">
                                <button hidden type="button" class="btn btn-info" id="btn_guardar_edicion"
                                    name="btn_guardar_edicion"
                                    onclick="EditarPerfil($('#Nombre').val(),$('#txt_apellido').val(),$('#identidad').val(),$('#correo').val());"><i
                                        class="fas fa-user-edit"></i>Guardar Información</button>
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
                                            <input disabled name="" type="text"
                                                onkeyup="Mayuscula('Nombre'); MismaLetra('Nombre'); DobleEspacio(this, event);"
                                                onkeypress="return sololetras(event)" class="form-control" id="Nombre"
                                                required>

                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="">Apellido(s):</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                            <input disabled name="" type="text"
                                                onkeyup="Mayuscula('txt_apellido');MismaLetra('txt_apellido'); DobleEspacio(this, event);"
                                                onkeypress="return sololetras(event);" class="form-control"
                                                id="txt_apellido" required>

                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="d-flex justify-content-around flex-row bd-highlight row">

                                <div class="col">
                                    <label for="">Nº Identidad:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input disabled name="" type="text"
                                                data-inputmask="'mask': '9999-9999-99999'" data-mask
                                                class="form-control" id="identidad" required
                                                onkeyup="ValidarIdentidad($('#identidad').val());"
                                                onblur="ExisteIdentidad();">

                                        </div>
                                    </div>
                                    <p hidden id="TextoIdentidad" style="color:red;">La Identidad Ya existe</p>
                                </div>


                                <div class="col">
                                    <label for="">Nacionalidad:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                            <input disabled name="" type="text" onkeyup="Mayuscula('nacionalidad');"
                                                class="form-control" id="nacionalidad">

                                        </div>
                                    </div>
                                </div>

                                <div hidden class="col">
                                    <label for="">Correo:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user icon"></i></span>
                                            <input disabled name="" type="email" onkeyup="Mayuscula('correo');"
                                                class="form-control" id="correo">

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

                            </div>

                            <div class="d-flex justify-content-around flex-row bd-highlight row">

                                <div class="col-20">
                                    <label for="email">Fecha de Nacimiento:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                            <input value="" type="date" name="Fecha" id="fecha" class="datepicker">
                                        </div>
                                    </div>
                                </div>



                                <div class="col-30">
                                    <label for="email">Genero:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>

                                            <select name="" disabled id="genero" class="form-control"
                                                style=" text-align-last: center;">

                                                <option value="1">Femenino</option>
                                                <option value="2">Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>






                                <div class="col-30">
                                    <label for="email">Estado Civil:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>

                                            <select name="" id="estado" class="form-control"
                                                style=" text-align-last: center;">
                                                <option value="1">CASADO</option>
                                                <option value="2">SOLTERO</option>


                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-around flex-row bd-highlight row">

                                <div class="col-20" style="">
                                    <label for="">Jornada:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user icon"></i></span>
                                            <input disabled name="" type="text" class="form-control" id="jornada">

                                        </div>
                                    </div>
                                </div>


                                <div class="col-30" style="">
                                    <label for="">Curriculum:</label>

                                    <div class="form-group">
                                        <div class="input-group-prepend">
                                            <a href="" target="_blank" id="curriculum">Curriculum</a>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-50" style="">

                                    <div class="form-group">

                                        <div class="input-group-prepend">
                                            <!-- CURRICULUM -->
                                            <p class="text-center" style="margin-top: 20px;">
                                                <button type="button" class="btn btn-info" id="btn_editar_curri"
                                                    name="btn_editar"><i class="fas fa-user-graduate"></i>Actualizar
                                                    Curriculum</button>
                                            </p>
                                            <input hidden class="form-control" type="file" accept=".doc, .docx, .pdf"
                                                maxlength="60" id="curriculum" name="curriculum" value=""
                                                style="text-transform: uppercase">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--final row-->


                            <div class="d-flex justify-content-around flex-row bd-highlight row">
                                <div class="card " style="width:420px;border-color:gray;">
                                    <div class="card-body">
                                        <h4 class="card-title">Contactos</h4>
                                        <div class="form-group card-text">
                                            <!-- TABLA CONTACTOS -->
                                            <button type="button" name="add" id="add" class="btn btn-primary card-title"
                                                data-toggle="modal" data-target="#ModalTel">Agregar Telefono</button>

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
                                                        <input required type="text" name="tel" id="tel"
                                                            class="form-control name_list"
                                                            data-inputmask="'mask': ' 9999-9999'" data-mask required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    onclick="addTel()">Agregar</button>
                                                <button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--CERRANDO MODAL TELEFONO-->



                                <div class="card " style="width:420px;border-color:gray;">
                                    <div class="card-body">
                                        <h4 class="card-title ">Formación Academica</h4>
                                        <button type="button" class="btn btn-primary card-title" data-toggle="modal"
                                            data-target="#myModal">Agregar Formación Academica <i
                                                class="fa fa-user-plus"></i></button>

                                        <ul class="card-text" id="ulFormacion">

                                        </ul>

                                        <!-- The Modal -->
                                        <div class="modal fade" id="myModal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Nueva Formación Academica</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <br>
                                                        <label for="">GRADO ACADEMICO:</label>

                                                        <div class="form-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-user-graduate"></i></span>
                                                                &nbsp; <select class="form-control"
                                                                    onchange="mostrar($('#id_select').val());"
                                                                    id="id_select" name="">

                                                                </select>


                                                            </div>
                                                        </div>

                                                        <label for="">ESPECIALIDAD:</label>
                                                        <div class="form-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-file-code"></i></span>
                                                                &nbsp;<select hidden id="select_especialidad"
                                                                    class="form-control" name="">
                                                                    <input id="especialidad" class="form-control"
                                                                        type="text"
                                                                        onkeyup="Mayuscula('especialidad');">
                                                                </select>


                                                            </div>
                                                        </div>

                                                        <br>

                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" id="guardarFormacion"
                                                            class="btn btn-primary">Guardar Formación Academica <i
                                                                class="fa fa-user-plus"></i></button>

                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
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
                                                        <th>Comisióm</th>
                                                        <th>Actividad</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbl_comisiones"></tbody>
                                            </table>
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




            </div>





            <!-- /.card-body -->
            <div class="card-footer">

            </div>



            <div class="RespuestaAjax"></div>
            </form>

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

</body>

</html>