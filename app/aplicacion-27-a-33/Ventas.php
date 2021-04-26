<?php

require_once("AccesoDatos.php");
require_once("Producto.php");
require_once("Usuario.php");

class Ventas
{
    public $id;
    public $id_producto;
    public $id_usuario;
    public $cantidad;
    public $fecha_de_venta;

    function nuevaVenta($id_producto, $id_usuario, $cantidad)
    {
        $this->id_producto = $id_producto;
        $this->id_usuario = $id_usuario;
        $this->cantidad = $cantidad;
    }

    static function RetornarVentas ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from venta");
        $consulta->execute();			
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");	
        return $array;
    }

    static function RealizarVentaEnBd($codigo_de_barra, $id_usuario, $cantidad) {
    
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
            if(Ventas::AgregarVentaEnBd($producto->id, $id_usuario, $cantidad)) {
                return 1;
            }
        }
        return 0;
    }
    static function AgregarVentaEnBd($id_producto, $id_usuario, $cantidad) {
        
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `venta`(`id_producto`, `id_usuario`, `cantidad`) VALUES (:id_producto,:id_usuario,:cantidad)");
        $consulta->bindValue(':id_producto',$id_producto, PDO::PARAM_INT);
        $consulta->bindValue(':id_usuario',$id_usuario, PDO::PARAM_INT);
        $consulta->bindValue(':cantidad',$cantidad, PDO::PARAM_INT);

        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
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
}

?>