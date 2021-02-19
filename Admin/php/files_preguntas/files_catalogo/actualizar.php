<?php 

  try {
    require_once '../../../../Server/conexion/conexion.php';
    
    $Update= new OpenConexion();

    $data=array(
        "cat_pregunta"=>strip_tags($_POST['catalogo']),
        "id_cat"=>strip_tags($_POST['id_catalogo'])
    );

    $check=$Update->Conn->prepare("update cat_pregunta set nom_cat_pregunta=upper(:cat_pregunta) where idcatalogo_p=:id_cat");

    $check->execute($data);

    echo "1";
  
  } catch (Exception $e) {
    echo "Error";
  
  }

?>