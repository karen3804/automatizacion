/* check unidades y dis en modificar carga */
$(document)
  .click(function () {
    var checked = $(".ch:checked").length;
    console.log(checked);
    var unid_valorativas = document.getElementById("txt_unidades_edita").value;

    if (unid_valorativas == "4" && checked == "5") {
      swal({
        title: "Alerta",
        text: "Solo se permiten 4 dias como maximo ",
        type: "warning",
        showConfirmButton: true,
        timer: 10000,
      });

      document.getElementById("Lu1").checked = false;
      document.getElementById("Ma1").checked = false;
      document.getElementById("Mi1").checked = false;
      document.getElementById("Ju1").checked = false;
      document.getElementById("Vi1").checked = false;
      document.getElementById("Sa1").checked = false;
      document.getElementById("Do1").checked = false;
    } else {
    }
    if (unid_valorativas == "5" && checked == "6") {
      swal({
        title: "Alerta",
        text: "Solo se permiten 5 dias como maximo ",
        type: "warning",
        showConfirmButton: true,
        timer: 10000,
      });

      document.getElementById("Lu1").checked = false;
      document.getElementById("Ma1").checked = false;
      document.getElementById("Mi1").checked = false;
      document.getElementById("Ju1").checked = false;
      document.getElementById("Vi1").checked = false;
      document.getElementById("Sa1").checked = false;
      document.getElementById("Do1").checked = false;
    } else {
    }

    if (unid_valorativas == "3" && checked == "4") {
      swal({
        title: "Alerta",
        text: "Solo se permiten 3 dias como maximo ",
        type: "warning",
        showConfirmButton: true,
        timer: 10000,
      });

      document.getElementById("Lu1").checked = false;
      document.getElementById("Ma1").checked = false;
      document.getElementById("Mi1").checked = false;
      document.getElementById("Ju1").checked = false;
      document.getElementById("Vi1").checked = false;
      document.getElementById("Sa1").checked = false;
      document.getElementById("Do1").checked = false;
    } else {
    }

    if (unid_valorativas == "2" && checked == "3") {
      swal({
        title: "Alerta",
        text: "Solo se permiten 2 dias como maximo ",
        type: "warning",
        showConfirmButton: true,
        timer: 10000,
      });

      document.getElementById("Lu1").checked = false;
      document.getElementById("Ma1").checked = false;
      document.getElementById("Mi1").checked = false;
      document.getElementById("Ju1").checked = false;
      document.getElementById("Vi1").checked = false;
      document.getElementById("Sa1").checked = false;
      document.getElementById("Do1").checked = false;
    } else {
    }
  })
  .trigger("click");

