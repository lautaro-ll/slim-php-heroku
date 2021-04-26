<?php

/*
LEMOS LAUTARO LUCAS

Aplicación No 25 (AltaProducto)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto (código de barra (6 cifras),nombre ,tipo, stock, precio) por POST,
crea un ID autoincremental (emulado, puede ser un random de 1 a 10.000).
crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un nuevo renglón
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“ si no se pudo hacer
Hacer los métodos necesarios en la clase

*/

require "Producto.php";
echo "Aplicación No 25 (AltaProducto)<br/>";

if(isset($_POST["numeroSerie"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"]))
{
    $id = rand(1,10000);
    $producto = new Producto($_POST["numeroSerie"],$_POST["nombre"],$_POST["tipo"],$_POST["stock"],$_POST["precio"],$id);
    
    if(($alta = Producto::DarDeAlta($producto)) == 1) 
    {
        echo "Ingresado. <br/>";
    } 
    else if($alta == 0) 
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