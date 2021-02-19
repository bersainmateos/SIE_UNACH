<?php 
  require_once '../../../../Server/conexion/conexion.php';

  $Update= new OpenConexion(); 
  $datos=array("nom_cat"=>strip_tags($_POST['catalogo']),"id"=>strip_tags($_POST['id_catalogo']));
$check=$Update->Conn->prepare("update cat_respuesta set nom_cat_respuesta=upper(:nom_cat) where idcatalogo_r=:id");

$check->execute($datos);
 

 ?>