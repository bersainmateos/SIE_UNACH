<?php 
    require_once '../../../../Server/conexion/conexion.php';
    $Editar=new OpenConexion();

    $query=$Editar->Conn->prepare("select * from cat_pregunta where idcatalogo_p > 1 order by idcatalogo_p");
    $query->execute();
    $Data=$query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($Data as $value) {
    //while ($value =pg_fetch_array($query)) {

      if ($value['status']==1) {
        $val='Deshabilitar';
        $update='0';
        $clase='btn-danger';
      } else {
        $val='Habilitar';
        $update='1'; 
        $clase='btn-warning';
      }
      echo "<tr>
              <td>".$value['nom_cat_pregunta']."</td>
              <td><input data-toggle='modal' data-target='.bd-example-modal-lg' type='button' value='Ver detalles' class='btn btn-block btn-success detalle_catalogo_pregunta' data-id_catalogo='".$value['idcatalogo_p']."' ></td>
              <td><input type='button' value='Renombrar' class='btn btn-block btn-info renom_catalogo_pregunta' data-id_catalogo='".$value['idcatalogo_p']."'  data-toggle='modal' data-target='.bd-example-modal-lg' ></td>
              <td><button id='Add_cat_pregunta-{$value['idcatalogo_p']}' data-id_catalogo='".$value['idcatalogo_p']."' class='btn btn-success btn-block  manejador' >Agregar Más</button></td>
              <td><input type='button' value='".$val."' class='btn btn-block ".$clase." elim_catalogo_pregunta' data-id_update='".$update."'  data-id_catalogo='".$value['idcatalogo_p']."' ></td>
              </tr>";   
    }

?>