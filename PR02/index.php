<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<script src="js/validar_form.js" type="text/javascript" charset="utf-8" async defer></script>
	<link rel="stylesheet" type="text/css" href="css/login.css"/>
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
	<div class="login">
	<h1>Login</h1>	
	<form action="login.proc.php" method="post" accept-charset="utf-8">
		<input type="text" name="user" placeholder="Usuario"  required onkeypress="return letras(event)"><br><br>
		<input type="password" placeholder="Contraseña" name="pass" required onkeypress="return letras_numeros(event)"><br><br>
		<button type="submit" class="btn btn-primary btn-block btn-large" value="Entrar">Entrar</button>
	</form>
	</div>
</body>
</html>