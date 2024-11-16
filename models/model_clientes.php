<?php

if ($_POST['accion'] == "ListarClientes") {
    require_once('../config/conexion.php');
    $query = mysqli_query($mysqli, "SELECT c.id,c.documento,c.numero,CONCAT(c.pnombre,' ',c.snombre,' ',c.papellido,' ',c.sapellido) AS cliente,
    c.sexo,c.estado FROM db_clientes c");
    $datos = array();
    while ($row = $query->fetch_assoc()) {
        $datos[] = $row;
    }
    $arrCliente = $datos;
    if (!empty($arrCliente)) {
        for ($i = 0; $i < count($arrCliente); $i++) {
            $activo = "";
            $inactivo = "";
            $editar = "";

            if ($arrCliente[$i]["estado"] == "A") {
                $arrCliente[$i]["estado"] = '<span class="badge bg-success">Activo</span>';
                $inac = 2;
                $activo = '<button class="btn btn-icon btn-sm btn-danger" onClick="InactivarCliente(' . $arrCliente[$i]['id'] . ',' . "$inac" . ')" title="Deshabilitar Cliente"><i class="bx bxs-message-square-x"></i></button>';
            } else {
                $arrCliente[$i]["estado"] = '<span class="badge bg-danger">Inactivo</span>';
                $act = 1;
                $inactivo = '<button class="btn btn-icon btn-sm btn-primary" onClick="InactivarCliente(' . $arrCliente[$i]['id'] . ','. "$act" .')" title="Habilitar Cliente"><i class="bx bxs-message-square-x"></i></button>';
            }

            $editar = '<button class="btn btn-icon btn-sm btn-success" onClick="seleccionarCliente(' . $arrCliente[$i]['id'] . ')" title="Editar Cliente"><i class="bx bxs-edit"></i></button>';
           
           

            $arrCliente[$i]["opciones"] = '<div class="text-center">' . $editar . ' ' . $activo . ' ' . $inactivo . '</div>';
        }
        $arrResponse["data"] = $arrCliente;
    } else {
        $arrResponse = [];
    }
    echo json_encode($arrResponse);
    die();
}

if ($_POST['accion'] == 'ObtenerCliente') {
    $documento = $_POST['datos'];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT c.id,c.documento,c.numero,c.pnombre,c.snombre,c.papellido,c.sapellido,
            c.sexo, c.fecha_nacimiento FROM db_clientes c WHERE c.id = ?");
        $stmt->bind_param('s', $documento);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $documento, $numero, $pnombre, $snombre, $papellido, $sapellido, $sexo, $fecha_nacimiento);
        $stmt->fetch();
        if ($id > 0) {
            $respuesta = array(
                'codigo' => 0,
                'documento' => $documento,
                'numero' => $numero,
                'pnombre' => $pnombre,
                'snombre' => $snombre,
                'papellido' => $papellido,
                'sapellido' => $sapellido,
                'sexo' => $sexo,
                'fecha_nacimiento' => $fecha_nacimiento
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
if ($_POST['accion'] == 'RegistroCliente') {
    $datos = json_decode($_POST['datos']);
    $documento = $datos->documento;
    $numero = $datos->numero;
    $pnombre = strtoupper($datos->pnombre);
    $snombre = strtoupper($datos->snombre);
    $papellido = strtoupper($datos->papellido);
    $sapellido = strtoupper($datos->sapellido);
    $fechan = $datos->fechan;
    $sexo = $datos->sexo;
    if (empty($documento) || empty($numero) || empty($pnombre) || empty($papellido) || empty($fechan) || empty($sexo)) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        try {

            $ejecutar = $mysqli->prepare("INSERT INTO db_clientes (documento,numero,pnombre,snombre,papellido,sapellido,fecha_nacimiento,sexo,estado,fecha_registro) VALUES (?,?,?,?,?,?,?,?,'A',NOW())");
            $ejecutar->bind_param("ssssssss", $documento, $numero, $pnombre, $snombre, $papellido,  $sapellido, $fechan, $sexo);
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
                    'respuesta' => 'No se Logro Registro el Cliente',
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


if ($_POST['accion'] == 'ActualizarCliente') {
    $datos = json_decode($_POST['datos']);
    $documento = $datos->documento;
    $numero = $datos->numero;
    $pnombre = strtoupper($datos->pnombre);
    $snombre = strtoupper($datos->snombre);
    $papellido = strtoupper($datos->papellido);
    $sapellido = strtoupper($datos->sapellido);
    $fechan = $datos->fechan;
    $sexo = $datos->sexo;

    if (
        empty($documento) || empty($numero) || empty($pnombre) || empty($papellido)
        || empty($fechan) || empty($sexo)
    ) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        try {
            $ejecutar1 = $mysqli->prepare("UPDATE db_clientes  SET  pnombre = ?, snombre = ?, papellido = ?, sapellido = ?, fecha_nacimiento = ?, sexo = ? WHERE documento = ? and numero = ?");
            $ejecutar1->bind_param("ssssssss", $pnombre, $snombre, $papellido, $sapellido, $fechan, $sexo, $documento, $numero);
            $ejecutar1->execute();
            if ($ejecutar1->affected_rows) {
                $respuesta = array(
                    'codigo' => 0,
                    'respuesta' => 'Cliente Modificado Correctamente'
                );
            } else {
                $respuesta = array(
                    'codigo' => 1,
                    'respuesta' => 'No se Logro Modificar el Cliente',
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
    $idcliente = $_POST['datos'];
    $estado = $_POST['estado'];
        require_once('../config/conexion.php');
        try {
            $ejecutar1 = $mysqli->prepare("UPDATE db_clientes  SET  estado = ? WHERE id = ?");
            $ejecutar1->bind_param("ss", $estado, $idcliente);
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
