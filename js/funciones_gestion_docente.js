/* function listar() {
	console.log('ejecutandose');
	$('#tabla').DataTable({
		"language": {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar Usuario:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		"ajax":
		{
			url: '../Controlador/gestion_docente_controlador.php?op=listar',
			type: "get",
			dataType: "json",
			error: function (e) {
				console.log(e.responseText);
			}
		}
	});
} */
var table;
function TablaDocente() {
	table = $("#tabladocentes").DataTable({
		paging: true,
		lengthChange: true,
		ordering: true,
		info: true,
		autoWidth: true,
		responsive: true,
		ordering: true,
		// LengthChange: false,
		searching: { regex: true },
		lengthMenu: [
			[10, 25, 50, 100, -1],
			[10, 25, 50, 100, "All"],
		],
		sortable: false,
		pageLength: 15,
		destroy: true,
		async: false,
		processing: true,
		ajax: {
			url: "../Controlador/tabla_docente_controlador.php",
			type: "POST",
		},
		columns: [
			{ data: "id_persona" },
			{ data: "numero_empleado" },
			{ data: "nombre" },
			{ data: "correos" },
			{ data: "contactos" },
			{ data: "comision" },
			{ data: "actividad" },
			{ data: "formacion_academica" },
			{ data: "foto" },
			{ data: "curriculum" },
			{
				defaultContent:
					"<button style='font-size:13px;' type='button' class='editar btn btn-primary '><i class='fas fa-edit'></i></button>",
			}

		],

		language: idioma_espanol,
		select: true,
	});

}
$("#tabladocentes").on("click", ".editar", function () {
	

	var data = table.row($(this).parents("tr")).data()
	if (table.row(this).child.isShown()) {

		var data = table.row(this).data();
	}
	$("#modal_editar").modal({ backdrop: "static", keyboard: false });
	$("#modal_editar").modal("show");
	$("#txt_id_persona").val(data.id_persona);
	$("#txt_nombre_docente").val(data.nombre);
	
	Actividades();
	
	
});
/* function llenar_selectcomisiones() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/reporte_docentes_controlador.php?op=select2",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);

			$("#cbm_comision_edita").html(r).fadeIn();
		},
	});
}
llenar_selectcomisiones();
function llenar_selectactividades() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/reporte_docentes_controlador.php?op=select3",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);

			$("#cbm_actividad_edita").html(r).fadeIn();
		},
	});
}
llenar_selectactividades(); */

 
//CARGAR TABLA DE ACTIVIDADES

function Actividades() {
	var id_persona = $("#txt_id_persona").val();
	
	$.post("../Controlador/perfil_docente_controlador.php?op=Actividades", { id_persona: id_persona }, function (data, status) {

		data = JSON.parse(data);

		//for (i = 0; i < data.actividades.length; ++i) {

			$('#tbl_comisiones').append('<tr>' +
				/* '<td>' + (i + 1) + '</td>' + */
				'<td>' + data["actividades"].comision + '</td>' +
				'<td>' + data["actividades"].actividad + '</td>' +
				'</tr>'

			);
		//}
	});

}

