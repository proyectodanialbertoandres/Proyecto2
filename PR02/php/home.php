<html>
	<head>
		<title></title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="../CSS/diseño.css"/>
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
				    	if (!isset($_REQUEST['user'])) {
				    		header('Location: ../index.php');
				    	}else{
					//Mostramos los datos.
						$user=$_REQUEST['user'];
						$id_user = $_REQUEST['id_user']; 
						$nombre=("SELECT `Nombre_Usuario`, `Apellido1_Usuario`,`Apellido2_Usuario` FROM tbl_user WHERE Login_Usuario = '$user'");
						$consulta=mysqli_query($conexion,$nombre);
						$valor = mysqli_fetch_array($consulta);

										
						//Damos la bienvenida al usuario.
						echo '<h2>Bienvenido '.$valor['Nombre_Usuario'].' '.$valor['Apellido1_Usuario'].' '.$valor['Apellido2_Usuario'].' '.'<button class="btn-success"><a style="text-decoration:none;color:white;(otros)" href="../index.php">Salir sesión</a></button>'.'</h2>';
						}
					}
?>
				<form action="home.php" method="POST">
				<div class="login">
				<div class="select">
				   	<select name="disponibilidad">    
				       <option value="" selected="selected">Disponibilidad:</option>  
				       <option value="Si">Disponible</option>
				       <option value="No">No disponible</option>
				   	</select>
				   	<div class="select_arrow"></div>
			   </div>
			   	</br></br></br></br>
			   	<div class="select">
				   	<select name="tiporecurso">
				   		<option value="" selected="selected">Tipo de recurso:</option>    
				       	<option value="Aula">Aula</option>
				       	<option value="Aula con material informático">Aula con material informático</option>
				       	<option value="Material informático">Material informático</option>
			   		</select>
				   	<div class="select_arrow"></div>
			   </div>
			   </br></br></br></br></br>
			   <div class="select">	
				   	<select name="usorecurso">
				   		<option value="" selected="selected">Uso de los recursos:</option>    
				       	<option value="DESC">Con mayor uso primero</option>
				       	<option value="ASC">Con menor uso primero</option>
				   	</select>
				  	<div class="select_arrow"></div>
			   </div>
			   	</br></br></br></br>	   
			   	<input type="hidden" name="user" value="<?php echo "$user" ?>">
			   	<input type="hidden" name="id_user" value="<?php echo "$id_user" ?>">
			   	<button type="submit" name="enviar" value="enviar" class="btn-success">Ver</button>
			   	<button class="btn-success" type="submit" name="reset"><a style='text-decoration:none;color:white;(otros)'>Resetear Valores</a></button></br></br>
			   </div>
			   	</form>



<?php


				//Filtro

				$q=("SELECT * FROM tbl_recurso");
				$cont= false;

				if (isset($_REQUEST['reset'])) {

					$q .=" ORDER BY";
				}
				
				
				if (isset($_REQUEST['enviar'])) {
					$disponibilidad = $_REQUEST['disponibilidad'];
					$tiporecurso = $_REQUEST['tiporecurso'];
					$usorecurso = $_REQUEST['usorecurso'];

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

					if ($usorecurso!="") {

						$q .= " ORDER BY Uso_Recurso $usorecurso,"; 
						$cont = true;

					} else{

						$q .=" ORDER BY";

					}				
				
				} 





				$q .= " Tipo_Recurso";
				
				$consulta=mysqli_query($conexion,$q);

				
				if (mysqli_num_rows($consulta) == 0) {

					echo "<div class='nmostrar'><h1>No hay datos que mostrar</h1></div>";
					
				}else{
				
					while ($valores = mysqli_fetch_array($consulta)) {
			          	echo '<form action="reserva.proc.php" method="get">';
			          	echo "<div class='todomostrar'>";
			          	echo "<div class='mostrar'>";
		    			echo '<b>Recurso:</u></b> '.$valores['Nombre_Recurso'].'</br></br>';
						echo '<b>Descripción:</b> '.$valores['Descripcion_Recurso'].'</br></br>';
						echo '<b>Tipo de recurso:</u></b> '.$valores['Tipo_Recurso'].'</br></br>';
						echo '<b>Disponible:</u></b> '.$valores['Disponibilidad_Recurso']. '</br></br>';
						echo "<b>Horas totales de uso:</b> $valores[Uso_Recurso]</br></br>";
						echo '<img width="300" src="../img/'.$valores['Fotos_Recurso'].'"></br></br>';
						
						if($valores['Disponibilidad_Recurso'] == "Si"){
							
							echo "<input type='checkbox' name='reserva[]' value='$valores[Id_Recurso]'><b>Reservar</b></input></br>";
							
						}else {

							$q="SELECT * FROM tbl_recurso LEFT JOIN tbl_reserva_recurso ON tbl_recurso.Id_Recurso = tbl_reserva_recurso.Id_Recurso LEFT JOIN tbl_reserva on tbl_reserva.Id_Reserva = tbl_reserva_recurso.Id_Reserva WHERE tbl_reserva_recurso.Fecha_Fin = '' AND tbl_recurso.Id_Recurso = $valores[Id_Recurso]";
							$consulta_user=mysqli_query($conexion,$q);
							$user_log = mysqli_fetch_array($consulta_user);

							if ($id_user == $user_log['Id_Usuario']) {

								echo "<input type='checkbox' name='reserva[]' value='$valores[Id_Recurso]'><b>Dejar disponible</b></input></br>";
								
							}else{
								echo "<b>Reservado por última vez:</b> $user_log[Fecha_Ini]</br>";
							}
							
							

										
						}
						
						
						

							
				
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}	
						echo "<div class='mover'>";
						echo "<input type='hidden' name='user' value='$user'>";
						echo "<input type='hidden' name='id_user' value='$id_user'>";
						echo "<input type='submit'class='btn-success' value='Realizar la petición'/>";
						echo "</div>";
			 			echo '</form>';	
			 	}

		 	
?>
	</body>
</htmlx>