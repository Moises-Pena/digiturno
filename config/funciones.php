<?php



function db()
	{
		return $mysqli=mysqli_connect('localhost', 'root', '', 'db_digiturno_consultorio');
	}

  function usuarios(){
    $mysqli = db();
	$results = mysqli_prepare($mysqli, 'SELECT u.cedula, u.id_admin, u.usuario, u.nombre, u.modulo, s.nombre_servicio,u.status,u.nivel
FROM usuarios_db u
INNER JOIN db_servicios s ON u.tramite=s.id_servicio');
	mysqli_stmt_execute($results);
	$result = mysqli_stmt_get_result($results);
	$resultado = array();
	while($datos = mysqli_fetch_assoc($result)) {
		$resultado[] = $datos;
	}
  return $resultado;
}


  function servicios(){
    $mysqli = db();
    $results = mysqli_query($mysqli,"SELECT * FROM db_servicios");
    $datos = array();
    while ($row = $results->fetch_assoc()) {
      $datos[]= $row;
    }
    return $datos;
  }

  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  function servicios1(){
    $mysqli = db();
    $results = mysqli_query($mysqli,"SELECT s.nombre_servicio, t.tipo_tramite, COUNT(*) AS total_turnos, 
    sum(t.estado_turno='ACTIVO')  AS en_espera,
    sum(t.estado_turno='FINALIZADO') AS atendidos
      FROM db_turnos t
      INNER JOIN db_servicios s ON t.tipo_tramite = s.id_servicio
      WHERE t.tipo_tramite is not null
      GROUP BY t.tipo_tramite");
    $datos = array();
    while ($row = $results->fetch_assoc()) {
      $datos[]= $row;
    }
    return $datos;
  }
  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@




  // VER LOS TURNOS EN LA PANTALLA //////////////////////////////////////////////////////////////////////////////////////////////

  function turno_en_pantalla(){
    $mysqli = db();
    $results = mysqli_query($mysqli,"SELECT turno,modulo,estado_turno 
FROM db_turnos where estado_turno IN ('ESPERE','PASE') and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE() order by tiempo_ingreso asc LIMIT 5");
   $datos = array();
    while ($row = $results->fetch_assoc()) {
      $datos[]= $row;
    }
    return $datos;
  }
 

// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@TURNOS hoy@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function turnos_ver_hoy(){
  $mysqli = db();
  $results = mysqli_query($mysqli,"CALL pr_ver_turnos_hoy()");
 $datos = array();
  while ($row = $results->fetch_assoc()) {
    $datos[]= $row;
  }
  return $datos;
}

function turnos_ver_hoy_atendidos(){
  $mysqli = db();
  $results = mysqli_query($mysqli,"SELECT tu.estado_turno, tu.turno, tu.documento,tu.pnombre,tu.papellido,tu.usuario_atendio,tu.tiempo_ingreso,tu.tiempo_atender,tu.tiempo_salida
FROM db_turnos tu 
WHERE tu.estado_turno IN ('ESPERE','FINALIZADO')
and DATE_FORMAT(tu.tiempo_ingreso, '%Y-%m-%d') = CURDATE()");
 $datos = array();
  while ($row = $results->fetch_assoc()) {
    $datos[]= $row;
  }
  return $datos;
}
// @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@GESTION DE TURNOS@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
  function turnos_en_espera(){
    $mysqli = db();
    $query = mysqli_query($mysqli, "SELECT COUNT(*) as numero FROM db_turnos  WHERE estado_turno='ESPERE' and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE()")
    or die('Error ' . mysqli_error($mysqli));
$data = mysqli_fetch_assoc($query);
return $data;
  }

  function turnos_atendidos(){
    $mysqli = db();
    $query = mysqli_query($mysqli, "SELECT COUNT(*) as numero FROM db_turnos  WHERE estado_turno='FINALIZADO' and DATE_FORMAT(tiempo_ingreso, '%Y-%m-%d') = CURDATE()")
    or die('Error ' . mysqli_error($mysqli));
$data = mysqli_fetch_assoc($query);
return $data;
  }




?>