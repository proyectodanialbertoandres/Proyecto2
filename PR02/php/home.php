<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../css/diseño.css"/>
	</head>
	<body>	
			<?php 
			$conexion=mysqli_connect("localhost", "root", "", "1718_projecte_2");
			$acentos = mysqli_query($conexion, "SET NAMES 'utf8'");
			if(!$conexion){
			    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			    exit;
			    } else {
				//Mostramos los datos.
					$user=$_REQUEST['user']; 
					$nombre=("SELECT `Nombre_Usuario`, `Apellido1_Usuario`,`Apellido2_Usuario` FROM tbl_user WHERE Login_Usuario = '$user'");
					$consulta=mysqli_query($conexion,$nombre);
					$numero = mysqli_num_rows($consulta);
					while ($valor = mysqli_fetch_array($consulta)) {
					
					//Damos la bienvenida al usuario.
					echo '<h2>Bienvenido '.$valor['Nombre_Usuario'].' '.$valor['Apellido1_Usuario'].' '.$valor['Apellido2_Usuario'].' '.'<button class="btn-success"><a style="text-decoration:none;color:white;(otros)" href="../index.php">Salir sesión</a></button>'.'</h2>';
					}	
				}
			?>
			<form action="home.php?user=<?php echo "$user" ?>">
			<div class="login">
		   	<select name="disponibilidad">    
		       <option value="" selected="selected">Disponibilidad:</option>  
		       <option value="Si">Disponible</option>
		       <option value="No">No disponible</option>
		   	</select>
		   	</br></br></br>
		   	<div class="select">	
		   	<select name="tiporecurso">
		   		<option value="" selected="selected">Tipo de recurso:</option>    
		       	<option value="Aula">Aula</option>
		       	<option value="Aula con material informático">Aula con material informático</option>
		       	<option value="Material informático">Material informático</option>
		   	</select>
		   </div>
		   	</br></br></br></br></br>		   
		   	<input type="hidden" name="user" value="<?php echo "$user" ?>">
		   	<input type="hidden" name="id_user" value="<?php echo "$id_user" ?>">
		   	<button type="submit" name="enviar" value="enviar " class="btn-success">Enviar</button>
		   	<button class="btn-success"><a style='text-decoration:none;color:white;(otros)' <?php  echo "href='home.php?user=$user'" ?>>Resetear Valores</a></button></br></br>
		   </div>
		   	</form>



			<?php


			//Filtro

			$q=("SELECT * FROM tbl_recurso");
			$cont= false;
			
			
			if (isset($_REQUEST['enviar'])) {
				$disponibilidad = $_REQUEST['disponibilidad'];
				$tiporecurso = $_REQUEST['tiporecurso'];

				if ($disponibilidad != "") {
			
					$q .= " WHERE Disponibilidad_Recurso = '$disponibilidad'";
					$cont = true;
				}

				if ($tiporecurso!="" && $cont == false) {

					$q .= " WHERE Tipo_Recurso = '$tiporecurso'";
					$cont = true;

				} elseif ($tiporecurso!="" && $cont == true) {

					$q .= " AND Tipo_Recurso = '$tiporecurso'";
				}

				
			
			} 
			
			$consulta=mysqli_query($conexion,$q);
			
				while ($valores = mysqli_fetch_array($consulta)) {
		          	echo '<form action="reserva.proc.php" method="get">';
		          	echo "<div class='todomostrar'>";
		          	echo "<div class='mostrar'>";
	    			echo '<b><u>Recurso:</u></b> '.$valores['Nombre_Recurso'].'</br>';
					echo '<b><u>Descripción:</u></b> '.$valores['Descripcion_Recurso'].'</br>';
					echo '<b><u>Tipo de recurso:</u></b> '.$valores['Tipo_Recurso'].'</br>';
					echo '<b><u>Disponible:</u></b> '.$valores['Disponibilidad_Recurso']. '</br></br>';
					echo '<img width="300" src="../img/'.$valores['Fotos_Recurso'].'"></br></br>';
					if($valores['Disponibilidad_Recurso'] == "Si"){
						echo "<input type='checkbox' name='reserva[]' value='$valores[Id_Recurso]'><b>Reservar</b></input></br>";
					}else{
						echo "<input type='checkbox' name='reserva[]' value='$valores[Id_Recurso]'><b>Dejar disponible</b></input></br>";		
					}
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}	
					echo "<div class='mover'>";
					echo "<input type='submit'class='btn-success' value='Realizar'/>";
					echo "</div>";
		 			echo '</form>';	
		 	
		?>
	</body>
</html>