function llenar_selectESP() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectESP",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);

			$("#especialidad").html(r).fadeIn();
		},
	});
}
function llenar_selectGRA() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectGRA",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);

			$("#gacademico").html(r).fadeIn();
		},
	});
}

function llenar_selectCAT() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectCAT",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);

			$("#categoria").html(r).fadeIn();
		},
	});
}
function llenar_selectJOR() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectJOR",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);

			$("#jornada").html(r).fadeIn();
		},
	});
}
function llenar_selectEST() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectEST",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);

			$("#cb_ecivil").html(r).fadeIn();
		},
	});
}

function llenar_selectGEN() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectGEN",
		type: "POST",
		data: cadena,
		success: function (r) {
			//  console.log(r);

			$("#cb_genero").html(r).fadeIn();
		},
	});
}

function llenar_selectNAC() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectNAC",
		type: "POST",
		data: cadena,
		success: function (r) {
			//  console.log(r);

			$("#cb_nacionalidad").html(r).fadeIn();
		},
	});
}

function llenar_selectHSAL() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectHSAL",
		type: "POST",
		data: cadena,
		success: function (r) {
			console.log(r);

			$("#txt_hf").html(r).fadeIn();
		},
	});
}

function llenar_selectHEN() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=selectHEN",
		type: "POST",
		data: cadena,
		success: function (r) {
			console.log(r);

			$("#txt_hi").html(r).fadeIn();
		},
	});
}

if ((document.getElementsByName = "categoria")) {
	llenar_selectCAT();
}

if ((document.getElementsByName = "jornada")) {
	llenar_selectJOR();
}

if ((document.getElementsByName = "gacademico")) {
	llenar_selectGRA();
}

if ((document.getElementsByName = "cb_ecivil")) {
	llenar_selectEST();
}

if ((document.getElementsByName = "cb_genero")) {
	llenar_selectGEN();
}
if ((document.getElementsByName = "cb_nacionalidad")) {
	llenar_selectNAC();
}
if ((document.getElementsByName = "txt_hi")) {
	llenar_selectHEN();
}
if ((document.getElementsByName = "txt_hf")) {
	llenar_selectHSAL();
}

if ((document.getElementsByName = "cbm_persona")) {
	llenar_persona();
}

//Grados academicos y especialidades
var sendData2 = {};
var list2 = [];
var gacademico = document.getElementById("gacademico");
var especialidad = document.getElementById("especialidad");
//especialidad = especialidad.toUpperCase();

var table = document.getElementById("tbData");

var addTask2 = () => {
	if ($("#especialidad").val().length == 0) {
		swal("Ingrese la especialidad!", "", "warning");

		return false;
	} else {
		var item2 = {
			gacademico: gacademico.value,
			especialidad: especialidad.value,

			muestra_gacademico: gacademico.options[gacademico.selectedIndex].text,
		};

		list2.push(item2);
		viewlist2();
		limpiarESP();
	}
};

function limpiarESP() {
	document.getElementById("especialidad").value = "";
}

var viewlist2 = () => {
	if (list2.length > 0) {
		var viewItem2 = "";
		list2.map((item2, index) => {
			item2.id = index + 1;
			viewItem2 += `<tr>`;
			viewItem2 += `<td hidden>${item2.gacademico}</td>`;
			viewItem2 += `<td>${item2.muestra_gacademico}</td>`;
			viewItem2 += `<td required style="text-transform: uppercase">${item2.especialidad}</td>`;
			viewItem2 += `</tr>`;
		});
		table.innerHTML = viewItem2;
		$("#ModalTask").modal("hide");
	}
};
var saveAll2 = () => {
	if (list2.length > 0) {
		sendData2.id = 1;
		sendData2.data = list2;
		console.log(sendData2);

		fetch("../api/guardar_grados.php", {
			method: "POST",
			body: JSON.stringify(sendData2),
		})
			.then((response) => response.json())
			.then((response) => console.log(response));
		//alert("grados creados!");

		//window.location.href = window.location.href;
	} else {
		alert("No Registró grados académicos!");

		// Location.reload()
	}
};

//telefonos
var sendData = {};
var list = [];
var telefono = document.getElementById("tel");
var table1 = document.getElementById("tbData2");

//const x = 0;
function valtel(tel) {
	var expresion3 = /(9|8|3|2)\d{3}[-]\d{4}/;
	console.log(expresion3.test(tel));
	if (list.length <= 3 && expresion3.test(tel)) {
		return 1;
	} else {
		return 0;
	}
}

