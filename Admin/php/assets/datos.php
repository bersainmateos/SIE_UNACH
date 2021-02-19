<?php
require_once '../../../Server/conexion/conexion.php'; 
$Datos= new OpenConexion();
 
    if($_POST['id'] < 3 ){
      $data=array("id"=>strip_tags($_POST['id']));
           $datos=$Datos->Conn->prepare("select * from cat_respuesta where idtipo=:id and status > 0");
           $datos->execute($data);
           //$numero=pg_num_rows($datos);
            
            if($datos->rowCount() > 0){
                   $indice=1;
    $e=$datos->fetchAll(PDO::FETCH_ASSOC);
    foreach ($e as $key => $info) {
      $datos=array("idcat"=>strip_tags($info['idcatalogo_r']));
   echo '<div class="card" >
        <div class="card-header">
           <center> <a href="#resp'.$indice.'" class="btn btn-block apertura_dis" data-toggle="collapse" data-parent="#acordeon" >'.$info['nom_cat_respuesta'].'</a></center>
        </div>

        <div id="resp'.$indice.'" class= "collapse apertura">
            <div class="card-body">';
            $variable=$Datos->Conn->prepare("select * from respuesta resp inner join det_cat_respuesta dc on (resp.idrespuesta=dc.idrespuesta) where idcatalogo_r=:idcat and dc.status > 0 ");
            $variable->execute($datos);
            $j=$variable->fetchAll(PDO::FETCH_ASSOC);
    foreach ($j as $key => $op) {
           echo '<div id="resp_'.$op['idrespuesta'].'" draggable="true" style="cursor: pointer; padding:5px; border-radius:8px; margin-top:3px;" data-idcat="'.$op['cns_det_respuesta'].'"  data-id_control="respuesta" data-id_encuesta="'.$op['idrespuesta'].'" class="respuesta">'.$op['nom_respuesta'].'</div>'; 
            }
        echo '</div></div></div>';
         $indice++;
    }
            }else{
                    echo "Lo sentimos debe crear un catalogo";
            }
    }else if($_POST['id'] == 3 ){
   
            ?>

<div id="respuesta"  class="respuesta bg-info" draggable='true' style='cursor: pointer; padding:10px; border-radius:8px; color: white;' data-idcat="220"  data-id_control="respuesta"  class="respuesta"> FECHA </div>


        <?php }else if($_POST['id'] == 4 ){ ?>

<div id="respuesta"  class="respuesta bg-info" draggable='true' style='cursor: pointer; padding:10px; border-radius:8px; color: white;' data-idcat="219"  data-id_control="respuesta"  class="respuesta">
           RESPUESTA LIBRE
        </div>

          <?php 
        }else{
           ?>
<div id="respuesta"  class="respuesta bg-info" draggable='true' style='cursor: pointer; padding:10px; border-radius:8px; color: white;' data-idcat="221"  data-id_control="respuesta"  class="respuesta">
           NÚMERO
        </div>


           <?php 

           } ?>