<br>
<div class="mostrar_encuestas">
	<table class=" table table-hover table-bordered">
		<tbody class="table-success">
			<th>NOMBRE</th>
			<th>IR</th>
		</tbody>
	<?php
	
	$Encuesta= new OpenConexion();

	$num=$Encuesta->Conn->query("select DISTINCT(idencuesta) from valida_encuesta_realizar where curp='{$_COOKIE['persona']}'");

	//$num=pg_num_rows($num);
	if (0) {

		$encuesta=$Encuesta->Conn->query("select * from encuesta as e where (fecha_expiracion-CURRENT_DATE) >= 0 and status=1 and idencuesta!= all(select DISTINCT(idencuesta) from valida_encuesta_realizar where matricula='".$_SESSION['egresado']['matricula']."') and e.enlace=idencuesta order by idencuesta");
		//$num=pg_num_rows($encuesta);
		if (1) {
			while ($datos=$encuesta->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>".$datos['nom_encuesta']."</td><td><a class='btn btn-block btn-success' href='".URL_EGRESADO."Aplicacion-".$datos['idencuesta']."'>Contestar</a></td></tr>";
	}
		} else {
			echo '<td>No hay encuestas disponibles.</td>';

		}
	} else {
		$encuesta=$Encuesta->Conn->query('select * from encuesta as e where (fecha_expiracion-CURRENT_DATE) >= 0 and status=1 and e.enlace=idencuesta order by idencuesta');

	while ($datos=$encuesta->fetch(PDO::FETCH_ASSOC)) {
		echo "<tr><td>".$datos['nom_encuesta']."</td><td><a class='btn btn-block btn-success' href='".URL_EGRESADO."Aplicacion-".$datos['idencuesta']."'>Contestar</a></td></tr>";
	}
	}

	 ?>	
</table>
</div>