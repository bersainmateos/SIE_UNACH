<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-lg">
    Contenido del modal
    <div class="modal-content">
      <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >PERSONAS ENCUESTADAS<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h2>
      </div>
      <div class="modal-body">
        <p id="dt">**********************</p>
      </div>
      <div class="modal-footer" id="footer">
      	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<button id="<?php echo 'Conteo-'.$rutas[1];?>" class="btn btn-danger manejador" >Resultado General</button><br><br>
	<table id="encuestas" class='table table-bordered table-hover'>
	<thead class="unach-table">
		<tr style="color: white;">
		<th><center>#</center></th>
		<th><center>NOMBRE</center></th>
		<th><center>APELLIDO PATERNO</center></th>
		<th><center>APELLIDO MATERNO</center></th>
		<th><center>TELEFONO</center></th>
		<th><center>PERSONAS ENCUESTADAS</center></th>
		</tr>
	</thead>
	<tbody >
<?php 

$contador=0;

$Encuesta= new OpenConexion();
$data=array("id"=>strip_tags($rutas[1]));
$datos=$Encuesta->Conn->prepare("select distinct(rfc) from valida_encuesta_realizar where idencuesta=:id");

$datos->execute($data);
//$num=pg_num_rows($datos);

	if ($datos->rowCount() > 0 ) {
		$variable=$datos->fetchAll(PDO::FETCH_ASSOC);
	foreach ($variable as $info) {
	//while($info=pg_fetch_array($datos)){
	$encuestador=$Encuesta->Conn->prepare("select * from encuestador where rfc='{$info['rfc']}' limit 1");
$encuestador->execute();
	$Detalles=$encuestador->fetch(PDO::FETCH_ASSOC);

	echo "<tr>
			<td>".++$contador."</td>
			<td>".$Detalles['nom_encuestador']."</td>
			<td>".$Detalles['ape_pat_encuestador']."</td>
			<td>".$Detalles['ape_mat_encuestador']."</td>
			<td>".$Detalles['telefono_encuestador']."</td>
			<td><button data-toggle='modal' data-id_matricula='".$Detalles['rfc']."-".$rutas[1]."' data-target='.bd-example-modal-lg' class='resultados btn btn-block btn-info' >Mostrar</button></td>
		</tr>";
}
	} else {
		echo "<tr><td colspan='6'><center><h3 class='text-danger'>¡ Lo sentimos, no hay registros !</h3></center></td></tr>";
	}
 ?>
</tbody>
 </table> 
</div>