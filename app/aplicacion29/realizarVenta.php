<?php

/*
LEMOS LAUTARO LUCAS

Aplicación No 26 (RealizarVenta)
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id) y la cantidad de ítems ,por POST .
Verificar que el usuario y el producto exista y tenga stock.
crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
carga los datos necesarios para guardar la venta en un nuevo renglón.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases

*/

require "producto.php";
require "usuario.php";
require "ventas.php";

echo "Aplicación No 26 (RealizarVenta)<br/>";

if(isset($_POST["numeroSerie"]) && isset($_POST["id"]) && isset($_POST["cantidadItems"]))
{
    $idUsuario = $_POST["id"];
    $numeroSerie = $_POST["numeroSerie"];
    $cantidadItems = $_POST["cantidadItems"];
    if(Ventas::RealizarVenta($numeroSerie, $cantidadItems, $idUsuario)) {
        echo "Venta Realizada.<br/>";
    }else {
        echo "No se pudo hacer la venta.<br/>";
    }
}
else {
    echo "No se ingresaron datos de la venta.<br/>";
}

?>