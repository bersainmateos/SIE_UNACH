<?php 
	
	try {
	require_once '../../../../Server/conexion/conexion.php';
	
	$Catalogo = new OpenConexion();
	$ids=str_replace(array("[","]"),array("{","}"), $_POST['id']);
	
	$data=array(
		"id"=>strip_tags((Integer)$_POST['id_']),
			"ids"=>$ids
	);
	$Add= $Catalogo->Conn->prepare("select add_catalogo_respuesta(:id, :ids)");
	$Add->execute($data);
	echo "1";
	} catch (Exception $e) {
		echo "Error";
	}


?>