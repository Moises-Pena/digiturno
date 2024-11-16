<?php 
if ($_POST['accion'] == "Verturnos") {
    require_once('../config/conexion.php');
    $query = mysqli_query($mysqli, "SELECT t.turno, t.modulo,
    CASE WHEN t.estado_turno='M' THEN 'LLAMADO'
    WHEN t.estado_turno='S' THEN 'MODULO'
    WHEN t.estado_turno='F' THEN 'ATENDIDO'
    ELSE 'No hay Turnos' END AS estado 
    FROM db_turnos t
    WHERE t.estado_turno IN ('M','S','F') AND  DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') = CURDATE() 
    order by tiempo_ingreso asc LIMIT 6;");
    $datos = array();
    while ($row = $query->fetch_assoc()) {
        $datos[] = $row;
    }
    $arrTurno = $datos;
    if (!empty($arrTurno)) {
        for ($i = 0; $i < count($arrTurno); $i++) {

        }
        $arrResponse = array('status' => true, 'data' => $arrTurno);
    } else {
        $arrResponse = array('status' => false, 'data' => []);
    }
    echo json_encode($arrResponse);
    die();
}

if ($_POST['accion'] == 'ver_turno'){
    $tipo_llamado = 'PASE';
    require_once('../../config/database.php');
   try {
$stmt = $conn->prepare("SELECT estado_turno, pnombre,papellido, turno, modulo FROM db_turnos WHERE estado_turno = ? and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE()");
$stmt -> bind_param('s', $tipo_llamado);
$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($turnotriaje,$pnombre,$papellido,$turno,$modulo);
$stmt -> fetch();

$datoturno = $turnotriaje;
$id_registro = $stmt->id;
if ($id_registro > 0 ){
    $respuesta = array(
        'pnombre' => $pnombre,
        'papellido' => $papellido,
        'turno' => $turno,
        'modulo' => $modulo,
        'su_turno_es' => $datoturno
    );
}else{
     
    $respuesta = array(
        'respuesta' => 'error',
    );

}
$stmt->close();
$conn->close();


   } catch (Exception $e) {
       echo " Error " . $e->getMessage();
   }

   die(json_encode($respuesta));
}