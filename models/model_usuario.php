<?php

if ($_POST['accion'] == "ListarUsuarios") {
    require_once('../config/conexion.php');
    $query = mysqli_query($mysqli, "SELECT u.id_usuario,u.usuario,u.cedula,u.nombres,u.apellidos,u.servicio,s.nombre_servicio,u.modulo,m.nombre_modulo
    ,u.nivel,n.nombre_nivel,u.estado
    FROM db_usuarios u
    INNER JOIN db_modulos m ON u.modulo=m.id_modulo
    INNER JOIN db_nivel_acceso n ON u.nivel=n.id_nivel
    INNER JOIN db_servicios s ON u.servicio=s.id");
    $datos = array();
    while ($row = $query->fetch_assoc()) {
        $datos[] = $row;
    }
    $arrUsuario = $datos;
    if (!empty($arrUsuario)) {
        for ($i = 0; $i < count($arrUsuario); $i++) {
            $activo = "";
            $inactivo = "";
            $editar = "";

            if ($arrUsuario[$i]["estado"] == "A") {
                $arrUsuario[$i]["estado"] = '<span class="badge bg-success">Activo</span>';
                $inac = 2;
                $activo = '<button class="btn btn-icon btn-sm btn-danger" onClick="InactivarUsuario(' . $arrUsuario[$i]['id_usuario'] . ',' . "$inac" . ')" title="Deshabilitar Usuario"><i class="bx bxs-message-square-x"></i></button>';
            } else {
                $arrUsuario[$i]["estado"] = '<span class="badge bg-danger">Inactivo</span>';
                $act = 1;
                $inactivo = '<button class="btn btn-icon btn-sm btn-primary" onClick="InactivarUsuario(' . $arrUsuario[$i]['id_usuario'] . ','. "$act" .')" title="Habilitar Usuario"><i class="bx bxs-message-square-x"></i></button>';
            }

            $editar = '<button class="btn btn-icon btn-sm btn-success" onClick="seleccionarUsuario(' . $arrUsuario[$i]['id_usuario'] . ')" title="Editar Usuario"><i class="bx bxs-edit"></i></button>';
           
           

            $arrUsuario[$i]["opciones"] = '<div class="text-center">' . $editar . ' ' . $activo . ' ' . $inactivo . '</div>';
        }
        $arrResponse["data"] = $arrUsuario;
    } else {
        $arrResponse = [];
    }
    echo json_encode($arrResponse);
    die();
}

if ($_POST['accion'] == 'Obtenerusuario') {
    $id_usuario = $_POST['datos'];
    require_once('../config/conexion.php');
    try {
        $stmt = $mysqli->prepare("SELECT u.id_usuario,u.usuario,u.cedula,u.nombres,u.apellidos,u.servicio,u.modulo,u.nivel 
        FROM db_usuarios u WHERE u.id_usuario= ?");
        $stmt->bind_param('s', $id_usuario);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $usuario, $documento, $nombres, $apellidos, $servicio, $modulo, $nivel);
        $stmt->fetch();
        if ($id > 0) {
            $respuesta = array(
                'codigo' => 0,
                'usuario' => $usuario,
                'documento' => $documento,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'servicio' => $servicio,
                'modulo' => $modulo,
                'nivel' => $nivel
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
if ($_POST['accion'] == 'RegistroUsuario') {
    $datos = json_decode($_POST['datos']);
    $usuario = $datos->usuario;
    $cedula = $datos->numero;
    $nombres = $datos->nombres;
    $apellidos = $datos->apellidos;
    $password = $datos->password;
    $servicio = $datos->servicio;
    $modulo = $datos->modulo;
    $nivel = $datos->nivel;
    if (empty($usuario) || empty($cedula) || empty($nombres) || empty($apellidos)  || empty($password) || empty($servicio) || empty($modulo) || empty($nivel)) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        $opciones = array('cost' => 12);
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
        try {
            $ejecutar = $mysqli->prepare("INSERT INTO db_usuarios (usuario,cedula, nombres,apellidos, password,servicio,modulo,estado,nivel,fecha_registro)  VALUES (?,?,?,?,?,?,?,'A',?,NOW())");
            $ejecutar->bind_param("ssssssss", $usuario, $cedula, $nombres,$apellidos, $password_hashed, $servicio, $modulo, $nivel);
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


if ($_POST['accion'] == 'ActualizarUsuario') {
    $datos = json_decode($_POST['datos']);
    $usuario = $datos->usuario;
    $cedula = $datos->numero;
    $nombres = $datos->nombres;
    $apellidos = $datos->apellidos;
    $password = $datos->password;
    $servicio = $datos->servicio;
    $modulo = $datos->modulo;
    $nivel = $datos->nivel;

    if (empty($usuario) || empty($cedula) || empty($nombres) || empty($apellidos) || empty($modulo) || empty($servicio) || empty($nivel)) {
        $respuesta = array(
            "codigo" => 2,
            "respuesta" => 'Verificar los Campos Vacios',
        );
    } else {
        require_once('../config/conexion.php');
        $opciones = array('cost' => 12);
        try {
            $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);
            if ($password == "") {
                $ejecutar = $mysqli->prepare("UPDATE  db_usuarios  SET usuario = ?, nombres = ?, apellidos = ?, servicio = ?, modulo = ?, nivel = ? WHERE cedula = ?");
                $ejecutar->bind_param("sssssss", $usuario, $nombres, $apellidos, $servicio, $modulo, $nivel, $cedula);
                $ejecutar->execute();
            }
            if ($password != "") {
                $ejecutar = $mysqli->prepare("UPDATE  db_usuarios  SET usuario = ?, password = ?, nombres =?, apellidos =?, servicio = ?, modulo=?, nivel=? WHERE cedula = ?");
                $ejecutar->bind_param("ssssssss", $usuario, $password_hashed, $nombres, $apellidos, $servicio, $modulo, $nivel, $cedula);
                $ejecutar->execute();
            }

            if ($ejecutar->affected_rows) {
                $respuesta = array(
                    'codigo' => 0,
                    'respuesta' => 'Registro Actualizado Correctamente'
                );
            } else {
                $respuesta = array(
                    'codigo' => 1,
                    'respuesta' => 'No se Logro actualizar el Usuario',
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
if ($_POST['accion'] == 'ActualizarEstado') {
    $id_usuario = $_POST['datos'];
    $estado = $_POST['estado'];
        require_once('../config/conexion.php');
        try {
            $ejecutar1 = $mysqli->prepare("UPDATE db_usuarios  SET  estado = ? WHERE id_usuario = ?");
            $ejecutar1->bind_param("ss", $estado, $id_usuario);
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

if ($_POST['accion'] == 'VerServicios') {
    require_once('../config/conexion.php');
                $query = mysqli_query($mysqli, "SELECT id_servicio,nombre_servicio from db_servicios");
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
if ($_POST['accion'] == 'VerModulos') {
    require_once('../config/conexion.php');
                $query = mysqli_query($mysqli, "SELECT id_modulo,nombre_modulo from db_modulos");
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
if ($_POST['accion'] == 'VerNiveles') {
    require_once('../config/conexion.php');
                $query = mysqli_query($mysqli, "SELECT id_nivel,nombre_nivel from db_nivel_acceso");
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