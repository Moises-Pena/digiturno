<?php 
if ($_POST['accion'] == 'ObtenerCliente') {
    $numerodocumento = $_POST['datos'];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT c.documento,c.numero,c.pnombre,c.snombre,c.papellido,c.sapellido FROM db_clientes c WHERE c.numero = ?");
        $stmt->bind_param('s', $numerodocumento);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($documento, $numero, $pnombre, $snombre, $papellido, $sapellido);
        $stmt->fetch();
        if ($documento > 0) {
            $respuesta = array(
                'codigo' => 0,
                'documento' => $documento,
                'numero' => $numero,
                'pnombre' => $pnombre,
                'snombre' => $snombre,
                'papellido' => $papellido,
                'sapellido' => $sapellido,
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


if ($_POST['accion'] == 'VerServicios') {
    require_once('../config/conexion.php');
                $query = mysqli_query($mysqli, "SELECT id,nombre_servicio,color_servicio,icono_servicio,letra_servicio from db_servicios");
                $datos = array();
                while ($row = $query->fetch_assoc()) {
                    $datos[] = $row;
                }

                $arraData = $datos;
                if(empty($arraData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados');
                }else{
                    $arrResponse = array('status' => true, 'data' => $arraData);
                }
                echo json_encode($arrResponse);
         
            die();
}


    if ($_POST['accion'] == 'GenerarTurno') {
        $datos = json_decode($_POST['datos']);
        $documento = $datos->documento;
        $numero = $datos->numero;
        $pnombre = strtoupper($datos->pnombre);
        $snombre = strtoupper($datos->snombre);
        $papellido = strtoupper($datos->papellido);
        $sapellido = strtoupper($datos->sapellido);
        if (empty($documento) || empty($numero) || empty($pnombre) || empty($papellido)) {
            $respuesta = array(
                "codigo" => 2,
                "respuesta" => 'Verificar los Campos Vacios',
            );
        } else {
            require_once('../config/conexion.php');
            try {
            if($datos->registrarcliente == "SI"){
                $ejecutar = $mysqli->prepare("INSERT INTO db_clientes (documento,numero,pnombre,snombre,papellido,sapellido,estado,fecha_registro) VALUES (?,?,?,?,?,?,'A',NOW())");
                $ejecutar->bind_param("ssssss", $documento, $numero, $pnombre, $snombre, $papellido,  $sapellido);
                $ejecutar->execute();
            }

                $query_id = mysqli_query($mysqli, "SELECT RIGHT(turno,3) as turno FROM db_turnos 
                WHERE tipo_servicio= $datos->id_servicio and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE()
                ORDER BY turno DESC LIMIT 1");
                 $contar = mysqli_num_rows($query_id);
                 if ($contar <> 0) {
                 $data_id = mysqli_fetch_assoc($query_id);
                 $turno    = $data_id['turno']+1;
                 } else {
                 $turno = 1;
                 }
                 $asignar_codigo   = str_pad($turno, 3, "0", STR_PAD_LEFT);
                 $turno = "$datos->letra$asignar_codigo";
                 // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ generar turno@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
                 $ejecutar = $mysqli->prepare("INSERT INTO db_turnos (tipo_servicio,estado_turno,turno,documento,tiempo_ingreso) VALUES (?,'A',?,?,NOW())");
                 $ejecutar->bind_param("sss", $datos->id_servicio,$turno,$numero);
                 $ejecutar->execute();
                $id_registro = $ejecutar->insert_id;
                if ($id_registro > 0) {
                    $respuesta = array(
                        'codigo' => 0,
                        'respuesta' => 'Turno Generado Correctamente',
                        'turno' => $turno
                    );
                } else {
                    $respuesta = array(
                        'codigo' => 1,
                        'respuesta' => 'No se Logro Registro el Turno',
                    );
                }
                $ejecutar->close();
                $mysqli->close();
            } catch (Exception $e) {
                echo " Error " . $e->getMessage();
            }
        }
        die(json_encode($respuesta));
    }