<?php
/*
B- (1 pt.) HeladoCarga.php: (por GET)se ingresa Sabor, precioBruto, Tipo (“agua” o “crema”), cantidad( de
unidades de palitos helados) el objeto helado tiene función que guarda el precio más IVA en el atributo
precioFinal. Se guardan los datos en en el archivo de texto helados.json, tomando un id autoincremental como
identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
Validar que los valores sean válidos.

5- (2 pts.)HeladoCarga.php:.(continuación) Cambio de get a post.
completar el alta con imagen del helado, guardando la imagen con el tipo y el sabor como nombre en la carpeta
/ImagenesDeHelados
*/
require "Helado.php";

if(isset($_POST["sabor"]) && isset($_POST["precioBruto"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]))
{
    $sabor = $_POST["sabor"];
    $precioBruto = $_POST["precioBruto"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];

    if($tipo == "agua" || $tipo == "crema")
    {
        $Helado = new Helado();
        $Helado->nuevaHelado($sabor, $precioBruto, $tipo, $cantidad);  
        
        if(($alta = Helado::AltaHeladoJson($Helado)) == 1) 
        {
            echo "Ingresado. <br/>";
            if($Helado->GuardarArchivo($archivo)) 
            {
                echo "El archivo ha sido subido exitosamente. <br/>";
            }
            else 
            {
                echo "El archivo no pudo ser subido. <br/>";
            }
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
