<?php
require_once '../../../Server/conexion/conexion.php';
?>

<?php
$Encuesta=new OpenConexion();

$contenido=$Encuesta->Conn->prepare("select idpregunta from pregunta_encuesta where idencuesta={$_POST['id_encuesta']}");

$contador=0;
$numero=0;
$contenido->execute();
$variable=$contenido->fetchAll(PDO::FETCH_ASSOC);
foreach ($variable as $info) { 

	$pregunta=$Encuesta->Conn->prepare("select * from pregunta where idpregunta={$info['idpregunta']}");
	$pregunta->execute();
	$nom_pregunta=$pregunta->fetch(PDO::FETCH_ASSOC);
 
$op1=$Encuesta->Conn->prepare("select * from View_creacion_cuestionario where idpregunta={$info['idpregunta']} and idencuesta={$_POST['id_encuesta']} order by cns_det_encuesta");
$contador++;

echo '<div class="form-group">';
 echo ++$numero.') <label class="col-xs-12 control-label"> '.$nom_pregunta['nom_pregunta'].'
                        </label><br>';

?>

<?php
	$op1->execute();
	$mostrar1=$op1->fetchAll(PDO::FETCH_ASSOC);

foreach ($mostrar1 as $mostrar1) {
//	while($mostrar1=pg_fetch_array($op1)){
		if ($mostrar1['idtipo']==1) {
			echo '<div style="margin-left:20px;" class="checkbox "><label><input  type="radio" name="valor'.$contador.'" > '.$mostrar1['nom_respuesta'].'</label></div>';
		} else if($mostrar1['idtipo']==2){
			echo '<div class="checkbox" style="margin-left:20px;"><label><input type="checkbox"> '.$mostrar1['nom_respuesta']."</label></div>";
		}else if($mostrar1['idtipo']==3){
			echo '<input type="text" class="form-control">';
		}else if($mostrar1['idtipo']==4){
			echo '<input type="date" class="form-control">';
		}else if($mostrar1['idtipo']==5){
			echo '<input type="number" class="form-control">';
		}
	}
?>
</div>

<?php
	}
?>