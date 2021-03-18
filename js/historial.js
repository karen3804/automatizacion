function cargartablaabajo() {
  var periodo = $("#txt_num_periodo").val();
  var anno = $("#txt_anno1").val();

  if (periodo.length == 0 || anno.length == 0) {
   // swal("Alerta!", "ingrese datos a buscar!", "warning");
    swal({
      title: "Alerta",
      text: "Ingrese Periodo y año buscar!",
      type: "error",
      showConfirmButton: true,
      timer: 20000,
    });
  } else {
    cambiar(anno, periodo);
  }

  console.log(periodo);
  console.log(anno);
}

$("#tabla_periodo").on("click", ".ver", function () {
  var data = table.row($(this).parents("tr")).data();
  if (table.row(this).child.isShown()) {
    var data = table.row(this).data();
  }

  //  var table1 = $("#tabla_periodo").DataTable();
  // table1.ajax.reload();

  $("#txt_num_periodo").val(data.num_periodo);
  $("#txt_anno1").val(data.num_anno);

  // table.ajax.reload("#tabla_periodo");

  //  TablaHcargahistorial(anno,periodo);

  // table.ajax.reload();

  // TablaHcargahistorial(anno,periodo);
});

function cambiar(a, p) {
  console.log(a);
  console.log(p);

  TablaHcargahistorial(a, p);
}

/* para limpiar la tabla de abajo */

function limpiar() {
  var table = $("#ver_carga").DataTable();

  table.clear().draw();
}

/* limpiar los text */

function limpiarinput() {
  document.getElementById("txt_num_periodo").value = "";
  document.getElementById("txt_anno1").value = "";
}

// $("#txt_num_periodo").change(function () {
//    document.getElementById("txt_num_periodo").value;
//   document.getElementById("txt_anno1").value;

//   alert('cam');
//  });

