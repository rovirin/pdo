<?php

$dni = strtoupper($_GET['dni']);
$resultado = '';

if(strlen($dni)!=9){
	$resultado = "La longitud del dni no es correcta";
}
else{
	$n = substr($dni,0,-1); // Solo los números del DNI
	$miletra = substr($dni,-1); // Solo la letra del DNI

	$resto = $n%23;  
	$palabro = 'TRWAGMYFPDXBNJZSQVHLCKE';
	$letraCalculada = $palabro[$resto];
	$dniCorrecto = $n.$letraCalculada;

	// Si la letra es correcta, devuelve 'ok', si no, devuelve un mensaje indicando que la letra es .... y no la que escribió....
	if($dni!=$dniCorrecto){
		$resultado = "La letra correcta para $n es $letraCalculada y no la que ha tecleado ($miletra).";
	}else{
		$resultado = "ok";
	}
}



echo $resultado;