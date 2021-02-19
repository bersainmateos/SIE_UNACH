<?php 
	require_once '../../../Server/conexion/conexion.php';
	$Data= new CI_Controller();
 ?>

 	<div class="form-group">
 		<h5 class="text-success">Elige el bono de la lista</h5>
 		<select class="js-example-basic-multiple form-control bono">
 			<option value="0">Selecciona el bono</option>
 			<?php
 			$datos=$Data->query("select * from bono");
 			$nom=$Data->query("select * from encuesta where idencuesta=".$_POST['id_encuesta']);
 			$nom=pg_fetch_array($nom);
 			while ($info=pg_fetch_array($datos)) {
 				echo "<option value='".$info['idbono']."'>".$info['nombre_articulo']."</option>";
 			}
 			 ?>
 		</select>
 		<h5 class="text-success">Número de árticulos a repartir</h5>
 		<input type="number" class="form-control numero"><br>
 		<input type="text" class="form-control encuesta" data-id_encuesta="<?php echo $_POST['id_encuesta'];?>" readonly value="<?php echo $nom['nom_encuesta'];?>"><br>
 		<button class="btn btn-success btn-block g_bono">Listo</button>
 	</div>
