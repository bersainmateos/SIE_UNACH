<?php 
    $datos=array();
    $datos=explode("-",$_POST['matricula']);
	require_once '../../../Server/conexion/conexion.php';

$Encuesta=new CI_Controller();

$contenido=$Encuesta->query("select nom_p,ape_pat_p, ape_mat_p from persona where curp in (select DISTINCT curp from valida_encuesta_realizar where idencuesta='".$datos[1]."' and rfc ='".$datos[0]."')");
$contador=0;
?>

<table class="table table-bordered">
	<tr class="unach" style="color:white;">
		<td>#</td>
		<td>NOMBRE</td>
		<td>APELLIDO PATERNO</td>
		<td>APELLIDO MATERNO</td>
	</tr>
	<tbody>
		<?php while ($nombre=pg_fetch_array($contenido)) { ?>
		<tr>
			<td><?php echo ++$contador; ?></td>
			<td><?php echo $nombre['nom_p']; ?></td>
			<td><?php echo $nombre['ape_pat_p']; ?></td>
			<td><?php echo $nombre['ape_mat_p']; ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>