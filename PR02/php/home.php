<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="/css/diseñocss.css"/>
	</head>
	<body>
			<?php 
			$conexion=mysqli_connect("localhost", "root", "", "1718_projecte_2");
			//Mostramos los datos.
			$user=$_REQUEST['user']; 
			$nombre=("SELECT `Nombre_Usuario`, `Apellido1_Usuario`,`Apellido2_Usuario` FROM tbl_user WHERE Login_Usuario = '$user'");
			$consulta=mysqli_query($conexion,$nombre);
			$numero = mysqli_num_rows($consulta);
			while ($valor = mysqli_fetch_array($consulta)) {
				//Damos la bienvenida al usuario.
				echo '<h2>Bienvenido '.utf8_encode($valor['Nombre_Usuario']).' '.utf8_encode($valor['Apellido1_Usuario']).' '.utf8_encode($valor['Apellido2_Usuario']).'</h2>';
			}
			?>
		  	<div id="FiltroHijo">DISPONIBILIDAD</div>
		   	<select name="disponible">    
		       <option value="Disponible" selected="selected">Disponible</option>
		       <option value="No disponible" selected="selected">No disponible</option>
		   	</select>
		   	<div>
		   	</br></br>	
		   	<div id="FiltroHijo">TIPO DE RECURSO</div>
		   	<select name="tipo_recurso">    
		       <option value="Aula" selected="selected">Aula</option>
		       <option value="Aula con proyector">Aula con proyector</option>
		       <option value="Material informatico">Material informático</option>
		   	</select>
		   </br></br></br></br>	
		   	 <input type="submit" value="Enviar"/>
		   	<button><a style='text-decoration:none;color:black;(otros)' <?php  echo "href='home.php?user=$user'" ?>>Resetear Valores</a></button></br></br>  	
		<center>   	
		<?php
			$conexion=mysqli_connect("localhost", "root", "", "1718_projecte_2");
			if(!$conexion){
			    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			    exit;
			} else {
					//Mostramos los datos.
					$q=("SELECT * FROM tbl_recurso");
					$consulta=mysqli_query($conexion,$q);
					        $numero = mysqli_num_rows($consulta);
					        while ($valores = mysqli_fetch_array($consulta)) {
					          	echo '<form action="reservas.php" method="post">';
					    		
								//Muestra los recursos que están disponibles.
					          	if($valores['Disponibilidad_Recurso'] == "Si"){
					          		
					          		$estado = "Disponible";
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Tipo de recurso: '.utf8_encode($valores['Tipo_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="../img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='reserva[]' value='$valores[Id_Recurso]'>Reservar</input></br></br>";
								//Muestra los recursos que no están disponibles
					          	}elseif($valores['Disponibilidad_Recurso'] == "No"){
					          		$estado = "No disponible";
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="../img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='dejar_disponible[]' value='$valores[Id_Recurso]'>Dejar disponible</input></br></br>";				
							    } 		      
							}
							echo "</br></br><input type='submit' value='Realizar'/>";
				 			echo '</form>';	
				 			echo "<button><a style='text-decoration:none;color:black;(otros)' href='../index.php'>Salir sesión</a></button>"; 
					}
		?>
	</center>
	</body>
</html>