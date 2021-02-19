<?php 
	try {
	require_once '../../../Server/conexion/conexion.php'; 
	$Update= new OpenConexion();
	$data=array(
		"palabra"=>strip_tags($_POST['pregunta']),
		"id"=>strip_tags($_POST['id_pregunta'])
	);

	$check=$Update->Conn->prepare("update pregunta set nom_pregunta=upper(:palabra) where idpregunta=:id");
	$check->execute($data);
	echo 1;

	//echo $_POST['pregunta']." ".$_POST['id_pregunta'];
	} catch (Exception $e) {
		echo 0;
	}
?>