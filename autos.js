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
		if ((nombre.length<1)||(nombre.length>15)) {
			alert("ERROR. El nombre debe tener entre 1 y 15 caracteres");
			document.f_autos.nombre.style.background="red";
			return;
		}
		if ((ap_pat.length<1)||(ap_pat.length>15)) {
			alert("ERROR. El Apellido Paterno debe tener entre 1 y 15 caracteres");
			document.f_autos.ap_pat.style.background="red";
			return;
		}
		if ((ap_mat.length<1)||(ap_mat.length>15)) {
			alert("ERROR. El Apellido Materno debe tener entre 1 y 15 caracteres");
			document.f_autos.ap_mat.style.background="red";
			return;
		}
		if ((folio.length!=5)||(folio.charAt(0)!='F')){
			alert("Error, el folio debe tener 5 posiciones en total y debe empezar por F mayuscula");
			document.f_autos.folio.style.background="red";
			return;		
		}
		
		
			
			//alert("letras="+letras+" numeros="+numeros);
			//alert(isAlpha(letras));
			//alert(isNumber(numeros));
			
			
				puntaje=parseInt(puntaje);
				if ((puntaje<1) || (puntaje>1200)){
					alert("Error, el puntaje debe estar entre 1 y 1200");
					document.f_autos.puntaje.style.background="red";
				}
				else{
					url="http://localhost/pfinal/autos.php?op=1";
					url=url+"&folio="+folio+"&nombre="+nombre+"&ap_pat="+ap_pat;
					url=url+"&ap_mat="+ap_mat+"&puntaje="+puntaje;
					//alert(url);
					location.href=url;
				} // Valida tamaño del puntaje
			 // Valida letras y núneros en las folio
		 // Valida que las folio tengan 7 posiciones exactas
	} // Valida los campos obligatorios
}

function consultas(op){
	folio=document.f_autos.folio.value;
	document.f_autos.folio.style.background="blue";
	folio=folio.toUpperCase();
	if (folio.length==0){
		alert("Error, el folio es obligatorio para una consulta");
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
		alert("Error, el folio es obligatorio para una baja");
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
