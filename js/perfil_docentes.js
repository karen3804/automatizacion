
$(document).ready(function () {

    var pulsado = false;


    $("input").keydown(function () {
        if (pulsado) return false;
        pulsado = true;
    })

        .keyup(function () {
            pulsado = false;
        });

    seleccionar()


    $('#add').click(function () {
        let i = ContarTel();

        if (i >= 3) {
            alert("Numero maximo de telefonos es de 3"); return false;
        } else {
            i++;

        }
    });



    function eliminar() {
        let i = ContarTel();
        var confirmLeave = confirm('¿Desea Eliminar el Número de telefono del docente?');
        if (confirmLeave == true) {

            var id = $(this).attr('id');
            var eliminar_tel = document.getElementById('tel' + id).value;
            console.log(eliminar_tel);
            $('#row' + id).remove();
            console.log(id);
            $.post("../Controlador/perfil_docente_controlador.php?op=EliminarTelefono",
                { eliminar_tel: eliminar_tel }, function (e) {

                });
            i--;

        }

    }
    function AgregarTel() {
        var id = $(this).attr('id');

    }


    $(document).on('click', '.btn_remove', eliminar);
    $(document).on('click', '.btn_add', AgregarTel);
    $(document).on('click', '.btn_foto', imagen);
    document.getElementById('btn_editar').addEventListener('click', editar);

    TraerDatos();


});

/*FUNCION PARA HABILITAR INPUTS CUANDPO EL USUARIO LE DE CLICK EN EDITAR INFORMACIÓN
----------------------------------------------------------------------------------------
*/

function editar() {

    let btn = document.getElementById('btn_editar');
    let inputs = document.getElementsByTagName("input");

    for (let index = 2; index <= 6; index++) {
        if (inputs[index].disabled == true) {
            inputs[index].disabled = false;
            $('#btn_guardar_edicion').removeAttr('hidden');
        } else {
            inputs[index].disabled = true;
            $('#btn_guardar_edicion').attr('hidden', 'hidden');
        }
    }

}


/*Guardar informacion editada
----------------------------------------------------------------------
*/
function EditarPerfil(nombre, apellido, identidad, nacionalidad, c_vitae) {
    var n = identidad.search("_");

    var id_persona = $("#id_persona").val();
    var nombre = $("#Nombre").val();
    var apellido = $("#txt_apellido").val();
    var identidad = $("#identidad").val();
    var nacionalidad = $("#nacionalidad").val();
    var estado = $("#estado option:selected").text();
    var c_vitae = document.getElementById("c_vitae");

    if (n != -1 || identidad.length == 0) {
        alert("Favor Completar el campo de identidad");
    } else {
        $.post("../Controlador/perfil_docente_controlador.php?op=EditarPerfil", { Nombre: nombre, apellido: apellido, identidad: identidad, id_persona: id_persona, nacionalidad: nacionalidad, estado_civil: estado, curriculum: c_vitae }, function (e) {

        });
        editar();
        swal({
            title: "Actualizado!",
            text:
                "Datos actualizados correctamente ",
            type: "warning",
            showConfirmButton: true,
            timer: 10000,
        });
    }
}


//Convertir inputs a Mayusculas
function Mayuscula(text) {

    var control = document.getElementById(text);
    control.value = control.value.toUpperCase();

}


//Funcion para ingresar grados y especialidades academicas
function AgregarEspecialidad(grado, especialidad) {

    var id_persona = $("#id_persona").val();
    $.post("../Controlador/perfil_docente_controlador.php?op=AgregarEpecialidad",
        { grado: grado, especialidad: especialidad, id_persona: id_persona }, function (e) {
            
            alert("se agrego correctamente, asegurate de actualizar tu curriculum");

        });

}


//Funcion para ingresar grados y especialidades academicas
function AgregarTelefono(telefono) {

    var n = telefono.search("_");
    var id_persona = $("#id_persona").val();

    if (n != -1 || telefono.length == 0) {
        alert("Favor Completar el campo de identidad");
    } else {
        $.post("../Controlador/perfil_docente_controlador.php?op=AgregarTelefono",
            { telefono: telefono, id_persona: id_persona }, function (e) {

            });
    }

}



