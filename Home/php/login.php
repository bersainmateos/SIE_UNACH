<?php

	if(!empty($_POST["usuario"]) && !empty($_POST["password"])){
		
		require_once '../../Server/conexion/conexion.php';

		$Login=new OpenConexion();
		$data=array("user"=>strip_tags($_POST['usuario']),"pass"=>strip_tags($_POST['password']));
		
		$query=$Login->Conn->prepare("select * from encuestador where rfc=:user and passwd=md5(:pass) limit 1");
			//$numero=pg_num_rows($this->query);
			$query->execute($data);
			//if($query->rowCount() > 0 ){
				$admin=$query->fetch(PDO::FETCH_ASSOC);
				session_start();
				$_SESSION["egresado"]=$admin;
			if (!empty($_SESSION["egresado"])) {
			//$_SESSION['tiempo']=time()+500;
			echo '1';
		}else{
			echo '0';
		}

/*
		$administrador=$Login->login("select * from encuestador where rfc='".pg_escape_string($_POST['usuario'])."' and rfc=('".pg_escape_string($_POST['password'])."') limit 1");
		
		if (isset($_SESSION["egresado"])) {
			$_SESSION['tiempo']=time()+500;
			echo '1';
		}else{
			echo '0';
		}*/

	}else{
		echo "Error, verifica los datos...";
	}

?> 