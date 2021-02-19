<title>Politecnica</title>
<link rel="icon" href="politecnica.ico">
<?php 

$historia=$_POST['historia'];

	      $status = ""; 
          ($_POST["action"] == "upload") or die ("Error al subir la imagen."); 
          $tamano = $_FILES["archivo"]['size']; 
          $tipo = $_FILES["archivo"]['type']; 
          $archivo = $_FILES["archivo"]['name']; 
          $prefijo = substr(md5(uniqid(rand())),0,6);//generamos una id para poder tener imagenens repetidas  
 
         ($archivo != "") or die ("Error al subir la imagen ".$archivo); 
      

//definimos la extension de la imagen            
($tipo == "image/jpeg" || $tipo == "image/jpg") or die ("Sólo se admiten imágenes en <b>.jpg</b> y <b>.jpeg </b>"); 
          //subimos la imagen original              
          $destino =  "imagenes/originales/".$prefijo."_".$archivo; //ruta de la imagen original
          (copy($_FILES['archivo']['tmp_name'],$destino)) or die ("Error al subir la imagen ".$archivo); 
         

	      $post=$destino;     
		  
		  echo $status; 
                  
          //creamos la miniaturas
          $source=$destino; 
          $destmini="imagenes/miniaturas/".$prefijo."_".$archivo;//ruta donde se guardan las miniaturas
          $width_d=200; // ancho de la imagen
          $height_d=250; // alto de la imagen 
include "php/conexion.php";

$val=mysqli_query($conn,"INSERT INTO  imagenes (ruta,ruta_miniatura,historia) values('$destino','$destmini','$historia')");
    if($val){
        print "<script>alert(\"Felicidades...\");window.location='./portal.php';</script>";
    }

mysqli_close($conn);
          
		  //copyamos la miniatura
          list($width_s, $height_s, $type, $attr) = getimagesize($source, $info2); 
          $gd_s = imagecreatefromjpeg($source); 
          $gd_d = imagecreatetruecolor($width_d, $height_d);  
          imagecopyresampled($gd_d, $gd_s, 0, 0, 0, 0, $width_d, $height_d, $width_s, $height_s); 
          imagejpeg($gd_d, $destmini);  
          imagedestroy($gd_s); 
          imagedestroy($gd_d); 


?>

