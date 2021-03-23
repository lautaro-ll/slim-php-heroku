<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
las estructuras while y foreach.

*******************************************************************************/
$i=0;
$num = 1;

do
{
    if($num%2)
    {
        $vec[$i] = $num;
        $i++;
    }
    $num++;
    
}while($i<10);

printf("**** FOR ****<br/>");
for($i=0;$i<10;$i++)
    printf("$vec[$i]<br/>");
    
printf("**** WHILE ****<br/>");
$i=0;
while($i<10)
{
    printf("$vec[$i]<br/>");
    $i++;
};

printf("**** FOREACH ****<br/>");
foreach($vec as $i)
    printf("$i<br/>");


?>