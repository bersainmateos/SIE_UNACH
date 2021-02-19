<?php 
  require_once '../../../../Server/conexion/conexion.php';
  $Detalle = new OpenConexion();
  $data=array("status"=>strip_tags($_POST['tres']),"cns"=>strip_tags($_POST['id_respuesta']));
 
  $check=$Detalle->Conn->prepare("update det_cat_respuesta set status=:status where cns_det_respuesta=:cns");

  $check->execute($data);
	
  $data2=array("id"=>strip_tags($_POST['id_catalogo']));
$query=$Detalle->Conn->prepare("select * from respuesta r inner join det_cat_respuesta dc on (r.idrespuesta=dc.idrespuesta) where dc.idcatalogo_r=:id order by r.idrespuesta"); 
$query->execute($data2);

    echo '<table class="table table-bordered">
             <thead class="unach-table">
      <tr style="color:white;">
            <th><center>RESPUESTAS</center></th>
             <th ><center>OPCIÓN</center></th></tr></thead>';
            $variable=$query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($variable as $value) {
//         while ($value=pg_fetch_array($query)) {

        if ($value['status']==1) {
              $val='Deshabilitar';
              $update='0';
              $clase='btn-danger';
          } else {
              $val='Habilitar';
              $update='1';
              $clase='btn-warning';
          }
          
              echo "<tr><td>".$value['nom_respuesta']."</td><td><input type='button' value='".$val."' data-id_update='".$update."' class='btn btn-block ".$clase." elim_respuesta' data-id_catalogo='".$_POST['id_catalogo']."'  data-id_respuesta='".$value['cns_det_respuesta']."' ></td></tr>";
        }
             
       echo '</table>';
 ?>