<?php

ob_start();

session_start();


require_once ('../vistas/pagina_inicio_vista.php');
require_once ('../clases/Conexion.php');
require_once ('../clases/funcion_bitacora.php');
require_once ('../clases/funcion_visualizar.php');
require_once ('../clases/funcion_permisos.php');
require_once ('../clases/conexion_mantenimientos.php');


 



        $Id_objeto=51 ; 
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
  

     // $respuesta1=$instancia_modelo->listar_select1();
        bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'Ingreso' , 'A gestion docentes');
        



if (permisos::permiso_modificar($Id_objeto)=='1')
 {
  $_SESSION['btn_modificar_CA']="";

}
else
{
    $_SESSION['btn_modificar_CA']="disabled";
 
}



  
}

ob_end_flush();
 


//$nomdocentes = "SELECT id_persona, nombres FROM tbl_personas WHERE id_tipo_persona=1";
//$resultado1 = $mysqli->query($nomdocentes);

?>


<!DOCTYPE html>

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

                <a href="http://localhost/Automatizacion/Automatizacion/vistas/registro_docentes_vista.php" class="btn btn-warning"><i class="fas fa-arrow"></i>Registrar Nuevo Usuario</a>

                </div>
                              
              <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-footer">

        

            <div class="card-body">
            <div class="table-responsive">
              <table id="tabla" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>ACCIONES</th>
                  <th>N_EMPLEADO</th>
                  <th>NOMBRE</th>
                  <th>CORREOS</th>
                  <th>CONTACTOS</th>
                  <th>COMISION</th>
                  <th>ACTIVIDAD</th>
                  <th>FORMACION ACADEMICA</th>
                  <th>FOTO</th>
                  <th>CURRICULUM</th>
                  
                   
                  </tr>
                </thead>
                
                
            </table>
            <br>


        </div>
        <div class="col-sm-4">
                                    <div class="form-group">

                                        <p class="text-center" style="margin-top: 20px;">
                                            <button class="btn btn-primary" id="btn1" name="btn1" data-toggle="modal" data-target="#modal2"> Elegir Columnas</button>
                                        </p>

                                    </div>
                                </div>


 <!-- CUERPO DEL MODAL -->
 <div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!--      Para centrado-->
        <div class="modal-dialog" role="document">

            <!--  <div class="modal-dialog" role="document">-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selección de columnas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">

                            <!-- CAPTURAMOS EL ID EN UN INPUT -->

                            <input id="id" hidden class="form control" type="text" name="id" value="">

                            <!-- -------------------------- -->

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label> <input class="form-control" type="checkbox" id="input8" name="cb-N_empleado" value="" >Numero Empleado</label>
                                   
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><input class="form-control" type="Checkbox" id="input6" name="cb-Nombre" value="" >Nombre</label>
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-checkbox"><input class="form-control" type="checkbox" id="input5" name="cb-jornada" value="" style="text-transform: uppercase" readonly>Jornada</label>
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label"><input class="form-control" type="checkbox" id="input2" name="cb-categoria" value="" style="text-transform: uppercase" readonly>Categoría</label>
                                    

                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Actividad</label>
                                  
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Comision</label>
                                  
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Formacion Academica</label>
                                  
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Correos</label>
                                  
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Contactos</label>
                                  
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Fecha Ingreso</label>
                                  
                                </div>
                            </div>


                            <!-- <div class="col-md-5">
                                <div class="form-group">
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Fecha Ingreso</label>
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Fecha Ingreso</label>
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Fecha Ingreso</label>
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Fecha Ingreso</label>
                                    <label class="control-label">  <input class="form-control" type="checkbox" id="input7" name="input7" value="" style="text-transform: uppercase" readonly>Fecha Ingreso</label>
                                </div>
                            </div>  -->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">

</div>

<!--<button type="button" onclick="javascript:imprim2();">Imprimir</button>-->

<!--<a class="btn btn-success hidden-print" onclick="javascript:Imprimir()">IMPRIMIR</a>-->
<!-- <button id="btnCrearPDF">guardar pdf</button>-->
<!--<a class="btn btn-success " href="../Controlador/gestion_docente_controlador2.php">PDF/IMPRIMIR</a>-->
<a class="btn btn-success " onclick=" ventana1()">Generar PDF</a>
</div> 

<!-- datatables JS -->
<!-- <script type="text/javascript" src="../Reporte/datatables/datatables.min.js"></script>-->
<!-- para usar botones en datatables JS -->
<!--<script src="../Reporte/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>-->
<!--<script src="../Reporte/datatables/JSZip-2.5.0/jszip.min.js"></script>-->
<!--<script src="../Reporte/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>-->
<!--<script src="../Reporte/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>-->
<!--<script src="../Reporte/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>-->

 
<!-- código JS propìo-->
<!--<script type="text/javascript" src="../Reporte/main.js"></script>-->
<script type="text/javascript"  src="../js/funciones_gestion_docente.js"></script>   
<script>
function imprim2() {
  var mywindow = window.open('', 'PRINT', 'height=400,width=600');
  mywindow.document.write('<html><head>');
  mywindow.document.write('</head><body >');
  mywindow.document.write(document.getElementById('id').innerHTML);
  mywindow.document.write('</body></html>');
  mywindow.document.close(); // necesario para IE >= 10
  mywindow.focus(); // necesario para IE >= 10
  mywindow.print();
  mywindow.close();
  return true;
}
</script>
<script>
        function Imprimir() {
          document.title = '';
          document.footer = 'unah';
          document.header = 'no ruta'
          window.print();
        }
      </script>
     
    <!-- datatables JS
    <script type="text/javascript" src="../Reporte/datatables/datatables.min.js"></script>    
     para usar botones en datatables JS  
    <script src="../Reporte/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="../Reporte/datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="../Reporte/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="../Reporte/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../Reporte/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script> -->
         
   
    <!-- código JS propìo       
    <script type="text/javascript"  src="../Reporte/main.js"></script>     -->
    
  <script language="javascript">
    function ventana1() {
      window.open("../Controlador/gestion_docente_controlador2.php", "GESTION");
    }
    </script>

        
          
 </body>
 <html>