if ((document.getElementsByName = 'cbm_persona')) {
	llenar_persona();
}

if ((document.getElementsByName = 'cbm_comision1')) {
	llenar_persona();
}

if ((document.getElementsByName = 'cbm_edificio')) {
	llenar_persona();
}

if ((document.getElementsByName = 'cbm_aulal')) {
	llenar_persona();
}

function llenar_persona() {
	var cadena = '&activar=activar';
	$.ajax({
		url: '../Controlador/mantenimientos_controlador.php?op=listar_persona',
		type: 'POST',
		data: cadena,
		success: function(r) {
			// console.log(r);
			$('#cbm_persona').html(r).fadeIn();
		}
	});
}
llenar_persona();

$('#cbm_persona').change(function() {
	var persona = $(this).val();
	console.log(persona);
	$('#persona1').val(persona);
});

function llenar_comision() {
	var cadena = '&activar=activar';
	$.ajax({
		url: '../Controlador/mantenimientos_controlador.php?op=listar_comision',
		type: 'POST',
		data: cadena,
		success: function(r) {
			// console.log(r);
			$('#cbm_comision1').html(r).fadeIn();
		}
	});
}
llenar_comision();

$('#cbm_comision1').change(function() {
	var comision = $(this).val();
	console.log(comision);
	$('#comision1').val(comision);
});


function llenar_edificio() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/mantenimientos_controlador.php?op=listar_edificio",
    type: "POST",
    data: cadena,
    success: function (r) {
      // console.log(r);
      $("#cbm_edificio").html(r).fadeIn();
    },
  });
}
llenar_edificio();

$("#cbm_edificio").change(function () {
  var edificio = $(this).val();
  console.log(edificio);
  $("#edificio").val(edificio);
  
});


function llenar_tipoaula() {
  var cadena = "&activar=activar";
  $.ajax({
    url: "../Controlador/mantenimientos_controlador.php?op=listar_aula",
    type: "POST",
    data: cadena,
    success: function (r) {
      // console.log(r);
      $("#cbm_aula").html(r).fadeIn();
    },
  });
}
llenar_tipoaula();

$("#cbm_aula").change(function () {
  var aula = $(this).val();
  console.log(aula);
  $("#aula").val(aula);
  
});