   <?php 
	require_once '../../../Server/conexion/conexion.php';
	$Data= new CI_Controller();
	$query=$Data->query("insert into det_bono values (default,".$_POST['bono'].",".$_POST['id_encuesta'].",".$_POST['numero'].",0)");

	if ($query) {
		echo '1';
	}
 ?>