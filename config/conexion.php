
<?php
$mysqli = new mysqli('localhost', 'root', '', 'db_digiturno');
if($mysqli->connect_error){
	echo $error -> $mysqli->connect_error;
}
?>