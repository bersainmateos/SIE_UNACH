<?php 

try {
	
require_once '../../../Server/conexion/conexion.php';

$Update= new OpenConexion();

$data=array(
	"respuesta"=>strip_tags($_POST['respuesta']),
	"id"=>strip_tags($_POST['id_respuesta'])
);

$check=$Update->Conn->prepare("update respuesta set nom_respuesta=upper(:respuesta) where idrespuesta=:id");
$check->execute($data);

	 echo "1";
$Update->Close();
} catch (Exception $e) {
	echo "Error";
}
 ?>