//Cargar y asignar datos a los inputs
function TraerDatos() {
    var id_persona = $("#id_persona").val();
    j = ContarTel();


    $.post("../Controlador/perfil_docente_controlador.php?op=CargarDatos", { id_persona: id_persona }, function (data, status) {
        //console.log(data);
        data = JSON.parse(data);
        console.log(data);
        for (var i = 0; i < data.all.length; ++i) {

            if (data['all'][i].sexo == "M") {
                $("#genero").val(1);
            } else {
                $("#genero").val(2);
            }

            if (data['all'][i].estado_civil == "SOLTERO") {
                $("#estado").val(2);
            } else {
                $("#estado").val(1);
            }


            if (data['all'][i].descripcion == "CORREO") {
                let m = 1 + i;

                $('#tbDataCorreo').append('<tr id="row2' + m + '">' +
                    '<td id="celda2' + m + '"><input maxlength="9"  id="correo' + m + '"  type="email" name="correo" class="form-control name_list" value="' + data['all'][i].valor + '"/></td>' +
                    '<td><button type="button" name="eliminar_correo" id="' + m + '" class="btn btn-danger btn_eliminar_correo">X</button></td>' +
                    '</tr>');

            } else {
                // $("#telefono").val(data['all'][i].valor);

                j = ContarTel();

                let n = 1 + i;

                $('#tbData2').append('<tr id="row' + n + '">' +
                    '<td id="celda' + n + '"><input maxlength="9"    onkeyup="javascript:mascara()" id="tel' + n + '"  type="tel" name="tel" class="form-control name_list" value="' + data['all'][i].valor + '" placeholder="___-___"/></td>' +
                    '<td><button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button></td>' +
                    '</tr>');
            }

        }


        $("#Nombre").val(data['all'][0].nombre);
        $("#txt_apellido").val(data['all'][0].apellidos);
        $("#identidad").val(data['all'][0].identidad);
        $("#categoria").val(data['all'][0].categoria);
        $("#fecha").val(data['all'][0].fecha_nacimiento);
        $("#nacionalidad").val(data['all'][0].nacionalidad);
        $("#jornada").val(data['all'][0].jornada);
        $("#foto").attr('src', data['all'][0].foto);

        MostrarEspecialidad();
        Actividades();
        Curriculum();
        Num_Empleado()

    })
}


//contar los telefonos existentes para solo permitir los requeridos

function ContarTel() {
    let inputs = document.getElementsByTagName("input");
    let cont = 0;
    for (let index = 0; index < inputs.length; index++) {
        if ($(inputs[index]).attr('type') == "tel") {
            cont++;
        }
    }
    return cont;
}


//Guardar Formacion academioca
$('#guardarFormacion').click(function () {
    var grado = $("#id_select").children("option:selected").val();
    var grado_text = $("#id_select").children("option:selected").text();
    var txt_especialidad = $("#especialidad").val().toUpperCase();


    if (grado == "SELECCIONAR" || txt_especialidad == "") {
        alert("Debe Elegir Un grado y Su especialidad.")
    } else {
        txt_especialidad = grado_text + '-' + txt_especialidad;
        AgregarEspecialidad(grado, txt_especialidad);
        agregarFormacion(txt_especialidad);
        $("#myModal").modal('hide');
        seleccionar()
        $("#id_select").val(0);
        $("#especialidad").val('');
    }

})

//agregar formacion de forma del front-end
function agregarFormacion(valor) {
    $("#ulFormacion").append("<li>" + valor + "</li>");
}


//mostrar select de Grado
function mostrar(id_empleado_valor) {

    $.post("../Controlador/perfil_docente_controlador.php?op=SelectGrado", { id_empleado: id_empleado_valor }, function (data, status) {

        data = JSON.parse(data);

        $("#input1").val(data.especialidad);

        var texto = $("#id_select").children("option:selected").text();

        if (texto != "SELECCIONAR") {

            $("#select_especialidad").empty();

            for (i = 0; i < data.all.length; i++) {
                var o = new Option("option text", data['all'][i].especialidad);
                $(o).html(data['all'][i].especialidad);
                $("#select_especialidad").append(o);
            }
        } else {
            $("#select_especialidad").empty();
            seleccionar()
            $("#select_especialidad").val(0);
        }

    })

}

