
var table = $("#TablaModulos").DataTable({
    "aProcessing": true,
    "aServerSide": true,
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla =(",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Sin Datos Por Favor Agregar",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad"
        }

    },
    ajax: {
        'type': 'POST',
        "data": {
            'accion': 'ListarModulos',
        },
        "url": "/digiturno/models/model_modulos.php",

    },
    "columns": [

        { "data": "nombre_modulo" },
        { "data": "estado" },
        { "data": "opciones" }
    ]
});



function GuardarModulo() {
var Modulo = {
    nombremodulo:document.getElementsByName('nombremodulo')[0].value
}
if(Modulo.nombremodulo == "" || Modulo.nombremodulo == null || Modulo.nombremodulo == undefined){
    Swal.fire({
        title: 'Notificacion!',
        position: 'center',
        icon: 'info',
        text: 'Todos Los Campos Son Requeridos',
        showConfirmButton: false,
        timer: 1500
    });
} else {
    Swal.fire({
        title: 'Cargando',
    });
    Swal.showLoading();
    setTimeout(() => {
        $.ajax({
            method: 'POST',
            datatype: 'json',
            data: {
                'accion': 'RegistroModulo',
                'datos': JSON.stringify(Modulo)
            },
            url: '/digiturno/models/model_modulos.php',
        }).then(function (response) {
            var data = JSON.parse(response);
            if (data.codigo == 0) {
                Swal.fire({
                    title: 'Notificacion!',
                    position: 'center',
                    icon: 'success',
                    text: data.respuesta,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#registrar_modulos')[0].reset();
                $('#modalAgregarmodulo').modal('hide');
                table.ajax.reload();
            } else if (data.codigo == 1){
                Swal.fire({
                    title: 'Notificacion!',
                    position: 'center',
                    icon: 'error',
                    text: data.respuesta,
                    showConfirmButton: false,
                    timer: 2000
                });
            }else {
                Swal.fire({
                    title: 'Notificacion!',
                    position: 'center',
                    icon: 'info',
                    text: data.respuesta,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    }, 1000);
}
}

function modalagregar() {
$('#registrar_modulos')[0].reset();
document.querySelector(".modal-title").innerHTML = "Agregar Modulo";
document.getElementById("botondeeditar").classList.replace("btn-success", "btn-primary");
document.querySelector("#btnText").innerHTML = "GUARDAR";
document.getElementById('botondeeditar').onclick = GuardarModulo;
$('#modalAgregarmodulo').modal('show');
}

function seleccionarModulo(idmodulo) {
document.querySelector(".modal-title").innerHTML = "Actualizar Modulo";
document.getElementById("botondeeditar").classList.replace("btn-primary", "btn-success");
document.querySelector("#btnText").innerHTML = "ACTUALIZAR";
document.getElementById('botondeeditar').onclick = ActualizarModulo;
$.ajax({
    method: 'POST',
    datatype: 'json',
    data: {
        'accion': 'ObtenerModulo',
        'datos': idmodulo
    },
    url: '/digiturno/models/model_modulos.php',
})
    .then(function (response) {
        var Data = JSON.parse(response);
        if (response != 'Error') {
            document.getElementsByName('idunicodelmodulo')[0].value = Data.idunico;
            document.getElementsByName('nombremodulo')[0].value = Data.nombre_modulo;
            $('#modalAgregarmodulo').modal('show');

        } else {
            Swal.fire({
                title: 'Notificacion!',
                position: 'center',
                icon: 'error',
                text: 'No hay datos para mostrar',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
}

function ActualizarModulo() {
    var Modulo = {
        nombremodulo:document.getElementsByName('nombremodulo')[0].value,
        idunicodelmodulo:document.getElementsByName('idunicodelmodulo')[0].value
    }
    if(Modulo.nombremodulo == "" || Modulo.nombremodulo == null || Modulo.nombremodulo == undefined){
        Swal.fire({
            title: 'Notificacion!',
            position: 'center',
            icon: 'info',
            text: 'Todos Los Campos Son Requeridos',
            showConfirmButton: false,
            timer: 1500
        });
    } else {
    Swal.fire({
        title: 'Cargando',
    });
    Swal.showLoading();
    setTimeout(() => {
        $.ajax({
            method: 'POST',
            datatype: 'json',
            data: {
                'accion': 'ActualizarModulos',
                'datos': JSON.stringify(Modulo)
            },
            url: '/digiturno/models/model_modulos.php',
        }).then(function (response) {
            var data = JSON.parse(response);
            if (data.codigo == 0) {
                Swal.fire({
                    title: 'Notificacion!',
                    position: 'center',
                    icon: 'success',
                    text: data.respuesta,
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#registrar_modulos')[0].reset();
                $('#modalAgregarmodulo').modal('hide');
                table.ajax.reload();
            } else if (data.codigo == 1){
                Swal.fire({
                    title: 'Notificacion!',
                    position: 'center',
                    icon: 'error',
                    text: data.respuesta,
                    showConfirmButton: false,
                    timer: 2000
                });
            }else {
                Swal.fire({
                    title: 'Notificacion!',
                    position: 'center',
                    icon: 'info',
                    text: data.respuesta,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    }, 1000);
}
}

function inactivarmodulo(id,estado) {
    if(estado == 1){
        var mensaje = "Activar"
    } else {
        var mensaje = "Desactivar"
    }
Swal.fire({
    title: 'Estas seguro?',
    text: "Deseas "+mensaje+" este modulo!",
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    customClass: {
      confirmButton: 'btn btn-primary me-1',
      cancelButton: 'btn btn-danger'
    },
    confirmButtonText: 'Si, '+mensaje+''
}).then((result) => {
    if (result.isConfirmed) {
        Swal.showLoading();
        setTimeout(() => {
            $.ajax({
                method: 'POST',
                datatype: 'json',
                data: {
                    'accion': 'ActualizarEstado',
                    'datos': id,
                    'estado': estado == 1 ? "A" : "I"
                },
                url: '/digiturno/models/model_modulos.php',
            }).then(function (response) {
                var data = JSON.parse(response);
            if (data.codigo == 0) {
                    Swal.fire(
                        'Notificacion!',
                        'Servicio ha sido '+mensaje+'.',
                        'success'
                    );
                    table.ajax.reload();
                } else {
                    Swal.fire({
                        title: 'Notificacion!',
                        position: 'center',
                        icon: 'error',
                        text: 'No se realizaron cambios',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }, 1000);

    }
})
}