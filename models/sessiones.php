<?php
session_start();
$session = ($_SESSION['usuario'] != '' ? $_SESSION['usuario'] : '') ;
if($session == ''){
    header('location: http://localhost/digiturno');
}
?>