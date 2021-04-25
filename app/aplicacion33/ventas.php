<?php

require_once("AccesoDatos.php");
require_once("producto.php");
require_once("usuario.php");

class Ventas
{
    public $id;
    public $id_producto;
    public $id_usuario;
    public $cantidad;
    public $fecha_de_venta;

    static function RealizarVentaBd($codigo_de_barra, $id_usuario, $cantidad) {
    
        $producto = Producto::TraerProductoDeBd($codigo_de_barra);
        $usuario = Usuario::TraerUsuarioDeBd($id_usuario);
        if($producto == false) {
            echo "No existe el producto.<br/>";
        }
        else if ($usuario == false) {
            echo "No existe el usuario.<br/>";
        }
        else if ($producto->stock<$cantidad) {
            echo "No hay stock suficiente.<br/>";
        }
        else 
        {
            $nuevoStock = $producto->stock - $cantidad;
            Producto::ActualizarStockEnBd($producto, $nuevoStock);
            if(Ventas::AgregarVentaBd($producto->id, $id_usuario, $cantidad)) {
                return 1;
            }
        }
        return 0;
    }
    static function AgregarVentaBd($id_producto, $id_usuario, $cantidad) {
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `venta`(`id_producto`, `id_usuario`, `cantidad`) VALUES (:id_producto,:id_usuario,:cantidad)");
        $consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario',$id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad',$cantidad, PDO::PARAM_INT);

        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }
    static function RetornarVentas ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from venta");
        $consulta->execute();			
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");	
        return $array;
    }
    static function DibujarListado($listado)
    {
        if(!is_null($listado) && is_array($listado)) 
        {
            echo "<ul>";
            foreach($listado as $venta)
            {
                echo "<li>Id: ".$venta->id."</li>";
                echo "<li>Id Producto: ".$venta->id_producto."</li>";
                echo "<li>Id Usuario: ".$venta->id_usuario."</li>";
                echo "<li>Cantidad: ".$venta->cantidad."</li>";
                echo "<li>F. Venta: ".$venta->fecha_de_venta."</li>";
                echo "<br/>";
            }
            echo "</ul>";
        }
    }    

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