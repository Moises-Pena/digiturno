<?php
require_once('../../config/conexion.php');
    header('Content-type: application/vnd.ms-excel;');
    header("Content-Disposition: attachment; filename=Reporte Turnos" . "_" . date("d_m_Y") . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

	$fechainicio = $_GET['fechainicio'];
    $fechafin = $_GET['fechafin'];
    ?>
 <table cellspacing="0" cellpadding="0" border="1" align="center">
    <tr>
    <th>Estado</th>
    <th>Turno</th>
    <th>Servicio</th>
    <th>Documento</th>
    <th>Nombre</th>
    <th>Ingreso</th>
    <th>Salida</th>
    <th>Diferencia</th>
    </tr>
    <?php
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

    foreach  ($datos as $row) {
        echo "<tr>";
        echo "<td>";
        echo $row['estado_turno'];
        echo "</td>";
        echo "<td>";
        echo $row['turno'];
        echo "</td>";
        echo "<td>";
        echo $row['nombre_servicio'];
        echo "</td>";
        echo "<td>";
        echo $row['numero'];
        echo "</td>";
        echo "<td>";
        echo $row['nombre'];
        echo "</td>";
        echo "<td>";
        echo $row['tiempo_ingreso'];
        echo "</td>";
        echo "<td>";
        echo $row['tiempo_salida'];
        echo "</td>";
        echo "<td>";
        echo $row['diferencia'];
        echo "</td>";       
        echo "</tr>";
    }