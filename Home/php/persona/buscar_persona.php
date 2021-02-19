<?php 
require_once '../../../Server/conexion/conexion.php';
	$Buscar = new OpenConexion();
	$data=array("curp"=>strip_tags($_POST['curp']));
	$persona=$Buscar->Conn->prepare("select * from persona where curp=upper(:curp)");
	$persona->execute($data);
	

		if($persona->rowCount() > 0){
			echo 1;
			$sesion=$persona->fetch(PDO::FETCH_ASSOC);
			setcookie('persona', $sesion['curp'],time()+36000,"/");
			
		}else{
			echo 0;
		}
		$Buscar->Close();
	
 ?>