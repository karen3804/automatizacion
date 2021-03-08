<?php
require "../clases/conexion_mantenimientos.php";


$instancia_conexion = new conexion();

class asignaturas
{
    	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($asignatura,$codigo,$uv)
	{
        global $instancia_conexion;
		$sql="INSERT INTO tbl_asignaturas (asignatura,codigo,uv)
		VALUES ('$asignatura','$codigo','$uv')";
		return $instancia_conexion->ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($docente, $id_supervisor)
	{	
		global $instancia_conexion;
		
		$sql="call asignar_docente('$id_supervisor','$docente')";;
		return $instancia_conexion->ejecutarConsulta($sql);
		
		
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($Id_asignatura)
	{
        global $instancia_conexion;
		$sql="UPDATE tbl_asignaturas SET estado='0' WHERE Id_asignatura='$Id_asignatura'";
		return $instancia_conexion->ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($Id_asignatura)
	{   
        global $instancia_conexion;
		$sql="UPDATE tbl_asignaturas SET estado='1' WHERE Id_asignatura='$Id_asignatura'";
		return $instancia_conexion->ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id_supervisor)
	{
        global $instancia_conexion;
		$sql="SELECT id_persona FROM tbl_practica_estudiantes WHERE id_persona='$id_supervisor'";
		return $instancia_conexion->ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
        global $instancia_conexion;
		$sql="SELECT px.valor, concat(a.nombres,'',a.apellidos) as nombre, ep.nombre_empresa, ep.direccion_empresa, pe.fecha_inicio, pe.fecha_finaliza, ep.id_persona

		FROM tbl_empresas_practica ep, tbl_personas a, tbl_practica_estudiantes pe, tbl_personas_extendidas px
		WHERE
		ep.id_persona = a.id_persona AND
		pe.id_persona = a.id_persona AND
	    px.id_atributo=12 and px.id_persona=a.id_persona and
		pe.docente_supervisor= ''";
		return $instancia_conexion->ejecutarConsulta($sql);
	}
}


























?>


