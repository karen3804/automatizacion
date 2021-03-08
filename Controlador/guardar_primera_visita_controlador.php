<?php
require_once "../Modelos/primera_visita_modelo.php";

$modelo=new primera_visita();


$numero_cuenta=isset($_POST["cuenta_pv"])? limpiarCadena($_POST["cuenta_pv"]):"";
$funciones=isset($_POST["funciones_analisis_pv"])?$_POST["funciones_analisis_pv"]:"";
$funciones_diseno=isset($_POST["funciones_diseno_pv"])?$_POST["funciones_diseno_pv"]:"";
$funciones_redes=isset($_POST["funciones_redes_pv"])?$_POST["funciones_redes_pv"]:"";
$funciones_capacitacion=isset($_POST["funciones_capacitacion_pv"])?$_POST["funciones_capacitacion_pv"]:"";
$funciones_seguridad=isset($_POST["funciones_seguridad_pv"])?$_POST["funciones_seguridad_pv"]:"";
$funciones_auditoria=isset($_POST["funciones_auditoria_pv"])?$_POST["funciones_auditoria_pv"]:"";
$funciones_base=isset($_POST["funciones_base_pv"])?$_POST["funciones_base_pv"]:"";
$funciones_soporte=isset($_POST["funciones_soporte_pv"])?$_POST["funciones_soporte_pv"]:"";
$funciones_programacion=isset($_POST["funciones_programacion_pv"])?$_POST["funciones_programacion_pv"]:"";
$comunicacion=isset($_POST["comunicacion_pv"])? limpiarCadena($_POST["comunicacion_pv"]):"";
$puntualidad=isset($_POST["puntualidad_pv"])? limpiarCadena($_POST["puntualidad_pv"]):"";
$responsabilidad=isset($_POST["responsabilidad_pv"])? limpiarCadena($_POST["responsabilidad_pv"]):"";
$creatividad=isset($_POST["creatividad_pv"])? limpiarCadena($_POST["creatividad_pv"]):"";
$presentacion=isset($_POST["presentacion_pv"])? limpiarCadena($_POST["presentacion_pv"]):"";
$atencion=isset($_POST["atencion_pv"])? limpiarCadena($_POST["atencion_pv"]):"";
$colaborativo=isset($_POST["colaborativo_pv"])? limpiarCadena($_POST["colaborativo_pv"]):"";
$trabajo_equipo=isset($_POST["trabajo_equipo_pv"])? limpiarCadena($_POST["trabajo_equipo_pv"]):"";
$proactivo=isset($_POST["proactivo_iniciativa_pv"])? limpiarCadena($_POST["proactivo_iniciativa_pv"]):"";
$relaciones=isset($_POST["relaciones_pv"])? limpiarCadena($_POST["relaciones_pv"]):"";
$analisis=isset($_POST["analisis_pv"])? limpiarCadena($_POST["analisis_pv"]):"";
$diseno=isset($_POST["diseno_pv"])? limpiarCadena($_POST["diseno_pv"]):"";
$programador=isset($_POST["programador_pv"])? limpiarCadena($_POST["programador_pv"]):"";
$mantenimiento=isset($_POST["mantenimiento_pv"])? limpiarCadena($_POST["mantenimiento_pv"]):"";
$aspecto_a=isset($_POST["aspectos_auditoria_pv"])? limpiarCadena($_POST["aspectos_auditoria_pv"]):"";
$aspecto_s=isset($_POST["aspectos_seguridad_pv"])? limpiarCadena($_POST["aspectos_seguridad_pv"]):"";
$comentario=isset($_POST["comentarios_pv"])? limpiarCadena($_POST["comentarios_pv"]):"";
$calificacion=isset($_POST["calificacion_uv"])? limpiarCadena($_POST["calificacion_uv"]):"";
$solicitar=isset($_POST["solicitar_practicante_pv"])? limpiarCadena($_POST["solicitar_practicante_pv"]):"";
$representante=isset($_POST["representante_pv"])? limpiarCadena($_POST["representante_pv"]):"";
$lugar=isset($_POST["lugar_pv"])? limpiarCadena($_POST["lugar_pv"]):"";
$fecha=isset($_POST["fecha_pv"])? limpiarCadena($_POST["fecha_pv"]):"";
$id_primera_visita=isset($_POST["id_primera_visita"])? limpiarCadena($_POST["id_primera_visita"]):"";








switch ($_GET["op"]){
	case 'guardar':
		
            $rspta=$modelo->insertar($numero_cuenta,$funciones,$funciones_diseno,$funciones_redes,$funciones_capacitacion,$funciones_seguridad
                                   ,$funciones_auditoria,$funciones_base,$funciones_soporte,$funciones_programacion,$comunicacion
                                    ,$puntualidad,$responsabilidad,$creatividad,$presentacion,$atencion,$colaborativo,$trabajo_equipo
                                    ,$proactivo,$relaciones,$analisis,$diseno,$programador,$mantenimiento,$comentario
                                    ,$calificacion,$solicitar,$representante,$lugar,$fecha,$aspecto_a,$aspecto_s);
			echo $rspta ? "Encuesta registrada con exito" : "La encuesta no se pudo registrar";
		
	break;


	
}


?>
