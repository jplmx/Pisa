function isAlpha(cadena){
	return /^[a-zA-Z()]+$/.test(cadena);
}

function isNumber(cadena){
	return /^[0-9()]+$/.test(cadena);
}

function altas(op){
	folio=document.f_autos.folio.value;
	nombre=document.f_autos.nombre.value;
	ap_pat=document.f_autos.ap_pat.value;
	ap_mat=document.f_autos.ap_mat.value;
	puntaje=document.f_autos.puntaje.value;

	document.f_autos.folio.style.background="blue";
	document.f_autos.nombre.style.background="blue";
	document.f_autos.ap_pat.style.background="blue";
	document.f_autos.ap_mat.style.background="blue";
	document.f_autos.puntaje.style.background="blue";

	if ((folio.length==0) || (nombre.length==0) || (ap_pat.length==0) || (ap_mat.length==0) || (puntaje.length==0)){
		alert("Error, todos los campos son obligatorios");
		if (folio.length==0) document.f_autos.folio.style.background="red";
		if (nombre.length==0) document.f_autos.nombre.style.background="red";
		if (ap_pat.length==0) document.f_autos.ap_pat.style.background="red";
		if (ap_mat.length==0) document.f_autos.ap_mat.style.background="red";
		if (puntaje.length==0) document.f_autos.puntaje.style.background="red";
	}
	else{
		if (folio.length!=7){
			alert("Error, las folio deben tener 3 letras y 4 dígitos, 7 posiciones en total");
			document.f_autos.folio.style.background="red";
		}
		else{
			folio=folio.toUpperCase();
			letras=folio.substr(0,3);
			numeros=folio.substr(3,4);
			//alert("letras="+letras+" numeros="+numeros);
			//alert(isAlpha(letras));
			//alert(isNumber(numeros));
			if ((!isAlpha(letras)) || (!isNumber(numeros))){
				alert("Error, las folio deben tener 3 letras y 4 dígitos, 7 posiciones en total");
				document.f_autos.folio.style.background="red";
			}
			else{
				puntaje=parseInt(puntaje);
				if ((puntaje<1600) || (puntaje>4200)){
					alert("Error, el tamaño del puntaje debe estar entre 1600 y 4200 CC");
					document.f_autos.puntaje.style.background="red";
				}
				else{
					url="http://localhost/pfinal/autos.php?op=1";
					url=url+"&folio="+folio+"&nombre="+nombre+"&ap_pat="+ap_pat;
					url=url+"&ap_mat="+ap_mat+"&puntaje="+puntaje;
					//alert(url);
					location.href=url;
				} // Valida tamaño del puntaje
			} // Valida letras y núneros en las folio
		} // Valida que las folio tengan 7 posiciones exactas
	} // Valida los campos obligatorios
}

function consultas(op){
	folio=document.f_autos.folio.value;
	document.f_autos.folio.style.background="blue";
	folio=folio.toUpperCase();
	if (folio.length==0){
		alert("Error, las folio son obligatorias para una consulta");
		document.f_autos.folio.style.background="red";
	}
	else{
		url="http://localhost/pfinal/autos.php?op=2";
		url=url+"&folio="+folio;
		//alert(url);
		location.href=url;
	}
}

function bajas(op){
	folio=document.f_autos.folio.value;
	document.f_autos.folio.style.background="blue";
	folio=folio.toUpperCase();
	if (folio.length==0){
		alert("Error, las folio son obligatorias para una baja");
		document.f_autos.folio.style.background="red";
	}
	else{
		url="http://localhost/pfinal/autos.php?op=3";
		url=url+"&folio="+folio;
		//alert(url);
		location.href=url;
	}
}

function listado(){
	url="http://localhost/pfinal/autos.php?op=4";
	location.href=url;
}
