<?php

/*
Aplicación No 21 ( Listado CSV y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
usuarios).
En el caso de usuarios carga los datos del archivo usuarios.csv.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>Coffee</li>
<li>Tea</li>
<li>Milk</li>
</ul>
Hacer los métodos necesarios en la clase usuario
*/
/*
leer el archivo, cada linea guardarla en un objeto Usuario 
y guardar todos los usuarios en un array
luego mostrar ese array en formato lista
*/
$miArchivo = fopen("usuarios.csv","r");
$listado = explode(",", fread($miArchivo,filesize("usuarios.csv")));
//$listado = array("nombre"=>$_GET["nombre"],"clave"=>$_GET["clave"],"mail"=>$_GET["mail"]);
echo "<ul>";
foreach($listado as $k => $valor)
{
    if($k==0)
        echo "<br/>".$k;
    echo "<li>".$valor."</li>";
}
echo "</ul>";

?>