var addTask = () => {
	//var n = telefono.search("_");
	if ($("#tel").val().length == 0) {
		swal("Ingrese el telefono!", "", "warning");

		return false;
	} else {
		if (list.length == 0) {
			if (valtel($("#tel").val()) == 0) {
				//aqui debo validar que no se agregue a la tabla ...
				swal("ingresar un numero valido");

				limpiarTEL();
				return false;
			}
		} else {
			if (valtel($("#tel").val()) == 0) {
				//aqui debo validar que no se agregue a la tabla ...
				swal("ingresar un numero valido");

				limpiarTEL();
				return false;
			}
		}

		var item = {
			telefono: telefono.value,
		};
		console.log(item);

		list.push(item);

		viewlist();
		limpiarTEL();
	}
};

function limpiarTEL() {
	document.getElementById("tel").value = "";
}

var viewlist = () => {
	if (list.length <= 3) {
		var viewItem = "";
		list.map((item, index) => {
			item.id = index + 1;
			viewItem += `<tr>`;
			viewItem += `<td >${item.telefono}</td>`;
			//viewItem += `<td><button class="btn btn-danger btn_remove" type='button' id="remove">X</button></td>`;
			viewItem += `</tr>`;
		});
		table1.innerHTML = viewItem;
		$("#ModalTask1").modal("hide");

		if (list.length == 3) {
			desactivarboton1();
			swal("Aviso", "limite 3 telefonos", "warning");

			$("#ModalTask1").modal("hide");
		}
	}
};

var saveAll = () => {
	if (list.length > 0) {
		sendData.id = 1;
		sendData.data = list;
		console.log(sendData);

		fetch("../api/guardar_telefonos.php", {
			method: "POST",
			body: JSON.stringify(sendData),
		})
			.then((response) => response.json())
			.then((response) => console.log(response));
		//alert("contactos creados!");

		//window.location.href = window.location.href;
	} else {
		alert("No registró telefonos!");

		// Location.reload()
	}
};
function limpiarTEL() {
	document.getElementById("tel").value = "";
}
function desactivarboton1() {
	document.getElementById("gcorreotel").disabled = true;
}

//correos
var sendData5 = {};
var list5 = [];
var correo = document.getElementById("email");
var table5 = document.getElementById("tbData5");

const x = 0;
function correoInstDet(correo) {
	var expresion = /^([a-z0-9_\.-]+)@unah\.edu\.hn$/;
	console.log(expresion.test(correo));
	if (list5.length <= 2 && expresion.test(correo)) {
		return 1;
	} else {
		return 0;
	}
}
function correovalido(correo1) {
	var expresion1 = /^\w+([\.-]?\w+)*@(?:|hotmail|outlook|yahoo|live|gmail)\.(?:|com|es)+$/;

	console.log(expresion1.test(correo1));
	if (list5.length <= 2 && expresion1.test(correo1)) {
		return 1;
	} else {
		return 0;
	}
}

var addTask5 = () => {
	if ($("#email").val().length == 0) {
		swal("Ingrese el correo!", "", "warning");

		return false;
	} else {
		//console.clear();
		if (list5.length == 0) {
			if (correoInstDet($("#email").val()) == 0) {
				//aqui debo validar que no se agregue a la tabla ...

				swal("Alerta", "Primero Ingresar correo institucional", "warning");

				limpiarCOR();
				return false;
			} else {
				//console.log("exitosss xD") ;
			}
		} else {
			if (correovalido($("#email").val()) == 0) {
				//aqui debo validar que no se agregue a la tabla ...
				swal("ingresar un correo valido");

				limpiarCOR();
				return false;
			} else {
				desactivarboton();

				swal("Aviso", "limite 2 correos", "warning");

				$("#ModalTask5").modal("hide");
			}
		}
		var item5 = {
			correo: correo.value,
		};

		list5.push(item5);

		//console.log(list5[0]["correo"]);

		viewlist5();
		limpiarCOR();
	}
};
function limpiarCOR() {
	document.getElementById("email").value = "";
}
function limpiarTEL() {
	document.getElementById("tel").value = "";
}

var viewlist5 = () => {
	if (list5.length <= 2) {
		var viewItem5 = "";
		list5.map((item5, index) => {
			item5.id = index + 1;
			viewItem5 += `<tr>`;
			viewItem5 += `<td>${item5.correo}</td>`;
			viewItem5 += `</tr>`;
			console.log(index);
			console.log(item5);
		});

		table5.innerHTML = viewItem5;

		$("#ModalTask5").modal("hide");
	} else {
		alert("solo puede ingresar 2 correos warning");
		return false;
	}
};

