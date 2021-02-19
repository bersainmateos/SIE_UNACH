<?php 
require_once '../../../Server/conexion/conexion.php';

	$Ganador= new CI_Controller();

$info=$Ganador->query("select * from alumno al inner join ganador gn on (al.matricula=gn.matricula) inner join det_bono db on (gn.cns_det_bono= db.cns_det_bono) inner join encuesta en on (db.idencuesta=en.idencuesta) inner join bono bn on (db.idbono=bn.idbono) where gn.codigo='".pg_escape_string($_POST['codigo'])."'");

	$num=pg_num_rows($info);
	
	$info=pg_fetch_array($info);
	

	if ($num > 0) {
echo '<h4 class="text-primary">NOMBRE: </h4> <b class="text-success">'.$info['nom_alumno']." ".$info['ape_pat_alumno']." ".$info['ape_mat_alumno'].'</b>
  <h4 class="text-primary">ENCUESTA RESUELTA: </h4> <b class="text-success">'.$info['nom_encuesta'].'</b>
   <h4 class="text-primary">PREMIO: </h4> <b class="text-success">'.$info['nombre_articulo'].'</b>';

	} else {
	echo '<h4 class="text-danger">Error, verifica el código</h4>';
	}
 ?>