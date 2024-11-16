<?php

if ($_POST['accion'] == "ListarModulos") {
    require_once('../config/conexion.php');
    $query = mysqli_query($mysqli, "SELECT m.id_modulo,m.nombre_modulo,m.estado FROM db_modulos m");
    $datos = array();
    while ($row = $query->fetch_assoc()) {
        $datos[] = $row;
    }
    $arrServicio = $datos;
    if (!empty($arrServicio)) {
        for ($i = 0; $i < count($arrServicio); $i++) {
            $activo = "";
            $inactivo = "";
            $editar = "";

            if ($arrServicio[$i]["estado"] == "A") {
                $arrServicio[$i]["estado"] = '<span class="badge bg-success">Activo</span>';
                $inac = 2;
                $activo = '<button class="btn btn-icon btn-sm btn-danger" onClick="inactivarmodulo(' . $arrServicio[$i]['id_modulo'] . ',' . "$inac" . ')" title="Deshabilitar Servicio"><i class="bx bxs-message-square-x"></i></button>';
            } else {
                $arrServicio[$i]["estado"] = '<span class="badge bg-danger">Inactivo</span>';
                $act = 1;
                $inactivo = '<button class="btn btn-icon btn-sm btn-primary" onClick="inactivarmodulo(' . $arrServicio[$i]['id_modulo'] . ','. "$act" .')" title="Habilitar Servicio"><i class="bx bxs-message-square-x"></i></button>';
            }

            $editar = '<button class="btn btn-icon btn-sm btn-success" onClick="seleccionarModulo(' . $arrServicio[$i]['id_modulo'] . ')" title="Editar Servicio"><i class="bx bxs-edit"></i></button>';
           
           

            $arrServicio[$i]["opciones"] = '<div class="text-center">' . $editar . ' ' . $activo . ' ' . $inactivo . '</div>';
        }
        $arrResponse["data"] = $arrServicio;
    } else {
        $arrResponse = [];
    }
    echo json_encode($arrResponse);
    die();
}

if ($_POST['accion'] == 'ObtenerModulo') {
    $id_modulo = $_POST['datos'];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT s.id_modulo,s.nombre_modulo FROM db_modulos s WHERE s.id_modulo = ?");
        $stmt->bind_param('s', $id_modulo);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $nombre_modulo);
        $stmt->fetch();
        if ($id > 0) {
            $respuesta = array(
                'codigo' => 0,
                'idunico' => $id,
                'nombre_modulo' => $nombre_modulo
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
if ($_POST['accion'] == 'RegistroModulo') {
    $datos = json_decode($_POST['datos']);
    $nombremodulo = strtoupper($datos->nombremodulo);
    if ( empty($nombremodulo)) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        try {

            $ejecutar = $mysqli->prepare("INSERT INTO db_modulos (nombre_modulo,estado,fecha_registro) VALUES (?,'A',NOW())");
            $ejecutar->bind_param("s", $nombremodulo);
            $ejecutar->execute();
            $id_registro = $ejecutar->insert_id;
            if ($id_registro > 0) {
                $respuesta = array(
                    'codigo' => 0,
                    'respuesta' => 'Registro Insertado Correctamente'
                );
            } else {
                $respuesta = array(
                    'codigo' => 1,
                    'respuesta' => 'No se Logro Registro el Servicio',
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


if ($_POST['accion'] == 'ActualizarModulos') {
    $datos = json_decode($_POST['datos']);
    $nombremodulo = strtoupper($datos->nombremodulo);
    $idunicodelmodulo = $datos->idunicodelmodulo;
    if ( empty($nombremodulo)) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        try {
            $ejecutar1 = $mysqli->prepare("UPDATE db_modulos  SET  nombre_modulo = ? WHERE id_modulo = ?");
            $ejecutar1->bind_param("ss", $nombremodulo, $idunicodelmodulo);
            $ejecutar1->execute();
            if ($ejecutar1->affected_rows) {
                $respuesta = array(
                    'codigo' => 0,
                    'respuesta' => 'Modulo Modificado Correctamente'
                );
            } else {
                $respuesta = array(
                    'codigo' => 1,
                    'respuesta' => 'No se Logro Modificar el Modulo',
                );
            }
            $ejecutar1->close();
            $mysqli->close();
        } catch (Exception $e) {
            echo " Error " . $e->getMessage();
        }
    }
    die(json_encode($respuesta));
}
if ($_POST['accion'] == 'ActualizarEstado') {
    $idmodulo = $_POST['datos'];
    $estado = $_POST['estado'];
        require_once('../config/conexion.php');
        try {
            $ejecutar1 = $mysqli->prepare("UPDATE db_modulos  SET  estado = ? WHERE id_modulo = ?");
            $ejecutar1->bind_param("ss", $estado, $idmodulo);
            $ejecutar1->execute();
            if ($ejecutar1->affected_rows) {
                $respuesta = array(
                    'codigo' => 0,
                    'respuesta' => 'Estado Actualizado Correctamente'
                );
            } else {
                $respuesta = array(
                    'codigo' => 1,
                    'respuesta' => 'No se Logro Actualizar el Estado',
                );
            }
            $ejecutar1->close();
            $mysqli->close();
        } catch (Exception $e) {
            echo " Error " . $e->getMessage();
        }
    die(json_encode($respuesta));
}
