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
              <h3 class="card-title">Producto/Caracteristicas</h3>
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
                                  <a class="nav-link" href="#">Producto</a>
                                  </li>
                                  <li class="nav-item">
                                  <a class="nav-link active" href="#">Caracteristicas</a>
                                  </li>
                               </ul>
                     </div>
              </div>
          </div>

            

            <!-- /.card-header -->
            <div class="card-body">
            <form>
    <div class="col-12">
    
    <div class="row mt-3">
    <div class="col-4">
    <div class="form-group">
            <label for="exampleFormControlSelect1">Tipo de producto</label>
            <select class="form-control" id="exampleFormControlSelect1" readonly="true">
            <option value="Computadora Laptop">Computadora Laptop</option>
            </select>
    </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Caracteristicas</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>Memoria ram</option>
            <option>Color</option>
            </select>
      </div>
    </div>
    
        <div class="col-2 form-inline">
          <div class="col-row pt-3">
            <div class="col-12">
              
               <!-- Button trigger modal -->
                  
                 
                  <button type="button" class="px-15 btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                     Agregar
                    </button>
                      <!-- Agregar nueva caracteristica  -->
                  <button type="button" class="px-12 btn btn-primary " data-toggle="modal" data-target="#exampleModal1"><i class="fas fa-plus" ></i></button>
                 
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title h3" id="exampleModalLabel">Agregada con exito</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">   
                          <!-- <img src="../dist/img/avatar04.png" style="width:auto;" alt=""> -->
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                           
                          </div>
                        </div>
                      </div>
                    </div>
        
            </div>
          </div>
        </div>
  
  </div>
  <div class="row mt-3">
    <div class="col-12">
       
    <table class="table table-bordered table-striped" id="tbllistado" >
                            
                            <thead >
                              <tr>
                                <th>Caracteristicas</th>
                                <th>Eliminar</th>
                              </tr>
                            </thead>
                           
                        </table>
    </div>
  
  </div>

  <div class="row mt-3">
        <div class="col-12">
          <div class="form-group">
              <a href="../vistas/registrarK_producto_vista.php"><button type="button" class=" btn btn-danger float-right">Cancelar</button></a>        
          
              <a href="../vistas/registrarK_caraceristicas_producto_vista.php"><button type="button" class="mr-4 btn btn-primary float-right ">Guardar</button></a>
          
          </div>
        </div>  
    </div>
 
 <!-- Button trigger modal -->


 
</form></div>

<!-- MODAL AGREGAR NUEVO ITEM CARACTERISTICA  -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo">Open modal for @mdo</button> -->

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h5" id="exampleModalLabel1"><b> Agregar nueva caracteristica</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre de Caracteristica</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#exampleModal">Guardar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
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


