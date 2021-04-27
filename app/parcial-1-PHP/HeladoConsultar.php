<?php
/*
(1pt.) HeladoConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo
helados.json, retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor.
*/

require "Helado.php";

if(isset($_POST["sabor"]) && isset($_POST["tipo"]))
{
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];

    if(($resultado = Helado::VerificarSiExisteJson($sabor, $tipo)) == 1)
    {
        echo "Si Hay. <br/>";
    }
    else if ($resultado == 2)
    {
        echo "No hay tipo. <br/>";
    }
    else if ($resultado == 3)
    {
        echo "No hay sabor. <br/>";
    }
    else
    {
        echo "No hay sabor ni tipo. <br/>";
    }
}
else 
{
    echo "Faltan datos. <br/>";
}


?>