function desactivarboton() {
	document.getElementById("gcorreo").disabled = true;
}

var saveAll5 = () => {
	if (list5.length > 0) {
		sendData5.id = 1;
		sendData5.data = list5;

		fetch("../api/guardar_correos.php", {
			method: "POST",
			body: JSON.stringify(sendData5),
		})
			.then((response) => response.json())
			.then((response) => console.log(response));
		//alert("correos creados!");

		//window.location.href = window.location.href;
	} else {
		alert("No Registró correos!");

		// Location.reload()
	}
};

//Comisiones y actividades
var sendData3 = {};
var list3 = [];
var actividades = document.getElementById("actividades");
var comisiones = document.getElementById("comisiones");

var table3 = document.getElementById("tbData3");

var addTask3 = () => {
	var item3 = {
		actividades: actividades.value,
		comisiones: comisiones.value,

		muestra_actividad: actividades.options[actividades.selectedIndex].text,
		muestra_comision: comisiones.options[comisiones.selectedIndex].text,
	};

	list3.push(item3);
	viewlist3();
};

var viewlist3 = () => {
	if (list3.length > 0) {
		var viewItem3 = "";
		list3.map((item3, index) => {
			item3.id = index + 1;
			viewItem3 += `<tr>`;
			viewItem3 += `<td hidden>${item3.actividades}</td>`;
			viewItem3 += `<td>${item3.muestra_comision}</td>`;
			viewItem3 += `<td>${item3.muestra_actividad}</td>`;
			viewItem3 += `</tr>`;
		});
		table3.innerHTML = viewItem3;
		$("#ModalTask2").modal("hide");
	}
};
var saveAll3 = () => {
	if (list3.length > 0) {
		sendData3.id = 1;
		sendData3.data = list3;
		console.log(sendData3);

		fetch("../api/guardar_actividades.php", {
			method: "POST",
			body: JSON.stringify(sendData3),
		})
			.then((response) => response.json())
			.then((response) => console.log(response));
		//alert("comisiones y actividades creados!");

		//window.location.href = window.location.href;
	} else {
		alert("No Registró comisiones!");

		// Location.reload()
	}
};

//FUNCION DE LAS COMISIONES Y ACTIVIDADES
$(function () {
	// Lista de comisiones
	$.post("../Controlador/comisiones.php").done(function (respuesta) {
		$("#comisiones").html(respuesta);
	});

	// lista de actividades
	$("#comisiones").change(function () {
		var la_comision = $(this).val();
		console.log(la_comision);

		// Lista de actividades
		$.post("../Controlador/actividades.php", {
			id_comisiones: la_comision,
		}).done(function (respuesta) {
			$("#actividades").html(respuesta);
		});
	});
});


	




function id_jornada() {
	var idjornada = $("#jornada").children("option:selected").val();
	// console.log(idjornada);
}


function ValidarIdentidad(identidad) {

	//console.log(n);
	var n = identidad.search("_");
	console.log(n);
	var mayor_edad = $("#mayoria_edad").val();
	var depto = identidad.substring(0, 4);
	var contar = depto;

	console.log(contar);

	if (n == 5) {
		var ver = false;
		$.post(
			"../Controlador/registro_docente_controlador.php?op=validar_depto",
			{ codigo: contar },

			function (data, status) {
				console.log(data);
				data = JSON.parse(data);
				console.log(data);
				/*si no tiene datos va copiar  */
				//$("#contar_depto").val(data.regis);


				if (data.regis == 0) {
					var ver = true;

					if (ver == true) {
						swal(
							"Datos incorrectos",
							"Asegurese de Introducir los digitos correspondientes a su departamento y municipio",
							"warning"
						);
						$("#contar_depto").val("");
						$("#identidad").val("");
						$("#identidad").attr("placeholder", "____-____-_____");
					}

				}
			}

		);

	}

	if (n == 10) {
		var currentTime = new Date();
		var year = currentTime.getFullYear();
		var anio = identidad.substring(5, 9);
		//console.log(year-anio);
		if (year - anio < mayor_edad) {
			swal("Aviso", "Debe ser mayor de edad", "warning");
			$("#identidad").val("");
			$("#identidad").attr("placeholder", "____-____-_____");
		}

		if (anio == '0000') {
			swal('Aviso', 'Año invalido', 'warning');
			$("#identidad").val("");
			$("#identidad").attr("placeholder", "____-____-_____");
		} else {

		}
	}

	if (n == -1) {
		var ultimo = identidad.substring(10, 15);
		// console.log(anio);
		if (ultimo == '00000') {
			swal('Aviso', 'no se permiten 5 ceros', 'warning');
			$("#identidad").val("");
			$("#identidad").attr("placeholder", "____-____-_____");
		} else {

		}
	}
}

