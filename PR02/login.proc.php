<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="js/funciones.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body onload="return redirecciona();">

	<?php  
		
		//Nos conectamos a la base de datos

		$conexion = mysqli_connect("localhost", "root", "", "1718_projecte_2");
		$acentos = mysqli_query($conexion, "SET NAMES 'utf8'");

		if (!$conexion) {
			//Si no nos podemos conectar mostramos un mensaje de error
			echo "Error: No se puede conectar a MySQL." . PHP_EOL;
			echo "Errno de depuración:  " . mysqli_connect_errno() . PHP_EOL;
			echo "Error de depuración:  " . mysqli_connect_error() . PHP_EOL;
			exit;
		} else{

			
			//Introducimos en una variable los valores que recibimos desde index.php
			$user = $_REQUEST['user'];
			$passwd = $_REQUEST['pass'];
			
			//Creamos la consulta con las variables y la introducimos en otra variable
			$sql = "SELECT * FROM tbl_user WHERE Login_Usuario = '$user' COLLATE utf8_bin AND  Password_Usuario = '$passwd' COLLATE utf8_bin";

			//Lanzamos la consulta
			$login=mysqli_query($conexion, $sql);
			
			//Comprobamos si la consulta nos devuelve algo
			
			if(mysqli_num_rows($login)>0){

				//Si la consulta nos devuelve algo redirigimos al usuario a la página correspondiente
				$datos_user = mysqli_fetch_array($login);

				
				
?>				

			<!--Usando un formulario sin boton de submit y mediante una funcion de javascript que se encuentra en el documento js/funciones.js le decimos que al cargar la pagina nos envie el formulario mediante POST -->

				<form id="variables" action="php/home.php" method="POST">
					<input type="hidden" name="user" value="<?php echo $user; ?>">
			   		<input type="hidden" name="id_user" value="<?php echo $datos_user['Id_Usuario']; ?>">
			   	</form>
				
<?php 

			} else {

				//Si la consulta no devuelve nada redirigimos al usuario de nuevo a la página de login  con un mensaje de error

				header('location: index.php?error=true&&error_msg=El usuario o la contraseña son incorrectos');

				
			}
		}
		


?>

</body>
</html>
