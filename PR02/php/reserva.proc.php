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

						foreach ($reservas as $reserva) {
							
							//Introducimos un nuevo registro en tbl_reserva mediante la id del usuario logeado
											
							$q = "INSERT INTO `tbl_reserva` (Id_Usuario) SELECT `Id_Usuario` FROM `tbl_user` WHERE `Id_Usuario` = $id_user";
							$insert_reserva=mysqli_query($conexion,$q);

							//Recuperamos la ultima id creada en tbl_reserva en una variable

							$rs = "SELECT MAX(Id_Reserva) AS id FROM tbl_reserva";
							$ultima_id = mysqli_query($conexion,$rs);
							
							$id = mysqli_fetch_array($ultima_id);

							//Introducimos un nuevo registro en tbl_reserva_recurso en funcion del array $reservas y tambien recogemos la hora y la fecha del momento en el que se realiza la acción
								
							foreach ($reservas as $reserva) {
								$q = "INSERT INTO `tbl_reserva_recurso` (Fecha_Ini, Id_Reserva, Id_Recurso) VALUES (Date_format(now(),'%Y-%m-%d %H:%i:%s %p'), $id[id], $reserva)";
								$insert_reserva=mysqli_query($conexion,$q);
							}	
							
							//Actualizamos la disponibilidad del recurso en la tabla tbl_recurso

							$q = "UPDATE `tbl_recurso` SET `Disponibilidad_Recurso`='No' WHERE ";
							
							foreach ($reservas as $reserva) {
								$q.="`Id_Recurso` = $reserva OR ";
								
							}
							//En caso de que sobre un OR lo eliminamos con esta función
							$q=substr($q, 0, -3);
							$consulta=mysqli_query($conexion,$q);
						
						}
					
					}
					
				}

				
				





				

				
			}


			header("location: home.php?user=$user&&id_user=$id_user[Id_Usuario]");

?>	