function llenar_persona() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=listar_persona",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);
			$("#cbm_persona").html(r).fadeIn();
		},
	});
}
llenar_persona();

$("#cbm_persona").change(function () {
	var persona = $(this).val();
	console.log(persona);
	$("#persona1").val(persona);
});

function llenar_comision() {
	var cadena = "&activar=activar";
	$.ajax({
		url: "../Controlador/registro_docente_controlador.php?op=listar_comision",
		type: "POST",
		data: cadena,
		success: function (r) {
			// console.log(r);
			$("#cbm_comision1").html(r).fadeIn();
		},
	});
}
llenar_comision();

$("#cbm_comision1").change(function () {
	var comision = $(this).val();
	console.log(comision);
	$("#comision1").val(comision);
});

function ExisteIdentidad() {
	identidad = $("#identidad").val();

	$.post(
		"../Controlador/registro_docente_controlador.php?op=ExisteIdentidad",
		{ identidad: identidad },
		function (data, status) {
			console.log(data);
			data = JSON.parse(data);
			console.log(data);
			if (data.existe == 1) {
				$("#TextoIdentidad").removeAttr("hidden");
				alert("¡Ya existe un registro con esta identidad!");
			} else {
				$("#TextoIdentidad").attr("hidden", "hidden");
			}
		}
	);
}

function MismaLetra(id_input) {
	var valor = $("#" + id_input).val();
	var longitud = valor.length;
	//console.log(valor+longitud);
	if (longitud > 2) {
		var str1 = valor.substring(longitud - 3, longitud - 2);
		var str2 = valor.substring(longitud - 2, longitud - 1);
		var str3 = valor.substring(longitud - 1, longitud);
		nuevo_valor = valor.substring(0, longitud - 1);
		if (str1 == str2 && str1 == str3 && str2 == str3) {
			swal("Error", "No se permiten 3 letras consecutivamente", "error");

			$("#" + id_input).val(nuevo_valor);
		}
	}
}

function soloNumeros(e) {
	var key = window.Event ? e.which : e.keyCode;
	return (key >= 48 && key <= 57) || key == 8;
}

function pierdeFoco(e) {
	var valor = e.value.replace(/^0*/, "");
	e.value = valor;
}

function calcularEdad() {
	var fecha = document.getElementById("txt_fecha_nacimiento").value;
	var values = fecha.split("/");
	var dia = values[0];
	var mes = values[1];
	var ano = values[2];
	fecha = dia + "/" + mes + "/" + ano;
	if (validate_fecha(fecha) == true) {
		// Si la fecha es correcta, calculamos la edad
		var values = fecha.split("/");
		var dia = values[0];
		var mes = values[1];
		var ano = values[2];
		//alert(ano);
		// cogemos los valores actuales
		var fecha_hoy = new Date();
		var ahora_ano = fecha_hoy.getYear();
		var ahora_mes = fecha_hoy.getMonth();
		var ahora_dia = fecha_hoy.getDate();
		// realizamos el calculo
		var edad = ahora_ano + 1900 - ano;
		if (ahora_mes < mes - 1) {
			edad--;
		}
		if (mes - 1 == ahora_mes && ahora_dia < dia) {
			edad--;
		}
		if (edad > 1900) {
			edad -= 1900;
		}
		document.getElementById("result").innerHTML = "Tienes " + edad + " años";
	} else {
		document.getElementById("result").innerHTML =
			"La fecha " + fecha + " es incorrecta";
	}
}

//VALIDAR QUE EL DOCENTE A REGISTRAR SEA MAYOR DE EDAD
$(function () {
	$("#txt_fecha_nacimiento").on("change", calcularEdad);
});

function calcularEdad() {
	fecha = $(this).val();
	var hoy = new Date();
	var cumpleanos = new Date(fecha);
	var edad = hoy.getFullYear() - cumpleanos.getFullYear();
	var m = hoy.getMonth() - cumpleanos.getMonth();

	if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
		edad--;
	}
	$("#age").val(edad);
}

