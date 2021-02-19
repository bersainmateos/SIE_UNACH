<?php 

try {
	require_once '../../../Server/conexion/conexion.php';

$Registro= new OpenConexion();

	$data=array("uno"=>strip_tags($_POST['alumno'][0]),"dos"=>strip_tags($_POST['alumno'][1]),"tres"=>strip_tags($_POST['alumno'][2]),"cuatro"=>strip_tags($_POST['alumno'][3]),"cinco"=>strip_tags($_POST['alumno'][4]),"seis"=>strip_tags($_POST['alumno'][5]),"siete"=>strip_tags($_POST['alumno'][6]));



$check=$Registro->Conn->prepare("insert into encuestador values (:uno,upper(:dos),upper(:tres),upper(:cuatro),:cinco,:seis,:siete,md5(:uno))");
$check->execute($data);
		echo '1';

} catch (Exception $e) {
	echo '0'.$e->getMessage();
}


?>