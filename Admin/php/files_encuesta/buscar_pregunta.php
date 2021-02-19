<?php 
    //if (!empty($_POST['pregunta'])) {
    try {
    require_once '../../../Server/conexion/conexion.php';
    
    $Encuesta=new OpenConexion();
    
    $datos=array("pregunta"=>strip_tags("%".$_POST['pregunta']."%"));

    $Data=$Encuesta->Conn->prepare("select * from pregunta where nom_pregunta like upper(:pregunta) and status > 0");
    
    $Data->execute($datos);
    $Encuesta->Close();
    $respuesta = ($Data->rowCount() > 0) ? $Data->fetchAll(PDO::FETCH_ASSOC) : 0 ;
    echo json_encode($respuesta);
    
    } catch (Exception $e) {
        echo "Respuesta-->".$e->getMessage();
    }
 ?>