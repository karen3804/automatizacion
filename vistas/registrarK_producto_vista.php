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
              <h3 class="card-title">Producto/Producto [Nuevo registro]</h3>
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
            </div>
            <div class="container">
              <div class="row">
                  
                    
                      <div class="col-12 align-text-center">

                               <ul class="nav nav-tabs card-header-tabs">
                                  <li class="nav-item">
                                  <a class="nav-link " href="#">Inicio</a>
                                  </li>
                                  <li class="nav-item">
                                  <a class="nav-link active" href="#">Producto</a>
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
            <form>
    <div class="col-12">
    
    <div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="exampleFormControlInput1">Nombre</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Escribir nombre del producto">
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Tipo de producto</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Almacenable</option>
            <option>Descartable</option>
            </select>
    </div>
    </div>
    </div>
  
  
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Descripcion</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Ingrese una breve descripcion del producto aqui."></textarea>
  </div>

  <div class="row">
        <div class="col-12">
          <div class="form-group">
            <a href="../vistas/registrarK_producto_vista.php"><button type="button" class="btn btn-danger float-right">Cancelar</button></a>        
            <a href="../vistas/registrarK_caraceristicas_producto_vista.php"><button type="button" class=" mr-2 btn btn-primary float-right ">Guardar</button></a>      
          </div>
          
        </div>  
    </div>
</form></div>
            
           
           
            
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
