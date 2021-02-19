 <?php 
	try {
	require_once '../../../Server/conexion/conexion.php';
	$Delete= new OpenConexion();
	$data=array("id"=>strip_tags($_POST['id_']));
	$check=$Delete->Conn->prepare("update respuesta set status=0 where idrespuesta=:id");	
	$check->execute($data);
	echo "1";
	} catch (Exception $e) {
		echo "Error". $e->getMessage();	
	}
 ?> 