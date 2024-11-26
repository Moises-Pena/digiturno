$('#vista_numero').hide();
$('#llamarturno').show();
$('#atenderturno').hide();
$('#finalizarturno').hide();
DatosUsuario();
function DatosUsuario() {
    var usuario = localStorage.getItem('usuario');
    $.ajax({
        method: 'POST',
        datatype: 'json',
        data: {
            'accion': 'Obtenerdatosusuario',
            'datos': usuario
        },
        url: '/digiturno/models/model_gestionar_turno.php',
    })
        .then(function (response) {
            var Data = JSON.parse(response);
            if (Data.codigo == 0) {
                $("#nombreservicio").html(Data.nombre_servicio);
                $("#nombremodulo").html(Data.nombre_modulo);
                $("#total_turnos").html(Data.total_turnos);
                $("#en_espera").html(Data.en_espera);
                $("#turnos_atendidos").html(Data.atendidos);

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

function llamar_Turno() {
    Swal.fire({
        text: "Deseas Llamar El Turno",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        customClass: {
            confirmButton: 'btn btn-primary me-1',
            cancelButton: 'btn btn-danger'
        },
        confirmButtonText: 'Confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            var usuario = localStorage.getItem('usuario');
            var servicio = localStorage.getItem('servicio');
            var modulo = localStorage.getItem('modulo');
            $.ajax({
                method: "POST",
                datatype: "json",
                data: {
                    "accion": "Llamarturno",
                    "usuario": usuario,
                    "servicio": servicio,
                    "modulo": modulo
                },
                url: "/digiturno/models/model_gestionar_turno.php",
            }).then(function (response) {
                var datos = JSON.parse(response);
                if (datos.codigo == 0) {
                    $('#vista_numero').show();
                    $('#llamarturno').hide();
                    $('#atenderturno').show();
                    $('#finalizarturno').hide();
                    //   $("#iddelturno").html(datos.id_turno);
                    $("#numerodelturno").html(datos.turno);
                    $("#documento").attr('disabled', 'disabled').val(datos.documento);
                    $("#numero").attr('disabled', 'disabled').val(datos.numero);
                    $("#pnombre").attr('disabled', 'disabled').val(datos.pnombre);
                    $("#papellido").attr('disabled', 'disabled').val(datos.papellido);
                    $("#sapellido").attr('disabled', 'disabled').val(datos.sapellido);
                } else {
                    Swal.fire({
                        title: 'Notificacion!',
                        position: 'center',
                        icon: 'info',
                        text: 'No hay Turnos Pendientes',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
}
function atender_Turno() {
    Swal.fire({
        text: "Deseas Atender El Turno",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        customClass: {
            confirmButton: 'btn btn-primary me-1',
            cancelButton: 'btn btn-danger'
        },
        confirmButtonText: 'Confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            var usuario = localStorage.getItem('usuario');
            var servicio = localStorage.getItem('servicio');
            var modulo = localStorage.getItem('modulo');
            $.ajax({
                method: "POST",
                datatype: "json",
                data: {
                    "accion": "AtenderTurno",
                    "usuario": usuario,
                    "servicio": servicio,
                    "modulo": modulo
                },
                url: "/digiturno/models/model_gestionar_turno.php",
            }).then(function (response) {
                var datos = JSON.parse(response);
                if (datos.codigo == 0) {
                    $('#vista_numero').show();
                    $('#llamarturno').hide();
                    $('#atenderturno').hide();
                    $('#finalizarturno').show();
                } else {
                    Swal.fire({
                        title: 'Notificacion!',
                        position: 'center',
                        icon: 'info',
                        text: 'No Se logro atender El turno',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
}

function finalizar_Turno() {
    DatosUsuario();
    Swal.fire({
        text: "Deseas Finalizar El Turno",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        customClass: {
            confirmButton: 'btn btn-primary me-1',
            cancelButton: 'btn btn-danger'
        },
        confirmButtonText: 'Confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            var usuario = localStorage.getItem('usuario');
            var servicio = localStorage.getItem('servicio');
            var modulo = localStorage.getItem('modulo');
            $.ajax({
                method: "POST",
                datatype: "json",
                data: {
                    "accion": "Finalizarturno",
                    "usuario": usuario,
                    "servicio": servicio,
                    "modulo": modulo
                },
                url: "/digiturno/models/model_gestionar_turno.php",
            }).then(function (response) {
                var datos = JSON.parse(response);
                if (datos.codigo == 0) {
                    $('#vista_numero').hide();
                    $('#llamarturno').show();
                    $('#atenderturno').hide();
                    $('#finalizarturno').hide();
                    Swal.fire({
                        title: 'Exito',
                        position: 'center',
                        icon: 'success',
                        text: 'Turno Finalizado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        title: 'Notificacion!',
                        position: 'center',
                        icon: 'info',
                        text: 'No hay Turnos Pendientes',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
}


function modalverturnos(){
    $('#TablaTurnos').DataTable().destroy();
    var table = $("#TablaTurnos").DataTable({
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
                'accion': 'ListarTurnos',
            },
            "url": "/digiturno/models/model_gestionar_turno.php",
    
        },
        columns: [
    
            { data: "estado_turno" },
            { data: "turno" },
            { data: "nombre_servicio" },
            { data: "numero" },
            { data: "nombre" },
            { data: "tiempo_ingreso" },
            { data: "tiempo_salida" },
        ]
    });
    $('#modalturnos').modal('show');
}
