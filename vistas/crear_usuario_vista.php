<?php

ob_start();


  session_start();

require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');


 $Id_objeto=3 ;
        
  bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'Ingreso' , 'A Crear Usuarios');

 $visualizacion= permiso_ver($Id_objeto);



if ($visualizacion==0)
 {
     echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Lo sentimos no tiene permiso de visualizar la pantalla",
                                   type: "error",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                           window.location = "../vistas/menu_usuarios_vista.php";

                            </script>';
 // header('location:  ../vistas/menu_usuarios_vista.php');
}

else

{
       


if (permisos::permiso_insertar($Id_objeto)=='1')
 {
  $_SESSION['btn_guardar_usuario']="";
}
else
{
    $_SESSION['btn_guardar_usuario']="disabled";
 }

}

ob_end_flush();


?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body >


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Registro de Usuarios</h1>
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
      
<form action="../Controlador/guardar_usuario_controlador.php" method="post"  data-form="save" autocomplete="off" class="FormularioAjax">

 <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Nuevo Usuario</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>


          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nombre Completo</label>
                    <input class="form-control" type="text"  maxlength="60" id="txt_nombreusuario" name="txt_nombreusuario"  value="" required style="text-transform: uppercase"   onkeypress="return Letras(event)" onkeyup="DobleEspacio(this, event)" onkeypress="return comprobar(this.value, event, this.id)">
                </div>

                  <div class="form-group">
                  <label>Usuario</label>
                    <input class="form-control" type="text" id="txt_usuario" name="txt_usuario"  value="" required style="text-transform: uppercase" onkeyup="Espacio(this, event)"  onkeypress="return Letras(event)" onkeypress="return comprobar(this.value, event, this.id)"  maxlength="30">
                </div>

                <div class="form-group clearfix">
                      <div class="icheck-success d-inline">
                        <input type="checkbox"  id="checkboxactivo" name="checkboxactivo" value="true">
                        <label for="checkboxactivo">Nuevo
                        </label>
                      </div>
                </div>

                  <label>Contraseña</label>

                  <div class="input-group mb-3">
                    <input class="form-control" type="password" id="txt_contrasenau" name="txt_contrasenau"  value="" onkeyup="Espacio(this, event)" required  oncopy="return false" onpaste="return false" maxlength="10">
                   <div class="input-group-append">
                 <div class="input-group-text">
                  <span  id="show-hide-passwd" action="hide" class="fas fa-eye"></span>
                </div>
               </div>
                </div>

                   

                  <label>Confirmar Contraseña</label>
                  <div class="input-group mb-3">
                    <input class="form-control" type="password" id="txt_confirmar_contrasenau" name="txt_confirmar_contrasenau"  value="" onkeyup="Espacio(this, event)" required  oncopy="return false" onpaste="return false" maxlength="10">

                <div class="input-group-append">
                 <div class="input-group-text">
                  <span  id="show-hide-passwd1" action="hide" class="fas fa-eye"></span>
                </div>
               </div>
                </div>


                  <div class="form-group">
                  <label>Roles</label>
                  <select class="form-control select2" style="width: 100%;" name="comborol" required="">
          <option value="0"  >Seleccione un Rol:</option>
        <?php
          $query = $mysqli -> query ("SELECT * FROM tbl_roles ");
          while ($resultado = mysqli_fetch_array($query)) {
            echo '<option value="'.$resultado['Id_rol'].'"> '.$resultado['Rol'].'</option>' ;
          }
        ?>
                </select>
                </div>

                 <div class="form-group">
                  <label>Correo Electronico</label>
                    <input class="form-control" type="email" id="txt_correoe" name="txt_correoe" value="" required onkeypress="return ValidaMail($Correo_electronico)" onkeyup="Espacio(this, event)" maxlength="50" onkeypress="return comprobar(this.value, event, this.id)">
                </div>

              <p class="text-center" style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary" id="btn_guardar_usuario" name="btn_guardar_usuario">  <?php echo $_SESSION['btn_guardar_usuario']; ?><i class="zmdi zmdi-floppy"></i>Guardar</button>
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


</div>


<script>

   $(document).ready( function (){
 
   $('#show-hide-passwd').click(function(){
      if($(this).hasClass('fa-eye'))
      {
      $('#txt_contrasenau').removeAttr('type');
      $('#show-hide-passwd').addClass('fa-eye-slash').removeClass('fa-eye');
      }
 
      else
      {
      //Establecemos el atributo y valor
      $('#txt_contrasenau').attr('type','password');
      $('#show-hide-passwd').addClass('fa-eye').removeClass('fa-eye-slash');
      }
       });
 
       });

    $(document).ready( function (){
 
   $('#show-hide-passwd1').click(function(){
      if($(this).hasClass('fa-eye'))
      {
      $('#txt_confirmar_contrasenau').removeAttr('type');
      $('#show-hide-passwd1').addClass('fa-eye-slash').removeClass('fa-eye');
      }
 
      else
      {
      //Establecemos el atributo y valor
      $('#txt_confirmar_contrasenau').attr('type','password');
      $('#show-hide-passwd1').addClass('fa-eye').removeClass('fa-eye-slash');
      }
       });
 
       });



    </script>

</body>
</html>


