<?php 

try {
	require '../../../Server/conexion/conexion.php';
	$Encuesta= new OpenConexion();

	$Preguntas=$Encuesta->Conn->prepare("select * from cat_pregunta where status=1 order by idcatalogo_p");
	$Preguntas->execute();
	$Datos=$Preguntas->fetchAll(PDO::FETCH_ASSOC);
	$Respuesta=array();

	foreach ($Datos as $value) {
		$d=array("id"=>strip_tags($value['idcatalogo_p']));
		$P=$Encuesta->Conn->prepare("select * from pregunta p inner join det_cat_pregunta dp on (p.idpregunta=dp.idpregunta) where dp.idcatalogo_p=:id and dp.status=1 order by dp.cns_det_pregunta desc");
		$P->execute($d);
		$D=$P->fetchAll(PDO::FETCH_ASSOC);
		
		$Respuesta=array(
			$value['nom_cat_pregunta']=>$D
		);
	}
	
	echo json_encode($Respuesta);
} catch (Exception $e) {
	echo "Ocurrio un error";
}
?>