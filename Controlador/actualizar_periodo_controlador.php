<?php
 session_start();

 require_once ('../clases/Conexion.php');
 require_once ('../clases/funcion_bitacora.php'); 

        $Id_objeto=63 ;


    $num_periodo=strtoupper ($_POST['num_periodo']);
    $num_anno=strtoupper ($_POST['num_anno']);
    $fecha_inicio=strtoupper ($_POST['fecha_inicio']);
    $fecha_final=strtoupper ($_POST['fecha_final']);
    $adic_cancel=strtoupper ($_POST['fecha_adic_canc']);
    $id_periodo=strtoupper ($_POST['id_periodo']);
    // $tipo_periodo= strtoupper ($_POST['tipo_p']);
    $fecha_actual = date("Y-m-d");
    //sumo 1 mes
    $desbloqueo = date("Y-m-d",strtotime($fecha_actual."+ 1 month")); 

 
///Logica para el que se repite
$sqlexiste=("select count(num_periodo) as num_periodo  from tbl_periodo where num_anno='$num_anno' ");
 //Obtener la fila del query
$existe = mysqli_fetch_assoc($mysqli->query($sqlexiste));



/* Logica para que no acepte campos vacios */
if ($_POST['num_periodo']  <>' ' and  $_POST['num_anno']<> '' and  $_POST['fecha_inicio']<> '' and  $_POST['fecha_final']<> '' and  $_POST['fecha_adic_canc']<> '')
{
       
    			/* Query para que haga el insert*/
				$sql = "call proc_actualizar_periodo_carga('$fecha_inicio','$fecha_final','$_SESSION[usuario]','$adic_cancel', '$desbloqueo', '$id_periodo')";
                $resultado = $mysqli->query($sql);
       
        
	        if($resultado === TRUE) 
          {
                    bitacora::evento_bitacora($Id_objeto, $_SESSION['id_usuario'],'INSERTO' , 'EL PERIODO  '. $num_periodo.' EN EL AÑO '. $num_anno.'');

         /*   require"../contenidos/crearRol-view.php"; 
    		header('location: ../contenidos/crearRol-view.php?msj=2');*/
         echo '<script type="text/javascript">
                              swal({
                                   title:"",
                                   text:"Los datos  se actualizaron correctamente",
                                   type: "success",
                                   showConfirmButton: false,
                                   timer: 3000
                                });
                                $(".FormularioAjax")[0].reset();
                                window.location = "../vistas/mantenimiento_periodo_vista.php";
                            </script>';
           
			} 
			else 
			{
    		echo "Error: " . $sql ;
			}

    


} 

else
{
  echo '<script type="text/javascript">
                                    swal({
                                       title:"",
                                       text:"Lo sentimos tiene campos por rellenar",
                                       type: "error",
                                       showConfirmButton: false,
                                       timer: 3000
                                    });
                                </script>';
}


