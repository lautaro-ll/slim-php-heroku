<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.

*******************************************************************************/

//OBTENER FECHA E IMPRIMIRLA
$hoy = date("d.m.y");
printf ("Formato 1: $hoy\n");

$hoy = date("F j, Y");
printf ("Formato 2: $hoy\n");

//INDICAR ESTACIÓN DEL AÑO ACTUAL
$dia = date("d");
$mes = date("m");

if($dia>20)
    $mes++;
    
switch ($mes)
{
    //verano
    case 1:
    case 2:
    case 3:
        printf("Es verano.");
        break;
    //otoño
    case 4:
    case 5:
    case 6:
        printf("Es otoño.");
        break;
    //invierno
    case 7:
    case 8:
    case 9:
        printf("Es invierno.");
        break;
    //primavera
    case 10:
    case 11:
    case 12:
        printf("Es primavera.");
        break;

}

?>