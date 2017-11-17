function letras(evt){

	if(window.event){//asignamos el valor de la tecla a keynum
 		keynum = evt.keyCode; //IE
 	}
	else{
 		keynum = evt.which; //FF
	} 
 	
 	//comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
 	
 	if(keynum == 8 || keynum == 13 || keynum == 6 || (keynum > 64 && keynum < 91 ) || (keynum > 96 && keynum < 123)){
 		return true;
 	}
	else{
  		return false;
 	}

 }

function numeros(evt){

	if(window.event){//asignamos el valor de la tecla a keynum
 		keynum = evt.keyCode; //IE
 	}
	else{
 		keynum = evt.which; //FF
	} 
 	
 	//comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
 	
 	if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6){
 		return true;
 	}
	else{
  		return false;
 	}

 }

function letras_numeros(evt){

	if(window.event){//asignamos el valor de la tecla a keynum
 		keynum = evt.keyCode; //IE
 	}
	else{
 		keynum = evt.which; //FF
	} 
 	
 	//comprobamos si se encuentra en el rango numérico y que teclas no recibirá.
 	
 	if((keynum > 47 && keynum < 58) || keynum == 8 || keynum == 13 || keynum == 6 || (keynum > 64 && keynum < 91 ) || (keynum > 96 && keynum < 123)){
 		return true;
 	}
	else{
  		return false;
 	}

 }

 //funcion de redireccionamiento del login.proc.php

function redirecciona(){
			var miform= document.getElementById('variables');
			miform.submit();
		}
