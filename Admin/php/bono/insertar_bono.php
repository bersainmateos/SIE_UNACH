<?php 
require_once '../../../Server/conexion/conexion.php';

$Insertar = new CI_Controller();


$nom=pg_escape_string($_POST['nom']);
$desc=pg_escape_string($_POST['desc']);


$check=$Insertar->query("insert into bono values (default,upper('".$nom."'),upper('".$desc."'))");

if ($check) {
	echo '1';
}
 ?>