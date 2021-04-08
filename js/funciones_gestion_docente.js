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
		dom: "Bfrtilp",
		
		buttons: [	
			  

        {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i> ',
        titleAttr: "Exportar a Excel",
		className: "btn btn-success",
				exportOptions: {
					columns: [1, 2, 3, 4, 5, 6, 7, 8],
				},
				title: " Carga Academica",
				messageTop: "REPORTE DE GESTION DOCENTES",
      },
      {
        extend: "pdfHtml5",
      
        customize: function (doc) {
          doc["footer"] = function (page, pages) {
            return {
              columns: [
                {
                  alignment: "center",
                  text: [
                    { text: page.toString(), italics: true },
                    " of ",
                    { text: pages.toString(), italics: true },
                  ],
                },
              ],
              margin: [10, 0],
            };
          };

        },

        text: '<i class="fas fa-file-pdf"></i> ',
        titleAttr: "Exportar a PDF",
        className: "btn btn-danger",
        orientation: "landscape",
        pageSize: "Legal",
        exportOptions: {
          columns: [1, 2, 3, 4, 5, 6, 7, 8],
        },
        title: " Carga Academica",
        messageTop: "REPORTE DE GESTION DOCENTES", //Coloca el título dentro del PDF
      },
      {
        extend: "print",
        text: '<i class="fa fa-print"></i> ',
        titleAttr: "Imprimir",
        className: "btn btn-info",
      },  
    ],
		columns: [
			{ data: 'id_persona' },
			{ data: 'numero_empleado' },
			{ data: 'nombre' },
			{ data: 'correos' },
			{ data: 'contactos' },
			{ data: 'comision' },
			{ data: 'actividad' },
			{ data: 'formacion_academica' },
			/* { data: 'foto' },
			{ data: 'curriculum' }, */
			{data: 'Estado',
				render: function(data, type, row) {
					if (data == 'ACTIVO') {
						return "<span class='label label-success'>" +data+ '</span>';
					} else {
						return "<span class='label label-danger'>" +data+ '</span>';
					}
				}
				
			},
			/* {defaultContent:
				"<div class=''> <button style='font-size:13px;' type='button' class='editar btn btn-primary btn-m '<i class='fas fa-edit'></i></button><button style='font-size:13px;' type='button' class='desactivar btn btn-danger'><i class='fa fa-trash'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check'></i></button> </div>"
				
			} */
			{
				"defaultContent": "<button style='font-size:13px;' type='button' class='desactivar btn btn-danger'></i><i class='fas fa-ban'></i></button>&nbsp;<button style='font-size:13px;' type='button' class='activar btn btn-success'><i class='fa fa-check-circle'></i></button>"
			
			},
			{
				"defaultContent": "<button style='font-size:13px;' type='button' class='editar btn btn-primary '><i class='fas fa-edit'></i></button>"
			
			} 

				
			
			
		],

		language: idioma_espanol,
		select: true
	});
}

//funciones de activar usuario
$('#tabladocentes').on('click', '.activar', function () {
	var data = table.row($(this).parents('tr')).data();
	if (table.row(this).child.isShown()) {
		var data = table.row(this).data();
	}
	if (data.Estado == 'ACTIVO') {
		mensaje = "ya se encuentra activo";
		swal(
			"Alert", "El usuario " + mensaje + "", "warning");
	} else {
	swal({
		title: "Alerta!",
		text:
			"Esta seguro de activar el docente ?",
		icon: "warning",
		buttons: true,
		dangerMode: false,
	}).then((willDelete) => {
		if (willDelete) {

			Modificar_Estatus(data.id_persona, 'ACTIVO');
			/* table.ajax.reload();  */

		}
	});
	}
})

$('#tabladocentes').on('click','.desactivar',function(){
    var data = table.row($(this).parents('tr')).data();
    if(table.row(this).child.isShown()){
		var data = table.row(this).data();
		
	}
	if (data.Estado == 'INACTIVO') {
		mensaje = "ya se encuentra inactivo";
		swal(
			"Alert", "El usuario " + mensaje + " ", "warning");
	} else {
		
	
	swal({
		title: "Alerta!",
		text:
			"Esta seguro de desactivar el docente ?",
		icon: "warning",
		buttons: true,
		dangerMode: false,
	}).then((willDelete) => {
		if (willDelete) {
			
		 	Modificar_Estatus(data.id_persona, 'INACTIVO');
			 /* table.ajax.reload();  */ 
			
		} 
	});

	}
})

function Modificar_Estatus(id_persona_,Estado){
     var mensaje ="";
    if(Estado=='INACTIVO'){
        mensaje="desactivó"; 
    }else{
        mensaje="activó";
    }
    $.ajax({
		"url": "../Controlador/actualizar_estado_controlador.php",
        type:'POST',
        data:{
            id_persona:id_persona_,
            Estado:Estado
        }
    }).done(function(resp){
        if(resp>0){
			swal(
				"Buen trabajo!", "El usuario se " + mensaje + " con exito", "success"
			);
			table.ajax.reload();
		} else {
			swal(
				"Buen trabajo!", "ERROR TONTA", "success"
			);
		}
		
		
    })


}




