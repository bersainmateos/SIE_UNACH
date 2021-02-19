<?php
   require_once '../../../Server/conexion/conexion.php';
?>
 
<?php
$Encuesta=new CI_Controller();


$contenido=$Encuesta->query("select idpregunta from pregunta_encuesta where idencuesta=".$_POST['idencuesta']);

$contador=0;
$numero=0;
while($info=pg_fetch_array($contenido)){ 

	$pregunta=$Encuesta->query("select * from pregunta where idpregunta=".$info['idpregunta']);
	$nom_pregunta=pg_fetch_array($pregunta);

$op1=$Encuesta->query("select r.nom_respuesta,t.idtipo from det_cat_respuesta dc inner join respuesta r on (dc.idrespuesta=r.idrespuesta) inner join det_encuesta de on (de.cns_det_respuesta=dc.cns_det_respuesta) inner join cat_respuesta c on (dc.idcatalogo_r=c.idcatalogo_r) inner join tipo t on (c.idtipo=t.idtipo) where de.idpregunta=".$info['idpregunta']." and de.idencuesta=".$_POST['idencuesta']." order by de.cns_det_encuesta");
$contador++;
echo '<div class="form-group">';
 echo ++$numero.') <label class="col-xs-12 control-label"> '.$nom_pregunta['nom_pregunta'].'
                        </label><br>';


?>
<!--  --> 

<?php
	
	while($mostrar1=pg_fetch_array($op1)){
		$num=$Encuesta->query("select count(respuesta) as valor from det_respuesta_encuesta where respuesta='".$mostrar1['nom_respuesta']."' and idencuesta=".$_POST['idencuesta']." and idpregunta=".$info['idpregunta']);

		$valor=pg_fetch_array($num);
		echo "<b class='text-primary'>".$mostrar1['nom_respuesta']."</b> <b class='text-danger'>".$valor['valor']."</b><br>";
		
	}
echo '<div id="canvas-holder" style="width:400px; height: 200px;">
    	<h3>Encuesta</h3>
        <canvas id="'.$numero.'" width="400px" height="200px" />
    </div>';

	$dt=array('SI'=>10,'No'=>15);
	$Encuesta->grafica($numero,$dt);
	
?>
</div>


<?php
}




?>


