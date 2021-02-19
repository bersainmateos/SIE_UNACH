<?php
 
	if(!empty($_POST["matricula"]) && !empty($_POST["password"])){
		require '../../Server/conexion/conexion.php';
		
		$Login=new OpenConexion();
		
		$administrador=$Login->loginAdmin($_POST['matricula'],$_POST['password']);

		if($administrador== null ){
				echo "<script>alert(\"Lo sentimos, correo y/o constraseña invalido.\");
				window.location='../../Admin';</script>";
			}else{
				if (isset($_POST['recordar'])) {
					$data=array(
						"user"=>strip_tags($_POST['matricula']),
						"pass"=>strip_tags($_POST['password'])
					);
					$Date_user=$Login->Conn->prepare("select * from admin where correo_admin=:user and 	passwd=md5(:pass) limit 1");
					$Date_user->execute($data);
					$datos=$Date_user->fetch(PDO::FETCH_ASSOC);
					//echo json_encode($datos);
					$Login->Close();
					setcookie("SESSION_[CORREO]", $datos['correo_admin'], time()+31622400,"/");
					setcookie("SESSION_[PASS]", $datos['passwd'], time()+31622400,"/");
					$_SESSION['tiempo']=time();
					echo "<script>window.location='../../Admin/Home';</script>";	
				}else{
					$_SESSION['tiempo']=time()+500;
					echo "<script>window.location='../../Admin/';</script>";
				}
			}		
	}else{
		echo "Error, verifica los datos...";
	}
?>