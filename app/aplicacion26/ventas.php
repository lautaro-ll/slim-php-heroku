<?php

require_once("producto.php");
require_once("usuario.php");

class Ventas
{
    static function RealizarVenta($numeroSerie, $cantidadItems, $idUsuario) {
    
        $producto = Producto::TraerProducto($numeroSerie);
        $usuario = Usuario::TraerUsuario($idUsuario);

        if($producto == NULL) {
            echo "No existe el producto.<br/>";
        }
        else if ($usuario == NULL) {
            echo "No existe el usuario.<br/>";
        }
        else if ($producto["stock"]<$cantidadItems) {
            echo "No hay stock suficiente.<br/>";
        }
        else 
        {
            for($i=0;$i<$cantidadItems;$i++) {
                Producto::DisminuirStock($numeroSerie);
                $producto["stock"]--;
            }
            if(!file_exists("log-ventas.txt") || is_writable("log-ventas.txt")) 
            {
                $archivo = fopen("log-ventas.txt", "a");
                fwrite($archivo, $usuario["nombre"]." compró ".$cantidadItems." unidades de ".$producto["nombre"].", Serie: ".$producto["numeroSerie"]." por ".$producto["precio"]." pesos. "."Stock restante: ".$producto["stock"]." unidades."."\n");
                fclose($archivo);
                return 1;
            }
        }
        return 0;
    }
}

?>