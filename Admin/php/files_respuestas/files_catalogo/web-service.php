<?php
    require_once '../../../../Server/conexion/conexion.php';
    $Editar = new OpenConexion();

        if ($_POST['tipo'] > 0) {
            $data=array("id"=>strip_tags($_POST['tipo']));
            $query=$Editar->Conn->prepare("select * from cat_respuesta where idtipo=:id and idcatalogo_r > 3 order by idcatalogo_r");
        $query->execute($data);

        }else{
             $query=$Editar->Conn->prepare("select * from cat_respuesta where idcatalogo_r > 3 order by idcatalogo_r");  
        $query->execute();
        }

        if ($query->rowCount() > 0) {
             echo '<table class="table table-bordered">
              <thead class="table-dark">
                <th><center>NOMBRE CATÁLOGO</center></th>
               <th colspan="4"><center>OPCIONES</center></th>
              </thead>
            '; 
        $variable=$query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($variable as $value) {
        // while ($value =pg_fetch_array($query)) {

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
              <td>".$value['nom_cat_respuesta']."</td>
              <td><input data-toggle='modal' data-target='.bd-example-modal-lg' type='button' value='Ver detalles' class='btn btn-block btn-success detalle_catalogo_respuesta' data-id_catalogo_respuesta='".$value['idcatalogo_r']."' ></td>
              <td><input type='button' value='Renombrar' class='btn btn-block btn-info renom_catalogo_respuesta' data-id_catalogo_respuesta='".$value['idcatalogo_r']."'  data-toggle='modal' data-target='.bd-example-modal-lg' ></td>
              <td><button id='Add_cat_respuesta-{$value['idcatalogo_r']}' data-id_catalogo='".$value['idcatalogo_r']."' class='btn btn-success btn-block manejador' >Agregar Más</button></td>
              <td><input type='button' value='".$val."' class='btn btn-block ".$clase." elim_catalogo_respuesta'  data-id_catalogo_respuesta='".$value['idcatalogo_r']."' data-id_update='".$update."' ></td>
              </tr>";
        }
          echo '</table>';
        } else {
          echo "<br><center><h3>No tienes catalogos de este tipo</h3></center>";
        }
   ?>      
