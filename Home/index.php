<?php
	require_once '../Server/conexion/conexion.php';
	session_start();
  $Home= new OpenConexion();
  /*
  if (isset($_SESSION['egresado'])) {
    $segundos = 500;
      if(($_SESSION['tiempo']+$segundos) < time()) {
         echo"<script>
                  alert('Su sesión ha expirado por inactividad ');
                  window.location='./php/logout.php';
              </script>";
      }else{
        $_SESSION['tiempo']=time();
      }
  }
*/
?>

<html>
<head> 
	<link rel="icon" href="../favicon.ico">
	<title>UNACH</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/alertify.css">
  <link rel="stylesheet"  href="../css/Slider.css">
  <link rel="stylesheet"  href="../css/encuesta_style.css">
  <link rel="stylesheet" href="../css/estilos_propios.css">
  <script src="../javascript/Chart.bundle.js"></script>

<body>

	<header>
      <nav class="navbar navbar-expand-md navbar-dark " style="background-color:rgb(7,66,127);" >
      <img  src="../imagenes/logo_unach.jpg"  alt="Logo Unach" class="mr-md-auto imgunach">
       <!--  <a class="navbar-brand" href="#">Carousel</a> -->
<?php  if (!isset($_SESSION['egresado'])) { ?>
       <a class="navbar-brand Inicio" url="<?php echo URL_EGRESADO; ?>" href="<?php echo URL_EGRESADO; ?>Inicio"><span class="glyphicon glyphicon-home"></span><b> INICIO </b></a>

<?php }else{ ?>

<a class="navbar-brand Inicio" href="<?php echo URL_EGRESADO; ?>Egresado"><span class="glyphicon glyphicon-home"></span><b> INICIO </b></a>

<?php } ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
 <?php 
        if (isset($_SESSION['egresado'])){
          echo '
          <a class="nav-item nav-link" href="'.URL_EGRESADO.'Egresado"><span class="glyphicon glyphicon-eye-open"></span><b> Encuesta </b></a>

          <div class="nav-item nav-link">
          <span class="glyphicon glyphicon-user ">Bienvenido(a):</span>  <b style="color:white;">&nbsp;'. $_SESSION["egresado"]["nom_encuestador"]." ".$_SESSION["egresado"]["ape_pat_encuestador"]." ".$_SESSION["egresado"]["ape_mat_encuestador"].'</b></div>  <a   href="./php/logout.php" class="btn btn-danger">Salir</a> </div>';
        }
        ?>
          </ul>
        </div>
      </nav>
    </header>
<div class="container socket" socket='<?php echo $_SERVER['SERVER_NAME']; ?>' url='<?php echo URL_EGRESADO ?>'>
  
<?php 

if (isset($_GET['modulo'])) {
  $rutas=array();
  $rutas=explode("-",$_GET['modulo']);

  if (isset($_SESSION['egresado'])) {
    if (in_array($rutas[0], $Home->C_Egresado_log)) {
      require_once './assets/'.$rutas[0].'.php';
    } else {
      require_once './assets/PageError.php';
    }
  } else {
    if (in_array($rutas[0], $Home->C_Egresado)) {
      require_once './assets/'.$rutas[0].'.php';
    } else {
      require_once './assets/PageError.php';
    }
  }
}else{
    require_once './assets/Inicio.php';
}
?>
	
<!--  -->
</div>

<?php 

if (isset($rutas[0])) {

if($rutas[0]!='Aplicacion' and $rutas[0]!='Encuesta' ) {  ?>
<div id="footer" class="fixed-bottom">
		<p class="copyright">&copy; <?php echo date('Y');?> TAPACHULA, CHIAPAS</p>
	</div>
<?php }}else{
  echo '<div id="footer" class="fixed-bottom">
    <p class="copyright">&copy; <?php echo date("Y");?> TAPACHULA, CHIAPAS</p>
  </div>';
} ?>

	<script src="../javascript/Home/jquery.js"></script>
	<script src="../javascript/Admin/bootstrap.js"></script>
  <script >
  var ip=$('.socket').attr('socket');;

</script>
   <script src="../javascript/fancywebsocket.js"></script>
	<script src="../javascript/Admin/alertify.js"></script>
	<script src="../javascript/Home/wowslider.js"></script>
	<script src="../javascript/Home/script.js"></script>
	<script src="../javascript/Home/control.js"></script>
  <script src="../javascript/Home/encuesta.js"></script>

	
</body>
</html>  