/* modificar carga */
function modificar_carga_academica() {
  var idcarga = $("#txt_carga_id").val();
  // var num_doce = $("#txt_num_doc_edita").val();
  // var nombre_doce = $("#txt_nombre_doc_edita").val();
  // var cod_asig = $("#txt_cod_asignatura_edita").val();
  var cb_asig = $("#cbm_asignatura_edita").val();
  var seccion = $("#txt_seccion_edita").val();
  var cb_hi = $("#cbm_hi_edita").val();
  var cb_hf = $("#cbm_hf_edita").val();
  var dias = $("#txt_dias_edita").val();
  // var cb_edif = $("#cbm_edificio_edita").val();
  var cb_aula = $("#cbm_aula_edita").val();
  var cb_modalidad = $("#cbm_modalidad_edita").val();
  var matriculados = $("#txt_matriculados_edita").val();
  //var control = $("#txt_control_edita").val();
  var idPersona = $("#txt_id_docente").val();
  var idPeriodo = $("#txt_id_periodo").val();
  //para validar que modifico

  var entradatabla = $("#txthrentradatabla").val();
  var salidatabla = $("#txthrsalidatabla").val();
  var aulatabla = $("#txtaulatabla").val();

  if (
    idcarga.length == 0 ||
    // num_doce.length == 0 ||
    // nombre_doce.length == 0 ||
    // cod_asig.length == 0 ||
    cb_asig == null ||
    seccion.length == 0 ||
    cb_hi == null ||
    cb_hf == null ||
    dias.length == 0 ||
    // cb_edif.length == 0 ||
    cb_aula == null ||
    matriculados.length == 0 ||
    cb_modalidad == null
    // control.length == 0
  ) {
    swal({
      title: "alerta",
      text: "Llene o seleccione los campos vacios",
      type: "warning",
      showConfirmButton: true,
      timer: 15000,
    });
  } else {
    swal({
      title: "alerta",
      text: "Por favor espere",
      type: "warning",
      showConfirmButton: false,
      timer: 20000,
    });

    var hora_inicial = document.getElementById("cbm_hi_edita").value;
    var hora_final = document.getElementById("cbm_hf_edita").value;
    var horas_validas = document.getElementById("txt_hras_validas").value;

    if (hora_inicial > hora_final) {
      swal({
        title: "alerta",
        text: "Hora inicial incorrecta",
        type: "warning",
        showConfirmButton: true,
        timer: 20000,
      });
      document.getElementById("cbm_hi_edita").value = "";
      document.getElementById("cbm_hf_edita").value = "";
    } else if (hora_inicial == hora_final) {
      swal({
        title: "alerta",
        text: "Las horas son iguales",
        type: "warning",
        showConfirmButton: true,
        timer: 20000,
      });
      // alert("Las horas son iguales");
      // document.getElementById("cbm_hi_edita").value = "";
      document.getElementById("cbm_hf_edita").value = "";
    } else {
      if (
        entradatabla != cb_hi ||
        aulatabla != cb_aula ||
        salidatabla != cb_hf
      ) {
        $.post(
          "../Controlador/reporte_carga_controlador.php?op=verificarCarga",
          {
            id_periodo: idPeriodo,
            hora_final: cb_hf,
            //seccion: seccion,
            hora_inicial: cb_hi,
            id_aula: cb_aula,
            //Id_asignatura: cb_asig,
            //dias: dias
          },

          function (data, status) {
            console.log(data);
            data = JSON.parse(data);
            /*si no tiene datos va copiar  */
            $("#txt_registro").val(data.registro);
            var registro = $("#txt_registro").val();
            var aula_codigo = $("#txt_descripcion_aula").val();

            if (registro > 0) {
              // swal(
              //   "Alerta!",
              //   "el periodo actual contiene datos, registre un periodo nuevo para continuar la copia",
              //   "warning"
              // );
              swal({
                title: "Alerta",
                text:
                  "Ya hay una carga asignada a esa hora, Hora Inicial: " +
                  cb_hi +
                  ",Hora Final: " +
                  cb_hf +
                  ", Aula: " +
                  aula_codigo +
                  " ",
                type: "warning",
                showConfirmButton: true,
                timer: 6000,
                // "El docente: "+ nombre_doce +" ya tiene una carga asignada, Seccion: "+ seccion +" Hora Inicial: "+ cb_hi +", Aula: "+ cb_aula +", Asignatura: "+ cb_asig +" ",
              });
              document.getElementById("txt_registro").value = "";
            } else {
              $.ajax({
                url: "../Controlador/modificar_carga_controlador.php",
                type: "POST",
                data: {
                  // cod_asig: ,
                  control: control,
                  seccion: seccion,
                  hora_inicial: cb_hi,
                  hora_final: cb_hf,
                  num_alumnos: matriculados,
                  id_aula: cb_aula,
                  id_asignatura: cb_asig,
                  dias: dias,
                  id_modalidad: cb_modalidad,
                  // cb_edif: rol,
                  id_carga_academica: idcarga,
                },
              }).done(function (resp) {
                if (resp > 0) {
                  $("#modal_editar").modal("hide");
                  swal(
                    "Buen trabajo!",
                    "datos actualizados correctamente!",
                    "success"
                  );
                  document.getElementById("txt_registro").value = "";

                  cerrar();
                  table.ajax.reload();
                } else {
                  swal(
                    "Alerta!",
                    "No se pudo completar la actualización",
                    "warning"
                  );
                  document.getElementById("txt_registro").value = "";
                }
              });
            }
          }
        );
      } else {
        $.ajax({
          url: "../Controlador/modificar_carga_controlador.php",
          type: "POST",
          data: {
            // cod_asig: ,
            control: control,
            seccion: seccion,
            hora_inicial: cb_hi,
            hora_final: cb_hf,
            num_alumnos: matriculados,
            id_aula: cb_aula,
            id_asignatura: cb_asig,
            dias: dias,
            id_modalidad: cb_modalidad,
            // cb_edif: rol,
            id_carga_academica: idcarga,
          },
        }).done(function (resp) {
          if (resp > 0) {
            $("#modal_editar").modal("hide");
            swal(
              "Buen trabajo!",
              "datos actualizados correctamente!",
              "success"
            );
            document.getElementById("txt_registro").value = "";

            cerrar();
            table.ajax.reload();
          } else {
            swal("Alerta!", "No se pudo completar la actualización", "warning");
            document.getElementById("txt_registro").value = "";
          }
        });
      }

      //  } else { */
      /* toda la validacion de existe, y modificar */
    }
  }
}

