<?php
require "../clases/conexion_mantenimientos.php";

$instancia_conexion = new conexion();

class segunda_visita
{
    	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    
	//Implementamos un método para insertar registros de una visita unica de supervision
	public function insertar($numero_cuenta,$asistencia,$horario,$adaptacion
    ,$cumplimiento,$calidad,$percepcion_conocimiento,$percepcion_habilidad,$comentario,$area_refuerzo
    ,$calificacion,$solicitar,$representante,$lugar,$oportunidad)
	{
		$visita="Segunda Supervisión";
        global $instancia_conexion;
		$sql = "call ins_segunda_visita('$numero_cuenta',
									  '$comentario',
									  '$area_refuerzo',
									  '$calificacion',
									  '$solicitar',
									  '$oportunidad',
									  '$representante',
									  '$lugar',
									  '$visita',
									  '$asistencia',
									  '$horario',
									  '$adaptacion',
									  '$cumplimiento',
									  '$calidad',
									  '$percepcion_conocimiento',
									  '$percepcion_habilidad')";
		return $instancia_conexion->ejecutarConsulta($sql);
	}

}


























?>


