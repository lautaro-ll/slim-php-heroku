<?php

/* 
LEMOS LAUTARO LUCAS

Aplicación No 30 (AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 cifras ),nombre ,tipo, stock, precio )por POST
, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega .
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
*/

require "producto.php";
echo "Aplicación No 25 (AltaProducto)<br/>";

if(isset($_POST["codigo_de_barra"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"]))
{
    $codigo_de_barra = $_POST["codigo_de_barra"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];

    $producto = new Producto();
    $producto->nuevoProducto($codigo_de_barra, $nombre, $tipo, $stock, $precio);  
    
    if(($nuevoId = Producto::AltaProductoEnBd($producto)) > 0) 
    {
        echo "Ingresado. <br/>";
        echo "Nuevo Id: ".$nuevoId." <br/>";
    } 
    else if($nuevoId == -1) 
    {
        echo "Actualizado. <br/>";
    } 
    else 
    {
        echo "No se pudo hacer el alta. <br/>";
    }

}
else {
    echo "No se ingresó listado. <br/>";
}

?>