$(document).ready(function () {
  $('[name="check[]"]').click(function () {
    var arr1 = $('[name="check[]"]:checked')
      .map(function () {
        return this.value;
      })
      .get();

    var str1 = arr1.join(",");

    $("#arr1").text(JSON.stringify(arr1));

    $("#str1").text(str1);

    $("#txt_dias_edita").val(str1);

    console.log(str1);
  });
});

//llenar modalidad editar
function llenar_modalidadd() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/reporte_carga_controlador.php?op=modalidad",
    type: "POST",
    data: cadena,
    success: function (r) {
      // console.log(r);
      $("#cbm_modalidad_edita").html(r).fadeIn();
    },
  });
}
llenar_modalidadd();

// trae hora docente
function hora(id) {
  $.post(
    "../Controlador/reporte_carga_controlador.php?op=validarhoradocente",
    { id_persona: id },
    function (data, status) {
      data = JSON.parse(data);
      // console.log(data);
      //mostrarform(true);
      $("#txtentrada").val(data.Hora_Entrada);
      $("#txtsalida").val(data.Hora_Salida);
    }
  );
}

function limpiar_registro_eliminar() {
  document.getElementById("txt_carga_id_eliminar").value = "";
}

function validaentrada_edita() {
  var hrEntrada = document.getElementById("txtentrada").value;
  var hora_inicial = document.getElementById("cbm_hi_edita").value;

  var nombre_doce = $("#txt_nombre_doc_edita").val();
  if (hora_inicial < hrEntrada) {
    swal({
      title: "alerta",
      text:
        "Ha seleccionado una hora para la asignatura que no corresponde al horarario de entrada del docente: " +
        nombre_doce +
        " ,Hora de entrada: " +
        hrEntrada +
        "",
      type: "warning",
      showConfirmButton: true,
      timer: 10000,
    });
  }
}

function validahoraperiodo_edita() {
  var hora_final = document.getElementById("cbm_hf_edita").value;
  var hrSalida = document.getElementById("txtsalida").value;
  var hora_final = document.getElementById("cbm_hf_edita").value;
  var horas_validas = document.getElementById("txt_hras_validas").value;
  var hora_inicial = document.getElementById("cbm_hi_edita").value;

  var nombre_doce = $("#txt_nombre_doc_edita").val();

  var nombre_doce = $("#txt_nombre_doc_edita").val();
  if (
    hora_final - hora_inicial > horas_validas * 100 &&
    hora_final - hora_inicial > horas_validas * 100 != 4
  ) {
    swal({
      title: "Alerta",
      text: "Sobrepasa el horario establecido para el tipo de periodo!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
      } else {
        document.getElementById("cbm_hf_edita").value = "";
      }
    });
  }

  if (hora_final > hrSalida) {
    swal({
      title: "Alerta",
      text:
        "El horario de salida sobrepasa el establecido para el docente: " +
        nombre_doce +
        ", hora salida: " +
        hrSalida +
        "",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
      } else {
        document.getElementById("cbm_hf_edita").value = "";
      }
    });
  }
}

/* para modal editar DATOS*/
var id_aula;
var id_edificio;
var idPersona;
var hr_entrada_tabla;
var hr_salida_tabla;
var aulatabla;
$("#tabla_carga").on("click", ".editar", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }

  $("#txt_id_docente").val(data.idpersona);

  idPersona = $("#txt_id_docente").val();

  console.log(idPersona);

  hora(idPersona);

  $("#modal_editar").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar").modal("show");
  // listar_combo_edificio_edita();
  // listar_combo_aula_edita();

  $("#txt_carga_id").val(data.id_carga_academica);
  $("#txt_num_doc_edita").val(data.num_empleado);
  $("#txt_nombre_doc_edita").val(data.nombres);
  $("#txt_cod_asignatura_edita").val(data.codigo);
  $("#cbm_asignatura_edita").val(data.id_asignatura).trigger("change");
  $("#txt_seccion_edita").val(data.seccion);
  $("#cbm_hi_edita").val(data.hra_inicio).trigger("change");
  $("#cbm_hf_edita").val(data.hra_final).trigger("change");
  //$("#txt_dias_edita").val(" ");
  $("#txt_dias_edita").val(data.dia);

  $("#cbm_edificio_edita").val(data.id_edificio).trigger("change");
  $("#cbm_aula_edita").val(data.id_aula).trigger("change");
  $("#txt_matriculados_edita").val(data.num_alumnos);
  $("#txt_control_edita").val(data.control);
  $("#txt_unidades_edita").val(data.unidades_valorativas);
  $("#cbm_modalidad_edita").val(data.id_modalidad).trigger("change");

  id_aula = data.id_aula;
  id_edificio = data.id_edificio;

  hr_entrada_tabla = data.hra_inicio;
  hr_salida_tabla = data.hra_final;
  aulatabla = data.id_aula;

  datosValidacion(hr_salida_tabla, hr_entrada_tabla, aulatabla);

  listar_aula(id_aula, id_edificio);

  id_asignatura = data.Id_asignatura;
  mostrar2(id_asignatura);

  seleccionar_dias($("#txt_dias_edita").val(), ",");
});

