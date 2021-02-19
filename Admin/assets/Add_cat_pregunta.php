<?php 

	$Catalogo=new OpenConexion();
	
	$data=array(
		"id_cat_p"=>strip_tags((Integer)$rutas[1])
	);

	$nom=$Catalogo->Conn->prepare("select * from cat_pregunta where idcatalogo_p=:id_cat_p");
	$nom->execute($data);
	$nom=$nom->fetch(PDO::FETCH_ASSOC);
//$nom=pg_fetch_array($nom);
?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-sm modal-lg">
    <!-- Contenido del modal -->
    <div class="modal-content">
      <div class="modal-header unach">
        <h2 style="color: white;" class="text-center" >Preguntas del catálogo<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> </h2>
      </div>
      <div class="modal-body">
        <p id="dt">Texto del modal</p>
      </div>
      <div class="modal-footer" id="footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-info Add_catalogo_p" >Confirmar</button>
      </div>
    </div>
  </div>
</div>

		<div class="col-md-12 well">  
			<h2 class="text-center">
				<font size=5 color="#741086">Agregar al cátalogo "<?php echo  $nom['nom_cat_pregunta'];?>"</font>
			</h2>
				<div class="form-group" id="catalogo" data-id_catalogo="<?php echo strip_tags($rutas[1]);?>" >
		  			<div class="form-group">
		    			<input type="search" placeholder="Busqueda..." class="form-control" autocomplete="off" tipo="2" id="Busqueda">
		  			</div>
		  		</div>
		<center>
				<div style="width:100%; height:62%; overflow-y: scroll;">
				<?php
	$data=array("id"=>strip_tags((Integer)$rutas[1]));

$variable=$Catalogo->Conn->prepare("select nom_pregunta,idpregunta, (CURRENT_DATE-fecha) AS fecha from pregunta where idpregunta !=all(select idpregunta from det_cat_pregunta where idcatalogo_p=:id) and  status > 0 order by fecha asc");
$variable->execute($data);
//$num=pg_num_rows($variable);

if($variable->rowcount() > 0):

$variable=$variable->fetchAll(PDO::FETCH_ASSOC);
					?>
	<table class='table table-bordered'>
		<thead class="table-dark">
			<th><center>PREGUNTA</center></th>
			<th><center>PERTENECE</center></th>
			<th colspan="2"></th>
		</thead>
		<tbody class="resultado" >
		<?php
		$con=0;
		foreach ($variable as $datos) {
		$pertenece=$Catalogo->Conn->prepare("select * from cat_pregunta where idcatalogo_p=any(select idcatalogo_p from det_cat_pregunta where idpregunta={$datos['idpregunta']} and status > 0 and idcatalogo_p > 1)");

		$pertenece->execute();
		
		
		echo "<tr class='resaltar'>
		<td>{$datos['nom_pregunta']}</td>";
		//$num=pg_num_rows($pertenece);
		echo "<td>"; 
		if ($pertenece->rowCount() > 0) {
		$nombre=$pertenece->fetchAll(PDO::FETCH_ASSOC);				
		foreach ($nombre as $value) {
			echo "<b style='color:black; font-size:12px;'>".++$con." {$value['nom_cat_pregunta']} </b>";
		}
	}
						if ($datos['fecha'] > 1) {
							echo "<td class='c' >Agregada hace ".$datos['fecha']." Dias.</td>";
						}else if ($datos['fecha']==0) {
							echo "<td class='c'>Agregada Hoy.</td>";
						}else{
							echo "<td class='c' >Agregada Ayer.</td>";
						}

						echo "</td><td><input class='check p' data-id_valor='".$datos['idpregunta']."' data-id_nom='".$datos['nom_pregunta']."'  type='checkbox' ></td></tr>";
						$con=0;
					}
				endif;
				?>
				</tbody></table>
			</div>
		</center>
		  	
	</div>
	<div class="fixed-bottom" >
		<button style="margin-left: 87%; position: absolute;" class="q btn btn-success">Agregar al cátalogo</button>
		<button type="submit" class="btn btn-danger" style="width: 50%; margin-left: 25%;"  id="pcatalogo_" data-toggle='modal' data-target='.bd-example-modal-lg' >Guardar</button>
	</div>