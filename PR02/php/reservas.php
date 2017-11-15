<?php			
$conexion=mysqli_connect("localhost", "root", "", "1718_projecte_2");
	if(!$conexion){
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	} else {
		if (!isset($_REQUEST['reserva'])) {
			echo "No hay datos selecionados para hacer la reserva</br>";
			}else{
			$reserva=$_REQUEST['reserva'];
			foreach ($reserva as $reserva) {
				echo "ID  reservado $reserva</br>";	
			}
		}
		if(!isset($_REQUEST['dejar_disponible'])){
			echo "No hay datos seleccionados para dejar disponible el recurso";
			}else{
			$dejar_disponible=$_REQUEST['dejar_disponible'];
		 	foreach ($dejar_disponible as $dejar_disponible) {
			echo "ID  dejar disponible $dejar_disponible";	
			}
		}
	}

