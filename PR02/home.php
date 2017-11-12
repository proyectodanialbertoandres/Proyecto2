<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php
			$conexion=mysqli_connect("localhost", "root", "", "1718_projecte_2");
			if(!$conexion){
			    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			    exit;
			} else {
					//Damos la bienvenida al usuario.
					// $user=$_REQUEST['user'];
					// echo "<h2>Bienvenido $user</h2>";
					//Mostramos los datos.
					$q=("SELECT * FROM tbl_recurso");
					$consulta=mysqli_query($conexion,$q);
					        $numero = mysqli_num_rows($consulta);                                  
					        while ($valores = mysqli_fetch_array($consulta)) {

					          	if ($valores['Disponibilidad_Recurso']) {
					          		
					          	}
					          	echo '<form action="reserva.php" method="post">';
					    		
								//Muestra los recursos que están disponibles.
					          	if($valores['Disponibilidad_Recurso'] == "Si"){
					          		$estado = "Disponible";

					          	if ($valores['Id_Recurso'] == 1){
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Tipo de recurso: '.utf8_encode($valores['Tipo_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='reserva' value='reserva'>Reservar</input>";
								}
								if ($valores['Id_Recurso'] >= 2 && $valores['Id_Recurso'] < $numero ){
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Tipo de recurso: '.utf8_encode($valores['Tipo_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='reserva' value='reserva'>Reservar</input>";
								}
								if ($valores['Id_Recurso'] == $numero){
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Tipo de recurso: '.utf8_encode($valores['Tipo_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='reserva' value='reserva'>Reservar</input>";
								}
								echo'</form>';

								//Muestra los recursos que no están disponibles
					          	}elseif($valores['Disponibilidad_Recurso'] == "No"){
					          		$estado = "No disponible";
					          	echo '<form action="devolver.php" method="post">';
			          			if ($valores['Id_Recurso'] == 1){
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='dejar_disponible' value='dejar_disponible'>Dejar disponible</input>";
								}
								if ($valores['Id_Recurso'] >= 2 && $valores['Id_Recurso'] < $numero ){
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='dejar_disponible' value='dejar_disponible'>Dejar disponible</input>";
								}
								if ($valores['Id_Recurso'] == $numero){
									echo 'Recurso: '.utf8_encode($valores['Nombre_Recurso']).'</br>';
									echo 'Descripción: '.utf8_encode($valores['Descripcion_Recurso']).'</br>';
									echo 'Estado: '.$estado. '</br>';
									echo 'Foto:<br/> <img width="300" src="img/'.$valores['Fotos_Recurso'].'"></br>';
									echo "<input type='checkbox' name='dejar_disponible' value='dejar_disponible'>Dejar disponible</input>";
								}
								echo '</form>';	
							    }    
							}
				 
					}
		?>
	</body>
</html>