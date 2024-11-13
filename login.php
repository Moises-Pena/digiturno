<?php 
session_start();
if ($_POST['accion'] == 'LoginUsuario'){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    try {
        require_once('../config/conexion.php');
    $ejecutar = $mysqli->prepare("SELECT u.usuario,u.nombres,u.apellidos,u.password,u.modulo,u.nivel,u.servicio
    FROM db_usuarios u
    INNER JOIN db_modulos m ON u.modulo=m.id_modulo
    INNER JOIN db_servicios s ON u.servicio=s.id
    WHERE u.usuario = ?");
    $ejecutar->bind_param("s", $usuario);
    $ejecutar->execute();
    $ejecutar->bind_result($usuario_admin,  $nombres, $apellidos, $password_admin, $modulo,$nivel, $servicio);
    if($ejecutar->affected_rows){
        $existe = $ejecutar->fetch();
        if($existe){
            if ( password_verify($password,$password_admin)){
                $_SESSION['usuario'] = $usuario_admin;
                $_SESSION['nombre'] = $nombres.' '.$apellidos;
                $_SESSION['modulo'] = $modulo;
                $_SESSION['nivel'] = $nivel;
                $_SESSION['servicio'] = $servicio;
                $respuesta = array(
                    'codigo' => 0,
                    'mensaje' => $nombres.' '.$apellidos,
                    'usuario' => $usuario_admin,
                    'servicio' => $servicio,
                    'modulo' => $modulo,
                );
            }else{
                $respuesta = array(
                    'codigo' => 1,
                    'mensaje' => 'usuario o contraseña incorrecto'
                );
            }
        } else {
            $respuesta = array(
                'codigo' => 2,
                'mensaje' => 'No se Logro acceder al sistema'
            ); 
        }
    }
    $ejecutar->close();
$mysqli->close();
       } catch (Exception $e) {
           echo " Error " . $e->getMessage();
       }
       die(json_encode($respuesta));
}
?>