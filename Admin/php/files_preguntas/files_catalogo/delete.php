<?php 
  
  try {
    require_once '../../../../Server/conexion/conexion.php';
    $Delete= new OpenConexion(); 
 
    $data=array(
        "status"=>strip_tags($_POST['update']),
        "id"=>strip_tags($_POST['id_catalogo'])
      );

  $check=$Delete->Conn->prepare("update cat_pregunta set status=:status where idcatalogo_p=:id");
  
  $check->execute($data);
  echo "1";
  
  } catch (Exception $e) {
    echo "0";
  }

 ?>