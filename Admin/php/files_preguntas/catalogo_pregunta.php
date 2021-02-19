<?php 
require_once '../../../Server/conexion/conexion.php';
 
	$Catalogo=new OpenConexion();
	$ids=str_replace(array('[',']'), array('{','}'), $_POST['id']);
	$data=array(
		"nombre"=>strip_tags(($_POST['nombre'])),
		"id"=>$ids
	); 

	$check=$Catalogo->Conn->prepare("select catalogo_pregunta(:nombre , :id)");
	$check->execute($data);
	echo $check->fetch(PDO::FETCH_ASSOC)['catalogo_pregunta'];
?>