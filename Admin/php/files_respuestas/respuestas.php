<?php
	if(!empty($_POST['respuesta'])){
		try {
				require_once '../../../Server/conexion/conexion.php';
		
	$Respuesta = new OpenConexion();
	
	$data=array("respuesta"=>strip_tags($_POST['respuesta']));

	$valor=$Respuesta->Conn->prepare("select * from respuesta where nom_respuesta=upper(:respuesta) and status > 0");
	$valor->execute($data);
	if($valor->rowCount() > 0){
		echo "0";
	}else{
		$check=$Respuesta->Conn->prepare("insert into respuesta values (default,upper(:respuesta))");
		$check->execute($data);		
		echo "1";
	}

		} catch (Exception $e) {
			echo "Error";		
		}
	}
?>