//MODIFICADO LUIS
function valida_mayoria() {
	var valor = new Date();
	var mayoria = $("#mayoria_edad").val();
	var edad = document.getElementById("age").value;
	if (edad < mayoria) {
		$("#Textofecha").removeAttr("hidden");
		//alert("Debe ser mayor de edad!");
		$("#txt_fecha_nacimiento").val(valor);
	} else {
		$("#Textofecha").attr("hidden", "hidden");
	}
}
function seleccionar() {
	var e = new Option("SELECCIONAR", 0);

	$("#select_especialidad").empty();
	$("#select_especialidad").append(e);
	$("#select_especialidad").val(0);
}

//FECHA MAXIMA HOY
let today = new Date();
let dd = today.getDate();
let mm = today.getMonth() + 1; //January is 0!
let yyyy = today.getFullYear();
if (dd < 10) {
	dd = "0" + dd;
}
if (mm < 10) {
	mm = "0" + mm;
}

today = yyyy + "-" + mm + "-" + dd;

let minimum = "1970-01-01";

let search_date = document.getElementById("txt_fecha_ingreso");

search_date.max = today;
search_date.min = minimum;

//VALIDAR HORARIOS
function valida_horario_edita() {
	var hora_inicial = document.getElementById("txt_hi").value;
	var hora_final = document.getElementById("txt_hf").value;

	if (hora_inicial > hora_final) {
		//alert("Hora inicial incorrecta");
		swal({
			title: "alerta",
			text: "Hora incorrecta",
			type: "warning",
			showConfirmButton: true,
			timer: 20000,
		});
		document.getElementById("txt_hi").value = "";
		document.getElementById("txt_hf").value = "";
	} else {
		if (hora_inicial == hora_final) {
			swal({
				title: "alerta",
				text: "Las horas son iguales",
				type: "warning",
				showConfirmButton: true,
				timer: 20000,
			});
			// alert("Las horas son iguales");
			document.getElementById("txt_hi").value = "";
			document.getElementById("txt_hf").value = "";
		}
	}
}

//INGRESADO POR PACHECO

$(document).ready(function () {
	$.post(
		"../Controlador/registro_docente_controlador.php?op=mayoria_edad",
		function (data) {
			data = JSON.parse(data);
			// console.log(data);
			$("#mayoria_edad").val(data.valor);
		}
	);
});

//============================
//      TAMAÑO DE FOTO       =
//============================
var uploadField = document.getElementById("seleccionararchivo");

uploadField.onchange = function () {
	if (this.files[0].size > 5242880) {
		//alert("Archivo muy grande!");
		swal("Error", "Archivo muy grande!", "warning");

		this.value = "";
	}
};

//============================
//      TAMAÑO DE FOTO       =
//============================
var uploadField = document.getElementById("seleccionararchivo");

uploadField.onchange = function () {
	if (this.files[0].size > 5242880) {
		//alert("Archivo muy grande!");
		swal("Error", "Archivo muy grande!", "warning");

		this.value = "";
	}
};


function valida_jornada_hora() {
	var jornada = $("#jornada_id").val();
	var hora_entrada = $("#txt_hi").val();
	var hora_salida = $("#txt_hf").val();

	if (jornada == "TIEMPO_COMPLETO" && (hora_salida - hora_entrada) < 600) {
		swal({
			title: "Alerta",
			text:
				"Deben ser al menos 6 horas laborales para jornada completa",
			type: "warning",
			showConfirmButton: true,
			timer: 10000,
		});
		document.getElementById("txt_hi").value = "";
		document.getElementById("txt_hf").value = "";

	} else if(jornada == 'MEDIO_TIEMPO' && (hora_salida - hora_entrada) < 300){
		swal({
			title: "Alerta",
			text: "Deben ser al menos 3 horas laborales para media jornada",
			type: "warning",
			showConfirmButton: true,
			timer: 20000,
		});
		document.getElementById("txt_hi").value = "";
		document.getElementById("txt_hf").value = "";
	}else{

	}
}

$("#jornada").change(function () {
	var jornada = $(this).val();
	console.log(jornada);

    $.post(
      "../Controlador/registro_docente_controlador.php?op=descripcion",
      { id_jornada: jornada },
      function (data_, status) {
        data_ = JSON.parse(data_);

        // console.log(data_.capacidad);
        $("#jornada_id").val(data_.jornada);
      }
    );
});

