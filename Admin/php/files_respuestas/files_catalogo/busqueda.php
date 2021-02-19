<?php

require_once '../../../../Server/conexion/conexion.php';
$Catalogo = new OpenConexion(); 
				
				
	if ($_POST['tipo']=='1') {
		$data=array("respuesta"=>strip_tags("%".$_POST['busqueda']."%"));

		$variable=$Catalogo->Conn->prepare("select nom_respuesta,idrespuesta, (CURRENT_DATE-fecha) AS fecha from respuesta where status > 0 and nom_respuesta like upper(:respuesta) order by fecha asc");

//	$variable->execute($data);

	} else if($_POST['tipo']=='2'){
		
		$data=array(
			"idcatalogo"=>strip_tags($_POST['catalogo']),
			"respuesta"=>strip_tags("%".$_POST['busqueda']."%")
			);

	$variable=$Catalogo->Conn->prepare("select nom_respuesta,idrespuesta, (CURRENT_DATE-fecha) AS fecha from respuesta where idrespuesta !=all(select idrespuesta from det_cat_respuesta where idcatalogo_r=:idcatalogo) and  status > 0 and nom_respuesta like upper(:respuesta) order by fecha asc");
	
	}
		$variable->execute($data);
	//		$num=pg_num_rows($variable);
		if ($variable->rowCount() > 0) {
			$con=0;
		$datos=$variable->fetchAll(PDO::FETCH_ASSOC);

		foreach ($datos as$datos) {
		//while($datos=pg_fetch_array($variable)){

	$pertenece=$Catalogo->Conn->prepare("select * from cat_respuesta where idcatalogo_r=any(select idcatalogo_r from det_cat_respuesta where idrespuesta={$datos['idrespuesta']} and status > 0 and idcatalogo_r > 1)");
	$pertenece->execute();

						
						echo "<tr class='resaltar'><td>".$datos['nom_respuesta']."</td>";
						//$num=pg_num_rows($pertenece);
						
						echo "<td>"; 
						if ($pertenece->rowCount() > 0) {
						$nombre=$pertenece->fetchAll(PDO::FETCH_ASSOC);
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

						echo "<td><input data-id_valor='".$datos['idrespuesta']."' data-id_nom='".$datos['nom_respuesta']."' class='check rs' data-id_valor='".$datos['idrespuesta']."' type='checkbox' ></td></tr>";
						$con=0;
					}
					$Catalogo->Close();
					} else {
						echo '<br><br><br>
						<b class="text-danger" >La busqueda no arrojo ningún resultado</b>';
					}
					
?>