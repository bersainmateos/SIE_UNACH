<?php 
require_once '../../../../Server/conexion/conexion.php'; 
$Datos = new OpenConexion();
      $data=array("id"=>strip_tags($_POST['id_encuesta']));
       $datos=$Datos->Conn->prepare("select * from cat_respuesta where idtipo=:id and status > 0");
       //    $numero=pg_num_rows($datos);
        $datos->execute($data);
            if($datos->rowCount() > 0){
                   $indice=1;
    $infox=$datos->fetchAll(PDO::FETCH_ASSOC);
    foreach ($infox as $info) {
   // while($info=pg_fetch_array($datos)){ 
   echo '<div class="card"> 
        <div class="card-header">
           <center> <a href="#resp'.$indice.'" class="btn btn-block" data-toggle="collapse" data-parent="#acordeon" >'.$info['nom_cat_respuesta'].'</a></center>
        </div>

        <div id="resp'.$indice.'" class= "collapse">
            <div class="card-body">';
                $variable=$Datos->Conn->prepare("select * from respuesta where idrespuesta=any(select idrespuesta from det_cat_respuesta where idcatalogo_r={$info['idcatalogo_r']} and status > 0)");
          $variable->execute();
          $opx=$variable->fetchAll(PDO::FETCH_ASSOC);
  foreach ($opx as $op) {
 // while($op=pg_fetch_array($variable)){
           echo '<div id="resp_'.$op['idrespuesta'].'"  data-idcat="'.$info['idcatalogo_r'].'"  data-id_control="respuesta" data-id_encuesta="'.$op['idrespuesta'].'" >'.$op['nom_respuesta'].'</div>'; 
            }
        echo '</div></div></div>';
         $indice++;
     }

 }else{
 	echo '<br><h5 class="text-center">¡¡No tienes catálogo de este tipo!!</h5>';
 }
 ?>