$('#tabladocentes').on('click', '.editar', function() {
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
$(document).ready(function() {
	function eliminar() {
		var confirmLeave = confirm('¿Desea Eliminar el Número de telefono del docente?');
		if (confirmLeave == true) {
			var id = $(this).attr('id');
			var eliminar_actividad = document.getElementById('tel' + id).value;
			console.log(eliminar_actividad);
			$('#row' + id).remove();
			console.log(id);
			$.post(
				'../Controlador/gestion_docente_controlador.php?op=eliminar_actividad',
				{ eliminar_actividad: eliminar_actividad },
				function(e) {}
			);

			swal('Buen trabajo!', '¡ Se eliminaron comisiones y actividades!', 'success');
		}
	}

	$(document).on('click', '.btn_remove', eliminar);

	Actividades();
});

function Actividades() {
	var id_persona = $('#txt_id_persona').val();

	$.post('../Controlador/gestion_docente_controlador.php?op=Actividades', { id_persona: id_persona }, function(
		data,
		status
	) {
		data = JSON.parse(data);
		console.log(data);
		for (i = 0; i < data.actividades.length; i++) {
			$('#tbl_comisiones').append(
				'<tr id="row' +
					i +
					'">' +
					'<td id="celda' +
					i +
					'"><input maxlength="9" onkeyup="javascript:mascara()" id="tel' +
					i +
					'" type="tel" name="tel" class="form-control name_list" value="' +
					data['actividades'][i].id_act_persona +
					'" placeholder="___-___"/></td>' +
					'<td>' +
					data['actividades'][i].comision +
					'</td>' +
					'<td>' +
					data['actividades'][i].actividad +
					'</td>' +
					'<td><button type="button" name="remove" id="' +
					i +
					'" class="btn btn-danger btn_remove">X</button></td>' +
					'</tr>'
			);
		}
	});
	limpiar();
}

//Comisiones y actividades
var sendData3 = {};
var list3 = [];
var actividades = document.getElementById('actividades');
var comisiones = document.getElementById('comisiones');
var id_persona = document.getElementById('txt_id_persona1');

var tbl_comisiones = document.getElementById('tbl_comisiones');
var actividades1 = document.getElementById('actividades');
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
function actualizar_tabla() {
	table.ajax.reload();
}
function saveAll3 () {

	var actividades1_ = actividades1.value;
	var id_persona1 = id_persona.value;
	$.post(
		"../Controlador/gestion_docente_controlador.php?op=existe_actividad",
		{ id_actividad: actividades1_, id_persona1: id_persona1 },

		function (data, status) {
			console.log(data);
			data = JSON.parse(data);

			if (data == null  ) {
			
				insert_actividades();

			} else {
				swal({
					title: "Alerta",
					text: "El docente ya cuenta con esta actividad!",
					icon: "warning",
					showConfirmButton: true,
					timer: 20000,
				});
				document.getElementById("actividades").value = "";
				$('#ModalTask2').modal('hide');
			
				limpiar();
				
			}
			});

	
}
function insert_actividades() {
	var id_persona = document.getElementById('txt_id_persona1');
	var actividades1 = document.getElementById('actividades');
	var actividades1_ = actividades1.value;
	var id_persona1 = id_persona.value;
	$.post(
		"../Controlador/gestion_docente_controlador.php?op=insertar_actividades",
		{ id_actividad: actividades1_, id_persona1: id_persona1 },

		function (data, status) {
			console.log(data);
			data = JSON.parse(data);
			swal('Buen trabajo!', '¡ Se insertaron nuevas comisiones y actividades!', 'success');
			limpiar_arreglo();
			Actividades();
			/* tbl_comisiones.reload(); */
		});
	
}
function eliminar() {
	// let i = ContarTel();
	var confirmLeave = confirm('¿Esta seguro de eliminar la actividad del docente?');
	if (confirmLeave == true) {
		var id = $(this).attr('id');
		var eliminar_tel = document.getElementById('tel' + id).value;
		//console.log(eliminar_tel);
		$('#row' + id).remove();
		// console.log(id);
		$.post(
			'../Controlador/perfil_docente_controlador.php?op=EliminarTelefono',
			{ eliminar_tel: eliminar_tel },
			function(e) {}
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
$(function() {
	// Lista de comisiones
	$.post('../Controlador/comisiones.php').done(function(respuesta) {
		$('#comisiones').html(respuesta);
	});

	// lista de actividades
	$('#comisiones').change(function() {
		var la_comision = $(this).val();
		console.log(la_comision);

		// Lista de actividades
		$.post('../Controlador/actividades.php', {
			id_comisiones: la_comision
		}).done(function(respuesta) {
			$('#actividades').html(respuesta);
			$('#id_actividad').val(id_actividad);
		});
	});
});
function actualizar_pagina() {
	windows.location.href = windows.location.href;
}

/* $("#actividades").change(function () {
	var id_tipo_periodo = $(this).val();

	$("#txt_actividad").val(id_tipo_periodo);
}); */
