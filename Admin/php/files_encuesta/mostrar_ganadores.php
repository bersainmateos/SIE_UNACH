<?php 
require_once '../../../Server/conexion/conexion.php';

$Ganador= new CI_Controller();

	$datos=$Ganador->query("select * from alumno al inner join ganador gn on (al.matricula=gn.matricula) inner join det_bono db on (gn.cns_det_bono= db.cns_det_bono) inner join encuesta en on (db.idencuesta=en.idencuesta) inner join bono bn on (db.idbono=bn.idbono) where db.idencuesta=".$_POST['id_encuesta']);

	$premio=$Ganador->query("select * from bono b inner join det_bono db on (b.idbono=db.idbono) where db.idencuesta=".$_POST['id_encuesta']);

	$num=pg_num_rows($datos);
	$mostrar=pg_fetch_array($premio);
	
	echo "
	<table>
	<tr>
	<td><h4 class='text-success'>PREMIO:<h4></td>
	<td> <h5 class='text-danger'>".$mostrar['nombre_articulo']."</h5></td>
	</tr>
	<tr>
	<td><h4 class='text-success'>Cantidad a Repartir:<h4></td>
	<td> <h5 class='text-danger'>".$mostrar['cantidad']."</h5></td>
	</tr>
	<tr>
	<td><h4 class='text-success'>En Stock:<h4></td>";
	
	if(($mostrar['cantidad']-$mostrar['contador']) < 0){
		echo "<td> <h5 class='text-danger'>0</h5></td>";
	}else{
		echo "<td> <h5 class='text-danger'>".($mostrar['cantidad']-$mostrar['contador'])."</h5></td>";
	}

	echo "</tr>
	</table>
	";

if ($num > 0) {
		echo "<table class ='table table-bordered'>
				<thead class='thead-dark'>
				<th>#</th>
				<th><center>GANADORES</center>
				</thead>
			</th>";
			$cont=0;
		while ($info=pg_fetch_array($datos)) {
			echo "<tr class='resaltar'>";
			echo "<td>".++$cont."</td>";
			echo "<td class='text-danger'><h6><center>".$info['nom_alumno']." ".$info['ape_pat_alumno']." ".$info['ape_mat_alumno']."</center></h6></td>";
			echo "</tr>";
		}
		echo "</table>";
} else {
	echo "<h4 class='text-danger'>No hay Ganadores.</h4>";
}
 ?>