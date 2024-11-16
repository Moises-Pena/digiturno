<?php

if ($_POST['accion'] == "ListarServicios") {
    require_once('../config/conexion.php');
    $query = mysqli_query($mysqli, "SELECT s.id,s.nombre_servicio,s.color_servicio,s.icono_servicio,s.letra_servicio,s.estado FROM db_servicios s");
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
                $activo = '<button class="btn btn-icon btn-sm btn-danger" onClick="inactivarservicio(' . $arrServicio[$i]['id'] . ',' . "$inac" . ')" title="Deshabilitar Servicio"><i class="bx bxs-message-square-x"></i></button>';
            } else {
                $arrServicio[$i]["estado"] = '<span class="badge bg-danger">Inactivo</span>';
                $act = 1;
                $inactivo = '<button class="btn btn-icon btn-sm btn-primary" onClick="inactivarservicio(' . $arrServicio[$i]['id'] . ','. "$act" .')" title="Habilitar Servicio"><i class="bx bxs-message-square-x"></i></button>';
            }

            $editar = '<button class="btn btn-icon btn-sm btn-success" onClick="seleccionarServicio(' . $arrServicio[$i]['id'] . ')" title="Editar Servicio"><i class="bx bxs-edit"></i></button>';
           
            $arrServicio[$i]["color_servicio"] = '<span class="badge bg-'.$arrServicio[$i]["color_servicio"].'">'.$arrServicio[$i]["color_servicio"].'</span>';
            $arrServicio[$i]["icono_servicio"] = '<i class="bx '.$arrServicio[$i]["icono_servicio"].'"></i>';

            $arrServicio[$i]["opciones"] = '<div class="text-center">' . $editar . ' ' . $activo . ' ' . $inactivo . '</div>';
        }
        $arrResponse["data"] = $arrServicio;
    } else {
        $arrResponse = [];
    }
    echo json_encode($arrResponse);
    die();
}

if ($_POST['accion'] == 'ObtenerServicio') {
    $id_servicio = $_POST['datos'];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT s.id,s.nombre_servicio,s.color_servicio,s.icono_servicio,s.letra_servicio FROM db_servicios s WHERE s.id = ?");
        $stmt->bind_param('s', $id_servicio);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $nombre_servicio, $color_servicio,$icono_servicio,$letra_servicio);
        $stmt->fetch();
        if ($id > 0) {
            $respuesta = array(
                'codigo' => 0,
                'idunico' => $id,
                'nombre_servicio' => $nombre_servicio,
                'color_servicio' => $color_servicio,
                'icono_servicio' => $icono_servicio,
                'letra_servicio' => $letra_servicio,
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
if ($_POST['accion'] == 'RegistroServicio') {
    $datos = json_decode($_POST['datos']);
    $nombreservicio = strtoupper($datos->nombreservicio);
    $colorservicio = strtolower($datos->colorservicio);
    $iconoservicio = strtolower($datos->iconoservicio);
    $letraservicio = strtoupper($datos->letraservicio);
    if (empty($colorservicio) || empty($nombreservicio) || empty($iconoservicio) || empty($letraservicio)) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        try {

            $ejecutar = $mysqli->prepare("INSERT INTO db_servicios (nombre_servicio,color_servicio,icono_servicio,letra_servicio,estado,fecha_registro) VALUES (?,?,?,?,'A',NOW())");
            $ejecutar->bind_param("ssss", $nombreservicio,$colorservicio,$iconoservicio,$letraservicio);
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


if ($_POST['accion'] == 'ActualizarServicio') {
    $datos = json_decode($_POST['datos']);
    $nombreservicio = strtoupper($datos->nombreservicio);
    $colorservicio = strtolower($datos->colorservicio);
    $iconoservicio = strtolower($datos->iconoservicio);
    $letraservicio = strtoupper($datos->letraservicio);
    $idunicodelservicio = $datos->idunicodelservicio;
    if (empty($idunicodelservicio) || empty($nombreservicio) || empty($colorservicio) || empty($iconoservicio) || empty($letraservicio)) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        try {
            $ejecutar1 = $mysqli->prepare("UPDATE db_servicios  SET  nombre_servicio = ?, color_servicio = ?, icono_servicio = ?, letra_servicio = ? WHERE id = ?");
            $ejecutar1->bind_param("sssss", $nombreservicio,$colorservicio,$iconoservicio,$letraservicio, $idunicodelservicio);
            $ejecutar1->execute();
            if ($ejecutar1->affected_rows) {
                $respuesta = array(
                    'codigo' => 0,
                    'respuesta' => 'Servicio Modificado Correctamente'
                );
            } else {
                $respuesta = array(
                    'codigo' => 1,
                    'respuesta' => 'No se Logro Modificar el Servicio',
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
    $idservicio = $_POST['datos'];
    $estado = $_POST['estado'];
        require_once('../config/conexion.php');
        try {
            $ejecutar1 = $mysqli->prepare("UPDATE db_servicios  SET  estado = ? WHERE id = ?");
            $ejecutar1->bind_param("ss", $estado, $idservicio);
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
