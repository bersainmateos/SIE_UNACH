<?php 
	require_once '../../../Server/conexion/conexion.php';
	$localidad= new CI_Controller();
	if (isset($_POST['nom'])) {
		$nombre=$localidad->query("select * from localidad where id_municipio=".$_POST['id']." and upper(nombre) like upper('%".$_POST['nom']."%') order by nombre");
	}else{
		$nombre=$localidad->query("select * from localidad where id_municipio=".$_POST['id']." order by nombre");
	}
$controlador=0;


?>
<?php while ($datos=pg_fetch_array($nombre)) {?>
<tr>
	<td><?php echo $datos['nombre'] ?></td>
	<td>
		<?php if($datos['idtipo_institucion'] > 0){ 
			$ins=$localidad->query("select abreviacion from tipo_institucion where idtipo_institucion=".$datos['idtipo_institucion']);
			$insx=pg_fetch_array($ins);
			?>
<select class="form-control generar" localidad="<?php echo $datos['id_localidad'] ?>" style="cursor: pointer;">
				<option value="null"><?php echo $insx['abreviacion'] ?></option>
			</select>

		<?php }else{ ?>
			<select class="form-control generar" localidad="<?php echo $datos['id_localidad'] ?>" style="cursor: pointer;">
				<option value="null">Seleccione</option>
				<option value="1" >UMR</option>
				<option value="2" >CS</option>
				<option value="3" >ESI</option>
			</select>
		<?php } ?>
	</td>
</tr>

<?php } ?>


<br><br>