function llenar_select1() {

    var cadena = "&activar=activar"
    $.ajax({
        url: "../Controlador/perfil_docente_controlador.php?op=select1",
        type: "POST",
        data: cadena,
        success: function (r) {
            $("#id_select").html(r).fadeIn();
            var o = new Option("SELECCIONAR", 0);

            $("#id_select").append(o);
            $("#id_select").val(0);
        }
    });
}
llenar_select1();


$("#id_select").val(0);
//Agregar valor de seleccionar
function seleccionar() {
    var e = new Option("SELECCIONAR", 0);

    $("#select_especialidad").empty();
    $("#select_especialidad").append(e);
    $("#select_especialidad").val(0);

}


//MOSTRAR ESPECIALIDADES DEL DOCENTE

function MostrarEspecialidad() {
    
    var id_persona = $("#id_persona").val();
    $.post("../Controlador/perfil_docente_controlador.php?op=MostrarEspecialidad", { id_persona: id_persona },
        function (data, status) {

            data = JSON.parse(data);


            for (i = 0; i < data.all.length; i++) {
                var valor = data['all'][i].ESPECIALIDAD;
                agregarFormacion(valor);
            }

        });

}


//Agregar Telefono en el front
function addTel() {
    var telefono = document.getElementById("tel");

    j = ContarTel();
    let n = 1 + j;

    var n1 = telefono.value.search("_");

    if (n1 != -1 || telefono.value.length == 0 ) {
        alert("Completar El Campo Telefono Por Favor");
    } else {
       

        $('#tbData2').append(
            '<tr id="row' + n + '">' +
            '<td id="celda' + n + '"><input maxlength="9"    onkeyup="javascript:mascara()" id="tel' + n + '"  type="tel" name="tel" class="form-control name_list" value="' + telefono.value + '" placeholder="___-___"/></td>' +
            '<td><button type="button" name="remove" id="' + n + '" class="btn btn-danger btn_remove">X</button></td>' +
            '</tr>'
        );

        AgregarTelefono(telefono.value);
        telefono.value = "";
    }

    $("#ModalTel").modal('hide');
}


// Cambiar Imagen de Perfil
function imagen() {

    var frmData = new FormData;
    frmData.append("imagen", $("input[name=imagen]")[0].files[0]);
    frmData.append("id_persona", $("#id_persona").val());

    $.ajax({

        url: "../Controlador/perfil_docente_controlador.php?op=CambiarFoto",
        type: "post",
        data: frmData,
        processData: false,
        contentType: false,
        cache: false,

        success: function (data) {
            data = JSON.parse(data);

            $("#foto").attr('src', data);
            $('#imagen').val('');
            $('#btn_mostrar').removeAttr('hidden');
            $('#imagen').attr('hidden', 'hidden');
            $('#btn_foto').attr('hidden', 'hidden');
        }
    });


    return false;

}


//CARGAR TABLA DE ACTIVIDADES
function Actividades() {

    var id_persona = $("#id_persona").val();
    $.post("../Controlador/perfil_docente_controlador.php?op=Actividades", { id_persona: id_persona }, function (data, status) {

        data = JSON.parse(data);

        for (i = 0; i < data.actividades.length; ++i) {

            $('#tbl_comisiones').append('<tr id="row' + i + '">' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + data["actividades"][i].comision + '</td>' +
                '<td>' + data["actividades"][i].actividad + '</td>' +
                '</tr>'

            );
        }
    });

}

//CARGAR CURRICULUM
function Curriculum() {
    var id_persona = $("#id_persona").val();

    $.post("../Controlador/perfil_docente_controlador.php?op=Curriculum", { id_persona: id_persona }, function (data, status) {
        data = JSON.parse(data);

        $("#curriculum").attr('href', data.curriculum);

    });
}

