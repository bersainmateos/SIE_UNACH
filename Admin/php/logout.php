<?php
	setcookie("SESSION_[CORREO]", true, time()+0,"/");
	setcookie("SESSION_[PASS]", true, time()+0,"/");
	session_start();
	session_destroy();
	echo "<script>window.location='../';</script>";
?>