/* para validar si existe y modifica */

function datosValidacion(salida, entrada, aula) {
  $("#txthrentradatabla").val(entrada);
  $("#txthrsalidatabla").val(salida);
  $("#txtaulatabla").val(aula);
}

/* eliminar registro ABRE MODAL */

$(document).on("click", ".borrar", function () {
  $("#modal_borrar").modal({ backdrop: "static", keyboard: false });
  $("#modal_borrar").modal("show");

  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }

  $("#txt_carga_id_eliminar").val(data.id_carga_academica);
  $("#txt_docente_eliminar").val(data.nombres);
  $("#txt_seccion_eliminar").val(data.seccion);
  $("#txt_asignatura_eliminar").val(data.asignatura);
});
//ELIMINAR REGISTRO DE GESTION
function eliminarRegistro() {
  var id = $("#txt_carga_id_eliminar").val();
  console.log(id);

  swal({
    title: "Alerta",
    text: "Por favor espera!",
    type: "warning",
    showConfirmButton: false,
    timer: 20000,
  });
  $.ajax({
    url: "../Controlador/borrar_carga_gestion_controlador.php",
    type: "POST",
    data: {
      id_carga_academica: id,
    },
  }).done(function (resp) {
    console.log(resp);

    if (resp > 0) {
      if (resp == 1) {
        swal("buen trabajo!", "Se elimino correctamente!", "success");
        table.ajax.reload();
      }
    } else {
      swal("Error!", "No se pudo eliminar!", "warning");
    }
  });
}
//LLENAR AULA Y CAPACIDAD CODIGO
function listar_aula(id_aula, id_edificio) {
  $.post(
    "../Controlador/reporte_carga_controlador.php?op=cargar_aula",
    { id_aula: id_aula, id_edificio: id_edificio },
    function (data1, status) {
      $("#cbm_aula_edita").html(data1);
      // console.clear();
      console.log(data1);
    }
  );
  $.post(
    "../Controlador/reporte_carga_controlador.php?op=capacidad",
    { id_aula: id_aula },
    function (data_, status) {
      data_ = JSON.parse(data_);

      console.log(data_.capacidad);
      $("#txt_capacidad_edita").val(data_.capacidad);
      $("#txt_descripcion_aula").val(data_.codigo);
    }
  );
}

/* //LLENAR COMBOBOX EDIFICIO Y CAPACIDAD AULA*/

$(function () {
  // Lista de edificios
  $.post("../Controlador/edificio.php").done(function (respuesta) {
    $("#cbm_edificio_edita").html(respuesta);
  });

  $("#cbm_aula_edita").change(function () {
    var id_aula = $(this).val();
    console.log(id_aula);

    $.post(
      "../Controlador/reporte_carga_controlador.php?op=capacidad",
      { id_aula: id_aula },
      function (data_, status) {
        data_ = JSON.parse(data_);

        console.log(data_.capacidad);
        $("#txt_capacidad_edita").val(data_.capacidad);
        $("#txt_descripcion_aula").val(data_.codigo);
      }
    );
  });

  // lista de aulas
  $("#cbm_edificio_edita").change(function () {
    var el_edificio = $(this).val();
    console.log(el_edificio);
    document.getElementById("txt_capacidad_edita").value = "";
    // Lista deaulas
    $.post("../Controlador/aula.php", {
      id_edificio: el_edificio,
    }).done(function (respuesta) {
      $("#cbm_aula_edita").html(respuesta);
      console.log(respuesta);
    });
  });

  $.post("../Controlador/aula.php").done(function (respuesta) {
    $("#cbm_aula_edita").html(respuesta);
  });
});

