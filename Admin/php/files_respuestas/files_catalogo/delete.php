<?php 
require_once '../../../../Server/conexion/conexion.php';

$Delete = new OpenConexion();

$datos=array("status"=>strip_tags($_POST['tres']),"id"=>strip_tags($_POST['id_catalogo']));
$check2=$Delete->Conn->prepare("update cat_respuesta set status=:status where idcatalogo_r=:id");
$check2->execute($datos);
/*
	
  echo '<table class="table table-bordered">
              <thead class="unach-table">
              <tr style="color:white;">
                <th><center>NOMBRE CATÁLOGO</center></th>
               <th colspan="4"><center>OPCIONES</center></th>
              </thead> </tr>';
                  
            if ($_POST['tipo'] > 0) {
                   $query=$Delete->Conn->prepare("select * from cat_respuesta where idtipo={$_POST['tipo']}  and idcatalogo_r > 1 order by idcatalogo_r");
              $query->execute();
            } else {
                   $query=$Delete->Conn->prepare("select * from cat_respuesta where idcatalogo_r > 1 order by idcatalogo_r");
              $query->execute();
            }
            
            $variable=$query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($variable as $value) {
             
//         while ($value =pg_fetch_array($query)) {

          if ($value['status']==1) {
            $val='Deshabilitar';
            $update='0';
            $clase='btn-danger';
          } else {
            $val='Habilitar';
            $update='1';
            $clase='btn-warning';
          }
              echo "<tr class='resaltar'>
              <td>".$value['nom_cat_respuesta']."</td>
              <td><input data-toggle='modal' data-target='.bd-example-modal-lg' type='button' value='Ver detalles' class='btn btn-block btn-success detalle_catalogo_respuesta' data-id_catalogo_respuesta='".$value['idcatalogo_r']."' ></td>
              <td><input type='button' value='Renombrar' class='btn btn-block btn-info renom_catalogo_respuesta' data-id_catalogo_respuesta='".$value['idcatalogo_r']."'  data-toggle='modal' data-target='.bd-example-modal-lg' ></td>
              <td><button data-id_catalogo='".$value['idcatalogo_r']."' class='btn btn-success btn-block  agregar_new_respuesta' >Agregar Más</button></td>
              <td><input type='button' value='".$val."' class='btn btn-block ".$clase." elim_catalogo_respuesta'  data-id_catalogo_respuesta='".$value['idcatalogo_r']."' data-id_update='".$update."' ></td>
              </tr>";
        }
      
      echo  '</table>';
 */
 ?>