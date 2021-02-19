<?php 
	$Catalogo=new OpenConexion();
	
	$data=array(
		"id_cat_p"=>strip_tags((Integer)$rutas[1])
	);

	$nom=$Catalogo->Conn->prepare("select * from cat_respuesta where idcatalogo_r=:id_cat_p");
	$nom->execute($data);
	$nom=$nom->fetch(PDO::FETCH_ASSOC);
  
 ?>


<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-lg"> 
    <!-- Contenido del modal -->
    <div class="modal-content">
      <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >Respuestas del catálogo<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h2>
      </div>
      <div class="modal-body">
        <p id="dt">Texto del modal</p>
      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-info Add_catalogo_r" >Confirmar</button>
      </div>
    </div>
  </div>
</div>
 
		<div class="col-md-12 well">  
			<h2 class="text-center">
				<font size=5 color="#741086">Agregar al cátalogo "<?php echo  $nom['nom_cat_respuesta'];?>"</font>

			</h2>
				<div class="form-group" id="catalogo" data-id_catalogo="<?php echo $rutas[1];?>" >
		  			<div class="form-group">
		    			<input type="search" placeholder="Busqueda..." class="form-control" autocomplete="off" tipo="2" id="Busqueda2">
		  			</div>
		  		</div>
		<center>
				<div style="width:100%; height:62%; overflow-y: scroll;">
				<?php

$variable=$Catalogo->Conn->prepare("select nom_respuesta,idrespuesta, (CURRENT_DATE-fecha) AS fecha from respuesta where idrespuesta !=all(select idrespuesta from det_cat_respuesta where idcatalogo_r={$rutas[1]}) and  status > 0 and idrespuesta > 1 order by fecha asc");
		$variable->execute();		
					echo "<table class='table table-bordered'>";
					?>
					
					<thead class="table-dark">
					<th><center>PREGUNTA</center></th>
					<th><center>PERTENECE</center></th>
					<th colspan="2"></th>
					</thead>
					<tbody class="resultado" >
					<?php
					$con=0;
			$variablex=$variable->fetchAll(PDO::FETCH_ASSOC);
			foreach ($variablex as $datos) {
					//while($datos=pg_fetch_array($variable)){

	$pertenece=$Catalogo->Conn->prepare("select * from cat_respuesta where idcatalogo_r=any(select idcatalogo_r from det_cat_respuesta where idrespuesta={$datos['idrespuesta']} and status > 0 and idcatalogo_r > 1)");

						$nombre=$pertenece->fetchAll(PDO::FETCH_ASSOC);
						echo "<tr class='resaltar'><td>".$datos['nom_respuesta']."</td>";
						//$num=pg_num_rows($pertenece);
						
						echo "<td>"; 
						if ($pertenece->rowCount() > 0) {
							foreach ($nombre as $value) {
								echo "<b style='color:black; font-size:12px;'>".++$con."._".$value['nom_cat_respuesta']."&nbsp </b>";
						}}
						if ($datos['fecha'] > 1) {
							echo "<td class='c' >Agregada hace ".$datos['fecha']." Dias.</td>";
						}else if ($datos['fecha']==0) {
							echo "<td class='c'>Agregada Hoy.</td>";
						}else{
							echo "<td class='c' >Agregada Ayer.</td>";
						}

						echo "</td><td><input class='check rs' data-id_valor='".$datos['idrespuesta']."' data-id_nom='".$datos['nom_respuesta']."'  type='checkbox' ></td></tr>";
						$con=0;
					}
				?>
					</tbody></table>
			</div>
		</center>
		  	
	</div>
	<div class="fixed-bottom" >
		<button style="margin-left: 87%; position: absolute;" class="r btn btn-success">Agregar al cátalogo</button>
		<button type="submit" class="btn btn-danger" style="width: 50%; margin-left: 25%;"  id="pcatalogo_r" data-toggle='modal' data-target='.bd-example-modal-lg' >Guardar</button>
	</div>

