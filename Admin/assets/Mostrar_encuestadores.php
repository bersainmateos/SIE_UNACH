<div class="col-lg-12 col-md-12 container" ><br>
	<table id="encuestadores" class='table table-bordered table-hover'>
	<thead class="unach-table">
			<tr style="color:white;" >
			<th><center>RFC</center></th>
			<th><center>NOMBRE</center></th>
			<th><center>APELLIDO PATERNO</center></th>
			<th><center>APELLIDO MATERNO</center></th>
			<th><center>SEXO</center></th>
			<th><center>TELEFONO</center></th>
			<th><center>CORREO</center></th>
			</tr>
	</thead>

<tbody>
<?php 
	$encuestador = new OpenConexion();
	$ver_encuestador=$encuestador->Conn->prepare("select * from encuestador");
	//$num=pg_num_rows($ver_encuestador);
	$ver_encuestador->execute();
	$ver_=$ver_encuestador->fetchAll(PDO::FETCH_ASSOC);
	if($ver_encuestador->rowCount() > 0){
	foreach ($ver_ as $ver){
		echo "<tr>
 				<td>{$ver['rfc']}</td>
 				<td>{$ver['nom_encuestador']}</td>
 				<td>{$ver['ape_pat_encuestador']}</td>
 				<td>{$ver['ape_mat_encuestador']}</td>
 				<td>{$ver['sexo']}</td>
 				<td>{$ver['telefono_encuestador']}</td>
 				<td>{$ver['correo']}</td>
 			</tr>";
 		}
	}
 ?>
</tbody>
 </table>
</div>