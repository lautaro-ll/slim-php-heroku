<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.


*******************************************************************************/

$lapicera = array("Color"=>"Rojo", "Marca"=>"Faber", "Trazo"=>"Fino", "Precio"=>12.5);
$lapicera2 = array("Color"=>"Negro", "Marca"=>"Bic", "Trazo"=>"Fino", "Precio"=>5);
$lapicera3 = array("Color"=>"Azul", "Marca"=>"PaperMate", "Trazo"=>"Grueso", "Precio"=>60);

$lapiceras = array($lapicera,$lapicera2,$lapicera3);
printf("LAPICERAS TOTALES<br/>");
foreach($lapiceras as $unidad)
{
    printf("<br/>");
    foreach($unidad as $nombre => $caracteristicas)
        printf("$nombre: $caracteristicas<br/>");
}
?>

