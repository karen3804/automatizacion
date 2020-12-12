<?php

              ob_start();

              session_start();

              require_once ('../vistas/pagina_inicio_vista.php');
              require_once ('../clases/Conexion.php');
              require_once ('../clases/funcion_bitacora.php');
              require_once ('../clases/funcion_visualizar.php');
              require_once ('../clases/funcion_permisos.php');

?>
  
   <div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <!--<center><h1>Estadisticas Práctica Profesional Supervisada</h1></center>
          </div>
          <div class="panel-body" style="height: 500px;" id="formulariContacto">
          <form  method="POST" action="">
          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Fecha Desde:</label>
            <input type="date" class="form-control" placeholder="Start"   name="date1"/>&nbsp&nbsp&nbsp&nbsp
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Hasta</label>
            <input type="date" class="form-control" placeholder="End"  name="date2"/>&nbsp&nbsp&nbsp&nbsp
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Empresa</label>
            <input type="text" class="form-control" placeholder="Empresa a buscar"  name="empresa"/>&nbsp&nbsp&nbsp&nbsp
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Docente Supervisor</label>
            <input type="text" class="form-control" placeholder="Docente"  name="Docente"/>&nbsp&nbsp&nbsp&nbsp
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <button class="btn btn-primary" value="Buscar" name="search"><span class="glyphicon glyphicon-search"></span>Buscar</button> <a href="estadisticas_practica_profesional_vista.php" type="button" value="Refrescar"class="btn btn-success">Recargar<span class = "glyphicon glyphicon-refresh"><span></a>
           
            </div>
		      </form>
         </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vistas/pagina_principal_vista.php">Inicio</a></li>
              <li class="breadcrumb-item "><a href="../vistas/menu_supervision_vista.php">Supervisión</a></li></li>
            </ol>
          </div>-->
          <form  method="POST" action="">
          <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Datos de filtro</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>


          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
                     
                           
              <div class="col-sm-6">
                <div class="form-group">
                <label>Fecha Desde:</label>
                <input type="date" class="form-control" placeholder="Start"   name="date1">
                </div>


              </div>
                <div class="col-sm-6">
                 <div class="form-group">
                 <label>Hasta:</label>
                <input type="date" class="form-control" placeholder="End"  name="date2">
                </div>

              </div>
                <div class="col-sm-6">
                 <div class="form-group">
                 <label>Empresa:</label>
                <input type="text" class="form-control" placeholder="Buscar por empresa"  name="empresa">
                </div>

              </div>
                <div class="col-sm-6">

                 <div class="form-group">
                 <label>Docente Supervisor:</label>
                <input type="text" class="form-control" placeholder="Buscar por docente"  name="Docente"/>
                </div>
                 </div>

              <p class="text-center" style="margin-top: 20px;">
              <center> <button class="btn btn-primary" value="Buscar" name="search"><span class="glyphicon glyphicon-search"></span>Buscar</button> <a href="estadisticas_practica_profesional_vista.php" type="button" value="Refrescar"class="btn btn-success">Recargar<span class = "glyphicon glyphicon-refresh"><span></a>  </center>
              </p>
            </div>
          </div>
          </form>

            <div class="RespuestaAjax"></div>
   
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Columnas a imprimir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table id="columnas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                                    <th>Nombre Completo</th>
                                    <th>Número de cuenta</th>
                                    <th>Empresa</th>
                                    <th>Dirección</th>
                                    <th>Supervisor Asignado</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de finalización</th>
                                    
            </tr>
        </thead>
        <tbody align="center">
            <tr>
                <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
                <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
                <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
                <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
                <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
                <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
                <td><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"></td>
            </tr>
            </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger">Imprimir</button>
      </div>
    </div>
  </div>
</div>

              <!--Contenido-->
              <!-- Content Wrapper. Contains page content -->
           
                <!-- Main content -->
                <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Reporte Practica Profesional Supervisada</h3>
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                 Imprimir
            </button>
            <br>
            <br>
                            <table class="table table-bordered table-striped" id="example" >
                            
                                <thead >
                                  <tr align="center">
                                    <th>Nombre Completo</th>
                                    <th>Número de cuenta</th>
                                    <th>Empresa</th>
                                    <th>Dirección</th>
                                    <th>Supervisor Asignado</th>
                                    <th>Fecha de inicio</th>
                                    <th>Fecha de finalización</th>
                                    <th>Primera Visita</th>
                                    <th>Segunda Visita</th>
                                    <th>Visita Unica</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php  require_once ('../Controlador/estadisticas_practica_profesional_controlador.php');?>
                                </tbody>
                            </table>
                            </div>
                           
                            </div>
                            <!--Fin centro -->
                          </div><!-- /.box -->
                      </div><!-- /.col -->
                  </div><!-- /.row -->
              </section><!-- /.content -->
        
            </div><!-- /.content-wrapper -->
          <!--Fin-Contenido-->
          <script type="text/javascript">
          $(document).ready(function() {
         
          });
          </script>
          <script type="text/javascript" src="../js/supervisiones/estadisticas.js"></script>