$("#cb_nacionalidad").change(function () {

	var selected = cb_nacionalidad.options[cb_nacionalidad.selectedIndex].text;
	var pasaporte = document.getElementById("pasaporte");
	var identidad = document.getElementById("identidad");
	console.log(selected);

	if (selected != "HONDUREÑA") {
     
		$("#pasaporte").removeAttr("hidden");
		$("#identidad").attr("hidden", "hidden");
		identidad.disabled = true;
		pasaporte.disabled = false;
	} else {

		$("#pasaporte").attr("hidden", "hidden");
		$("#identidad").removeAttr("hidden");
		pasaporte.disabled = true;
		identidad.disabled = false;

	}
	
});
function RegistarDocente(
	nombre,
	apellidos,
	sexo,
	identidad,
	nacionalidad,
	estado,
	fecha_nacimiento,
	hi,
	hf,
	nempleado,
	fecha_ingreso
) {
	var idjornada = $("#jornada").children("option:selected").val();
	var idcategoria = $("#categoria").children("option:selected").val();
	var foto = document.getElementById("seleccionararchivo");
	var curriculo = document.getElementById("curriculum");
	var n = identidad.search("_");
	if (
		n != -1 ||
		nombre.length == 0 ||
		apellidos.length == 0 ||
		sexo == null ||
		foto.value == 0 ||
		curriculo.value == 0 ||
		identidad.length == 0 ||
		nacionalidad == null ||
		estado == null ||
		fecha_nacimiento.length == 0 ||
		hi == null ||
		hf == null ||
		nempleado.length == 0 ||
		fecha_ingreso.length == 0 ||
		idjornada == null ||
		idcategoria == null
	) {
		swal({
			title: "alerta",
			text: "Llene o seleccione los campos vacios correctamente",
			type: "warning",
			showConfirmButton: true,
			timer: 15000,
		});
	} else {
		
		nombre = nombre.toUpperCase();
		apellidos = apellidos.toUpperCase();
		identidad = identidad.toUpperCase();
		nacionalidad = nacionalidad.toUpperCase();

		estado = estado.toUpperCase();
		sexo = sexo.toUpperCase();

		$.post(
			"../Controlador/registro_docente_controlador.php?op=registar",
			{
				nombre: nombre,
				apellidos: apellidos,
				sexo: sexo,
				identidad: identidad,
				nacionalidad: nacionalidad,
				estado: estado,
				fecha_nacimiento: fecha_nacimiento,
				hi: hi,
				hf: hf,
				nempleado: nempleado,
				fecha_ingreso: fecha_ingreso,
				idjornada: idjornada,
				idcategoria: idcategoria,
			},
			function (e) {
				saveAll();
				saveAll2();
				saveAll3();
				saveAll5();
				Registrar();
				Registrarcurriculum();
			}
				
		);
		
		//window.location.href = window.location.href;
		swal("Buen trabajo!", "Los datos se insertaron correctamente!", "success");
		
	}
	
	refrescar(10000);
}
function refrescar(tiempo){
    //Cuando pase el tiempo elegido la página se refrescará 
    setTimeout("location.reload(true);", tiempo);
  }



document.getElementById("seleccionararchivo").addEventListener("change", () => {
    var archivoseleccionado = document.querySelector("#seleccionararchivo");
    var archivos = archivoseleccionado.files;
    var imagenPrevisualizacion = document.querySelector("#mostrarimagen");
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
      imagenPrevisualizacion.src = "";
      return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    var primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    var objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    imagenPrevisualizacion.src = objectURL;
  });

  var archivo = $("#seleccionararchivo").val();
  function Registrar() {
    var formData = new FormData();
    var foto = $("#seleccionararchivo")[0].files[0];
    formData.append('f', foto);

    $.ajax({
      url: 'subirimagen.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        if (respuesta != 0) {
          Swal('Mensaje De Confirmacion', "Se subio fotografia con exito", "success");
        }
      }
    });
    return false;
  }

  function Registrarcurriculum() {
    
    var formData = new FormData();
    var curriculum = $("#curriculum")[0].files[0];
    formData.append('c', curriculum);
    //formData.append('nombrearchivo',nombrearchivo);

    $.ajax({
      url: 'subirdocumento.php',
      type: 'post',
      data: formData,
      contentType: false,
      processData: false,
      success: function(respuesta) {
        if (respuesta != 0) {

          Swal('Mensaje De Confirmacion',"Se subio el curriculum con exito","success");
        }
      }
    });
    return false;
  }



