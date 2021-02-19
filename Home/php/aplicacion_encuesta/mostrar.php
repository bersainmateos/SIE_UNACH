	<table class="table table-hover table-bordered">
		<tbody class="table-success">
			<th>NOMBRE</th>
			
			<th>IR</th>
		</tbody> 
	<?php
	session_start();
	require_once '../conexion/conexion.php';
	$Encuesta= new CI_Controller();
$num=$Encuesta->query("select DISTINCT(idencuesta) from det_respuesta_encuesta where matricula='".$_SESSION['egresado']['matricula']."'");

	$num=pg_num_rows($num);
	if ($num > 0) {

		$encuesta=$Encuesta->query("select * from encuesta where (fecha_expiracion-CURRENT_DATE) >= 0 and status=1 and idencuesta!= all(select DISTINCT(idencuesta) from det_respuesta_encuesta where matricula='".$_SESSION['egresado']['matricula']."') order by idencuesta");
		$num=pg_num_rows($encuesta);
		if ($num > 0 ) {
			while ($datos=pg_fetch_array($encuesta)) {
		echo "<tr><td>".$datos['nom_encuesta']."</td> <td><a class='btn btn-block btn-success' href='".$_POST['urlx']."Aplicacion-".$datos['idencuesta']."' >Contestar</a></td></tr>";
	}
		} else {
			echo '<td>No hay encuestas disponibles.</td>';

		}
			
	} else {
		$encuesta=$Encuesta->query('select * from encuesta where (fecha_expiracion-CURRENT_DATE) >= 0 and status=1 order by idencuesta');

	while ($datos=pg_fetch_array($encuesta)) {
		echo "<tr><td>".$datos['nom_encuesta']."</td><td><a class='btn btn-block btn-success' href='".$_POST['urlx']."Aplicacion-".$datos['idencuesta']."' target='_black'>Contestar</a></td></tr>";
	}
	}
	


	 ?>	
</table>