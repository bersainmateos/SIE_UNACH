<div class="wrapper">
  <div id="wizard" class="wizard">    
    <div class="wizard__content">  
      <header class="wizard__header">
        <div class="wizard__header-overlay">
         </div>
        <div class="wizard__steps">

          <nav class="steps">
         
            <?php 

            if (is_numeric($rutas[1])) {

                $step=new OpenConexion();

                $encuestas=$step->Conn->query("select idencuesta from encuesta where enlace={$rutas[1]} and status=1 and fecha_expiracion > CURRENT_DATE order by idencuesta");
               
        while ($encuesta=$encuestas->fetch(PDO::FETCH_ASSOC)) {
            $color=$step->Conn->query("select * from valida_encuesta_realizar where curp='".$_COOKIE['persona']."' and idencuesta=".$encuesta['idencuesta']);
        
                 // $numColor=pg_num_rows($color);
                  $Class='';
                  if ($color->rowCount() > 0) {
                    $Class='-completed';
                  }
             ?>
          <div class="<?php echo 'c'.$encuesta['idencuesta']; ?>   step <?php echo $Class;?> "> 
            <div class="step__content">
              <p class="step__number"><i class="fa fa-github-alt"></i></p>
              <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            
                 <circle class="checkmark__circle si" cx="26" cy="26" r="25" fill="none"/>
                 
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
               
              </svg>

              <div class="lines">
                <div class="line -start">
                </div>

                <div class="line -background">
                </div>

                <div class="line -progress">
                </div>
              </div>  
            </div>
          </div>

        <?php  }} ?>
        </nav>
        </div>
      </header>
       <div style="margin: 30px">
        <center><button class="btn btn-danger previous">Anterior</button>
         <button class="btn btn-success next">Siguiente</button></center>
      </div>
      
      <div class="panels">
        <?php

