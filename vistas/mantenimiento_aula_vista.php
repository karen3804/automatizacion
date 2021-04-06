<?php
ob_start();

session_start();

require_once('../vistas/pagina_inicio_vista.php');
require_once('../clases/Conexion.php');
require_once('../clases/funcion_bitacora.php');
require_once('../clases/funcion_visualizar.php');
require_once('../clases/funcion_permisos.php');

//Lineas de msj al cargar pagina de acuerdo a actualizar o eliminar datos
if (isset($_REQUEST['msj'])) {
  $msj = $_REQUEST['msj'];

  if ($msj == 1) {
    echo '<script type="text/javascript">
    swal({
        title: "",
        text: "Lo sentimos el aula ya existe",
        type: "info",
        showConfirmButton: false,
        timer: 3000
    });
</script>';
  }

  if ($msj == 2) {


    echo '<script type="text/javascript">
    swal({
        title: "",
        text: "Los datos  se almacenaron correctamente",
        type: "success",
        showConfirmButton: false,
        timer: 3000
    });
</script>';



    $sqltabla = "select id_aula, codigo, descripcion, capacidad, id_edificio, id_tipo_aula FROM tbl_aula";
    $resultadotabla = $mysqli->query($sqltabla);
  }
  if ($msj == 3) {


    echo '<script type="text/javascript">
    swal({
        title: "",
        text: "Error al actualizar lo sentimos,intente de nuevo.",
        type: "error",
        showConfirmButton: false,
        timer: 3000
    });
</script>';
  }
}


$Id_objeto = 60;
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

  bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'], 'Ingreso', 'A Mantenimiento Aulas');


  if (permisos::permiso_modificar($Id_objeto) == '1') {
    $_SESSION['btn_modificar_aula'] = "";
  } else {
    $_SESSION['btn_modificar_aula'] = "disabled";
  }


  /* Manda a llamar todos las datos de la tabla para llenar el gridview  */
  $sqltabla = "select id_aula, codigo, descripcion, capacidad, id_edificio, id_tipo_aula FROM tbl_aula";
  $resultadotabla = $mysqli->query($sqltabla);



  /* Esta condicion sirve para  verificar el valor que se esta enviando al momento de dar click en el icono modicar */
  if (isset($_GET['codigo'])) {
    $sqltabla = "select id_aula, codigo, descripcion, capacidad, id_edifico, id_tipo_aula FROM tbl_aula";
    $resultadotabla = $mysqli->query($sqltabla);

    /* Esta variable recibe el estado de modificar */
    $codigo = $_GET['codigo'];

    /* Iniciar la variable de sesion y la crea */
    /* Hace un select para mandar a traer todos los datos de la 
 tabla donde rol sea igual al que se ingreso en el input */
    $sql = "select * FROM tbl_aula WHERE codigo = '$codigo'";
    $resultado = $mysqli->query($sql);
    /* Manda a llamar la fila */
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    /* Aqui obtengo el id_actividad de la tabla de la base el cual me sirve para enviarla a la pagina actualizar.php para usarla en el where del update   */
    $_SESSION['id_aula'] = $row['id_aula'];
    $_SESSION['codigo'] = $row['codigo'];
    $_SESSION['descripcion'] = $row['descripcion'];
    $_SESSION['capacidad'] = $row['capacidad'];
    $_SESSION['id_edificio'] = $row['id_edificio'];
    $_SESSION['id_tipo_aula'] = $row['id_tipo_aula'];
    /*Aqui levanto el modal*/

    if (isset($_SESSION['codigo'])) {


?>
      <script>
        $(function() {
          $('#modal_modificar_aula').modal('toggle')

        })
      </script>;

      <?php
      ?>

<?php


    }
  }
}

ob_end_flush();


?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
</head>


