
function renderIcons(option) {
    if (!option.id) {
      return option.text;
    }
    var $icon = "<i class='bx bxl-" + $(option.element).data("icon") + " me-2'></i>" + option.text;
    return $icon
  }

$(".select2").wrap('<div class="position-relative"></div>').select2({
    templateResult: renderIcons,
    templateSelection: renderIcons,
    dropdownParent: $("#modalAgregarservicios"),
    escapeMarkup: function(es) {
      return es;
    }
  });
  

  let _colors = [
    {"id":"blue","color":"#007bff","text":"blue"},
    {"id":"primary","color":"#696cff","text":"primary"},
    {"id":"secondary","color":"#8592a3","text":"secondary"},
    {"id":"success","color":"#71dd37","text":"success"},
    {"id":"info","color":"#03c3ec","text":"info"},
    {"id":"warning","color":"#ffab00","text":"warning"},
    {"id":"danger","color":"#ff3e1d","text":"danger"},
    {"id":"dark","color":"#233446","text":"dark"}
  ]
  $(".select-color").select2({
    dropdownParent: $("#modalAgregarservicios"),
    templateResult: function (data, container) {
        if (data.element) {
            $(container).css({"background-color":data.color,"color":"white"});
        }
        return data.text;
    },data:_colors
});

var table = $("#TablaServicios").DataTable({
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
            'accion': 'ListarServicios',
        },
        "url": "/digiturno/models/model_servicios.php",

    },
    "columns": [

        { "data": "nombre_servicio" },
        { "data": "color_servicio" },
        { "data": "icono_servicio" },
        { "data": "letra_servicio" },
        { "data": "estado" },
        { "data": "opciones" }
    ]
});



function GuardarServicio() {
var Servicio = {
    nombreservicio:document.getElementsByName('nombreservicio')[0].value,
    colorservicio:document.getElementsByName('colorservicio')[0].value,
    iconoservicio:document.getElementsByName('iconoservicio')[0].value,
    letraservicio:document.getElementsByName('letraservicio')[0].value,
}
if(Servicio.nombreservicio == "" || Servicio.nombreservicio == null || Servicio.nombreservicio == undefined ||
Servicio.colorservicio == "" || Servicio.colorservicio == null || Servicio.colorservicio == undefined ||
Servicio.iconoservicio == "" || Servicio.iconoservicio == null || Servicio.iconoservicio == undefined ||
Servicio.letraservicio == "" || Servicio.letraservicio == null || Servicio.letraservicio == undefined){
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
                'accion': 'RegistroServicio',
                'datos': JSON.stringify(Servicio)
            },
            url: '/digiturno/models/model_servicios.php',
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
                $('#registrar_servicios')[0].reset();
                $('#modalAgregarservicios').modal('hide');
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
$('#registrar_servicios')[0].reset();
document.querySelector(".modal-title").innerHTML = "Agregar Servicio";
document.getElementById("botondeeditar").classList.replace("btn-success", "btn-primary");
document.querySelector("#btnText").innerHTML = "GUARDAR";
document.getElementById('botondeeditar').onclick = GuardarServicio;
$("#iddelservicio").removeAttr('disabled');
$('#modalAgregarservicios').modal('show');
}

function seleccionarServicio(idservicio) {
document.querySelector(".modal-title").innerHTML = "Actualizar Servicio";
document.getElementById("botondeeditar").classList.replace("btn-primary", "btn-success");
$("#iddelservicio").attr('disabled', 'disabled');
document.querySelector("#btnText").innerHTML = "ACTUALIZAR";
document.getElementById('botondeeditar').onclick = ActualizarServicio;
$.ajax({
    method: 'POST',
    datatype: 'json',
    data: {
        'accion': 'ObtenerServicio',
        'datos': idservicio
    },
    url: '/digiturno/models/model_servicios.php',
})
    .then(function (response) {
        var Data = JSON.parse(response);
        if (response != 'Error') {
            document.getElementsByName('idunicodelservicio')[0].value = Data.idunico;
            document.getElementsByName('nombreservicio')[0].value = Data.nombre_servicio;
            document.getElementsByName('colorservicio')[0].value = Data.color_servicio;
            document.getElementsByName('iconoservicio')[0].value = Data.icono_servicio;
            document.getElementsByName('letraservicio')[0].value = Data.letra_servicio;
            $('#modalAgregarservicios').modal('show');

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

function ActualizarServicio() {
    var Servicio = {
        nombreservicio:document.getElementsByName('nombreservicio')[0].value,
        colorservicio:document.getElementsByName('colorservicio')[0].value,
        iconoservicio:document.getElementsByName('iconoservicio')[0].value,
        letraservicio:document.getElementsByName('letraservicio')[0].value,
        idunicodelservicio:document.getElementsByName('idunicodelservicio')[0].value
    }
    if(Servicio.nombreservicio == "" || Servicio.nombreservicio == null || Servicio.nombreservicio == undefined ||
    Servicio.colorservicio == "" || Servicio.colorservicio == null || Servicio.colorservicio == undefined ||
    Servicio.iconoservicio == "" || Servicio.iconoservicio == null || Servicio.iconoservicio == undefined ||
    Servicio.letraservicio == "" || Servicio.letraservicio == null || Servicio.letraservicio == undefined){
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
                'accion': 'ActualizarServicio',
                'datos': JSON.stringify(Servicio)
            },
            url: '/digiturno/models/model_servicios.php',
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
                $('#registrar_servicios')[0].reset();
                $('#modalAgregarservicios').modal('hide');
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

function inactivarservicio(id,estado) {
    if(estado == 1){
        var mensaje = "Activar"
    } else {
        var mensaje = "Desactivar"
    }
Swal.fire({
    title: 'Estas seguro?',
    text: "Deseas "+mensaje+" este Servicio!",
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
                url: '/digiturno/models/model_servicios.php',
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