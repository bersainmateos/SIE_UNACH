<?php
  require_once '../../../Server/conexion/conexion.php';
  
  $Pregunta= new OpenConexion();

  $query=$Pregunta->Conn->prepare('select * from pregunta where status > 0 order by idpregunta desc');
  $cns=1; 
  $query->execute();
  	if($query->rowCount() > 0):
  		$data=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $dato): ?>
		<tr class="resaltar">
			<td><?php echo $cns++; ?></td>
			<td><?php echo $dato['nom_pregunta']; ?></td>
			<td><input id="Editar" value="Actualizar" type="button" data-id_pregunta="<?php echo $dato['idpregunta']; ?>" class ="btn btn-success btn-block Editar" data-toggle="modal" data-target=".bd-example-modal-lg"></td>
			<td><input id="Borrar" value="Borrar" type="button" data-id_pregunta="<?php echo $dato['idpregunta']; ?>" class ="btn btn-danger btn-block Editar" ></td>
		</tr>
<?php endforeach; endif; $Pregunta->Close(); ?>	