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
	table = $('#tabladocentes').DataTable({
		paging: true,
		lengthChange: true,
		ordering: true,
		info: true,
		autoWidth: true,
		responsive: true,
		ordering: true,
		// LengthChange: false,
		searching: { regex: true },
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
		sortable: false,
		pageLength: 15,
		destroy: true,
		async: false,
		processing: true,
		ajax: {
			url: '../Controlador/tabla_docente_controlador.php',
			type: 'POST'
		},
		columns: [
			{ data: 'id_persona' },
			{ data: 'numero_empleado' },
			{ data: 'nombre' },
			{ data: 'correos' },
			{ data: 'contactos' },
			{ data: 'comision' },
			{ data: 'actividad' },
			{ data: 'formacion_academica' },
			{ data: 'foto' },
			{ data: 'curriculum' },
			{
				defaultContent:
					"<button style='font-size:13px;' type='button' class='editar btn btn-primary '><i class='fas fa-edit'></i></button>"
			}
		],

		language: idioma_espanol,
		select: true
	});
}
$('#tabladocentes').on('click', '.editar', function () {
	var data = table.row($(this).parents('tr')).data();
	if (table.row(this).child.isShown()) {
		var data = table.row(this).data();
	}

	$('#modal_editar').modal({ backdrop: 'static', keyboard: false });
	$('#modal_editar').modal('show');
	$('#txt_id_persona').val(data.id_persona);
	$('#txt_nombre_docente').val(data.nombre);
	//var id_persona=$("#txt_id_persona").val();

	Actividades();
	
});

function persona() {
	document.getElementById('txt_id_persona1').value = document.getElementById('txt_id_persona').value;
	
	/* $.post("../Controlador/actividades.php", { id_comisiones: la_comision }, function (data, status) {
		//console.log(data);
		data = JSON.parse(data);
		console.log(data); */
		/* $("#txt_actividad").val(data.id_actividad); */


		/* }); */
}


//CARGAR TABLA DE ACTIVIDADES
/* function TraerDatos() {
	var id_persona = $("#txt_id_persona").val();

	$.post("../Controlador/perfil_docente_controlador.php?op=Actividades", { id_persona: id_persona }, function (data, status) {
		//console.log(data);
		data = JSON.parse(data);
		console.log(data);
		for (var i = 0; i < data.actividades.length; ++i) {

			let n = 1 + i;

			$('#tbl_comisiones').append(
				'<tr id="row">' +
				'<td> </td>' +
				'<td>' + data['actividades'][i].comision + '</td>' +
				'<td>' + data['actividades'][i].actividad + '</td>' +
				'<td><button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button></td>' +
				'</tr>');
		}

	})
} */


function Actividades() {
	var id_persona = $('#txt_id_persona').val();

	$.post('../Controlador/gestion_docente_controlador.php?op=Actividades', { id_persona: id_persona }, function (
		data,
		status
	) {
		data = JSON.parse(data);
		console.log(data);
		for (i = 0; i < data.actividades.length; i++) {
			
			$('#tbl_comisiones').append(
				'<tr id="row' + i + '">' +
				'<td>' + data['actividades'][i].id_act_persona + '</td>' + 
				'<td>' + data['actividades'][i].comision + '</td>' +
				'<td>' + data['actividades'][i].actividad + '</td>' +
				'<td><button type="button" name="remove" id="' + i +
				'" class="btn btn-danger btn_remove">X</button></td>' +
				'</tr>'
			);
			

		}
		
		
	}); limpiar();
	
}

//Comisiones y actividades
var sendData3 = {};
var list3 = [];
var actividades = document.getElementById('actividades');
var comisiones = document.getElementById('comisiones');
var id_persona = document.getElementById('txt_id_persona1');


var tbl_comisiones = document.getElementById('tbl_comisiones');

var addTask3 = () => {
	var item3 = {
		id_persona: id_persona.value,
		actividades: actividades.value,
		comisiones: comisiones.value,

		muestra_actividad: actividades.options[actividades.selectedIndex].text,
		muestra_comision: comisiones.options[comisiones.selectedIndex].text
	};
	
	Actividades();

	list3.push(item3);
	viewlist3();
	
	
};

var viewlist3 = () => {
	if (list3.length > 0) {
		var viewItem3 = '';
		list3.map((item3, index) => {
			item3.id = index + 1;
			viewItem3 += `<tr>`;
			viewItem3 += `<td></td>`;
			viewItem3 += `<td>${item3.muestra_comision}</td>`;
			viewItem3 += `<td>${item3.muestra_actividad}</td>`;
			viewItem3 += `<td><button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button> </td>`;
			


			viewItem3 += `</tr>`;
		});
		tbl_comisiones.innerHTML = viewItem3;
		


		$('#ModalTask2').modal('hide');
		
		
	}
};
function limpiar_arreglo() {
	list3.pop();
	
}
var saveAll3 = () => {
	if (list3.length > 0) {
		/* var id_persona = $('#txt_id_persona1').val(); */
		sendData3.id = 1;
		sendData3.data = list3;
		console.log(sendData3);

		fetch('../api/guardar_comisiones.php', {
			method: 'POST',
			body: JSON.stringify(sendData3)
		})
			.then((response) => response.json())
			.then((response) => console.log(response));
		swal("Buen trabajo!", "¡ Se insertaron nuevas comisiones y actividades!", "success");
		limpiar_arreglo();
		
		

		//window.location.href = window.location.href;
	} else {
		//alert("No Registró comisiones!");
		// Location.reload()
	}
};
function eliminar() {
	// let i = ContarTel();
	var confirmLeave = confirm('¿Desea Eliminar el Número de telefono del docente?');
	if (confirmLeave == true) {
		var id = $(this).attr('id');
		var eliminar_tel = document.getElementById('tel' + id).value;
		//console.log(eliminar_tel);
		$('#row' + id).remove();
		// console.log(id);
		$.post(
			'../Controlador/perfil_docente_controlador.php?op=EliminarTelefono',
			{ eliminar_tel: eliminar_tel },
			function (e) { }
		);
		i--;
	}
}

function limpiar() {
	$('#tbl_comisiones').empty(); 
	
}
function actualizar_modal() {
	
	$('#tbl_comisiones').reload();

}

//FUNCION DE LAS COMISIONES Y ACTIVIDADES
$(function () {
	// Lista de comisiones
	$.post('../Controlador/comisiones.php').done(function (respuesta) {
		$('#comisiones').html(respuesta);
	});

	// lista de actividades
	$('#comisiones').change(function () {
		var la_comision = $(this).val();
		console.log(la_comision);

		// Lista de actividades
		$.post('../Controlador/actividades.php', {
			id_comisiones: la_comision
		}).done(function (respuesta) {
			$('#actividades').html(respuesta);
			$('#id_actividad').val(id_actividad);
		

		});
	
	});
});


/* $("#actividades").change(function () {
	var id_tipo_periodo = $(this).val();

	$("#txt_actividad").val(id_tipo_periodo);
}); */
