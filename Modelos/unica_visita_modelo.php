<?php
require "../clases/conexion_mantenimientos.php";

$instancia_conexion = new conexion();

class unica_visita
{
    	//Implementamos nuestro constructor
	public function __construct()
	{

    }
    
	//Implementamos un método para insertar registros de una visita unica de supervision
	public function insertar($numero_cuenta,$funciones,$funciones_diseno,$funciones_redes,$funciones_capacitacion,$funciones_seguridad
    ,$funciones_auditoria,$funciones_base,$funciones_soporte,$funciones_programacion,$comunicacion,$oportunidad
    ,$puntualidad,$responsabilidad,$creatividad,$presentacion,$atencion,$colaborativo,$trabajo_equipo
    ,$proactivo,$relaciones,$analisis,$diseno,$programador,$mantenimiento,$asistencia,$horario,$adaptacion
    ,$cumplimiento,$calidad,$percepcion_conocimiento,$percepcion_habilidad,$comentario,$area_refuerzo
    ,$calificacion,$solicitar,$representante,$lugar,$aspecto_a,$aspecto_s)
   

    
	{
        $visita="Única Supervisión";
        global $instancia_conexion;
        $sql = "CALL ins_unica_visita('$numero_cuenta',
                            '$comentario',
                            '$area_refuerzo',
                            '$calificacion',
                            '$solicitar',
                            '$oportunidad',
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
                            '$analisis'
                            '$diseno',
                            '$programador',
                            '$mantenimiento',
                            '$aspecto_a',
                            '$aspecto_s',
                            '$asistencia',
                            '$horario',
                            '$adaptacion',
                            '$cumplimiento',
                            '$calidad',
                            '$percepcion_conocimiento',
                            '$percepcion_habilidad',
                            'a')";
		return $instancia_conexion->ejecutarConsulta($sql);
	}

}


























?>