/* ejecutar seleccion de los check editar*/
function seleccionar_dias(cadenaADividir, separador) {
  //Esta funcion me separa mi resultado por comas
  var arrayDeCadenas = cadenaADividir.split(separador);

  for (var i = 0; i < arrayDeCadenas.length; i++) {
    $("#" + arrayDeCadenas[i] + "1").prop("checked", true);
    console.log(arrayDeCadenas[i]);
  }
}
//LIMPIAR CHAECK DE EDITAR Y LA CAPACIDAD
function cerrar() {
  $(".ch").prop("checked", false);
  document.getElementById("txt_capacidad_edita").value = "";
  document.getElementById("txt_carga_id_eliminar").value = "";
  document.getElementById("txtsalida").value = "";
  document.getElementById("txtentrada").value = "";
  document.getElementById("txt_unidades_edita").value = "";
  document.getElementById("txthrsalidatabla").value = "";
  document.getElementById("txthrentradatabla").value = "";
  document.getElementById("txtaulatabla").value = "";
}
/* tabla carga */
var table;
function TablaCarga() {
  table = $("#tabla_carga").DataTable({
    paging: true,
    lengthChange: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: true,
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
      url: "../Controlador/tabla_carga_controlador.php",
      type: "POST",
    },
    dom: "Bfrtilp",
   
    buttons: [
      {
        extend: "excelHtml5",
        text: '<i class="fas fa-file-excel"></i> ',
        titleAttr: "Exportar a Excel",
        className: "btn btn-success",
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
        pageSize: "A4",
        exportOptions: {
          columns: [1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15],
        },
        title: " Carga Academica",
        messageTop: "REPORTE DE CARGA ACADEMICA", //Coloca el título dentro del PDF
      },
      {
        extend: "print",
        text: '<i class="fa fa-print"></i> ',
        titleAttr: "Imprimir",
        className: "btn btn-info",
      },
    ],
    columns: [
      {
        defaultContent:
          // "<button style='font-size:13px;' type='button' class='editar btn btn-primary'><i class='fas fa-edit'></i></button><button style='font-size:10px;' type='button' class='eliminar btn btn-primary'><i class='fas fa-trash-alt'></i></button>",

          "<div class='text-center'><div class='btn-group'><button class='editar btn btn-primary btn-m '><i class='fas fa-edit'></i></button> <button id='borrar' class='borrar btn btn-danger btn-m '><i class='fas fa-trash-alt'></i></button></div></div>",
      },
      { data: "id_carga_academica" },
      { data: "num_empleado" },
      { data: "nombres" },
      { data: "codigo" },
      { data: "asignatura" },
      { data: "unidades_valorativas" },
      { data: "seccion" },
      { data: "hra_inicio" },
      { data: "hra_final" },
      { data: "dia" },
      { data: "aula" },
      { data: "edificio" },
      { data: "num_alumnos" },
      { data: "control" },
      { data: "modalidad" },
    ],

    language: idioma_espanol,
    select: true,
  });
}

// ----------------- COMBOBOX DE ASIGNATURA----------------
function llenar_selectasignatura() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/reporte_carga_controlador.php?op=select2",
    type: "POST",
    data: cadena,
    success: function (r) {
      // console.log(r);

      $("#cbm_asignatura_edita").html(r).fadeIn();
    },
  });
}
llenar_selectasignatura();

function mostrarasignaturacodigo(codigo) {
  $.post(
    "../Controlador/reporte_carga_controlador.php?op=mostrar2",
    { Id_asignatura: codigo },
    function (data, status) {
      data = JSON.parse(data);
      // console.log(data);
      //mostrarform(true);
      $("#txt_unidades_edita").val(data.uv);
      $("#txt_cod_asignatura_edita").val(data.codA);
    }
  );
}

$("#cbm_asignatura_edita").change(function () {
  var codigo = $(this).val();
  console.log(codigo);
  $.post(
    "../Controlador/reporte_carga_controlador.php?op=mostrar2",
    { Id_asignatura: codigo },
    function (data, status) {
      data = JSON.parse(data);
      // console.log(data);
      //mostrarform(true);
      $("#txt_unidades_edita").val(data.uv);
      $("#txt_cod_asignatura_edita").val(data.codA);
    }
  );
});

function valida_matriculados_edita() {
  var capacidad = document.getElementById("txt_capacidad_edita").value;
  var matriculados = document.getElementById("txt_matriculados_edita").value;
  if (matriculados > capacidad) {
    swal({
      title: "Alerta",
      text: "Esta excediendo la capacidad, desea continuar?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
      } else {
        document.getElementById("txt_matriculados_edita").value = "";
      }
    });
  }
}
