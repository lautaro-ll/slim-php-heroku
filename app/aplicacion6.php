<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número entre 0 y 10 (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.


*******************************************************************************/

$vec[0] = rand(0,10);
$vec[1] = rand(0,10);
$vec[2] = rand(0,10);
$vec[3] = rand(0,10);
$vec[4] = rand(0,10);
$suma = 0;

for($i=0;$i<5;$i++)
    $suma += $vec[$i];
$promedio = $suma / 5;

if($promedio>6)
    printf("Resultado: $promedio\nMayor a 6");
elseif ($promedio<6) 
    printf("Resultado: $promedio\nMenor a 6");
else
    printf("Resultado: $promedio");

?>