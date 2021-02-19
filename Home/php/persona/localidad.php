<?php 
require_once '../../../Server/conexion/conexion.php';
	
	$l = new OpenConexion();
	$id=(Integer)$_POST['id'];
	$info=$l->Conn->query("select * from localidad where id_municipio=$id order by nombre");

	echo "<option value='0'>Seleccione</option>";
	while ($d=$info->fetch(PDO::FETCH_ASSOC)) {
		echo "<option value='".$d['id_localidad']."'>".$d['nombre']."</option>";
	}
?>