var table;
function TablaHcargahistorial(anno1, periodo1) {
  table = $("#ver_carga").DataTable({
    paging: true,
    lengthChange: true,
    ordering: true,
    info: true,
    autoWidth: true,
    responsive: false,
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
      url: "../Controlador/tabla_periodo_controlador.php",
      type: "POST",
      data: { num_anno: anno1, num_periodo: periodo1 },
    },
    columns: [
      { data: "id_carga_academica" },
      { data: "num_empleado" },
      { data: "nombres" },
      { data: "control" },
      { data: "codigo" },
      { data: "asignatura" },
      { data: "seccion" },
      { data: "hra_inicio" },
      { data: "hra_final" },
      { data: "aula" },
      { data: "edificio" },
      { data: "num_alumnos" },
      { data: "dia" },
    ],

    language: idioma_espanol,
    select: true,
  });
  // document.getElementById("ver_carga_filter").style.display = "none";
  // $("input.global_filter").on("keyup click", function () {
  //   filterGlobal();
  // });
  // $("input.column_filter").on("keyup click", function () {
  //   filterColumn($(this).parents("tr").attr("data-column"));
  // });
  // function filterGlobal() {
  //   $("#ver_carga").DataTable().search($("#global_filter").val()).draw();
  // }
}
// comprobar datos para copiar carga
function copiar_carga() {
  var periodo2 = $("#txt_num_periodo").val();
  var anno2 = $("#txt_anno1").val();
  console.log(anno2);
  console.log(periodo2);
  if (periodo2.length == 0 || anno2.length == 0) {
    // swal("Alerta!", "campos vacios", "warning");
    swal({
      title: "Alerta",
      text: "campos  de busqueda vacios!",
      icon: "warning",
      showConfirmButton: true,
      timer: 20000,
    });

  } else {

    swal({
      title: "Estas seguro?",
      text:
        "Una vez hecho, se copiará la carga al periodo actual!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if (willDelete) {
         swal({
           title: "alerta",
           text: "verificando datos",
           icon: "warning",
           showConfirmButton: false,
           timer: 20000,
         });
        /* 1 trae el id del periodo que ingresa */
        $.post(
          "../Controlador/reporte_carga_controlador.php?op=id_periodo_historial",
          { num_anno: anno2, num_periodo: periodo2 },

          function (data, status) {
            console.log(data);
            data = JSON.parse(data);

            if (data == null) {
              //   swal("Alerta!", "el periodo no existe!", "warning");
              swal({
                title: "Alerta",
                text: "El periodo que busca no existe!",
                icon: "warning",
                showConfirmButton: true,
                timer: 20000,
              });

              document.getElementById("txt_id_periodo_busca").value = "";
              /* 1 hasta aqui */
            } else {
             
              $("#txt_id_periodo_busca").val(data.id_periodo);
              /* si esxiste el periodo hace la validacion de que no tenga datos el periodo nuevo */
              var idnuevo = $("#id_periodo_actual").val();

              $.post(
                "../Controlador/reporte_carga_controlador.php?op=id_periodo_nuevo",
                { id_periodo: idnuevo },

                function (data, status) {
                  console.log(data);
                  data = JSON.parse(data);
                  /*si no tiene datos va copiar  */
                  $("#txt_count").val(data.suma);
                  var count = $("#txt_count").val();

                  if (count > 0) {
                    // swal(
                    //   "Alerta!",
                    //   "el periodo actual contiene datos, registre un periodo nuevo para continuar la copia",
                    //   "warning"
                    // );
                    swal({
                      title: "Alerta",
                      text:
                        "el periodo actual contiene datos, registre un periodo nuevo para continuar la copia",
                      icon: "warning",
                      showConfirmButton: true,
                      timer: 20000,
                    });
                    document.getElementById("txt_id_periodo_busca").value = "";
                    document.getElementById("txt_count").value = "";
                  } else {
                    /* si tiene datos no va copiar */
                    var idbusca = $("#txt_id_periodo_busca").val();

                    var periodonuevo = $("#id_periodo_actual").val();

                    insertarCopia(idbusca, periodonuevo);
                  }
                }
              );
            }
          }
        );
      } else {
        swal("Cancelado!");
      }
    }); 

    
  }
}
//insertar la carga al periodo nuevo
function insertarCopia(periodobusca,periodonuevo) {
  console.log(periodobusca);
  $.ajax({
    url: "../Controlador/copiar_carga_historial_controlador.php",
    type: "POST",
    data:
      { id_periodo: periodobusca,id_periodo_nuevo_: periodonuevo }
  }).done(function (resp) {
    console.log(resp);
    if (resp > 0) {
      if (resp == 1) {
        // swal({
        //   title: "buen trabajo!",
        //   text: "Los datos se insertaron correctamente!",
        //   type: "success",
        //   showConfirmButton: true,
        //   timer: 6000,
        // });
        //  swal({
        //    title: "buen trabajo!",
        //    text:
        //      "Los datos se insertaron correctamente! ,Seras redirigido a la pantalla de gestion de carga!",
        //    type: "success",
        //    showConfirmButton: true,
        //    timer: 6000,
        //  });
         swal({
           title: "Buen trabajo!",
           text:
             "Los datos se insertaron correctamente! , deseas ir a la pantalla gestion de carga?",
           icon: "success",
           buttons: true,
           dangerMode: false,
         }).then((willDelete) => {
           if (willDelete) {
              location.href = "../vistas/gestion_carga_academica_vista.php";
           } else {
            
              // swal({
              //         title: "Alerta",
              //         text:
              //           "el periodo actual contiene datos, registre un periodo nuevo para continuar la copia",
              //         icon: "warning",
              //         showConfirmButton: true,
              //         timer: 20000,
              //       });
           }
         });

        // swal("buen trabajo!", "Los datos se insertaron correctamente!", "success");

       
        
        document.getElementById("txt_id_periodo_busca").value = "";
        document.getElementById("txt_count").value = "";
        // document.getElementById("txt_anno1").value = "";
        // document.getElementById("txt_num_periodo").value = "";
      }
    
    } else {
      //  swal(
      //    "Error!",
      //    "No se pudo insertar los datos!",
      //    "warning"
      // );
      swal({
        title: "Alerta!",
        text: "No se pudo insertar los datos intente de nuevo!",
        type: "warning",
        showConfirmButton: true,
        timer: 20000,
      });
      
        
    
      document.getElementById("txt_id_periodo_busca").value = "";
      document.getElementById("txt_count").value = "";
    }
         
  });
}


