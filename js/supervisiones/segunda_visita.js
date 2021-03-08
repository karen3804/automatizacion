var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardar(e);
    })
}


//Función para guardar o editar

function guardar() {



    var datos = $("#formulario").serialize();
    console.log(datos);
    $.ajax({
        url: "../Controlador/guardar_segunda_visita_controlador.php?op=guardar",
        type: "POST",
        data: datos,


        success: function(d) {

            swal({
                title: d,

                icon: "success",
                button: "OK",

            }).then(function() {
                window.location = "../vistas/menu_supervision_vista.php";
            });


        }


    });

    //limpiar();
}



$(function() {
    $("#busqueda_cuenta_sv").autocomplete({
        source: "../Controlador/seleccionar_datos_segunda_visita_controlador.php",
        minLength: 11,
        select: function(event, ui) {
            event.preventDefault();
            $('#busqueda_cuenta_sv').val(ui.item.nombre);
            $('#cuenta_sv').val(ui.item.cuenta_sv);
            $('#empresa_sv').val(ui.item.empresa_sv);
            $('#jefe_sv').val(ui.item.jefe_sv);
            $('#titulo_sv').val(ui.item.titulo_sv);
            $('#correo_sv').val(ui.item.correo_sv);
            $('#telefono_sv').val(ui.item.telefono_sv);
            $('#estudiante_sv').val(ui.item.estudiante_sv);

            $("#busqueda_cuenta_sv").focus();
        }
    });
});


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type=text]').forEach(node => node.addEventListener('keypress', e => {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    }))
});


console.log('estoy funcionando');

listar();