<?php


	try {
		require_once '../../../Server/conexion/conexion.php';

	$Diseno=new OpenConexion(); 

	$nombre=$_POST['nom'];
	$descripcion=$_POST['desc'];
	$tiempo=$_POST['tiempo'];


	$Diseno->Conn->beginTransaction();
	$data=array(
		"nom"=>strip_tags($nombre),
		"desc"=>strip_tags($descripcion),
		"tiempo"=>strip_tags($tiempo)
	);

	$ejecucion=$Diseno->Conn->prepare("select crear_encuesta(:nom,:desc,:tiempo)");
	
	if ($ejecucion->execute($data)) {

		$valor=$ejecucion->fetch(PDO::FETCH_ASSOC);

			if ($valor['crear_encuesta']==0) {
				echo '0';
			} else {

				$cont2=json_decode($_POST['json']);
				$idpregunta=json_decode($_POST['pregunta']);

				foreach ($idpregunta->{"datox"} as $pregunta) {
					$variable=$pregunta->{'pregunta'};
					$variable2=$pregunta->{'status'};

					$datos=array(
						"var"=>strip_tags($variable),
						"var2"=>strip_tags($variable2)
					);
		 			
		 			$e=$Diseno->Conn->prepare("insert into pregunta_encuesta values ({$valor['crear_encuesta']},:var,:var2)");
	
		 			$e->execute($datos);
	
				}

				foreach ($cont2->{"datos"} as $contenido) {
					$variable=$contenido->{'pregunta'};
		 			$variable2=$contenido->{'respuesta'};
					
					$datos=array(
						"var"=>strip_tags($variable),
						"var2"=>strip_tags($variable2)
					);
		 		
		 		$v = $Diseno->Conn->prepare("insert into det_encuesta values (default,{$valor['crear_encuesta']},:var,:var2)");
		 		
		 		$v->execute($datos);
				
				}

					echo '1';


			}
			$Diseno->Conn->commit();
			$Diseno->Close();

	} 
} catch (Exception $e) {
	echo "2".$e->getMessage();
}
	
?>