<?php 

	define('URL_ADMIN', 'http://'.$_SERVER["SERVER_NAME"].'/SIE_UNACH/Admin/');
	define('URL_EGRESADO', 'http://'.$_SERVER["SERVER_NAME"].'/SIE_UNACH/Home/');
	define('Ipserver', $_SERVER["SERVER_NAME"]);
	define('Puerto', 3128);


class OpenConexion extends PDO{

	private $srv = "localhost"; // PostgreSQL server host
 	private $usr = "postgres"; // PostgreSQL user
 	private $pas = "bersa"; // PostgreSQL password
 	private $dba = "sie_unach"; // PostgreSQL database
 	private $prt="5432";

 	private $modulos=array('Home','Preguntas','Encuesta','Catalogo_respuesta','Respuestas','Catalogo_pregunta','Encuestas_creadas','Editar_catalogo_pregunta','Editar_catalogo_respuesta','Registrar_encuestador','Mostrar_encuestadores','Encuesta_resuelta','New_bono','Reclamo_premio','Conteo','Add_cat_pregunta','Add_cat_respuesta','Institucion');
 	
 	public $C_Egresado_log=array('Que_es','Egresado','Encuesta','Aplicacion');

	public $C_Egresado=array('Inicio','Que_es');

 	public $Conn;

	public function __construct() { 
		$this->conectar(); 
	}
 	

 	private final function conectar() {
	
	 $this->Conn = null;
 
	try{
 		$this->Conn = new PDO("pgsql:host = $this->srv;port= $this->prt;dbname= $this->dba;user= $this->usr;password= $this->pas");
 		$this->Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 		
		}catch(PDOException $e) {
			echo "Ocurrio un error al accesar a la base de datos".$e->getMessage(); 
 		}

 	}

 	public final function Close(){
 		$this->Conn=null;
 	}

 	public final function select($argumento,$datos=array()){

 		$statements=$this->Conn->prepare($argumento);

 		if(is_array($datos)){
 			$statements->execute($datos);
 		}else{
 			$statements->execute();
 		}
 		$this->Close();
 		return $statements->fetchAll(PDO::FETCH_ASSOC);
 	}

 	public function View($param=''){
		if (isset($param)) {
			$rutas=array();
			$rutas=explode("-", $param);
			if (in_array($rutas[0], $this->modulos)) {
				require "./assets/{$rutas[0]}.php";
			}else{
				require "./assets/PageError.html";
			}
		}
	}

	public function loginAdmin($user="",$pass=""){
	
		$data=array(
			"user"=>strip_tags($user),
			"pass"=>strip_tags($pass)
		);

		$user=$this->Conn->prepare("select * from admin where correo_admin=:user and 	passwd=md5(:pass) limit 1");
	
		$user->execute($data);

		if($user->rowCount() > 0 ){
			$admin=$user->fetch(PDO::FETCH_ASSOC);
			session_start();
			return $_SESSION["administrador"]=$admin['nombre_admin']." ".$admin['ape_pat_admin']." ".$admin['ape_mat_admin'];
		}else{
			return null;
		}
	}
/*
public function login($query=''){//Verificación del
			$numero=0;
			$admin='';
			$query=$this->Conn->query($query);
			//$numero=pg_num_rows($this->query);
			if($query->rowCount() > 0 ){
				$admin=$query->fetch(PDO::FETCH_ASSOC);
				session_start();
				return $_SESSION["egresado"]=$admin ;
			}else{
				return null;
			}

		}*/



		public function EntrarCookie(){
			$data=array(
				"user"=>$_COOKIE['SESSION_']['CORREO'],
				"pass"=>$_COOKIE['SESSION_']['PASS']
			);
			$admin=$this->Conn->prepare("select * from admin where correo_admin=:user and passwd=:pass limit 1");
			$admin->execute($data);
			if($admin->rowCount() > 0 ){
				$Result=$admin->fetch(PDO::FETCH_ASSOC);
				$_SESSION["administrador"]=$Result['nombre_admin']." ".$Result['ape_pat_admin']." ".$Result['ape_mat_admin'];
				//$_SESSION['tiempo']=time();
				 echo "<script>window.location='./Home';</script>";
			}else{
				return null;
			}
		}


		public function cat_preguntas(){
	
	$Preguntas=$this->Conn->prepare("select * from cat_pregunta where status=1 order by idcatalogo_p");
	$Preguntas->execute();
	$Datos=$Preguntas->fetchAll(PDO::FETCH_ASSOC);
	$Respuesta=array();

	foreach ($Datos as $value) {
		$d=array("id"=>strip_tags($value['idcatalogo_p']));
		$P=$this->Conn->prepare("select * from pregunta p inner join det_cat_pregunta dp on (p.idpregunta=dp.idpregunta) where dp.idcatalogo_p=:id and dp.status=1 order by dp.cns_det_pregunta desc");
		$P->execute($d);
		$D=$P->fetchAll(PDO::FETCH_ASSOC);
		
		$Respuesta=array(
			$value['nom_cat_pregunta']=>$D
		);
	}
	
	return $Respuesta;

		}


