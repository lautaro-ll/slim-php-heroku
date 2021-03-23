<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 11 (Potencias de números)
Mostrar por pantalla las primeras 4 potencias de los números del uno 1 al 4 (hacer una función
que las calcule invocando la función pow).


*******************************************************************************/

for($i=1;$i<5;$i++)
{
	mostrarPotencias($i);
	printf("<br/>");
}

function mostrarPotencias($num){
	for($i=1;$i<5;$i++)
	{
		$res=pow($num,$i);
		printf("$res ");
	}
}


?>