<?php



    $servidor= "den1.mysql3.gear.host";
    $usuario= "automatizacion2";
    $password = "Be50i?1!guh3";
    $base= "automatizacion2";

	$mysqli = new mysqli($servidor, $usuario,$password,$base);
	$connection = mysqli_connect($servidor, $usuario,$password,$base) or die("Error " . mysqli_error($connection));
	
	if($mysqli->connect_error){
		echo "Nuestro sitio presenta fallas....";
		die('Error en la conexion' . $mysqli->connect_error);
		exit();	
	}
 $connect = new PDO("mysql:host=den1.mysql3.gear.host;dbname=automatizacion2", "automatizacion2", "Be50i?1!guh3");

if (!mysqli_set_charset($mysqli, "utf8")) {
        printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($mysqli));
        exit();
    } else {
        printf("");
    }

    
	

?>