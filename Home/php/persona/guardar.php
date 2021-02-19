<?php 
try {
	require_once '../../../Server/conexion/conexion.php';
	$Guardar = new OpenConexion();
	$curp=$_POST['curp'];
	$data=array("curp"=>strip_tags($curp),"nombre"=>strip_tags($_POST['nombre']),"apt_p"=>strip_tags($_POST['ape_pat']),"ap_m"=>strip_tags($_POST['ape_mat']),"js"=>strip_tags($_POST['jsanit']),"localidad"=>strip_tags($_POST['localidad']));

	$persona=$Guardar->Conn->prepare("insert into persona values (upper(:curp),upper(:nombre),upper(:apt_p),upper(:ap_m),'none',:js,:localidad) returning curp");
	
	$persona->execute($data);

		$curpx=$persona->fetch(PDO::FETCH_ASSOC);
			setcookie('persona',$curpx['curp'], time()+36000,"/");
		echo "1";

} catch (Exception $e) {
	
}
 ?>