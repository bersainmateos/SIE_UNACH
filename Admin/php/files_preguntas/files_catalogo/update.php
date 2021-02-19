<?php 
	require_once '../../../../Server/conexion/conexion.php';
	
	$Update = new OpenConexion();
	$data=array("id"=>strip_tags($_POST['id_catalogo']));

	$pregunta=$Update->Conn->prepare("select * from cat_pregunta where idcatalogo_p=:id");
	$pregunta->execute($data);
	
	$nom_pregunta = ($pregunta->rowCount() > 0) ? $pregunta->fetchAll(PDO::FETCH_ASSOC)[0] : "";
	$Update->Close();
	echo json_encode($nom_pregunta);
 ?>