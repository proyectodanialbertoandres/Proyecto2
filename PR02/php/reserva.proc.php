<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="../js/funciones.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body onload="return redirecciona();">

<?php  


$reservas = $_REQUEST['reserva'];
$user = $_REQUEST['user'];
$id_user = $_REQUEST['id_user'];


$conexion=mysqli_connect("localhost", "root", "", "1718_projecte_2");
			if(!$conexion){
			    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
			    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
			    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
			    exit;
			} else {
				


				foreach ($reservas as $reserva) {
					
					$q="SELECT `Disponibilidad_Recurso` FROM `tbl_recurso` WHERE `Id_Recurso` = $reserva";
					$consulta=mysqli_query($conexion,$q);

					$disponibilidad = mysqli_fetch_array($consulta);

					if ($disponibilidad['Disponibilidad_Recurso'] == 'Si') {

						
							
						//Introducimos un nuevo registro en tbl_reserva mediante la id del usuario logeado
										
						$q = "INSERT INTO `tbl_reserva` (Id_Usuario) SELECT `Id_Usuario` FROM `tbl_user` WHERE `Id_Usuario` = $id_user";
						$insert_reserva=mysqli_query($conexion,$q);

						//Recuperamos la ultima id creada en tbl_reserva en una variable

						$rs = "SELECT MAX(Id_Reserva) AS id FROM tbl_reserva";
						$ultima_id = mysqli_query($conexion,$rs);
						
						$id = mysqli_fetch_array($ultima_id);

						//Introducimos un nuevo registro en tbl_reserva_recurso en funcion del array $reservas y tambien recogemos la hora y la fecha del momento en el que se realiza la acción
						
						$fechaactual = getdate();
						
						$q = "INSERT INTO `tbl_reserva_recurso` (Fecha_Ini, Id_Reserva, Id_Recurso) VALUES ('$fechaactual[year]-$fechaactual[mon]-$fechaactual[mday] $fechaactual[hours]:$fechaactual[minutes]:$fechaactual[seconds]', $id[id], $reserva)";
						$insert_reserva=mysqli_query($conexion,$q);
						
						
						//Actualizamos la disponibilidad del recurso en la tabla tbl_recurso

						$q = "UPDATE `tbl_recurso` SET `Disponibilidad_Recurso`='No' WHERE `Id_Recurso` = $reserva ";
						
						
						//En caso de que sobre un OR lo eliminamos con esta función
						
						$consulta=mysqli_query($conexion,$q);
						
						
					
					} else{

						//Recuperamos la id creada en tbl_reserva_recurso en una variable

						$rs = "SELECT Id_Reserva_Recurso AS id FROM tbl_reserva_recurso WHERE Id_Recurso = $reserva AND Fecha_Fin = '' ";
						$ultima_id = mysqli_query($conexion,$rs);
						
						$id = mysqli_fetch_array($ultima_id);

						

						//Introducimos un nuevo registro en tbl_reserva_recurso en funcion del array $reservas y tambien recogemos la hora y la fecha del momento en el que se realiza la acción
						
						$fechaactual = getdate();
						
						$q = "UPDATE`tbl_reserva_recurso` SET Fecha_Fin = '$fechaactual[year]-$fechaactual[mon]-$fechaactual[mday] $fechaactual[hours]:$fechaactual[minutes]:$fechaactual[seconds]' WHERE Id_Reserva_Recurso = $id[id]";
						$insert_reserva=mysqli_query($conexion,$q);

						//Calculamos el tiempo de uso de la ultima reserva

						$q="SELECT SEC_TO_TIME((TIMESTAMPDIFF(MINUTE ,tbl_reserva_recurso.Fecha_Ini,tbl_reserva_recurso.Fecha_Fin ))*60) AS h_total  FROM tbl_reserva_recurso WHERE Id_Reserva_Recurso = $id[id]";

						$horas_uso = mysqli_query($conexion,$q);
						$horas = mysqli_fetch_array($horas_uso);

											

						//Actualizamos la disponibilidad del recurso y el uso total en la tabla tbl_recurso

						$q = "UPDATE `tbl_recurso` SET `Disponibilidad_Recurso`='Si',`Uso_Recurso` = (SELECT ADDTIME('$horas[h_total]', `Uso_Recurso`)) WHERE `Id_Recurso` = $reserva";
						
											
						$update_recurso = mysqli_query($conexion,$q);


					}
					
				}

				
				





				

				
			

?>				

			<!--Usando un formulario sin boton de submit y mediante una funcion de javascript que se encuentra en el documento js/funciones.js le decimos que al cargar la pagina nos envie el formulario mediante POST -->

				<form id="variables" action="home.php" method="POST">
					<input type="hidden" name="user" value="<?php echo $user; ?>">
			   		<input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
			   	</form>
				
<?php 
			}
?>	

</body>
</html>