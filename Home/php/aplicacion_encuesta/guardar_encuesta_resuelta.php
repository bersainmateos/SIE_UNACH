<?php
	try {
		
	if (isset($_POST['json'])) {
		session_start();
		require_once '../../../Server/conexion/conexion.php';

	$Diseno = new OpenConexion();
	$cont2 = json_decode($_POST['json']);

$data=array("id"=>strip_tags($_POST['id_encuesta']));

$verificar=$Diseno->Conn->prepare("select 'TRUE' as bool  from encuesta where idencuesta=:id and (fecha_expiracion >= CURRENT_DATE and status > 0 )");

$verificar->execute($data);


$verificar=$verificar->fetch(PDO::FETCH_ASSOC);

$data=array("curp"=>strip_tags($_COOKIE['persona']),"id"=>strip_tags($_POST['id_encuesta']));

$puede=$Diseno->Conn->prepare(" select curp from valida_encuesta_realizar where curp=:curp and idencuesta=:id limit 1");
$puede->execute($data);

//$num=pg_num_rows($puede);

if ($verificar['bool'] and $puede->rowCount()==0) {

$Diseno->Conn->beginTransaction();

$data=array("rfc"=>strip_tags($_SESSION["egresado"]['rfc']),"id"=>strip_tags($_POST['id_encuesta']),"persona"=>strip_tags($_COOKIE['persona']));

$idvalidar=$Diseno->Conn->prepare("insert into valida_encuesta_realizar values (default,:rfc,:id,:persona) RETURNING idvalidar");

$idvalidar->execute($data);

$idvalidar=$idvalidar->fetch(PDO::FETCH_ASSOC);


	foreach ($cont2->{"datos"} as $contenido) {
		
		$idrespuesta = ($contenido->{'idrespuesta'}=="null") ? NULL : strip_tags((Integer)$contenido->{'idrespuesta'});

		$data=array("uno"=>strip_tags((Integer)$contenido->{'pregunta'}),"dos"=>strip_tags($contenido->{'respuesta'}),"tres"=>$idrespuesta);
		
		$v=$Diseno->Conn->prepare("insert into det_respuesta_encuesta values (default,:uno,:dos,:tres,{$idvalidar['idvalidar']})");
		$v->execute($data);
	}

$Diseno->Conn->commit();
$Diseno->Close();

	echo 1;


} else {
	echo 2;
}
	} else {
		echo 0;
	}
	
	} catch (Exception $e) {
		echo json_encode($cont2);
		echo $e->getMessage()."En la linea ".$e->getLine();		
	}

?>