<?php

/*
LEMOS LAUTARO LUCAS

Aplicación No 33 (ModificacionProducto BD)
Archivo: modificacionproducto.php
método:POST
Recibe los datos del producto (código de barra (6 cifras),nombre ,tipo, stock, precio) por POST,
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto el código de barras.
Retorna un :
“Actualizado” si ya existía y se actualiza
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase
*/

require "producto.php";
echo "Aplicación No 33 (ModificacionProducto BD)<br/>";

if(isset($_POST["codigo_de_barra"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"]))
{
    $codigo_de_barra = $_POST["codigo_de_barra"];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $fecha_de_modificacion = date("Y-m-d");

    $producto = new Producto();
    $producto->nuevoProducto($codigo_de_barra, $nombre, $tipo, $stock, $precio, $fecha_de_modificacion);  
    

    if(($resultado = Producto::ValidarProductoEnBd($codigo_de_barra)) == 1 && Producto::ModificarProductoEnBd($producto)) 
    {
        echo "Producto Modificado. <br/>";
    } 
    else if($resultado == -1) 
    {
        echo "No existe ese producto. <br/>";
    }
    else 
    {
        echo "No se pudo hacer la modificación. <br/>";
    }
}
else
{
    echo "No se ingresó producto. <br/>";
}


?>
