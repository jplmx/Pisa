<html>

	<head>
		<meta charset="utf-8">
		<title>Autos</title>
		<link href="efectos_autos.css" rel="stylesheet" type="text/css">
		<script src="autos.js" type="text/JavaScript"></script>
	</head>

	<body><center>
	<?php
		$op=$_GET['op'];
		if ($op==0) formulario();
		if ($op==1) altas();
		if ($op==2) consultas();
		if ($op==3) bajas();
		if ($op==4) listado();

		function altas(){
			global $op, $folio, $nombre, $ap_pat, $ap_mat, $puntaje;
			$folio=$_GET['folio'];
			$nombre=$_GET['nombre'];
			$ap_pat=$_GET['ap_pat'];
			$ap_mat=$_GET['ap_mat'];
			$puntaje=$_GET['puntaje'];
			

			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");

			$cbd=mysqli_select_db($cs,"registro_pisa");
			// ****************************************************
			$query="INSERT INTO puntajes VALUES('$folio','$nombre','$ap_pat','$ap_mat','$puntaje')";
			
			$sql=mysqli_query($cs,$query);
			if (mysqli_affected_rows($cs)<0){
				echo "
					<font size='6' color='red'>
					Error, el folio está duplicado en la base de datos
					</font>
					<br><br>
					<a href='http://localhost/pfinal/autos.php?op=0'>
					Regresar
					</a>
				";
			}
			else{
				echo "
					<font size='6' color='blue'>
					El registro ha sido grabado
					</font>
					<br><br>
					<a href='http://localhost/pfinal/autos.php?op=0'>
					Regresar
					</a>
				";
			} // Validación de que no se duplique
		}

		function consultas(){
			global $op, $folio, $nombre, $ap_pat, $ap_mat, $puntaje;
			$folio=$_GET['folio'];
			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");
			$cbd=mysqli_select_db($cs,"registro_pisa");
			// ****************************************************
			$query="SELECT * FROM puntajes WHERE folio='$folio'";
			$sql=mysqli_query($cs,$query);
			$reg=mysqli_fetch_object($sql);
			if ($reg==mysqli_fetch_array($sql)){
				echo "
					<font size='6' color='red'>
					Error, el folio NO existe en la base de datos
					</font>
					<br><br>
					<a href='http://localhost/pfinal/autos.php?op=0'>
					Regresar
					</a>
				";
			}
			else{
				$nombre=$reg->nombre;
				$ap_pat=$reg->ap_pat;
				$ap_mat=$reg->ap_mat;
				$puntaje=$reg->puntaje;
				formulario();
			}
		} // Termina función consultas

		function bajas(){
			global $op;
			$folio=$_GET['folio'];
			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");
			$cbd=mysqli_select_db($cs,"registro_pisa");
			// ****************************************************
			$query="DELETE FROM puntajes WHERE folio='$folio'";
			$sql=mysqli_query($cs,$query);
			if (mysqli_affected_rows($cs)<=0){
				echo "
					<font size='6' color='red'>
					Error, el folio NO existe en la base de datos
					</font>
					<br><br>
					<a href='http://localhost/pfinal/autos.php?op=0'>
					Regresar
					</a>
				";
			}
			else{
				echo "
					<font size='6' color='blue'>
					El registro ha sido eliminado
					</font>
					<br><br>
					<a href='http://localhost/pfinal/autos.php?op=0'>
					Regresar
					</a>
				";
			}
		} // Termina función bajas

		function listado(){
			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");
			$cbd=mysqli_select_db($cs,"registro_pisa");
			// ****************************************************
			$query="SELECT * FROM puntajes";
			$sql=mysqli_query($cs,$query);
			echo plantilla_formulario();

			while ($reg=mysqli_fetch_object($sql)){
				$plantilla=plantilla_formulario_datos();
				//echo $reg->folio." ".$reg->nombre." ".$reg->ap_pat." ".$reg->color." ".$reg->puntaje."<br>";
				printf("$plantilla", "$reg->folio", "$reg->nombre", "$reg->ap_pat", "$reg->ap_mat", "$reg->puntaje","<br>");

			}
			//echo "<h1>Hola</h1>";
			echo plantilla_formulario_final();
			//echo "$plantilla";
		}


		function formulario(){
			global $op, $folio, $nombre, $ap_pat, $ap_mat, $puntaje;
			echo "
				<br><br><br>
				<form name='f_autos'>
				<table border='3' width='80%'>
					<tr align='center'>
						<td colspan='2'><p class='titulo36'>Registro de Puntajes PISA</p></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el folio</p></td>
						<td><input name='folio' type='text' class='campo' maxlength='7' value='$folio'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el nombre del aplicante</p></td>
						<td><input name='nombre' type='text' class='campo' maxlength='20' value='$nombre'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el Ap. Paterno del aplicante</p></td>
						<td><input name='ap_pat' type='text' class='campo' maxlength='20' value='$ap_pat'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el Ap. Materno del aplicante</p></td>
						<td><input name='ap_mat' type='text' class='campo' maxlength='20' value='$ap_mat'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el puntaje del aplicante</p></td>
						<td><input name='puntaje' type='number' class='campo' maxlength='4' value='$puntaje'></td>
					</tr>
					<tr align='center'>
						<td colspan='2'>
						<table width='100%'>
						<tr align='center'>
							<td><input name='b_altas' type='button' class='boton' value='Altas' onClick='altas(1)'></td>
							<td><input name='b_consultas' type='button' class='boton' value='Consultas' onClick='consultas(2)'></td>
							<td><input name='b_bajas' type='button' class='boton' value='Bajas' onClick='bajas(3)'></td>
							<td><input name='b_listado' type='button' class='boton' value='Listado' onClick='listado(4)'></td>
							<td><input name='b_reset' type='reset' class='boton' value='Reset' style='background:red;'></td>
						</tr>
						</table>
						</td>
					</tr>
				</table>
				</form>
			";
		}

		function plantilla_formulario(){
			return "
				<br><br><br>
				<form name='f_autos'>
				<table border='3' width='80%'>
					<tr align='center'>
						<td colspan='5'><p class='titulo36'>Registro de Puntajes de PISA</p></td>
					</tr>
					<tr align='center'>
					
						<td><p>Folio</p></td>
						
					
					
						<td><p>Nombre del aplicante</p></td>
						
					
						<td><p>Ap. Paterno del aplicante</p></td>
						
						<td><p>Ap. Materno del aplicante</p></td>
						
						<td><p>Puntaje</p></td>
						
					</tr>
					

				
			";
		}

		function plantilla_formulario_datos(){
			return "<tr>
					<td><input name='folio' type='text' class='campo' maxlength='7' value='%s' readonly='true'></td>
					<td><input name='nombre' type='text' class='campo' maxlength='20' value='%s' readonly='true'></td>
					<td><input name='ap_pat' type='text' class='campo' maxlength='20' value='%s' readonly='true'></td>
					<td><input name='ap_mat' type='text' class='campo' maxlength='20' value='%s' readonly='true'></td>
					<td><input name='puntaje' type='number' class='campo' maxlength='4' value='%s' readonly='true'></td>
					</tr>";
		}
		function plantilla_formulario_final(){
			return "</table>
				</form>";
		}
	?>
	</center></body>
</html>
