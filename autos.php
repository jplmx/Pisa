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
			global $op, $placas, $marca, $tipo, $color, $motor;
			$placas=$_GET['placas'];
			$marca=$_GET['marca'];
			$tipo=$_GET['tipo'];
			$color=$_GET['color'];
			$motor=$_GET['motor'];
			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");
			$cbd=mysqli_select_db($cs,"autos_prepa");
			// ****************************************************
			$query="INSERT INTO autos VALUES('$placas','$marca','$tipo','$color','$motor')";
			$sql=mysqli_query($cs,$query);
			if (mysqli_affected_rows($cs)<0){
				echo "
					<font size='6' color='red'>
					Error, las placas se duplican en la base de datos
					</font>
					<br><br>
					<a href='http://localhost/autos/autos.php?op=0'>
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
					<a href='http://localhost/autos/autos.php?op=0'>
					Regresar
					</a>
				";
			} // Validación de que no se duplique
		}

		function consultas(){
			global $op, $placas, $marca, $tipo, $color, $motor;
			$placas=$_GET['placas'];
			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");
			$cbd=mysqli_select_db($cs,"autos_prepa");
			// ****************************************************
			$query="SELECT * FROM autos WHERE placas='$placas'";
			$sql=mysqli_query($cs,$query);
			$reg=mysqli_fetch_object($sql);
			if ($reg==mysqli_fetch_array($sql)){
				echo "
					<font size='6' color='red'>
					Error, las placas NO existen en la base de datos
					</font>
					<br><br>
					<a href='http://localhost/autos/autos.php?op=0'>
					Regresar
					</a>
				";
			}
			else{
				$marca=$reg->marca;
				$tipo=$reg->tipo;
				$color=$reg->color;
				$motor=$reg->motor;
				formulario();
			}
		} // Termina función consultas

		function bajas(){
			global $op;
			$placas=$_GET['placas'];
			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");
			$cbd=mysqli_select_db($cs,"autos_prepa");
			// ****************************************************
			$query="DELETE FROM autos WHERE placas='$placas'";
			$sql=mysqli_query($cs,$query);
			if (mysqli_affected_rows($cs)<=0){
				echo "
					<font size='6' color='red'>
					Error, las placas NO existen en la base de datos
					</font>
					<br><br>
					<a href='http://localhost/autos/autos.php?op=0'>
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
					<a href='http://localhost/autos/autos.php?op=0'>
					Regresar
					</a>
				";
			}
		} // Termina función bajas

		function listado(){
			// ************ Conectar el servidor y la base de datos
			$cs=mysqli_connect("localhost","root","");
			$cbd=mysqli_select_db($cs,"autos_prepa");
			// ****************************************************
			$query="SELECT * FROM autos";
			$sql=mysqli_query($cs,$query);
			echo plantilla_formulario();

			while ($reg=mysqli_fetch_object($sql)){
				$plantilla=plantilla_formulario_datos();
				//echo $reg->placas." ".$reg->marca." ".$reg->tipo." ".$reg->color." ".$reg->motor."<br>";
				printf("$plantilla", "$reg->placas", "$reg->marca", "$reg->tipo", "$reg->color", "$reg->motor","<br>");

			}
			//echo "<h1>Hola</h1>";
			echo plantilla_formulario_final();
			//echo "$plantilla";
		}


		function formulario(){
			global $op, $placas, $marca, $tipo, $color, $motor;
			echo "
				<br><br><br>
				<form name='f_autos'>
				<table border='3' width='80%'>
					<tr align='center'>
						<td colspan='2'><p class='titulo36'>Registro de de autos</p></td>
					</tr>
					<tr align='center'>
						<td><p>Indica las placas del auto</p></td>
						<td><input name='placas' type='text' class='campo' maxlength='7' value='$placas'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica la marca del auto</p></td>
						<td><input name='marca' type='text' class='campo' maxlength='20' value='$marca'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el tipo del auto</p></td>
						<td><input name='tipo' type='text' class='campo' maxlength='20' value='$tipo'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el color del auto</p></td>
						<td><input name='color' type='text' class='campo' maxlength='20' value='$color'></td>
					</tr>
					<tr align='center'>
						<td><p>Indica el tamaño del motor en CC</p></td>
						<td><input name='motor' type='number' class='campo' maxlength='4' value='$motor'></td>
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
						<td colspan='5'><p class='titulo36'>Registro de datos</p></td>
					</tr>
					<tr align='center'>
					
						<td><p>Placas del auto</p></td>
						
					
					
						<td><p>Marca del auto</p></td>
						
					
						<td><p>Tipo del auto</p></td>
						
						<td><p>Color del auto</p></td>
						
						<td><p>Tamaño del motor en CC</p></td>
						
					</tr>
					

				
			";
		}

		function plantilla_formulario_datos(){
			return "<tr>
					<td><input name='placas' type='text' class='campo' maxlength='7' value='%s' readonly='true'></td>
					<td><input name='marca' type='text' class='campo' maxlength='20' value='%s' readonly='true'></td>
					<td><input name='tipo' type='text' class='campo' maxlength='20' value='%s' readonly='true'></td>
					<td><input name='color' type='text' class='campo' maxlength='20' value='%s' readonly='true'></td>
					<td><input name='motor' type='number' class='campo' maxlength='4' value='%s' readonly='true'></td>
					</tr>";
		}
		function plantilla_formulario_final(){
			return "</table>
				</form>";
		}
	?>
	</center></body>
</html>
