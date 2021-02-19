<?php 
require_once '../../../../Server/conexion/conexion.php';
$Detalle= new OpenConexion();

$data=array("status"=>strip_tags($_POST['update']),"cns"=>strip_tags($_POST['id_pregunta']));


$check=$Detalle->Conn->prepare("update det_cat_pregunta set status=:status where cns_det_pregunta= :cns");

$check->execute($data);

$datos=array(
  "id_p"=>strip_tags($_POST['id_catalogo'])
);

	$query=$Detalle->Conn->prepare("select * from pregunta p inner join det_cat_pregunta dp on (p.idpregunta=dp.idpregunta) where dp.idcatalogo_p= :id_p order by p.idpregunta");
 
  $query->execute($datos);

		echo '<table class="table table-bordered">
             <thead class="unach-table">
  <tr style="color:white;">
            <th><center>PREGUNTAS</center></th>
             <th ><center>OPCIÓN</center></th>
  </tr>
</thead>';
  
  $variable=$query->fetchAll(PDO::FETCH_ASSOC);
  foreach ($variable as  $value) {
 //  while ($value=pg_fetch_array($query)) {

    if($value['status']==0){
        $clase='btn-warning';
        $val='Habilitar';
        $update='1';
      }else{
        $clase='btn-danger';
        $val='Deshabilitar';
        $update='0';
      }


        echo "<tr>
        <td>".$value['nom_pregunta']."</td>
        <td><input data-id_update='".$update."' type='button' value='".$val."' class='btn btn-block ".$clase." elim_pregunta' data-id_catalogo='{$_POST['id_catalogo']}'  data-id_pregunta='".$value['cns_det_pregunta']."' >
        </td>
        </tr>";
    }
    echo '</table>';
	
 ?>