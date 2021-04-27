<?php
/*
a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
helados.json, y hay stock guardar en la base de datos (con la fecha, número de pedido y id autoincremental ) y se
debe descontar la cantidad vendida del stock .
b- (1 pt) completar el alta con imagen de la venta , guardando la imagen con el tipo+sabor+mail(solo usuario hasta
el @) y fecha de la venta en la carpeta /ImagenesDeLaVenta.
*/
require "Helado.php";
require "Venta.php";

if(isset($_POST["mail"]) && isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_FILES["archivo"]))
{
    $mail = $_POST["mail"];
    $sabor = $_POST["sabor"];
    $tipo = $_POST["tipo"];
    $cantidad = $_POST["cantidad"];
    $archivo = $_FILES["archivo"];

    $venta = new Ventas();
    $venta->nuevaVenta($mail, $tipo, $sabor, $cantidad, $archivo);

    if(Ventas::RealizarVentaEnBd($mail, $sabor, $tipo, $cantidad)) 
    {
        echo "Venta Realizada.<br/>";
        if($venta->GuardarArchivo($archivo)) 
        {
            echo "El archivo ha sido subido exitosamente. <br/>";
        }
        else 
        {
            echo "El archivo no pudo ser subido. <br/>";
        }
    }
    else 
    {
        echo "No se pudo hacer la venta. <br/>";
    }

}
else 
{
    echo "Faltan datos. <br/>";
}
    
?>
