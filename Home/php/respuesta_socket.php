<?php

require_once '../../Server/conexion/conexion.php';

$Encuesta=new CI_Controller();
	
	$porcentage=$Encuesta->query("select count(curp) porcentage from (select DISTINCT (curp) from valida_encuesta_realizar where idencuesta='".$_POST['encuesta']."') as encuesta");/*La función de esta consulta es sacar el número de personas que han sido encuestadas*/

		$porcentagex=pg_fetch_array($porcentage);

echo "<h1 class='text-center text-success'>
			ENCUESTA REALIZADA A ".$porcentagex['porcentage']." PERSONAS.
	  </h1><br>";

$contenido=$Encuesta->query("select idpregunta from pregunta_encuesta where idencuesta='".$_POST['encuesta']."'");/*Aqui saco todas las preguntas de mi encuesta de manera ordenada*/

$contador=0;
$numerox=0;

while($info=pg_fetch_array($contenido)){ 

	$pregunta=$Encuesta->query("select * from pregunta where idpregunta='".$info['idpregunta']."'");

	$nom_pregunta=pg_fetch_array($pregunta);

$op1=$Encuesta->query("select r.nom_respuesta,t.idtipo from det_cat_respuesta dc inner join respuesta r on (dc.idrespuesta=r.idrespuesta) inner join det_encuesta de on (de.cns_det_respuesta=dc.cns_det_respuesta) inner join cat_respuesta c on (dc.idcatalogo_r=c.idcatalogo_r) inner join tipo t on (c.idtipo=t.idtipo) where de.idpregunta='".$info['idpregunta']."' and de.idencuesta='".$_POST['encuesta']."' and t.idtipo !=3 order by de.cns_det_encuesta");

/*Aqui le doy forma a las respuesta ya que cada una pertenece a 'OPCIONES' diferentes.

Opciones:

1.-	Libre
2.-	Única
3.-	Número
4.-	Fecha
5.-	Multiple
*/

echo '<div class="form-group">';

echo '<h3 class="text-center">'.++$numerox.") ".htmlspecialchars($nom_pregunta['nom_pregunta']).'
	</h3>';

$acumulado=0;
$i=0;
$dt=array();

	while($mostrar1=pg_fetch_array($op1)){
$num=$Encuesta->query("select count (respuesta) as valor from det_respuesta_encuesta where respuesta='".htmlspecialchars($mostrar1['nom_respuesta'])."' and idpregunta='".$info['idpregunta']."' and idvalidar in (select idvalidar from valida_encuesta_realizar where idencuesta ='".$_POST['encuesta']."')");

		$valor=pg_fetch_array($num);
		$acumulado=$acumulado+$valor['valor'];
		
		if ($porcentagex['porcentage'] > 0) {
			$numero=(($valor['valor']*100)/$porcentagex['porcentage']);
			$dt[$i++]=[$mostrar1['nom_respuesta']." (".$valor['valor'].")"=>$numero];
		}
	}

	if ($acumulado < $porcentagex['porcentage']) {
		$indice=count($dt);
		$auxiliar=($porcentagex['porcentage']-$acumulado);
		$pctg=(($auxiliar*100)/$porcentagex['porcentage']);
		$dt[$indice]=["Sin respuesta"."(".$auxiliar.")"=>$pctg];
	}

$contador++;
echo '<div id="container"style="width:500px; height: 300px; margin-left:28%;">
        <canvas id="'.$contador.'" width="500px" height="300px"/>
    </div>';

	$Encuesta->grafica($contador,$dt);
	
?>

<?php
}
?>