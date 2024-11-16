<?php
if ($_POST['accion'] == "ListarReportes") {
    require_once('../config/conexion.php');
	$fechainicio = $_POST['fechainicio'];
    $fechafin = $_POST['fechafin'];
    $query = mysqli_query($mysqli, "SELECT t.estado_turno, t.turno, s.nombre_servicio, CONCAT(c.documento,'-',c.numero) AS numero,
    concat(c.pnombre,' ',c.papellido,' ',c.sapellido) AS nombre,t.tiempo_ingreso,t.tiempo_salida,
	TIMEDIFF(t.tiempo_salida,t.tiempo_ingreso) AS diferencia
    FROM db_turnos t
    INNER JOIN db_clientes c ON t.documento=c.numero
    INNER JOIN db_servicios s ON t.tipo_servicio=s.id
    WHERE  DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') between '$fechainicio' and '$fechafin'");
    $datos = array();
    while ($row = $query->fetch_assoc()) {
        $datos[] = $row;
    }
    $arrTurnos = $datos;
    if (!empty($arrTurnos)) {
        for ($i = 0; $i < count($arrTurnos); $i++) {

            if ($arrTurnos[$i]["estado_turno"] == "A") {
                $arrTurnos[$i]["estado_turno"] = '<span class="badge bg-success">Activo</span>';
            } else if($arrTurnos[$i]["estado_turno"] == "M") {
                $arrTurnos[$i]["estado_turno"] = '<span class="badge bg-primary">Llamado</span>';
            } else  {
                $arrTurnos[$i]["estado_turno"] = '<span class="badge bg-danger">Finalizado</span>';
            }
        }
        $arrResponse["data"] = $arrTurnos;
    } else {
        $arrResponse = [];
    }
    echo json_encode($arrResponse);
    die();
}