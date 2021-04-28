<?php
/*
7- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
la carpeta /BACKUPVENTAS
*/


if(isset($_POST["nro_pedido"]))
{
    $nro_pedido = $_POST["nro_pedido"];    

    if(($resultado = Helado::ValidarHeladoEnBd($nro_pedido)) == 1 && Helado::BorrarVentaEnBd($nro_pedido)) 
    {
        Helado::EliminarFoto($nro_pedido);
        echo "Producto Eliminado. <br/>";
    } 
    else if($resultado == -1) 
    {
        echo "No existe ese producto. <br/>";
    }
    else 
    {
        echo "No se pudo eliminar. <br/>";
    }
}
else
{
    echo "No se ingresó producto. <br/>";
}

?>