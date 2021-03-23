<?php
/******************************************************************************
Lautaro Lemos
Aplicación No 1 (Sumar números)
Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
se sumaron.

*******************************************************************************/
$suma = 0;
$entero = 1;

while ($suma + $entero <1000)
{
    printf("Número a sumar: $entero\n");
    $suma += $entero;
    $entero++;
};
$entero -= 1;
printf("Números sumados: $suma\n");
printf("Se sumaron un total de $entero números");
?>
