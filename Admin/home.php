<?php
  session_start();
  require_once '../Server/conexion/conexion.php';
  $url = (isset($_GET['modulo'])) ? $_GET['modulo'] : "Null" ;
 if(empty($_SESSION["administrador"])){
      echo "<script>window.location='".URL_ADMIN."';</script>";
    }
?>
<html>   
	<head>
    <title>SRI</title>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="../css/alertify.css">
    <link rel="stylesheet" href="../css/estilos_propios.css">
    <script src="../javascript/Chart.bundle.js"></script>
     
	</head>
	<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3  unach fixed-top">
    <a class="navbar-brand inicio" url="<?php echo URL_ADMIN;?>" href="<?php echo URL_ADMIN; ?>Home">
  <span class="glyphicon glyphicon-home"></span><b> INICIO </b></a>
      <nav class="my-2 my-md-0 mr-md-3">
         <a class="navbar-brand" style="font-size: 16px;" href="<?php echo URL_ADMIN; ?>Registrar_encuestador"><span class="glyphicon glyphicon-user"></span><b> REGISTRO ENCUESTADOR</b></a>
      </nav>
      <a class="p-2 text-dark navbar-brand" style="font-size: 16px;" href="<?php echo URL_ADMIN; ?>php/logout.php"><span class="glyphicon glyphicon-log-in"></span><b> SALIR</b></a>
    </div>
  <br><br><br>
   <div class="container">
        <div align="right"><span style="color:rgba(13,81,160,1);" class="glyphicon glyphicon-home">
        <b style="color:rgba(13,81,160,1);">Bienvenido(a): </b> </span><b style="color:black;"><?php echo $_SESSION["administrador"];?> </b></div>
    </div>

<div class="espera"></div>
<div class="datax" socket='<?php echo $_SERVER['SERVER_NAME']; ?>'>
  <?php 
      $Controlador= new OpenConexion();
      $Controlador->View($_GET['modulo']);
  ?>
</div>

<script src="../javascript/Admin/jquery-3.3.1.js"></script>
<script src="../javascript/fancywebsocket.js"></script>
<script src="../javascript/Admin/bootstrap.js"> </script>
<script src="../javascript/Admin/alertify.js"></script>
<script src="../javascript/Admin/jquery.dataTables.min.js"></script>
<script src="../javascript/Admin/dataTables.bootstrap4.min.js"></script>
<script src="../javascript/Admin/dataTables.fixedHeader.min.js"></script>
<script >
  var ruta="<?php echo $url; ?>";
</script>
<script src="../javascript/Admin/control.js"></script>
</body>	
</html>