<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 14 (Par e impar)
Crear una función llamada esPar que reciba un valor entero como parámetro y devuelva TRUE
si este número es par ó FALSE si es impar.
Reutilizando el código anterior, crear la función esImpar.

*******************************************************************************/

$numero = 5;
if(esPar($numero))
	printf("El numero $numero es PAR<br/>");
if(esImpar($numero))
	printf("El numero $numero es IMPAR<br/>");

$numero = 10;
if(esPar($numero))
	printf("El numero $numero es PAR<br/>");
if(esImpar($numero))
	printf("El numero $numero es IMPAR<br/>");


function esPar(int $valor){
	if($valor%2==1)
		return FALSE;
	else
		return TRUE;
}
function esImpar(int $valor){
	return !esPar($valor);
}

?>