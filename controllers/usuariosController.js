
var table = $("#TablaUsuarios").DataTable({
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
            'accion': 'ListarUsuarios',
        },
        "url": "/digiturno/models/model_usuario.php",

    },
    "columns": [

        { "data": "usuario" },
        { "data": "cedula" },
        { "data": "nombres" },
        { "data": "apellidos" },
        { "data": "nombre_servicio" },
        { "data": "nombre_modulo" },
        { "data": "estado" },
        { "data": "nombre_nivel" },
        { "data": "opciones" },
    ]
});



function GuardarUsuario() {
var Usuario = {
    numero:document.getElementsByName('numero')[0].value,
    usuario:document.getElementsByName('usuario')[0].value,
    password:document.getElementsByName('password')[0].value,
    nombres:document.getElementsByName('nombres')[0].value,
    apellidos:document.getElementsByName('apellidos')[0].value,
    servicio:document.getElementsByName('servicio')[0].value,
    modulo:document.getElementsByName('modulo')[0].value,
    nivel:document.getElementsByName('nivel')[0].value
}
if(Usuario.numero == "" || Usuario.numero == null || Usuario.numero == undefined ||
Usuario.usuario == "" || Usuario.usuario == null || Usuario.usuario == undefined ||
Usuario.password == "" || Usuario.password == null || Usuario.password == undefined ||
Usuario.nombres == "" || Usuario.nombres == null || Usuario.nombres == undefined ||
Usuario.apellidos == "" || Usuario.apellidos == null || Usuario.apellidos == undefined ||
Usuario.servicio == "" || Usuario.servicio == null || Usuario.servicio == undefined ||
Usuario.modulo == "" || Usuario.modulo == null || Usuario.modulo == undefined ||
Usuario.nivel == "" || Usuario.nivel == null || Usuario.nivel == undefined){
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
                'accion': 'RegistroUsuario',
                'datos': JSON.stringify(Usuario)
            },
            url: '/digiturno/models/model_usuario.php',
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
                $('#registrar_usuarios')[0].reset();
                $('#modalAgregarusuario').modal('hide');
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
$('#registrar_usuarios')[0].reset();
document.querySelector(".modal-title").innerHTML = "Agregar Usuario";
document.getElementById("botondeeditar").classList.replace("btn-success", "btn-primary");
document.querySelector("#btnText").innerHTML = "GUARDAR";
document.getElementById('botondeeditar').onclick = GuardarUsuario;
$("#usuario").removeAttr('disabled');
$("#numero").removeAttr('disabled');
$('#modalAgregarusuario').modal('show');
}

function seleccionarUsuario(idusuario) {
document.querySelector(".modal-title").innerHTML = "Actualizar Usuario";
document.getElementById("botondeeditar").classList.replace("btn-primary", "btn-success");
$("#usuario").attr('disabled', 'disabled');
$("#numero").attr('disabled', 'disabled');
document.querySelector("#btnText").innerHTML = "ACTUALIZAR";
document.getElementById('botondeeditar').onclick = ActualizarUsuarios;
$.ajax({
    method: 'POST',
    datatype: 'json',
    data: {
        'accion': 'Obtenerusuario',
        'datos': idusuario
    },
    url: '/digiturno/models/model_usuario.php',
})
    .then(function (response) {
        var Data = JSON.parse(response);
        if (response != 'Error') {
            document.getElementsByName('numero')[0].value = Data.documento;
            document.getElementsByName('usuario')[0].value = Data.usuario;
            document.getElementsByName('nombres')[0].value = Data.nombres;
            document.getElementsByName('apellidos')[0].value = Data.apellidos;
            document.getElementsByName('servicio')[0].value = Data.servicio;
            document.getElementsByName('modulo')[0].value = Data.modulo;
            document.getElementsByName('nivel')[0].value = Data.nivel;
            $('#modalAgregarusuario').modal('show');

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

function ActualizarUsuarios() {
var usuario = {
    numero:document.getElementsByName('numero')[0].value,
    usuario:document.getElementsByName('usuario')[0].value,
    password:document.getElementsByName('password')[0].value,
    nombres:document.getElementsByName('nombres')[0].value,
    apellidos:document.getElementsByName('apellidos')[0].value,
    servicio:document.getElementsByName('servicio')[0].value,
    modulo:document.getElementsByName('modulo')[0].value,
    nivel:document.getElementsByName('nivel')[0].value
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
                'accion': 'ActualizarUsuario',
                'datos': JSON.stringify(usuario)
            },
            url: '/digiturno/models/model_usuario.php',
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
                $('#registrar_usuarios')[0].reset();
                $('#modalAgregarusuario').modal('hide');
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

function InactivarUsuario(id,estado) {
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
                url: '/digiturno/models/model_usuario.php',
            }).then(function (response) {
                var data = JSON.parse(response);
            if (data.codigo == 0) {
                    Swal.fire(
                        'Notificacion!',
                        'Usuario ha sido '+mensaje+'.',
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

ListadoServicios();
function ListadoServicios() {
  $.ajax({
      method: "POST",
      datatype: "json",
      data: {
          "accion": "VerServicios"
      },
      url: "/digiturno/models/model_usuario.php",
  }).then(function (response) {
      var datos = JSON.parse(response);
      if (datos.status == true) {
          for (var i = 0; i < datos.data.length; i++) {
              document.getElementById("servicio").innerHTML += "<option value='" + datos.data[i].id_servicio + "'>" + datos.data[i].nombre_servicio + "</option>";

          }
      }
  });
}
ListadoModulos();
function ListadoModulos() {
  $.ajax({
      method: "POST",
      datatype: "json",
      data: {
          "accion": "VerModulos"
      },
      url: "/digiturno/models/model_usuario.php",
  }).then(function (response) {
      var datos = JSON.parse(response);
      if (datos.status == true) {
          for (var i = 0; i < datos.data.length; i++) {
              document.getElementById("modulo").innerHTML += "<option value='" + datos.data[i].id_modulo + "'>" + datos.data[i].nombre_modulo + "</option>";

          }
      }
  });
}
ListadoNiveles();
function ListadoNiveles() {
  $.ajax({
      method: "POST",
      datatype: "json",
      data: {
          "accion": "VerNiveles"
      },
      url: "/digiturno/models/model_usuario.php",
  }).then(function (response) {
      var datos = JSON.parse(response);
      if (datos.status == true) {
          for (var i = 0; i < datos.data.length; i++) {
              document.getElementById("nivel").innerHTML += "<option value='" + datos.data[i].id_nivel + "'>" + datos.data[i].nombre_nivel + "</option>";

          }
      }
  });
}