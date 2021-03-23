<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.

*******************************************************************************/

$palabra=array("H","O","L","A");
$palabrainvertida = invertirPalabra($palabra);
printf("$palabrainvertida ");

function invertirPalabra($array){
	$retorno="";
	$tamano=count($array);
	for($i=$tamano-1;$i>=0;$i--)
	{
		$retorno = $retorno . $array[$i];
	}
	return $retorno;
	
}

?>