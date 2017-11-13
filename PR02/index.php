<!DOCTYPE html>
<html>
<head>
	<title>LogIn</title>
	<script src="js/validar_form.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>

	<?php  

		//Comprobamos que la variable $_REQUEST['error'] esté vacia
		
		if (!isset($_REQUEST['error'])) {
			
	
		} else{

			//Si  no esta vacia comprobamos si está en true o false

			if ($_REQUEST['error'] == true) {

				//Si esta en true mostramos el mensaje de error que pasamos por url desde login.proc.php
				
				echo "<h1>$_REQUEST[error_msg]</h1>";
			}

		}



	?>

	<form action="login.proc.php" method="get" accept-charset="utf-8">
		Usuario: <input type="text" name="user"  required onkeypress="return letras(event)"><br><br>
		Password: <input type="password" name="pass" required onkeypress="return letras_numeros(event)"><br><br>
		<input type="submit" value="Entrar">
	</form>
	
</body>
</html>