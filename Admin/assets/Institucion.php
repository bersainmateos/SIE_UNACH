<?php 	
	$Institucion=	new CI_Controller();
	$municipio=$Institucion->query("select * from municipio");

?>

<br><br><br><br><br>

<div class="container">
<button class="btn btn-success" id="finalizar" >Guardar</button>

<select class="form-group" id="institucion">
	<option>Seleccione</option>
	<?php while ($nombre=pg_fetch_array($municipio)){ ?>

		<option value="<?php echo $nombre['id_municipio']; ?>"> <?php echo $nombre['nom_municipio']; ?></option>
	<?php } ?>
</select>
<input type="text" id="bus">
	<table class="table table-bordered">
	<tr  class="bg-primary">
		<td>localidad</td>
		<td>Elige</td>
	</tr>

	<tbody id="contenido">
		
	</tbody>
</table>

</div>
