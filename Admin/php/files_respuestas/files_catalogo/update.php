<?php 
	require_once '../../../../Server/conexion/conexion.php';
	
	$Update = new OpenConexion();
	$data=array("id"=>strip_tags($_POST['id_catalogo_respuesta']));

	$respuesta=$Update->Conn->prepare("select * from cat_respuesta where idcatalogo_r=:id");
	$respuesta->execute($data);
	
	$nom_respuesta = ($respuesta->rowCount() > 0) ? $respuesta->fetchAll(PDO::FETCH_ASSOC)[0] : "";
	$Update->Close();
	echo json_encode($nom_respuesta);
 ?>