<?php 

require_once '../../../Server/conexion/conexion.php'; 
$Datos= new CI_Controller();

 $valor =json_decode($_POST['valor']);

	foreach ($valor->{"nombre"} as $institucion) {
		$c=$Datos->query("update localidad set idtipo_institucion=".$institucion->{'tipo'}." where id_localidad=".$institucion->{'localidad'});
		
		if($c){
			echo 1;
		}else{
			echo 0;
		}
	}

 ?>