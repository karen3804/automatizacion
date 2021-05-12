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
          
      

              <!--Contenido-->
              <!-- Content Wrapper. Contains page content -->
           
                <!-- Main content -->
                <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Producto/Inicio</h3>
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
            </div>
            <div class="container">
              <div class="row">
                  
                    
                      <div class="col-12 align-text-center">

                               <ul class="nav nav-tabs card-header-tabs">
                                  <li class="nav-item">
                                  <a class="nav-link active" href="#">Inicio</a>
                                  </li>
                                  <li class="nav-item">
                                  <a class="nav-link" href="#">Producto</a>
                                  </li>
                                  <li class="nav-item">
                                  <a class="nav-link " href="#">Caracteristicas</a>
                                  </li>
                               </ul>
                     </div>
              </div>
          </div>

            

            <!-- /.card-header -->
            <div class="card-body">
            
           
           
            <button type="button" class=" my-3 btn btn-secondary btn-inline p-3 mr-2">Generar pdf</button>
           <a href="../vistas/registrarK_producto_vista.php"><button type="button" class=" my-3 btn btn-primary btn-inline p-3 ">Nuevo</button></a>
                            <table class="table table-bordered table-striped" id="tbllistado" >
                            
                                <thead >
                                  <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Modificar</th>
                                    <th>Eliminar</th>
                                    <th>Reporte</th>
                                    
                                  </tr>
                                </thead>

                                <tbody>
                                <tr>
                                <td>nombre </td>
                                <td>nombre </td>
                                <td><i class="far fa-address-card"></i></td>
                                <td>nombre </td>
                                <td>nombre </td>
                                
                                </tr>
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
          <script type="text/javascript" src="../js/supervisiones/estadisticas.js"></script>
