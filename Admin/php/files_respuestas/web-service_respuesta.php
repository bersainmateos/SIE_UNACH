<?php
echo "Ebrsain";
  require_once '../../../Server/conexion/conexion.php';
  
  $Pregunta= new OpenConexion();

  $query=$Pregunta->Conn->prepare('select * from respuesta where status > 0 order by idrespuesta desc');
  $cns=1; 
  $query->execute();
  	if($query->rowCount() > 0):
  		$data=$query->fetchAll(PDO::FETCH_ASSOC);
		foreach ($data as $dato): ?>
		<tr class="resaltar">
			<td><?php echo $cns++; ?></td>
			<td><?php echo $dato['nom_respuesta']; ?></td>
			<td><input id="Editarrespuesta" value="Update" type="button" data-id_respuesta="<?php echo $dato['idrespuesta']; ?>" class ="btn btn-success btn-block Editar" data-toggle="modal" data-target=".bd-example-modal-lg"></td>
			<td><input id="Borrarrespuesta" value="Borrar" type="button" data-id_respuesta="<?php echo $dato['idrespuesta']; ?>" class ="btn btn-danger btn-block Editar" ></td>
		</tr>
<?php endforeach; endif; $Pregunta->Close(); ?>	