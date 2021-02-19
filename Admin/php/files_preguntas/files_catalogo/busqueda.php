<?php 
	require_once '../../../../Server/conexion/conexion.php';
	$Catalogo = new OpenConexion();
				
	if ($_POST['tipo']=='1') { 
		$data=array("nom"=>strip_tags("%".$_POST['busqueda']."%"));

		$variable=$Catalogo->Conn->prepare("select nom_pregunta,idpregunta, (CURRENT_DATE-fecha) AS fecha from pregunta where status > 0 and nom_pregunta like upper(:nom) order by fecha asc");
		$variable->execute($data);
				} else if($_POST['tipo']=='2'){
		$data=array("id_catalogo"=>strip_tags($_POST['catalogo']), "nom"=>strip_tags("%".$_POST['busqueda']."%"));
		$variable=$Catalogo->Conn->prepare("select nom_pregunta,idpregunta, (CURRENT_DATE-fecha) AS fecha from pregunta where idpregunta !=all(select idpregunta from det_cat_pregunta where idcatalogo_p=:id_catalogo) and  status > 0 and nom_pregunta like upper(:nom) order by fecha asc");
		$variable->execute($data);
				}

					?>
					<?php
					if ($variable->rowCount() > 0) {
						$con=0;
					$Data=$variable->fetchAll(PDO::FETCH_ASSOC);
				foreach ($Data as $datos){

						$pertenece=$Catalogo->Conn->prepare("select * from cat_pregunta where idcatalogo_p=any(select idcatalogo_p from det_cat_pregunta where idpregunta={$datos['idpregunta']} and status > 0 and idcatalogo_p > 1)");
						$pertenece->execute();
							echo "<tr class='resaltar'><td >".$datos['nom_pregunta']."</td>";
							//$num=pg_num_rows($pertenece);
						echo "<td>";
						$nombre=$pertenece->fetchAll(PDO::FETCH_ASSOC);
						if ($pertenece->rowCount() > 0) {
							foreach ($nombre as $value) {
								echo "<b style='color:black; font-size:12px;'>".++$con."._".$value['nom_cat_pregunta']."&nbsp </b>";
						}}
						if ($datos['fecha'] > 1) {
							echo "<td class='c' >Agregada hace ".$datos['fecha']." Dias.</td>";
						}else if ($datos['fecha']==0) {
							echo "<td class='c'>Agregada Hoy.</td>";
						}else{
							echo "<td class='c' >Agregada Ayer.</td>";
						}

						echo "</td><td><input class='check p' data-id_valor='".$datos['idpregunta']."' data-id_nom='".$datos['nom_pregunta']."' type='checkbox' ></td></tr>";
						$con=0;
					}
					} else {
						echo '<br><br><br>
						<b class="text-danger" >La busqueda no arrojo ningún resultado</b>';
					}
					
				?>