//CARGAR NUMERO DE EMPLEADO
function Num_Empleado() {
    var id_persona = $("#id_persona").val();

    $.post("../Controlador/perfil_docente_controlador.php?op=Num_Empleado", { id_persona: id_persona }, function (data, status) {
        data = JSON.parse(data);

        $("#empleado").val(data.valor);

    });
}

//bOTONES PARA ACTUALIZAR FOTO
function MostrarBoton() {
    $('#imagen').removeAttr('hidden');
    $('#btn_foto').removeAttr('hidden');
    $('#btn_mostrar').attr('hidden', 'hidden');
}



function ValidarIdentidad(identidad) {
  
    	//console.log(n);
	var n = identidad.search('_');
	console.log(n);
	var mayor_edad = $('#mayoria_edad').val();
	var depto = identidad.substring(0, 4);
	var contar = depto;

	console.log(contar);

	if (n == 5) {
		var ver = false;
		$.post('../Controlador/perfil_docente_controlador.php?op=validar_depto', { codigo: contar }, function(
			data,
			status
		) {
			console.log(data);
			data = JSON.parse(data);
			console.log(data);
			/*si no tiene datos va copiar  */
			//$("#contar_depto").val(data.regis);

			if (data.regis == 0) {
				var ver = true;

				if (ver == true) {
					swal(
						'Datos incorrectos',
						'Asegurese de Introducir los digitos correspondientes a su departamento y municipio',
						'warning'
					);
					$('#contar_depto').val('');
					$('#identidad').val('');
					$('#identidad').attr('placeholder', '____-____-_____');
				}
			}
		});
	}

	if (n == 10) {
		var currentTime = new Date();
		var year = currentTime.getFullYear();
		var anio = identidad.substring(5, 9);
		//console.log(year-anio);
		if (year - anio < mayor_edad) {
			//swal("Aviso", "Debe ser mayor de edad", "warning");
			$('#Textomayor').removeAttr('hidden');
			//$("#identidad").val("");
			//$("#identidad").attr("placeholder", "____-____-_____");
		} else {
			$('#Textomayor').attr('hidden', 'hidden');
		}

		if (anio == '0000') {
			swal('Aviso', 'Año invalido', 'warning');
			$('#identidad').val('');
			$('#identidad').attr('placeholder', '____-____-_____');
		} else {
		}
	}

	if (n == -1) {
		var ultimo = identidad.substring(10, 15);
		// console.log(anio);
		if (ultimo == '00000') {
			swal('Aviso', 'no se permiten 5 ceros', 'warning');
			$('#identidad').val('');
			$('#identidad').attr('placeholder', '____-____-_____');
		} else {
		}
	}

}

