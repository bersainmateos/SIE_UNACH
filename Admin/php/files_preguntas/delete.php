<?php 
	require_once '../../../Server/conexion/conexion.php';
	$Delete = new OpenConexion();
	
	$data=array(
		"idpregunta"=>strip_tags($_POST['id_'])
	);

	$check=$Delete->Conn->prepare("update pregunta set status=0 where idpregunta=:idpregunta");
	$check->execute($data);
	if($check){
		echo "1";
	}
?>
