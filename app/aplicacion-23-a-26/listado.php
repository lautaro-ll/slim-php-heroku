<?php

/*
LEMOS LAUTARO LUCAS

Aplicación No 24 (Listado JSON y array de usuarios)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar (ej:usuarios,productos,vehículos,...etc), por ahora solo tenemos usuarios.
En el caso de usuarios carga los datos del archivo usuarios.json.
se deben cargar los datos en un array de usuarios.
Retorna los datos que contiene ese array en una lista
<ul>
<li>apellido, nombre,foto</li>
<li>apellido, nombre,foto</li>
</ul>
Hacer los métodos necesarios en la clase usuario
*/

require "Usuario.php";
require "Producto.php";
echo "Aplicación No 24 (Listado JSON y array de usuarios)<br/>";

if(isset($_GET["listado"]))
{
    $listadoIngresado = $_GET["listado"];
    switch($listadoIngresado)
    {
        case "usuarios":
            $arrayUsuarios = Usuario::RetornarArrayDelJSON();
            Usuario::DibujarListado($arrayUsuarios);
            break;
        case "productos":
            $arrayProductos = Producto::RetornarArrayDelJSON();
            Producto::DibujarListado($arrayProductos);
            break;
        default:
            echo "Listado incorrecto. <br/>";
            break;
    }
}
else
{
    echo "No se ingresó listado. <br/>";
}


?>