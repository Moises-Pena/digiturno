$('#verdatosreportes').hide();
function Generar_reporte(){
    var fechainicio = document.getElementsByName('fechainicio')[0].value;
    var fechafin = document.getElementsByName('fechafin')[0].value;
    if(fechainicio == "" || fechainicio == null || fechainicio == undefined ||
    fechafin == "" || fechafin == null || fechafin == undefined){
        Swal.fire({
            title: 'Notificacion!',
            position: 'center',
            icon: 'info',
            text: 'Todos Los Campos Son Requeridos',
            showConfirmButton: false,
            timer: 1500
        });
    } else {
    $('#Tablareportes').DataTable().destroy();
    var table = $("#Tablareportes").DataTable({
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
                'accion': 'ListarReportes',
                'fechainicio':fechainicio,
                'fechafin':fechafin
            },
            "url": "/digiturno/models/model_reporte.php",
    
        },
        columns: [
    
            { data: "estado_turno" },
            { data: "turno" },
            { data: "nombre_servicio" },
            { data: "numero" },
            { data: "nombre" },
            { data: "tiempo_ingreso" },
            { data: "tiempo_salida" },
            { data: "diferencia" },
        ]
    });
    $('#verdatosreportes').show();
}
}

function Descargar_Reporte() {
    var fechainicio = document.getElementsByName('fechainicio')[0].value;
    var fechafin = document.getElementsByName('fechafin')[0].value;
    if(fechainicio == "" || fechainicio == null || fechainicio == undefined ||
    fechafin == "" || fechafin == null || fechafin == undefined){
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
          title:
            "¿Desea Descargar el reporte?",
          text: "Descargar",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Confirmar",
          cancelButtonText: "Cancelar",
          cancelButtonColor: "#d33",
          allowOutsideClick: false,
        }).then(function (result) {
            if (result) {
              window.open('descargar_reporte.php?fechainicio=' + fechainicio + '&fechafin=' + fechafin, '_blank', "width=900,height=1100");
            }
          }).catch(swal.noop);
      }
}