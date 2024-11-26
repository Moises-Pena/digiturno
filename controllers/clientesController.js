
var table = $("#TablaClientes").DataTable({
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
            'accion': 'ListarClientes',
        },
        "url": "/digiturno/models/model_clientes.php",

    },
    "columns": [

        { "data": "numero" },
        { "data": "cliente" },
        { "data": "sexo" },
        { "data": "estado" },
        { "data": "opciones" }
    ]
});



function GuardarCliente() {
var Cliente = {
    documento:document.getElementsByName('documento')[0].value,
    numero:document.getElementsByName('numero')[0].value,
    pnombre:document.getElementsByName('pnombre')[0].value,
    snombre:document.getElementsByName('snombre')[0].value,
    papellido:document.getElementsByName('papellido')[0].value,
    sapellido:document.getElementsByName('sapellido')[0].value,
    sexo:document.getElementsByName('sexo')[0].value,
    fechan:document.getElementsByName('fecha_nacimiento')[0].value
}
if(Cliente.documento == "" || Cliente.documento == null || Cliente.documento == undefined ||
Cliente.numero == "" || Cliente.numero == null || Cliente.numero == undefined ||
Cliente.pnombre == "" || Cliente.pnombre == null || Cliente.pnombre == undefined ||
Cliente.snombre == "" || Cliente.snombre == null || Cliente.snombre == undefined ||
Cliente.papellido == "" || Cliente.papellido == null || Cliente.papellido == undefined ||
Cliente.sapellido == "" || Cliente.sapellido == null || Cliente.sapellido == undefined ||
Cliente.sexo == "" || Cliente.sexo == null || Cliente.sexo == undefined ||
Cliente.fechan == "" || Cliente.fechan == null || Cliente.fechan == undefined){
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
                'accion': 'RegistroCliente',
                'datos': JSON.stringify(Cliente)
            },
            url: '/digiturno/models/model_clientes.php',
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
                $('#registrar_cliente')[0].reset();
                $('#modalAgregarcliente').modal('hide');
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
$('#registrar_cliente')[0].reset();
document.querySelector(".modal-title").innerHTML = "Agregar Cliente";
document.getElementById("botondeeditar").classList.replace("btn-success", "btn-primary");
document.querySelector("#btnText").innerHTML = "GUARDAR";
document.getElementById('botondeeditar').onclick = GuardarCliente;
$("#documento").removeAttr('disabled');
$("#numero").removeAttr('disabled');
$('#modalAgregarcliente').modal('show');
}

function seleccionarCliente(idcliente) {
document.querySelector(".modal-title").innerHTML = "Actualizar Cliente";
document.getElementById("botondeeditar").classList.replace("btn-primary", "btn-success");
$("#documento").attr('disabled', 'disabled');
$("#numero").attr('disabled', 'disabled');
document.querySelector("#btnText").innerHTML = "ACTUALIZAR";
document.getElementById('botondeeditar').onclick = ActualizarClientes;
$.ajax({
    method: 'POST',
    datatype: 'json',
    data: {
        'accion': 'ObtenerCliente',
        'datos': idcliente
    },
    url: '/digiturno/models/model_clientes.php',
})
    .then(function (response) {
        var Data = JSON.parse(response);
        if (response != 'Error') {
            document.getElementsByName('documento')[0].value = Data.documento;
            document.getElementsByName('numero')[0].value = Data.numero;
            document.getElementsByName('pnombre')[0].value = Data.pnombre;
            document.getElementsByName('snombre')[0].value = Data.snombre;
            document.getElementsByName('papellido')[0].value = Data.papellido;
            document.getElementsByName('sapellido')[0].value = Data.sapellido;
            document.getElementsByName('sexo')[0].value = Data.sexo;
            document.getElementsByName('fecha_nacimiento')[0].value = Data.fecha_nacimiento;
            $('#modalAgregarcliente').modal('show');

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

function ActualizarClientes() {
var Cliente = {
    documento:document.getElementsByName('documento')[0].value,
    numero:document.getElementsByName('numero')[0].value,
    pnombre:document.getElementsByName('pnombre')[0].value,
    snombre:document.getElementsByName('snombre')[0].value,
    papellido:document.getElementsByName('papellido')[0].value,
    sapellido:document.getElementsByName('sapellido')[0].value,
    sexo:document.getElementsByName('sexo')[0].value,
    fechan:document.getElementsByName('fecha_nacimiento')[0].value
}
    Swal.fire({
        title: 'Cargando',
    });
    Swal.showLoading();
    setTimeout(() => {
        $.ajax({
            method: 'POST',
            datatype: 'json',
            data: {
                'accion': 'ActualizarCliente',
                'datos': JSON.stringify(Cliente)
            },
            url: '/digiturno/models/model_clientes.php',
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
                $('#registrar_cliente')[0].reset();
                $('#modalAgregarcliente').modal('hide');
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

function InactivarCliente(id,estado) {
    if(estado == 1){
        var mensaje = "Activar"
    } else {
        var mensaje = "Desactivar"
    }
Swal.fire({
    title: 'Estas seguro?',
    text: "Deseas "+mensaje+" este Cliente!",
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
                url: '/digiturno/models/model_clientes.php',
            }).then(function (response) {
                var data = JSON.parse(response);
            if (data.codigo == 0) {
                    Swal.fire(
                        'Notificacion!',
                        'Cliente ha sido '+mensaje+'.',
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