<?php

/*
LEMOS LAUTARO LUCAS

Aplicación Nº 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table>
*/

require "usuario.php";
require "producto.php";
require "ventas.php";

echo "Aplicación Nº 28 ( Listado BD)<br/>";

if(isset($_GET["listado"]))
{
    $listadoIngresado = $_GET["listado"];
    switch($listadoIngresado)
    {
        case "usuarios":
            $array = Usuario::RetornarUsuarios();
            Usuario::DibujarListado($array);
            break;
        case "productos":
            $array = Producto::RetornarProductos();
            Producto::DibujarListado($array);
            break;
        case "ventas":
            $array = Ventas::RetornarVentas();
            Ventas::DibujarListado($array);
            break;
        default:
            echo "Listado incorrecto";
            break;
    }
}
else
{
    echo "No se ingresó listado<br/>";
}


?>