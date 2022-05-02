function isAlpha(cadena){
	return /^[a-zA-Z()]+$/.test(cadena);
}

function isNumber(cadena){
	return /^[0-9()]+$/.test(cadena);
}

function altas(op){
	placas=document.f_autos.placas.value;
	marca=document.f_autos.marca.value;
	tipo=document.f_autos.tipo.value;
	color=document.f_autos.color.value;
	motor=document.f_autos.motor.value;

	document.f_autos.placas.style.background="blue";
	document.f_autos.marca.style.background="blue";
	document.f_autos.tipo.style.background="blue";
	document.f_autos.color.style.background="blue";
	document.f_autos.motor.style.background="blue";

	if ((placas.length==0) || (marca.length==0) || (tipo.length==0) || (color.length==0) || (motor.length==0)){
		alert("Error, todos los campos son obligatorios");
		if (placas.length==0) document.f_autos.placas.style.background="red";
		if (marca.length==0) document.f_autos.marca.style.background="red";
		if (tipo.length==0) document.f_autos.tipo.style.background="red";
		if (color.length==0) document.f_autos.color.style.background="red";
		if (motor.length==0) document.f_autos.motor.style.background="red";
	}
	else{
		if (placas.length!=7){
			alert("Error, las placas deben tener 3 letras y 4 dígitos, 7 posiciones en total");
			document.f_autos.placas.style.background="red";
		}
		else{
			placas=placas.toUpperCase();
			letras=placas.substr(0,3);
			numeros=placas.substr(3,4);
			//alert("letras="+letras+" numeros="+numeros);
			//alert(isAlpha(letras));
			//alert(isNumber(numeros));
			if ((!isAlpha(letras)) || (!isNumber(numeros))){
				alert("Error, las placas deben tener 3 letras y 4 dígitos, 7 posiciones en total");
				document.f_autos.placas.style.background="red";
			}
			else{
				motor=parseInt(motor);
				if ((motor<1600) || (motor>4200)){
					alert("Error, el tamaño del motor debe estar entre 1600 y 4200 CC");
					document.f_autos.motor.style.background="red";
				}
				else{
					url="http://localhost/pfinal/autos.php?op=1";
					url=url+"&placas="+placas+"&marca="+marca+"&tipo="+tipo;
					url=url+"&color="+color+"&motor="+motor;
					//alert(url);
					location.href=url;
				} // Valida tamaño del motor
			} // Valida letras y núneros en las placas
		} // Valida que las placas tengan 7 posiciones exactas
	} // Valida los campos obligatorios
}

function consultas(op){
	placas=document.f_autos.placas.value;
	document.f_autos.placas.style.background="blue";
	placas=placas.toUpperCase();
	if (placas.length==0){
		alert("Error, las placas son obligatorias para una consulta");
		document.f_autos.placas.style.background="red";
	}
	else{
		url="http://localhost/pfinal/autos.php?op=2";
		url=url+"&placas="+placas;
		//alert(url);
		location.href=url;
	}
}

function bajas(op){
	placas=document.f_autos.placas.value;
	document.f_autos.placas.style.background="blue";
	placas=placas.toUpperCase();
	if (placas.length==0){
		alert("Error, las placas son obligatorias para una baja");
		document.f_autos.placas.style.background="red";
	}
	else{
		url="http://localhost/pfinal/autos.php?op=3";
		url=url+"&placas="+placas;
		//alert(url);
		location.href=url;
	}
}

function listado(){
	url="http://localhost/pfinal/autos.php?op=4";
	location.href=url;
}