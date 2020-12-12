<?php require_once ('../clases/conexion_mantenimientos.php');?>
<?php
    
    if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
        $date2 = date("Y-m-d", strtotime($_POST['date2']));
        $Docente = $_POST['Docente'];
        $empresa = $_POST['empresa'];
		$query=mysqli_query($conexion, "SELECT a.documento, a.nombre, ep.nombre_empresa, ep.direccion_empresa, pe.docente_supervisor, pe.fecha_inicio, pe.fecha_finaliza, c.valor Correo, e.valor Celular, ep.tipo_empresa, ep.departamento_empresa, ep.jefe_inmediato, ep.titulo_jefe_inmediato, ep.cargo_jefe_inmediato, ep.correo_jefe_inmediato, ep.telefono_jefe_inmediato, ep.labora_dentro, a.id_persona, pe.horas

        FROM tbl_empresas_practica AS ep
        JOIN tbl_personas AS a
        ON ep.id_persona = a.id_persona
        JOIN tbl_practica_estudiantes AS pe
        ON pe.id_persona = a.id_persona
        JOIN tbl_contactos c ON a.id_persona = c.id_persona
        JOIN tbl_tipo_contactos d ON c.id_tipo_contacto = d.id_tipo_contacto AND d.descripcion = 'CORREO'
        JOIN tbl_contactos e ON a.id_persona = e.id_persona
        JOIN tbl_tipo_contactos f ON e.id_tipo_contacto = f.id_tipo_contacto AND f.descripcion = 'TELEFONO CELULAR'
        WHERE NOT (pe.docente_supervisor <=> '')  AND pe.docente_supervisor='$Docente' AND ep.nombre_empresa='$empresa' AND ep.Fecha_creacion BETWEEN '$date1' AND '$date2' ") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr align="center" >
    <td><?php echo $fetch['nombre']?></td>
		<td><?php echo $fetch['documento']?></td>
		<td><?php echo $fetch['nombre_empresa']?></td>
		<td><?php echo $fetch['direccion_empresa']?></td>
        <td><?php echo $fetch['docente_supervisor']?></td>
        <td><?php echo $fetch['fecha_inicio']?></td>
        <td><?php echo $fetch['fecha_finaliza']?></td>
        <td><center><a href="../pdf/primera_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank"  class="btn btn-secondary btn-raisedx btn-xs" >PDF</a><center></td>
		<td><center><a href="../pdf/segunda_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>																
		<td><center><a href="../pdf/unica_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>
	</tr>
<?php
			}
		}
	}
	if(ISSET($_POST['search'])){
		$date1 = date("Y-m-d", strtotime($_POST['date1']));
		$date2 = date("Y-m-d", strtotime($_POST['date2']));
		$query=mysqli_query($conexion, "SELECT a.documento, a.nombre, ep.nombre_empresa, ep.direccion_empresa, pe.docente_supervisor, pe.fecha_inicio, pe.fecha_finaliza, c.valor Correo, e.valor Celular, ep.tipo_empresa, ep.departamento_empresa, ep.jefe_inmediato, ep.titulo_jefe_inmediato, ep.cargo_jefe_inmediato, ep.correo_jefe_inmediato, ep.telefono_jefe_inmediato, ep.labora_dentro, a.id_persona, pe.horas

        FROM tbl_empresas_practica AS ep
        JOIN tbl_personas AS a
        ON ep.id_persona = a.id_persona
        JOIN tbl_practica_estudiantes AS pe
        ON pe.id_persona = a.id_persona
        JOIN tbl_contactos c ON a.id_persona = c.id_persona
        JOIN tbl_tipo_contactos d ON c.id_tipo_contacto = d.id_tipo_contacto AND d.descripcion = 'CORREO'
        JOIN tbl_contactos e ON a.id_persona = e.id_persona
        JOIN tbl_tipo_contactos f ON e.id_tipo_contacto = f.id_tipo_contacto AND f.descripcion = 'TELEFONO CELULAR'
        WHERE NOT (pe.docente_supervisor <=> '') AND ep.Fecha_creacion BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr align="center" >
    <td><?php echo $fetch['nombre']?></td>
		<td><?php echo $fetch['documento']?></td>
		<td><?php echo $fetch['nombre_empresa']?></td>
		<td><?php echo $fetch['direccion_empresa']?></td>
        <td><?php echo $fetch['docente_supervisor']?></td>
        <td><?php echo $fetch['fecha_inicio']?></td>
        <td><?php echo $fetch['fecha_finaliza']?></td>
        <td><center><a href="../pdf/primera_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank"  class="btn btn-secondary btn-raisedx btn-xs" >PDF</a><center></td>
		<td><center><a href="../pdf/segunda_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>																
		<td><center><a href="../pdf/unica_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>
	</tr>
<?php
			}
		}
	}
    //aqui 


    if(ISSET($_POST['search'])){
		$Docente = $_POST['Docente'];
		$query=mysqli_query($conexion, "SELECT a.documento, a.nombre, ep.nombre_empresa, ep.direccion_empresa, pe.docente_supervisor, pe.fecha_inicio, pe.fecha_finaliza, c.valor Correo, e.valor Celular, ep.tipo_empresa, ep.departamento_empresa, ep.jefe_inmediato, ep.titulo_jefe_inmediato, ep.cargo_jefe_inmediato, ep.correo_jefe_inmediato, ep.telefono_jefe_inmediato, ep.labora_dentro, a.id_persona, pe.horas

        FROM tbl_empresas_practica AS ep
        JOIN tbl_personas AS a
        ON ep.id_persona = a.id_persona
        JOIN tbl_practica_estudiantes AS pe
        ON pe.id_persona = a.id_persona
        JOIN tbl_contactos c ON a.id_persona = c.id_persona
        JOIN tbl_tipo_contactos d ON c.id_tipo_contacto = d.id_tipo_contacto AND d.descripcion = 'CORREO'
        JOIN tbl_contactos e ON a.id_persona = e.id_persona
        JOIN tbl_tipo_contactos f ON e.id_tipo_contacto = f.id_tipo_contacto AND f.descripcion = 'TELEFONO CELULAR'
        WHERE NOT (pe.docente_supervisor <=> '') AND pe.docente_supervisor='$Docente'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr  align="center" >
    <td><?php echo $fetch['nombre']?></td>
		<td><?php echo $fetch['documento']?></td>
		<td><?php echo $fetch['nombre_empresa']?></td>
		<td><?php echo $fetch['direccion_empresa']?></td>
        <td><?php echo $fetch['docente_supervisor']?></td>
        <td><?php echo $fetch['fecha_inicio']?></td>
        <td><?php echo $fetch['fecha_finaliza']?></td>
        <td><center><a href="../pdf/primera_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank"  class="btn btn-secondary btn-raisedx btn-xs" >PDF</a><center></td>
		<td><center><a href="../pdf/segunda_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>																
		<td><center><a href="../pdf/unica_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>
	</tr>
<?php
			}
		}
	}
	if(ISSET($_POST['search'])){
		$empresa = $_POST['empresa'];
		$query=mysqli_query($conexion, "SELECT a.documento, a.nombre, ep.nombre_empresa, ep.direccion_empresa, pe.docente_supervisor, pe.fecha_inicio, pe.fecha_finaliza, c.valor Correo, e.valor Celular, ep.tipo_empresa, ep.departamento_empresa, ep.jefe_inmediato, ep.titulo_jefe_inmediato, ep.cargo_jefe_inmediato, ep.correo_jefe_inmediato, ep.telefono_jefe_inmediato, ep.labora_dentro, a.id_persona, pe.horas

        FROM tbl_empresas_practica AS ep
        JOIN tbl_personas AS a
        ON ep.id_persona = a.id_persona
        JOIN tbl_practica_estudiantes AS pe
        ON pe.id_persona = a.id_persona
        JOIN tbl_contactos c ON a.id_persona = c.id_persona
        JOIN tbl_tipo_contactos d ON c.id_tipo_contacto = d.id_tipo_contacto AND d.descripcion = 'CORREO'
        JOIN tbl_contactos e ON a.id_persona = e.id_persona
        JOIN tbl_tipo_contactos f ON e.id_tipo_contacto = f.id_tipo_contacto AND f.descripcion = 'TELEFONO CELULAR'
        WHERE NOT (pe.docente_supervisor <=> '') AND ep.nombre_empresa='$empresa'") or die(mysqli_error());
		$row=mysqli_num_rows($query);
		if($row>0){
			while($fetch=mysqli_fetch_array($query)){
?>
	<tr  align="center" >
    <td><?php echo $fetch['nombre']?></td>
		<td><?php echo $fetch['documento']?></td>
		<td><?php echo $fetch['nombre_empresa']?></td>
		<td><?php echo $fetch['direccion_empresa']?></td>
        <td><?php echo $fetch['docente_supervisor']?></td>
        <td><?php echo $fetch['fecha_inicio']?></td>
        <td><?php echo $fetch['fecha_finaliza']?></td>
        <td><center><a href="../pdf/primera_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank"  class="btn btn-secondary btn-raisedx btn-xs" >PDF</a><center></td>
		<td><center><a href="../pdf/segunda_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>																
		<td><center><a href="../pdf/unica_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>
	</tr>
<?php
			}
		}else{
			
		}
	}else{
		$query=mysqli_query($conexion, "SELECT a.documento, a.nombre, ep.nombre_empresa, ep.direccion_empresa, pe.docente_supervisor, pe.fecha_inicio, pe.fecha_finaliza, c.valor Correo, e.valor Celular, ep.tipo_empresa, ep.departamento_empresa, ep.jefe_inmediato, ep.titulo_jefe_inmediato, ep.cargo_jefe_inmediato, ep.correo_jefe_inmediato, ep.telefono_jefe_inmediato, ep.labora_dentro, a.id_persona, pe.horas

        FROM tbl_empresas_practica AS ep
        JOIN tbl_personas AS a
        ON ep.id_persona = a.id_persona
        JOIN tbl_practica_estudiantes AS pe
        ON pe.id_persona = a.id_persona
        JOIN tbl_contactos c ON a.id_persona = c.id_persona
        JOIN tbl_tipo_contactos d ON c.id_tipo_contacto = d.id_tipo_contacto AND d.descripcion = 'CORREO'
        JOIN tbl_contactos e ON a.id_persona = e.id_persona
        JOIN tbl_tipo_contactos f ON e.id_tipo_contacto = f.id_tipo_contacto AND f.descripcion = 'TELEFONO CELULAR'
        WHERE NOT (pe.docente_supervisor <=> '')") or die(mysqli_error());
		while($fetch=mysqli_fetch_array($query)){
?>
	<tr  align="center" >
		<td><?php echo $fetch['nombre']?></td>
		<td><?php echo $fetch['documento']?></td>
		<td><?php echo $fetch['nombre_empresa']?></td>
		<td><?php echo $fetch['direccion_empresa']?></td>
        <td><?php echo $fetch['docente_supervisor']?></td>
        <td><?php echo $fetch['fecha_inicio']?></td>
        <td><?php echo $fetch['fecha_finaliza']?></td>
        <td><center><a href="../pdf/primera_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank"  class="btn btn-secondary btn-raisedx btn-xs" >PDF</a><center></td>
		<td><center><a href="../pdf/segunda_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>																
		<td><center><a href="../pdf/unica_visita_pdf.php?id=<?php echo $fetch['id_persona']?>" target="_blank" class="btn btn-secondary btn-raisedx btn-xs" >PDF</a></center></td>
	</tr>
<?php
		}
	}
?>
