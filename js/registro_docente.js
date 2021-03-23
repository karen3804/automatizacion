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
  fecha_ingreso,
  pasaporte
) {
  var identidad = document.getElementById("identidad");

  if (identidad.disabled == true) {
    console.log("desahbilitado");
    //va pasar el pasaporte
    var idjornada = $("#jornada").children("option:selected").val();
    var idcategoria = $("#categoria").children("option:selected").val();
    var foto = document.getElementById("seleccionararchivo");
    var curriculo = document.getElementById("curriculum");

    if (
      //pasaporte.length == 0 ||
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
      nacionalidad = nacionalidad.toUpperCase();

      estado = estado.toUpperCase();
      sexo = sexo.toUpperCase();

      $.ajax({
        url: "../Controlador/registro1_docente_controlador.php",
        type: "POST",
        data: {
          nombre: nombre,
          apellidos: apellidos,
          sexo: sexo,
         // identidad: pasaporte,
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
      }).done(function (resp) {
        if (resp > 0) {
          //   saveAll();
          //   saveAll2();
          //   saveAll3();
          //   saveAll5();
          //   Registrar();
          //   Registrarcurriculum();
          swal("Alerta!", "Se Guardaron los datos!");
        } else {
          swal("Alerta!", "No se pudo insertar los datos intentalo de nuevo!");
        }
      });
    }
  }
  //   else {
  //     console.log("habilitado");
  //     //va pasar identidad

  //     var idjornada = $("#jornada").children("option:selected").val();
  //     var idcategoria = $("#categoria").children("option:selected").val();
  //     var foto = document.getElementById("seleccionararchivo");
  //     var curriculo = document.getElementById("curriculum");
  //     var n = identidad.search("_");
  //     if (
  //       n != -1 ||
  //       nombre.length == 0 ||
  //       apellidos.length == 0 ||
  //       sexo == null ||
  //       foto.value == 0 ||
  //       curriculo.value == 0 ||
  //       identidad.length == 0 ||
  //       nacionalidad == null ||
  //       estado == null ||
  //       fecha_nacimiento.length == 0 ||
  //       hi == null ||
  //       hf == null ||
  //       nempleado.length == 0 ||
  //       fecha_ingreso.length == 0 ||
  //       idjornada == null ||
  //       idcategoria == null
  //     ) {
  //       swal({
  //         title: "alerta",
  //         text: "Llene o seleccione los campos vacios correctamente",
  //         type: "warning",
  //         showConfirmButton: true,
  //         timer: 15000,
  //       });
  //     } else {
  //       nombre = nombre.toUpperCase();
  //       apellidos = apellidos.toUpperCase();
  //       identidad = identidad.toUpperCase();
  //       nacionalidad = nacionalidad.toUpperCase();

  //       estado = estado.toUpperCase();
  //       sexo = sexo.toUpperCase();

  //       $.ajax({
  //         url: "../Controlador/registro1_docente_controlador.php",
  //         type: "POST",
  //         data: {
  //           nombre: nombre,
  //           apellidos: apellidos,
  //           sexo: sexo,
  //           identidad: identidad,
  //           nacionalidad: nacionalidad,
  //           estado: estado,
  //           fecha_nacimiento: fecha_nacimiento,
  //           hi: hi,
  //           hf: hf,
  //           nempleado: nempleado,
  //           fecha_ingreso: fecha_ingreso,
  //           idjornada: idjornada,
  //           idcategoria: idcategoria,
  //         },
  //       }).done(function (resp) {
  //         if (resp > 0) {
  //           saveAll();
  //           saveAll2();
  //           saveAll3();
  //           saveAll5();
  //           Registrar();
  //           Registrarcurriculum();
  //           swal("Alerta!", "Se Guardaron los datos!");
  //         } else {
  //           swal("Alerta!", "No se pudo insertar los datos intentalo de nuevo!");
  //         }
  //       });
  //     }
  //   }
}
