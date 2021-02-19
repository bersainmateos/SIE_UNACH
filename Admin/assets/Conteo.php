<div class="container <?php echo 's'.$rutas[1]; ?>" >
<?php

$Encuesta = new OpenConexion();
	
	$porcentage=$Encuesta->Conn->prepare("select count(curp) porcentage from (select DISTINCT (curp) from valida_encuesta_realizar where idencuesta='".$rutas[1]."') as encuesta");/*La función de esta consulta es sacar el número de personas que han sido encuestadas*/
	$porcentage->execute();
	$porcentagex=$porcentage->fetch(PDO::FETCH_ASSOC);

echo "<h1 class='text-center text-success'>
			ENCUESTA REALIZADA A ".$porcentagex['porcentage']." PERSONAS.
	  </h1><br>";

$contenido=$Encuesta->Conn->prepare("select distinct (idpregunta) from View_creacion_cuestionario where  idencuesta={$rutas[1]}");/*Aqui saco todas las preguntas de mi encuesta de manera ordenada*/

$contador=0;
$numerox=0;
$contenido->execute();
$variable=$contenido->fetchAll(PDO::FETCH_ASSOC);
foreach ($variable as $info) {
//while($info=pg_fetch_array($contenido)){ 

$pregunta=$Encuesta->Conn->prepare("select * from pregunta where idpregunta={$info['idpregunta']}");
$pregunta->execute();
	$nom_pregunta=$pregunta->fetch(PDO::FETCH_ASSOC);

$op1=$Encuesta->Conn->prepare("select * from View_creacion_cuestionario where idpregunta={$info['idpregunta']} and idencuesta={$rutas[1]} and idtipo !=3 order by cns_det_encuesta");

$op1->execute();


echo '<div class="form-group">';

echo '<h3 class="text-center">'.++$numerox.") ".$nom_pregunta['nom_pregunta'].'
	</h3>';

$acumulado=0;
$i=0;
$dt=array();


$variablex=$op1->fetchAll(PDO::FETCH_ASSOC);

foreach ($variablex as $mostrar1) {

	//while($mostrar1=pg_fetch_array($op1)){
$num=$Encuesta->Conn->prepare("select count (respuesta) as valor from det_respuesta_encuesta where respuesta='{$mostrar1['nom_respuesta']}' and idpregunta={$info['idpregunta']} and idvalidar in (select idvalidar from valida_encuesta_realizar where idencuesta ={$rutas[1]})");

$num->execute();

		$valor=$num->fetch(PDO::FETCH_ASSOC);
		
		$acumulado+=(Integer)$valor['valor'];
		
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
</div>
<?php
}
?>