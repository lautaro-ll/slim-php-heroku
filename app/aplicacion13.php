<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 13 (Invertir palabra)
Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
“Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
1 si la palabra pertenece a algún elemento del listado.
0 en caso contrario.

*******************************************************************************/

$palabra="Parcial";
$resultado = validarPalabra($palabra,20);
printf("Con -$palabra- y max=20 devuelve $resultado<br/>");

$palabra="Oveja";
$resultado = validarPalabra($palabra,20);
printf("Con -$palabra- y max=20 devuelve $resultado<br/>");

$palabra="“Recuperatorio”";
$resultado = validarPalabra($palabra,5);
printf("Con -$palabra- y max=5 devuelve $resultado<br/>");

function validarPalabra(string $palabra,int $max){
	if(strlen($palabra)<=$max && ($palabra=="Recuperatorio" || $palabra=="Parcial" || $palabra=="Programacion"))
	{
		return 1;
	}
	return 0;
}

?>