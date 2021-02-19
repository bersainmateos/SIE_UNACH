<?php
	if(!empty($_POST['pregunta'])){
		require_once '../../../Server/conexion/conexion.php';
		$Pregunta = new OpenConexion();
		$data=array(
			"valor"=>strip_tags($_POST['pregunta'])
		);

		$valor=	$Pregunta->Conn->prepare("select * from pregunta where nom_pregunta=upper(:valor) and status > 0");
		$valor->execute($data);
 
		if($valor->rowCount() > 0){
			echo "1";
		}else{
			$check=$Pregunta->Conn->prepare("select pregunta(:valor)");
			$check->execute($data);
		}
	}
?> 