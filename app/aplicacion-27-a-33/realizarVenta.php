<?php

/*
LEMOS LAUTARO LUCAS

Aplicación No 31 (RealizarVenta BD)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id) y la cantidad de ítems, por POST.
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases

*/

require "Producto.php";
require "Usuario.php";
require "Ventas.php";

echo "Aplicación No 31 (RealizarVenta BD)<br/>";

if(isset($_POST["codigo_de_barra"]) && isset($_POST["id"]) && isset($_POST["cantidad"]))
{
    $codigo_de_barra = $_POST["codigo_de_barra"];
    $idUsuario = $_POST["id"];
    $cantidad = $_POST["cantidad"];
    if(Ventas::RealizarVentaEnBd($codigo_de_barra, $idUsuario, $cantidad)) 
    {
        echo "Venta Realizada.<br/>";
    }
    else 
    {
        echo "No se pudo hacer la venta. <br/>";
    }
}
else {
    echo "No se ingresaron datos de la venta. <br/>";
}

?>