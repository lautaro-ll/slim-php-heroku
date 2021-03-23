<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘Color’, ‘Marca’, ‘Trazo’ y ‘Precio’. Crear, cargar y mostrar tres
lapiceras.


*******************************************************************************/

$lapicera = array("Color"=>"Rojo", "Marca"=>"Faber", "Trazo"=>"Fino", "Precio"=>12.5);
printf("LAPICERA 1<br/>");
    foreach($lapicera as $nombre => $caracteristicas)
        printf("$nombre: $caracteristicas<br/>");

$lapicera["Color"]="Verde";
$lapicera["Marca"]="Bic";
$lapicera["Trazo"]="Grueso";
$lapicera["Precio"]=5;

printf("<br/>LAPICERA 2<br/>");
    foreach($lapicera as $nombre => $caracteristicas)
        printf("$nombre: $caracteristicas<br/>");

$lapicera["Color"]="Negro";
$lapicera["Marca"]="PaperMate";
$lapicera["Trazo"]="Fino";
$lapicera["Precio"]=56;

printf("<br/>LAPICERA 3<br/>");
    foreach($lapicera as $nombre => $caracteristicas)
        printf("$nombre: $caracteristicas<br/>");
?>
