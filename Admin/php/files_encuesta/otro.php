<?php
require_once '../../../Server/conexion/conexion.php';
$contador=0;
$Encuesta = new OpenConexion();
  $data=array("status"=>strip_tags($_POST['status']),"id"=>strip_tags($_POST['id_encuesta'])); 
$q=$Encuesta->Conn->prepare("update encuesta set status=:status where idencuesta=:id");

	$q->execute($data);

			?>