<?php //test_bbdd.php

$mysqli = new Mysqli("localhost", "root", "root", "pruebas");

$sql = "SHOW TABLES";

$resultados = $mysqli->query($sql);

if($mysqli->error){
	print "Error: (".$mysqli->errno.")".$mysqli->error;
	exit();
}

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



?>