   public function grafica($id,$info=array()){

echo '<script>
    var config = {
        type: "pie",
        data: {
            datasets: [{
                data: ['; 
					foreach ($info as $key => $value) {
						foreach ($value as $k => $v) {
							echo "Math.round(".$v."),";
						}
					}echo '],
					backgroundColor: [
                    	"#1aa5e0",
                    	"#0edb79",
                    	"#F7464A",
                    	"#46BFBD",
                    	"#FDB45C",
                    	"#949FB1",
                    	"#4D5360",
                	],
            	}, 		],
            labels: [';
        		foreach ($info as $key => $value) {
					foreach ($value as $k => $v) {
						echo '"'.$k.'",';
					}
				}
         echo ']
        },
        options: {
            responsive: true
        }
    };

        var ctx = document.getElementById("'.$id.'");
        window.myPie = new Chart(ctx, config);
    </script>';
		}




}































/*	
	if (file_exists('./Constantes.php')) {
		require_once './Constantes.php';
	}else if (file_exists('../Constantes.php')) {
		require_once '../Constantes.php';
	} else if(file_exists('../../Constantes.php')) {
		require_once '../../Constantes.php';
	}else if(file_exists('../../../Constantes.php')) {
		require_once '../../../Constantes.php';
	}else if(file_exists('../../../../Constantes.php')) {
		require_once '../../../../Constantes.php';
	}
	
	class CI_Controller extends AddConexion{

#Variables
	public $host="host="; 
	public $port="port=";
	public $dbnombre="dbname=";
	public $user="user=";
	public $pass="password=";
	private $query='';
    private $fetch='';
    private $conexion=null;

	public function Conexion(){
		$conn=pg_connect ("$this->host".pg_escape_string($this->hostx)." $this->port".pg_escape_string($this->portx)." $this->dbnombre".pg_escape_string($this->dbnamex)." $this->user".pg_escape_string($this->userx)." $this->pass".pg_escape_string($this->passwordx));
		$this->conexion=$conn;
	}


		public function query($sql=''){
		if (isset($sql)) {
			self::Conexion();
			$this->query=pg_query($this->conexion,$sql);
			pg_close($this->conexion);
			return $this->query;
		} 	
	}

	public function close (){
		return pg_close($this->conexion);
	}



	public function transaction($sql=''){
		if (isset($sql)) {
			self::Conexion();
			$this->query=pg_query($this->conexion,$sql);
			//pg_close($this->conexion);
			return $this->query;
		} 	
	}

		public function EntrarCookie(){
			$numero=0;
			$admin='';
			$query='';
			$query=self::query("select * from admin where correo_admin='".pg_escape_string($_COOKIE['SESSION_']['CORREO'])."' and passwd='".pg_escape_string($_COOKIE['SESSION_']['PASS'])."' limit 1");

			$numero=pg_num_rows($query);
			if($numero > 0 ){
				$admin=pg_fetch_array($query);
				$_SESSION["administrador"]=$admin['nombre_admin']." ".$admin['ape_pat_admin']." ".$admin['ape_mat_admin'];
				$_SESSION['tiempo']=time();
				 echo "<script>window.location='./Home';</script>";
			}else{
				return null;
			}

		}

public function loginAdmin($query=''){//Verificación del
			$numero=0;
			$admin='';
			$query=self::query($query);
			$numero=pg_num_rows($query);
			if($numero > 0 ){
				$admin=pg_fetch_array($query);
				session_start();
				return $_SESSION["administrador"]=$admin['nombre_admin']." ".$admin['ape_pat_admin']." ".$admin['ape_mat_admin'];
			}else{
				return null;
			}

		}


	##Aqui termina la conexión a la base de datos##

		public function extraer($text=''){//Aqui se hace un select más rápido
			$this->query=pg_query($this->conexion,'select * from '.pg_escape_string($text));
			return $this->query;
			//$this->query='';
		}

			public function datos($text=''){//Aqui se hace un select más rápido
			$this->query=pg_query($this->conexion,'select * from '.pg_escape_string($text));
			return pg_fetch_all($this->query);
			//$this->query='';
		}

		
		public function tabla ($text='',$column='',$val=''){
		if ($column=='') {
			$info=self::query("select * from ".pg_escape_string($text));
		} else {
			$info=self::query("select * from ".pg_escape_string($text)." where ".pg_escape_string($column)."=".pg_escape_string($val));
	}
	$data=pg_fetch_array($info);
	return $data;
}

		public function grafica($id,$info=array()){

echo '<script>
    var config = {
        type: "pie",
        data: {
            datasets: [{
                data: ['; 
					foreach ($info as $key => $value) {
						foreach ($value as $k => $v) {
							echo "Math.round(".$v."),";
						}
					}echo '],
					backgroundColor: [
                    	"#1aa5e0",
                    	"#0edb79",
                    	"#F7464A",
                    	"#46BFBD",
                    	"#FDB45C",
                    	"#949FB1",
                    	"#4D5360",
                	],
            	}, 		],
            labels: [';
        		foreach ($info as $key => $value) {
					foreach ($value as $k => $v) {
						echo '"'.$k.'",';
					}
				}
         echo ']
        },
        options: {
            responsive: true
        }
    };

        var ctx = document.getElementById("'.$id.'");
        window.myPie = new Chart(ctx, config);
    </script>';
		}

		public function login($query=''){//Verificación del
			$numero=0;
			$admin='';
			$query=self::query($query);
			$numero=pg_num_rows($this->query);
			if($numero > 0 ){
				$admin=pg_fetch_array($query);
				session_start();
				return $_SESSION["egresado"]=$admin ;
			}else{
				return null;
			}

		} 


	public function Data($sql=''){
		if (isset($sql)) {
			$query=self::query($sql);
			$datos=pg_fetch_all($query);
			return $datos;
		} 	
	}

		public function View($param=''){
		if (isset($param)) {
			$rutas=array();
			$rutas=explode("-", $param);
			if (in_array($rutas[0], $this->C_Admin)) {
				include_once "./assets/{$rutas[0]}.php";
			}else{
				include_once "./assets/PageError.html";
			}
		}
	}
	}
*/
?> 