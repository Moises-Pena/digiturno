
$('#verdatoscliente').hide();
function BuscarCliente() {
    servicios();
    var tipodocumento = document.getElementsByName('tipodocumento')[0].value;
    var numerodocumento = document.getElementsByName('numerodocumento')[0].value;
    $.ajax({
        method: 'POST',
        datatype: 'json',
        data: {
            'accion': 'ObtenerCliente',
            'datos': numerodocumento
        },
        url: '/digiturno/models/model_generar_turno.php',
    })
        .then(function (response) {
            var Data = JSON.parse(response);
            if (Data.codigo == 0) {
                $('#verdatoscliente').show();
                $("#documento").attr('disabled', 'disabled').val(Data.documento);
                $("#numero").attr('disabled', 'disabled').val(Data.numero);
                $("#pnombre").attr('disabled', 'disabled').val(Data.pnombre);
                $("#snombre").attr('disabled', 'disabled').val(Data.snombre);
                $("#papellido").attr('disabled', 'disabled').val(Data.papellido);
                $("#sapellido").attr('disabled', 'disabled').val(Data.sapellido);
                $("#registrarcliente").attr('disabled', 'disabled').val("NO");

            } else if (Data.codigo == 1) {
                $('#verdatoscliente').show();
                Swal.fire({
                    title: 'Notificacion!',
                    position: 'center',
                    icon: 'info',
                    text: 'No hay datos para mostrar por favor llenar los campos',
                    showConfirmButton: false,
                    timer: 2000
                });
                $("#documento").attr('disabled', 'disabled').val(tipodocumento);
                $("#numero").attr('disabled', 'disabled').val(numerodocumento);
                $("#pnombre").removeAttr('disabled').val();
                $("#snombre").removeAttr('disabled').val();
                $("#papellido").removeAttr('disabled').val();
                $("#sapellido").removeAttr('disabled').val();
                $("#registrarcliente").attr('disabled', 'disabled').val("SI");
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

function servicios() {
    $("#contedinoservicios").empty();
    $.ajax({
        method: "POST",
        datatype: "json",
        data: {
            "accion": "VerServicios"
        },
        url: "/digiturno/models/model_generar_turno.php",
    }).then(function (response) {
        var datos = JSON.parse(response);
        if (datos.status == true) {
            var container = document.getElementById('contedinoservicios');
            for (var i = 0; i < datos.data.length; i++) {
                container.innerHTML += `
                <div class="col-md-4 col-lg-3 mb-2">
                <a style="cursor: pointer;" onClick="Generar_Turno('${encodeURIComponent(JSON.stringify(datos.data[i]))}')">
            <div class="card text-center bg-transparent border border-${datos.data[i].color_servicio}">
            <div class="card-body">
              <div class="card-link badge bg-${datos.data[i].color_servicio}">
                <i style="font-size: 68px;" class="bx ${datos.data[i].icono_servicio}"></i>
              </div>
              <h3 class="card-title mb-2 mt-4">${datos.data[i].nombre_servicio}</h3>
            </div>
          </div>
          </a>
          </div>`;
            }
        }
    });
}



function Generar_Turno(serv) {
    var datoservicio = JSON.parse(decodeURIComponent(serv))
    var Datos = {
        documento: document.getElementsByName('documento')[0].value,
        numero: document.getElementsByName('numero')[0].value,
        pnombre: document.getElementsByName('pnombre')[0].value,
        snombre: document.getElementsByName('snombre')[0].value,
        papellido: document.getElementsByName('papellido')[0].value,
        sapellido: document.getElementsByName('sapellido')[0].value,
        registrarcliente: document.getElementsByName('registrarcliente')[0].value,
        id_servicio:datoservicio.id,
        letra:datoservicio.letra_servicio,
    }
    if (Datos.documento == "" || Datos.documento == null || Datos.documento == undefined ||
        Datos.numero == "" || Datos.numero == null || Datos.numero == undefined ||
        Datos.pnombre == "" || Datos.pnombre == null || Datos.pnombre == undefined ||
        Datos.snombre == "" || Datos.snombre == null || Datos.snombre == undefined ||
        Datos.papellido == "" || Datos.papellido == null || Datos.papellido == undefined ||
        Datos.sapellido == "" || Datos.sapellido == null || Datos.sapellido == undefined) {
        Swal.fire({
            title: 'Notificacion!',
            position: 'center',
            icon: 'info',
            text: 'Todos Los Campos Son Requeridos',
            showConfirmButton: false,
            timer: 1500
        });
    } else {
            $.ajax({
                method: 'POST',
                datatype: 'json',
                data: {
                    'accion': 'GenerarTurno',
                    'datos': JSON.stringify(Datos)
                },
                url: '/digiturno/models/model_generar_turno.php',
            })
                .then(function (response) {
                    var Data = JSON.parse(response);
                    if (Data.codigo == 0) {
                        $('#verdatoscliente').hide();
                        $("#documento").removeAttr('disabled').val();
                        $("#numero").removeAttr('disabled').val();
                        $("#pnombre").removeAttr('disabled').val();
                        $("#snombre").removeAttr('disabled').val();
                        $("#papellido").removeAttr('disabled').val();
                        $("#sapellido").removeAttr('disabled').val();
                        $("#registrarcliente").removeAttr('disabled').val();
                        $("#tipodocumento").val();
                        $("#numerodocumento").val();
                        Swal.fire({
                            icon: 'success',
                            title: ' Su Numero De Turno:',
                            html: '<div class="btn btn-'+datoservicio.color_servicio+'">' +
                                '<span  class="badge bg-'+datoservicio.color_servicio+'"><h1 style="color:white">' + Data.turno + '</h1></span>' +
                                '</div>',
                            allowOutsideClick: false
                        })
                    } else {
                        Swal.fire({
                            title: 'Notificacion!',
                            position: 'center',
                            icon: 'error',
                            text: 'No Se Logro Generar el Turno',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
    }
}