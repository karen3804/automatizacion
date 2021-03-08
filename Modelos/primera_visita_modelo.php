<?php
require "../clases/conexion_mantenimientos.php";

$instancia_conexion = new conexion();

class primera_visita
{
    	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    
	//Implementamos un método para insertar registros de primera unica de supervision
	public function insertar($numero_cuenta,$funciones,$funciones_diseno,$funciones_redes,$funciones_capacitacion,$funciones_seguridad
    ,$funciones_auditoria,$funciones_base,$funciones_soporte,$funciones_programacion,$comunicacion
    ,$puntualidad,$responsabilidad,$creatividad,$presentacion,$atencion,$colaborativo,$trabajo_equipo
    ,$proactivo,$relaciones,$analisis,$diseno,$programador,$mantenimiento,$comentario
    ,$calificacion,$solicitar,$representante,$lugar,$fecha,$aspecto_a,$aspecto_s)
	{ 
        $visita="Primera Supervisión";
        global $instancia_conexion;
        $sql = "call ins_primera_visita('$numero_cuenta',
                                        '$comentario',
                                        '$representante',
                                        '$lugar',
                                        '$visita',
                                        '$funciones',
                                        '$funciones_diseno',
                                        '$funciones_redes',
                                        '$funciones_capacitacion',
                                        '$funciones_seguridad',
                                        '$funciones_auditoria',
                                        '$funciones_base',
                                        '$funciones_soporte',
                                        '$funciones_programacion',
                                        '$comunicacion',
                                        '$puntualidad',
                                        '$responsabilidad',
                                        '$creatividad',
                                        '$presentacion',
                                        '$atencion',
                                        '$colaborativo',
                                        '$trabajo_equipo',
                                        '$proactivo',
                                        '$relaciones',
                                        '$analisis',
                                        '$diseno',
                                        '$programador',
                                        '$mantenimiento',
                                        '$aspecto_a'
                                        '',
                                        '$aspecto_s')";
		return $instancia_conexion->ejecutarConsulta($sql);
	}

}


























?>


