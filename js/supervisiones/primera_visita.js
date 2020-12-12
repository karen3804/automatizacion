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
        url: "../Controlador/guardar_primera_visita_controlador.php?op=guardar",
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
    $("#cuenta_busqueda_pv").autocomplete({
        source: "../Controlador/seleccionar_datos_primera_visita_controlador.php",
        minLength: 11,
        select: function(event, ui) {
            event.preventDefault();
            $('#cuenta_busqueda_pv').val(ui.item.nombre);
            $('#cuenta_pv').val(ui.item.cuenta_pv);
            $('#empresa_pv').val(ui.item.empresa_pv);
            $('#jefe_pv').val(ui.item.jefe_pv);
            $('#titulo_pv').val(ui.item.titulo_pv);
            $('#correo_pv').val(ui.item.correo_pv);
            $('#telefono_pv').val(ui.item.telefono_pv);
            $('#estudiante_pv').val(ui.item.estudiante_pv);

            $("#cuenta_busqueda_pv").focus();
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