<body>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">


            <h1>AULAS
            </h1>
          </div>

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/menu_mantenimiento.php">Menu Mantenimiento</a></li>
              <li class="breadcrumb-item active"><a href="../vistas/mantenimiento_crear_aula_vista.php">Nueva Aula</a></li>
            </ol>
          </div>

          <div class="RespuestaAjax"></div>

        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!--Pantalla 2-->

    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">Aulas Existentes</h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
        <br>
        <div class=" px-12">
          <button class="btn btn-success "> <i class="fas fa-file-pdf"></i> <a style="font-weight: bold;" onclick="ventana()">Exportar a PDF</a> </button>
        </div>
      </div>
      <div class="card-body">

        <table id="tabla" class="table table-bordered table-striped">



          <thead>
            <tr>
              <th>ID </th>
              <th>CODIGO AULAS</th>
              <th>DESCRIPCION </th>
              <th>CAPACIDAD </th>
              <th>EDIFICIO</th>
              <th>TIPO AULA </th>
              <th>MODIFICAR</th>
              <th>ELIMINAR</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $resultadotabla->fetch_array(MYSQLI_ASSOC)) { ?>
              <tr>
                <td><?php echo $row['id_aula']; ?></td>
                <td><?php echo $row['codigo']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['capacidad']; ?></td>
                <td><?php echo $row['id_edificio']; ?></td>
                <td><?php echo $row['id_tipo_aula']; ?></td>


                <td style="text-align: center;">

                  <a href="../vistas/mantenimiento_aula_vista.php?id_aula=<?php echo $row['id_aula']; ?>" class="btn btn-primary btn-raised btn-xs">
                    <i class="far fa-edit" style="display:<?php echo $_SESSION['modificar_aula'] ?> "></i>
                  </a>
                </td>

                <td style="text-align: center;">

                  <form action="../Controlador/eliminar_aula_controlador.php?id_aula=<?php echo $row['id_aula']; ?>" method="POST" class="FormularioAjax" data-form="delete" autocomplete="off">
                    <button type="submit" class="btn btn-danger btn-raised btn-xs">

                      <i class="far fa-trash-alt" style="display:<?php echo $_SESSION['eliminar_aula'] ?> "></i>
                    </button>
                    <div class="RespuestaAjax"></div>
                  </form>
                </td>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>


    <!-- /.card-body -->
    <div class="card-footer">

    </div>
  </div>





  <!-- *********************Creacion del modal 

-->

  <form action="../Controlador/actualizar_aula_controlador.php?id_aula=<?php echo $_SESSION['id_aula']; ?>" method="post" data-form="update" autocomplete="off">



    <div class="modal fade" id="modal_modificar_aula">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"> Actualizar Aula</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>


          <!--Cuerpo del modal-->
          <div class="modal-body">





            <div class="card-body">
              <div class="row">
                <div class="col-md-12">



                  <div class="form-group">




                    <input hidden class="form-control" type="text" id="txt_idaula" name="txt_idaula" value="<?php echo $_SESSION['id_aula']; ?>" required style="text-transform: uppercase" onkeyup="DobleEspacio(this, event)" onkeypress="return Numeros(event)" maxlength="30">

                  </div>
                  <div class="form-group">

                    <label>Modificar Codigo Aula</label>


                    <input class="form-control" type="text" id="txt_codigo" name="txt_codigo" value="<?php echo $_SESSION['codigo']; ?>" required style="text-transform: uppercase" onkeyup="DobleEspacio(this, event)" onkeypress="return Numeros(event)" maxlength="30">

                  </div>


                  <div class="form-group">
                    <label class="control-label">Descripcion</label>

                    <input class="form-control" type="text" id="txt_descripcion" name="txt_descripcion" value="<?php echo $_SESSION['descripcion']; ?>" required style="text-transform: uppercase" onkeyup="DobleEspacio(this, event); MismaLetra('txt_descripcion');" onkeypress="return sololetras(event)" maxlength="30" onkeypress="return comprobar(this.value, event, this.id)">

                  </div>

                  <div class="form-group">
                    <label class="control-label">Capacidad</label>

                    <input class="form-control" type="text" id="txt_capacidad" name="txt_capacidad" value="<?php echo $_SESSION['capacidad']; ?>" required style="text-transform: uppercase" onkeypress="return Numeros(event)" onkeyup="DobleEspacio(this, event)" maxlength="30" onkeypress="return comprobar(this.value, event, this.id)">

                  </div>

                  <div class="form-group">
                    <label>Edificio</label>
                    <select class="form-control-lg select2" type="text" id="cbm_edificio" name="cbm_edificio" style="width: 100%;">
                      <option value="">Seleccione una opción</option>
                    </select>
                  </div>
                  <input class="form-control" id="edificio" name="edificio" value="<?php echo $_SESSION['id_edificio']; ?>" hidden>


                  <div class="form-group">
                    <label>Tipo Aula</label>
                    <select class="form-control-lg select2" type="text" id="cbm_aula" name="cbm_aula" style="width: 100%;">
                      <option value="">Seleccione una opción</option>
                    </select>
                  </div>
                  <input class="form-control" id="aula" name="aula" value="<?php echo $_SESSION['id_tipo_aula']; ?>" hidden>

                </div>
              </div>
            </div>

          </div>




          <!--Footer del modal-->
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btn_modificar_aula" name="btn_modificar_aula" <?php echo $_SESSION['btn_modificar_aula']; ?>>Guardar Cambios</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    <!-- /.  finaldel modal -->

    <!--mosdal crear -->



  </form>




  <script type="text/javascript">
    $(function() {

      $('#tabla').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });
  </script>


</body>

</html>
<script type="text/javascript" src="../js/funciones_registro_docentes.js"></script>
<script type="text/javascript" src="../js/validar_registrar_docentes.js"></script>
<script type="text/javascript" language="javascript">
  function ventana() {
    window.open("../Controlador/reporte_mantenimiento_aula_controlador.php", "REPORTE");
  }
</script>

<script type="text/javascript" src="../js/funciones_mantenimientos.js"></script>
<script type="text/javascript" language="javascript">
  $(document).ready(function() {

    $('.select2').select2({
      placeholder: 'Seleccione una opcion',
      theme: 'bootstrap4',
      tags: true,
    });

  });
</script>