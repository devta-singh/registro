<?php //registro.php

ini_set("display_errors", 1);
error_reporting(15);


//define("_d", true);
define("_d", false);

$mysqli = new Mysqli("localhost", "root", "root", "interesados");

//recuperamos los datos que llegan por REQUEST (POST)
//$datos = $_REQUEST[];

$datos_a_recuperar = explode(",", "nombre,apellidos,nick,email,clave,clave2,telefono1,telefono2");

if(constant("_d")){
	print_r($_REQUEST);
	print "<br>";
}
//exit();


//control de errores
$errores = array();
$error = 0;


//recorrer los datos y los asigna a sus variables
$valores = array();

foreach($datos_a_recuperar as $campo){

	//si el campo no está en los que llegan por POST, lo saltamos
	if(!in_array($campo, array_keys($_REQUEST))){
		if(constant("_d")){
			print "Saltando campo $campo (no existe en REQUEST)<br>";
		}
		$errores[] = "Error: Campo $campo no ha llegado";
		$error++;
		continue;
	}

	//si el campo es clave2
	if($campo=="clave2"){
		if(constant("_d")){
			print "Ignorando campo clave2<br>";	
		}
		continue;
	}
	
	//si el campo clave no coincide con clave2
	if(($campo=="clave"){
		if($_REQUEST["clave"] != $_REQUEST["clave2"]){		
			$errores[] = "Error: Campo clave no coincide con clave2"; 
			$error++;
			continue;
		}else{
			$clave = md5($clave);
			$valores[$campo] = "$campo = '$dato'";//lo añadimos para crear luego el SQL
		}
	}	

	//si llegamos hasta aquí es que este campo es válido
	$dato = $_REQUEST[$campo];//Recuperamos el valor del campo
	$$campo = $dato;//lo asignamos en la variable cuyo nobre está contenida en $dato
	$valores[$campo] = "$campo = '$dato'";//lo añadimos para crear luego el SQL

}

$_valores = implode(", ", $valores);

//imprime los valores
if(constant("_d")){
	print $_valores;
}

//si hay errores
if($error > 0){
	print "Se han producido ($error) errores:<br>";
	print implode("<br>", $errores);
	print "<br>";
	exit();
}else{
	if(constant("_d")){
		print "NO HAY ERRORES";
	}
}


//generamos la consulta SQL
//$sql = "SHOW TABLES";
$sql = "INSERT INTO interesados SET $_valores";
if(constant("_d")){
	print "SQL: $sql";
}



//ejecutamos la consulta SQL
$resultados = $mysqli->query($sql);

if($mysqli->error){
	print "Error: (".$mysqli->errno.")".$mysqli->error;
	print "<br>Al ejecutar la consulta:<br>$sql";
	exit();
}

//numero de filas afectadas por la consulta
$num_filas = $mysqli->affected_rows;
$id = $mysqli->insert_id;


print "Numero de filas afectadas: $num_filas, con id: $id";



/*
//while($datos = mysqli->fetch_assoc()){
$tablas = array();
while($datos = $resultados->fetch_array()){	
	//$nombre_tabla = $datos[0];
	//print "<br>$nombre_tabla";
	$tablas[] = $datos[0];
}

if(sizeof($tablas)){
	print "Tablas:<br>";
	print implode("<br>\n", $tablas);
}
*/



?>