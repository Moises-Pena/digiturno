<?php
if ($_POST['accion'] == 'Obtenerdatosusuario') {
    $usuario = $_POST['datos'];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT  COUNT(*) AS total_turnos, 
        CASE WHEN sum(t.estado_turno='A')='' THEN 0
        ELSE sum(t.estado_turno='A') end as en_espera, 
        CASE WHEN sum(t.estado_turno='F')='' THEN 0
        ELSE sum(t.estado_turno='F') end as atendidos
          FROM db_turnos t
          WHERE DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') = CURDATE()");
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($total_turnos, $en_espera, $atendidos);
        $stmt->fetch();

        $stmt = $mysqli->prepare("SELECT u.id_usuario,s.nombre_servicio,m.nombre_modulo
        FROM db_usuarios u
        INNER JOIN db_modulos m ON u.modulo=m.id_modulo
        INNER JOIN db_nivel_acceso n ON u.nivel=n.id_nivel
        INNER JOIN db_servicios s ON u.servicio=s.id WHERE u.usuario = ?");
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($idusuario, $nombre_servicio, $nombre_modulo);
        $stmt->fetch();
        if ($idusuario > 0) {
            $respuesta = array(
                'codigo' => 0,
                'nombre_servicio' => $nombre_servicio,
                'nombre_modulo' => $nombre_modulo,
                'total_turnos' => $total_turnos,
                'en_espera' => $en_espera,
                'atendidos' => $atendidos
            );
        } else {
            $respuesta = array(
                'codigo' => 1,
                'respuesta' => 'No se Obtuvieron Datos',
            );
        }
        $stmt->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo " Error " . $e->getMessage();
    }

    die(json_encode($respuesta));
}


if ($_POST['accion'] == 'Llamarturno') {
    $usuario = $_POST["usuario"];
    $modulo = $_POST["modulo"];
    $servicio = $_POST["servicio"];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT t.id, t.turno,c.documento,c.numero,c.pnombre,c.papellido,c.sapellido
    FROM db_turnos t
    INNER JOIN db_clientes c ON t.documento=c.numero
    WHERE t.tipo_servicio = ? AND t.estado_turno = 'A' 
    AND DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') = CURDATE() ORDER BY t.tiempo_ingreso ASC LIMIT 1");
        $stmt->bind_param('s', $servicio);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id_turno, $turno, $documento, $numero, $pnombre, $papellido, $sapellido);
        $stmt->fetch();


        $ejecutar = $mysqli->prepare("UPDATE  db_turnos  SET estado_turno = 'M', usuario_atendio = ?, modulo = ?, tiempo_atender = NOW() WHERE turno = ? and id = ?");
        $ejecutar->bind_param("ssss", $usuario, $modulo, $turno, $id_turno);
        $ejecutar->execute();
        if ($ejecutar->affected_rows) {
            $respuesta = array(
                'codigo' => 0,
                'id_turno' => $id_turno,
                'turno' => $turno,
                'documento' => $documento,
                'numero' => $numero,
                'pnombre' => $pnombre,
                'papellido' => $papellido,
                'sapellido' => $sapellido
            );
        } else {
            $respuesta = array(
                'codigo' => 1,
                'respuesta' => 'error'
            );
        }
        $ejecutar->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo " Error " . $e->getMessage();
    }

    die(json_encode($respuesta));
}

if ($_POST['accion'] == 'AtenderTurno') {
    $usuario = $_POST["usuario"];
    $modulo = $_POST["modulo"];
    $servicio = $_POST["servicio"];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT t.id, t.turno FROM db_turnos t
    WHERE t.tipo_servicio = ? AND t.estado_turno = 'M' and t.modulo = ? and t.usuario_atendio = ?
    AND DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') = CURDATE() ORDER BY t.tiempo_ingreso ASC LIMIT 1");
        $stmt->bind_param('sss', $servicio,$modulo,$usuario);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id_turno, $turno);
        $stmt->fetch();


        $ejecutar = $mysqli->prepare("UPDATE  db_turnos  SET estado_turno = 'S', usuario_atendio = ?, modulo = ?, tiempo_atender = NOW() WHERE turno = ? and id = ?");
        $ejecutar->bind_param("ssss", $usuario, $modulo, $turno, $id_turno);
        $ejecutar->execute();
        if ($ejecutar->affected_rows) {
            $respuesta = array(
                'codigo' => 0,
                'respuesta' => "Exito"
            );
        } else {
            $respuesta = array(
                'codigo' => 1,
                'respuesta' => 'error'
            );
        }
        $ejecutar->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo " Error " . $e->getMessage();
    }

    die(json_encode($respuesta));
}

if ($_POST['accion'] == 'Finalizarturno') {
    $usuario = $_POST["usuario"];
    $modulo = $_POST["modulo"];
    $servicio = $_POST["servicio"];
    require_once('../config/conexion.php');
    try {
        $ejecutar = $mysqli->prepare("UPDATE  db_turnos  SET estado_turno = 'F', tiempo_salida = NOW() WHERE  usuario_atendio = ? and modulo = ? and tipo_servicio = ? and estado_turno ='S'");
        $ejecutar->bind_param("sss", $usuario, $modulo, $servicio);
        $ejecutar->execute();
        if ($ejecutar->affected_rows) {
            $respuesta = array(
                'codigo' => 0,
                'respuesta' => "Exito"
            );
        } else {
            $respuesta = array(
                'codigo' => 1,
                'respuesta' => 'error'
            );
        }
        $ejecutar->close();
        $mysqli->close();
    } catch (Exception $e) {
        echo " Error " . $e->getMessage();
    }

    die(json_encode($respuesta));
}


if ($_POST['accion'] == "ListarTurnos") {
    require_once('../config/conexion.php');
    $query = mysqli_query($mysqli, "SELECT t.estado_turno, t.turno, s.nombre_servicio, CONCAT(c.documento,'-',c.numero) AS numero,
    concat(c.pnombre,' ',c.papellido,' ',c.sapellido) AS nombre,t.tiempo_ingreso,t.tiempo_salida
    FROM db_turnos t
    INNER JOIN db_clientes c ON t.documento=c.numero
    INNER JOIN db_servicios s ON t.tipo_servicio=s.id
    WHERE  DATE_FORMAT(t.tiempo_ingreso, '%Y-%m-%d') = CURDATE()");
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