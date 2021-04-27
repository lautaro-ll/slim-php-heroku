<?php
/*
B- (1 pt.) HeladoCarga.php: (por GET)se ingresa Sabor, precioBruto, Tipo (“agua” o “crema”), cantidad( de
unidades de palitos helados) el objeto helado tiene función que guarda el precio más IVA en el atributo
precioFinal. Se guardan los datos en en el archivo de texto helados.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
Validar que los valores sean válidos.

*/
require "Helado.php";

if(isset($_GET["sabor"]) && isset($_GET["precioBruto"]) && isset($_GET["tipo"]) && isset($_GET["cantidad"]))
{
    $sabor = $_GET["sabor"];
    $precioBruto = $_GET["precioBruto"];
    $tipo = $_GET["tipo"];
    $cantidad = $_GET["cantidad"];

    if($tipo == "agua" || $tipo == "crema")
    {
        $Helado = new Helado();
        $Helado->nuevaHelado($sabor, $precioBruto, $tipo, $cantidad);  
        
        if(($alta = Helado::AltaHeladoJson($Helado)) == 1) 
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
        echo "Parámetro NO válidos. <br/>";
    }
    

}
else {
    echo "Faltan datos. <br/>";
}


?>