$(document).ready(function () {
  $.post(
    "../Controlador/perfil_docente_controlador.php?op=mayoria_edad",
    function (data) {
      data = JSON.parse(data);
      // console.log(data);
      $("#mayoria_edad").val(data.valor);
    }
  );
});
$(function () {
  $("#fecha").on("change", calcularEdad);
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


function ExisteIdentidad() {

    identidad = $("#identidad").val();

    $.post("../Controlador/perfil_docente_controlador.php?op=ExisteIdentidad",
        { identidad: identidad }, function (data, status) {
            //console.log(data);
            data = JSON.parse(data);
            console.log(data);
            if (data.existe == 1) {
                $('#TextoIdentidad').removeAttr('hidden');

            } else {
                $('#TextoIdentidad').attr('hidden', 'hidden');
            }

        }
    );



}

function MismaLetra(id_input) {
    var valor = $("#" + id_input).val();
    var longitud = valor.length
    console.log(valor + longitud);
    if (longitud > 2) {
        var str1 = valor.substring(longitud - 3, longitud - 2);
        var str2 = valor.substring(longitud - 2, longitud - 1);
        var str3 = valor.substring(longitud - 1, longitud);
        nuevo_valor = valor.substring(0, longitud - 1);
        if (str1 == str2 && str1 == str3 && str2 == str3) {
            alert("No se permiten 3 letras igules consecutivamente");
            $("#" + id_input).val(nuevo_valor);
        }

    }
}

//document.getElementById('Nombre').addEventListener('keyup',MismaLetra);


$('#btn_editar_curri').click(function () {


    $('button').attr('hidden', 'hidden');
    window.print();
    $('button').removeAttr('hidden');
});


//TIPO DE CONTACTOS
function TipoContacto() {

    var cadena = "&activar=activar"
    $.ajax({
        url: "../Controlador/perfil_docente_controlador.php?op=TipoContacto",
        type: "POST",
        data: cadena,
        success: function (r) {
            $("#tipo_contacto").html(r).fadeIn();
            var o = new Option("SELECCIONAR", 0);

            $("#tipo_contacto").append(o);
            $("#tipo_contacto").val(0);
        }
    });
}
TipoContacto();

$('#tipo_contacto').change(function () {
    var value_tipo = $("#tipo_contacto").children("option:selected").val();
    var tipo_contacto = $("#tipo_contacto").children("option:selected").text();

    if (tipo_contacto != "SELECIONAR") {

        $('#lbl_tipo').text(tipo_contacto);

        if (value_tipo == 1 || value_tipo == 2) {

            //$('#txt_contacto').prop('type','email');
            $('#txt_contacto_tel').removeAttr('hidden');
            $('#txt_contacto').attr('hidden', 'hidden');

        } else if (value_tipo == 4) {
            $('#txt_contacto').removeAttr('hidden');
            $('#txt_contacto').attr('type', 'email');
            $('#txt_contacto_tel').attr('hidden', 'hidden');


        } else {
            $('#txt_contacto').removeAttr('hidden');
            $('#txt_contacto').attr('type', 'email');
            $('#txt_contacto_tel').attr('hidden', 'hidden');

        }

        var type = $('#txt_contacto').attr('type');
        console.log(type);


    }
});

function pregunta1() {
  $("#modalencuesta").modal({ backdrop: "static", keyboard: false });
  $("#modalencuesta").modal("show");
}
function pregunta2() {
  $("#modalencuesta2").modal({ backdrop: "static", keyboard: false });
  $("#modalencuesta2").modal("show");
}
function pregunta3() {
  $("#modalencuesta3").modal({ backdrop: "static", keyboard: false });
  $("#modalencuesta3").modal("show");
}
function ventana() {
  window.open(
    "../vistas/encuesta_docente_vista.php",
    "Encuesta"
  );
}

function enviarpregunta1(){
  
    var id_persona = $('#id_persona').val();

    var id_area = $('[name="areas[]"]:checked')
      .map(function () {
        return this.value;
      })
      .get();

   console.log(id_area);
    console.log(id_persona);
    $.ajax({
      type: "POST",
      url: "../Controlador/encuesta1_docente_controlador.php",
    //  data: { array: id_area}, //capturo array
      data: { array_prefe: JSON.stringify(id_area), id_persona: id_persona },
      success: function (data) {},
    });

   
   //enviar(id_persona);
    // var arr = [];

    // $("input:checkbox[name=areas]:checked").each(function () {
    //   arr.push($(this).val());
    // });
    //  console.log(arr);

   


}
function enviarpregunta2() {
  var id_persona = $("#id_persona").val();

  var id_area = $('[name="areas2[]"]:checked')
    .map(function () {
      return this.value;
    })
    .get();

  console.log(id_area);
  console.log(id_persona);
  $.ajax({
    type: "POST",
    url: "../Controlador/encuesta2_docente_controlador.php",
    //  data: { array: id_area}, //capturo array
    data: { array_prefe1: JSON.stringify(id_area), id_persona: id_persona },
    success: function (data) {},
  });

  //enviar(id_persona);
  // var arr = [];

  // $("input:checkbox[name=areas]:checked").each(function () {
  //   arr.push($(this).val());
  // });
  //  console.log(arr);
}
function enviarpregunta3() {
  var id_persona = $("#id_persona").val();

  var id_asignatura = $('[name="asignatura3[]"]:checked')
    .map(function () {
      return this.value;
    })
    .get();

  console.log(id_asignatura);
  console.log(id_persona);
  $.ajax({
    type: "POST",
    url: "../Controlador/encuesta3_docente_controlador.php",
    //  data: { array: id_area}, //capturo array
    data: {
      array_prefe1: JSON.stringify(id_asignatura),
      id_persona: id_persona,
    },
    success: function (data) {},
  });

  //enviar(id_persona);
  // var arr = [];

  // $("input:checkbox[name=areas]:checked").each(function () {
  //   arr.push($(this).val());
  // });
  //  console.log(arr);
}
function enviarpregunta4() {
  var id_persona = $("#id_persona").val();

  var id_asignatura = $('[name="asignatura4[]"]:checked')
    .map(function () {
      return this.value;
    })
    .get();

  console.log(id_asignatura);
  console.log(id_persona);
  $.ajax({
    type: "POST",
    url: "../Controlador/encuesta4_docente_controlador.php",
    //  data: { array: id_area}, //capturo array
    data: {
      array_prefe1: JSON.stringify(id_asignatura),
      id_persona: id_persona,
    },
      success: function (data) {
        
    },
  });

  //enviar(id_persona);
  // var arr = [];

  // $("input:checkbox[name=areas]:checked").each(function () {
  //   arr.push($(this).val());
  // });
  //  console.log(arr);
}




$("#btn_modal1").click(function () {
  var persona = $("#id_persona").val();
  console.log(persona);
    $.post(
      "../Controlador/respuesta1_carga_controlador.php",
      { id_persona: persona },

      function (data, status) {
        console.log(data);
        data = JSON.parse(data);

        console.log(data.id_area);

      }
  );


   
  // $.ajax({
  //   url: "../Controlador/respuesta1_carga_controlador.php",
  //   type: "POST",
  //   data: {
  //     // cod_asig: ,
  //     id_persona: persona,
  //   },
  // }).done(function (resp) {
  //   console.log(resp.id_area);
  // });
});

 function alerta() {
    
     var chk = document.getElementById("c").value;
     alert(chk);
 }




$('#add_correo').click(function () {
    let i = ContarCorreo();

    if (i >= 2) {
        alert("Numero maximo de correos es de 2"); return false;
    } else {
        i++;

    }
});

function Registrarcurriculum() {

    var formData = new FormData();
    var curriculum = $("#c_vitae")[0].files[0];
    formData.append('c', curriculum);
    formData.append("id_persona", $("#id_persona").val());

    $.ajax({
        url: '../Controlador/perfil_docente_controlador.php?op=cambiarCurriculum',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            if (respuesta = 1) {

                Swal('Mensaje De Confirmacion', "Se subio el curriculum con exito", "success");
            }
        }
    });
    return false;
}


function AgregarCorreo(correo) {

    var id_persona = $("#id_persona").val();
    console.log(correo);

    $.post("../Controlador/perfil_docente_controlador.php?op=AgregarCorreo",
        { id_persona: id_persona, correo: correo }, function (e) {

        });


}

function ContarCorreo() {
    let inputs = document.getElementsByTagName("input");
    let cont = 0;
    for (let index = 0; index < inputs.length; index++) {
        if ($(inputs[index]).attr('type') == "correo") {
            cont++;
        }
    }
    return cont;
}

function addCorreo() {
    j = ContarCorreo();
    let n = 1 + j;
    var correo = $("#correo").val();

    console.log(correo);
    $('#tbDataCorreo').append(
        '<tr id="row' + n + '">' +
        '<td id="celda' + n + '"><input maxlength="9" id="correo' + n + '"  type="correo" name="correo" class="form-control name_list" value="' + correo + '"/></td>' +
        '<td><button type="button" name="removeCorreo" id="' + n + '" class="btn btn-danger btn_removeCorreo">X</button></td>' +
        '</tr>'
    );

    AgregarCorreo(correo);
    correo.value = "";

    $("#ModalCorreo").modal('hide');
}

function MostrarBotonCurriculum() {
    $('#c_vitae').removeAttr('hidden');
    $('#btn_curriculum').removeAttr('hidden');
    $('#btn_mostrar_curriculum').attr('hidden', 'hidden');
}



