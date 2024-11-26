$(document).ready(function() {
    setInterval(function() {
        Fechayhoraactual();
    }, 1000);
    setInterval(function() {
        TurosGestion();
    }, 9500);
  });

  
function Fechayhoraactual() {
    let fecha, horas, minutos, segundos, diaSemana, dia, mes, anio;
    fecha = new Date();
    horas = fecha.getHours();
    minutos = fecha.getMinutes();
    segundos = fecha.getSeconds();
    diaSemana = fecha.getDay();
    dia = fecha.getDate();
    mes = fecha.getMonth();
    anio = fecha.getFullYear();
    let semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
    let diasemana = semana[diaSemana];
    let meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    let mesnombre = meses[mes];
    $("#anioymes").html(diasemana + ' ' + dia + ' ' + 'de' + ' ' + mesnombre + ' ' + 'del' + ' ' + anio);
    let ampm;
    if (horas >= 12) {
        horas = horas - 12;
        ampm = "PM"
    } else {
        ampm = "AM";
    }
    if (horas == 0) { horas = 12; }
    if (minutos < 10) { minutos = "0" + minutos; }
    if (segundos < 10) { segundos = "0" + segundos; }
    $("#tiempohora").html(horas + ' : ' + minutos + ' : ' + segundos + ' ' + ampm);
}

function TurosGestion() {
    $.ajax({
      method: "POST",
      datatype: "json",
      data: {
        "accion": "Verturnos",
      },
      url: "/digiturno/models/model_pantalla.php",
    }).then(function (response) {
      const tabla = document.querySelector("#tablaTurnos tbody");
      var datos = JSON.parse(response);
      if (datos.status == true) {
        while (tabla.firstChild) {
          tabla.removeChild(tabla.firstChild);
        }
        for (var i = 0; i < datos.data.length; i++) {
          const row = document.createElement("tr");
          if(datos.data[i].estado == "LLAMADO"){
              row.className = "movimiento";
              Swal.fire({
                showConfirmButton: false,
                width: 1000,
                timer: 5000,
                html: '<h1><table class="table table-bordered table-striped">'+
                '<tr>'+
                '<th class="text-center"><h1 class="fw-bold text-underline tamanoletra">TURNO</h1></th>'+
                '<th class="text-center"><h1 class="fw-bold text-underline tamanoletra">ESTADO</h1></th>'+
                '<th class="text-center"><h1 class="fw-bold text-underline tamanoletra">MODULO</h1></th>'+
                '</tr>'+
                '<tr class="movimiento">'+
                '<td class="text-center"><h1 class="fw-bold text-white tamanoletra"><b>'+datos.data[i].turno+'</b></h1></td>'+
                '<td class="text-center"><h1 class="fw-bold text-white tamanoletra"><b>'+datos.data[i].estado+'</b></h1></td>'+
                '<td class="text-center"><h1 class="fw-bold text-white tamanoletra"><b>'+datos.data[i].modulo+'</b></h1></td>'+
                '</tr>'+
            '</table></h1>'+
            '<audio id="denied" autoplay controls="false" style="display:none"> <source src="assets/sonidos/timbre.mp3" /> </audio>'
              })
          }else{
            row.className = "bg-primary";
          }
          row.innerHTML = `
                      <td class="text-center"><h1 class="fw-bold text-underline tamanoletra text-white">${datos.data[i].turno}</h1></td>
                      <td class="text-center"><h1 class="fw-bold text-underline tamanoletra text-white">${datos.data[i].estado}</h1></td>
                      <td class="text-center"><h1 class="fw-bold text-underline tamanoletra text-white">${datos.data[i].modulo}</h1></td>
                      `;
          tabla.appendChild(row);
        }
      }
    });
  }


