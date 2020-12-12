//var tabla;




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
        url: "../Controlador/guardar_unica_visita_controlador.php?op=guardar",
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
    $("#busqueda_cuenta_uv").autocomplete({
        source: "../Controlador/seleccionar_datos_unica_visita_controlador.php",
        minLength: 11,
        select: function(event, ui) {
            event.preventDefault();
            $('#busqueda_cuenta_uv').val(ui.item.nombre);
            $('#cuenta_uv').val(ui.item.cuenta_uv);
            $('#empresa_uv').val(ui.item.empresa_uv);
            $('#jefe_uv').val(ui.item.jefe_uv);
            $('#titulo_uv').val(ui.item.titulo_uv);
            $('#correo_uv').val(ui.item.correo_uv);
            $('#telefono_uv').val(ui.item.telefono_uv);
            $('#estudiante_uv').val(ui.item.estudiante_uv);

            $("#busqueda_cuenta_uv").focus();
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