if (is_numeric($rutas[1])) {
  $stepencuestas=new OpenConexion();
 
  $encuestas=$stepencuestas->Conn->query("select idencuesta,descripcion from encuesta where enlace={$rutas[1]} and status=1 and fecha_expiracion > CURRENT_DATE order by idencuesta");
$numero=0;
$Fin=1;
                while ($encuesta=$encuestas->fetch(PDO::FETCH_ASSOC)) {

$Encuesta=new OpenConexion();
$verificar=$Encuesta->Conn->query("select * from valida_encuesta_realizar where curp='".$_COOKIE['persona']."' and idencuesta=".$encuesta['idencuesta']);

$Recorrido=$Encuesta->Conn->query("select * from pregunta_encuesta where idencuesta=".$encuesta['idencuesta']);

$Requeridas=$Encuesta->Conn->query("select * from pregunta_encuesta where idencuesta=".$encuesta['idencuesta']." and requerida=1");

$Required=$Requeridas->rowCount();

$Inicio=$Fin;
$Fin=($Recorrido->rowCount())+$Fin;
$numVAl=$verificar->rowCount();
?>

<div class="panel">

     
<h2 style="display: none;" class="panel__title text-success text-bold <?php echo 'mensaje'.$encuesta['idencuesta']; ?> ">Encuesta Resuelta</h2>


<header class=" <?php echo 'oculto'.$encuesta['idencuesta']; ?> ">

<?php if($numVAl > 0){ ?>
<h2 class="panel__title text-success text-bold">Encuesta Resuelta</h2>
<?php }else{

 $persona=$Encuesta->Conn->query("select * from persona where curp='".$_COOKIE['persona']."'");
$nombre=$persona->fetch(PDO::FETCH_ASSOC);

 ?>
<label class="text-success text-bold"><?php echo $encuesta['descripcion'];?></label>

<?php 
echo "<h6 class='text-danger'><center>----->".$nombre["nom_p"]." ".$nombre["ape_pat_p"]." ".$nombre["ape_mat_p"]."<-----</center></h6>";

} ?>

<br>

<?php 

$VALIDAR=$Encuesta->Conn->query('select (fecha_expiracion-CURRENT_DATE) as mostrar from encuesta where idencuesta='.$encuesta['idencuesta']);

$VALIDAR=$VALIDAR->fetchAll(PDO::FETCH_ASSOC);


$contenido=$Encuesta->Conn->query("select * from encuesta e inner join pregunta_encuesta pe on (e.idencuesta=pe.idencuesta) where pe.idencuesta=".$encuesta['idencuesta']." and e.status=1");
 
  $num=$contenido->rowCount();
  if(is_numeric($encuesta['idencuesta'])){
$contador=0;

while($info=$contenido->fetch(PDO::FETCH_ASSOC)){

  $pregunta=$Encuesta->Conn->query("select * from pregunta where idpregunta=".$info['idpregunta']);
 
  $nom_pregunta=$pregunta->fetch(PDO::FETCH_ASSOC);

$op1=$Encuesta->Conn->query("select * from View_creacion_cuestionario where idpregunta=".$info['idpregunta']." and idencuesta=".$encuesta['idencuesta']." order by cns_det_encuesta");
 
$Val = ($info['requerida']) ? "<label class='text-danger'>*</label>" : "" ;


if($numVAl >0 ){
  echo '<div class="form-group panel__subheading none">';
}else{
  echo '<div class="form-group panel__subheading ">';  
}

 echo '<h6 class="col-xs-12 control-label " data-id_pregunta="'.$info['idpregunta'].'"> '.++$contador."). ".$nom_pregunta['nom_pregunta']." ".$Val."
       </h6>";

++$numero;
?>
<!--  -->

<?php
   
  while($mostrar1=$op1->fetch(PDO::FETCH_ASSOC)){

    if ($mostrar1['idtipo']==1) {
      echo '<div style="margin-left:20px;" class="checkbox "><label><input data-ver_tipo="radio" data-requerida="'.$info['requerida'].'" data-id_respuesta='.$mostrar1['idrespuesta'].' data-id_pregunta='.$info['idpregunta'].' data-id_res="'.$mostrar1['nom_respuesta'].'" class="respuesta '.$numero.'"  type="radio" name="'.$encuesta['idencuesta'].'-'.$contador.'" > '.$mostrar1['nom_respuesta'].'</label><!-Si modificas en está parte me dare cuenta en la base de datos!--></div>';
    } else if($mostrar1['idtipo']==2){
        echo '<div style="margin-left:20px;" class="checkbox "><label><input data-ver_tipo="multi" data-requerida="'.$info['requerida'].'" data-id_respuesta='.$mostrar1['idrespuesta'].'  data-id_pregunta='.$info['idpregunta'].' data-id_res="'.$mostrar1['nom_respuesta'].'" class="respuesta '.$numero.'"  type="checkbox" name="'.$encuesta['idencuesta'].'-'.$contador.'" > '.$mostrar1['nom_respuesta'].'</label><!-Si modificas en está parte me dare cuenta en la base de datos!--></div>';
    }else if($mostrar1['idtipo']==3){
      echo '<input type="text" data-requerida="'.$info['requerida'].'" data-id_res="'.$mostrar1['cns_det_respuesta'].'" data-ver_tipo="libre" data-id_pregunta='.$info['idpregunta'].' class="form-control respuesta_ '.$numero.'"><!-Si modificas en está parte me dare cuenta en la base de datos!--><br>';
    }else if($mostrar1['idtipo']==4){
      echo '<input type="date" data-requerida="'.$info['requerida'].'" data-id_res="'.$mostrar1['cns_det_respuesta'].'" data-ver_tipo="libre" data-id_pregunta='.$info['idpregunta'].' class="form-control respuesta_ '.$numero.'"><!-Si modificas en está parte me dare cuenta en la base de datos!--><br>';
    }else if($mostrar1['idtipo']==5){
      echo '<input type="number" data-requerida="'.$info['requerida'].'" data-id_res="'.$mostrar1['cns_det_respuesta'].'" data-ver_tipo="libre" data-id_pregunta='.$info['idpregunta'].' class="form-control respuesta_ '.$numero.'"><!-Si modificas en está parte me dare cuenta en la base de datos!--><br>';
    }
  }
?>



<?php
}

 if ($numVAl > 0) {
    echo '<br><button disabled  id="g"  class="btn btn-info " data-id_encuesta="'.$encuesta['idencuesta'].'">¡Guardar Encuesta!</button>
      </div>';
  }else{
    echo '<br><button   id="g" onclick="capturar('.$encuesta['idencuesta'].','.$Required.','.$Inicio.','.$Fin.')"  class="btn btn-info " data-id_encuesta="'.$encuesta['idencuesta'].'">¡Guardar Encuesta!</button>
    </div> ';
  }

}else{
  echo '<h2 class="text-danger text-center ">Encuesta no encontrada</h2>';
}

echo '</header></div>';

 }
}else{
  echo '<h2 class="text-danger text-center ">Encuesta no encontrada</h2>';
}
?>


      </div>
      <br>
      <div class="img fixed-bottom" style="display: none;" >
          <center><img src="../imagenes/espera.gif"></center>
        </div>
     
    </div>
    
  </div>
</div>