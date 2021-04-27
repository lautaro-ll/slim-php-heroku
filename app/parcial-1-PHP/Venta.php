<?php

require_once("AccesoDatos.php");
require_once("Helado.php");

class Ventas
{
    public $id;
    public $nroPedido;
    public $fecha_de_venta;
    public $mail;
    public $tipo;
    public $sabor;
    public $cantidad;
    public $archivo;

    function nuevaVenta($mail, $tipo, $sabor, $cantidad, $archivo)
    {
        $this->mail = $mail;
        $this->tipo = $tipo;
        $this->sabor = $sabor;
        $this->cantidad = $cantidad;
        $this->archivo = $archivo;
    }

    static function DibujarListado($listado)
    {
        if(!is_null($listado) && is_array($listado)) 
        {
            echo "<ul>";
            foreach($listado as $venta)
            {
                echo "<li>Id: ".$venta->id."</li>";
                echo "<li>Pedido: ".$venta->nroPedido."</li>";
                echo "<li>F. Venta: ".$venta->fecha_de_venta."</li>";
                echo "<li>Mail Usuario: ".$venta->mail."</li>";
                echo "<li>Tipo: ".$venta->tipo."</li>";
                echo "<li>Sabor: ".$venta->sabor."</li>";
                echo "<li>Cantidad: ".$venta->cantidad."</li>";
                echo "<br/>";
            }
            echo "</ul>";
        }
    }    
    static function obtenerTotalVendidos()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) FROM `ventas`");
        return $consulta->execute();
    }
    static function obtenerComprasEntreFechas($fechaUno,$fechaDos)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `ventas` WHERE fecha_de_venta BETWEEN :f1 AND :f2");
        $consulta->bindValue(':f1',$fechaUno, PDO::PARAM_STR);
        $consulta->bindValue(':f2',$fechaDos, PDO::PARAM_STR);
        $consulta->execute();
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");	
        return $array;
    }
    static function obtenerVentasPorUsuario($usuario)
    {
        $mail = "$usuario@%";
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `ventas` WHERE mail LIKE :mail;");
        $consulta->bindValue(':mail',$mail, PDO::PARAM_STR);
        $consulta->execute();
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");	
        return $array;
    }
    static function obtenerVentasPorTipo($tipo)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM `ventas` WHERE tipo=:tipo;");
        $consulta->bindValue(':tipo',$tipo, PDO::PARAM_STR);
        $consulta->execute();
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");	
        return $array;
    }


    static function RealizarVentaEnBd($mail, $sabor, $tipo, $cantidad) {
    
        $producto = Helado::TraerProducto($sabor, $tipo);
        if($producto == NULL) {
            echo "No existe el producto.<br/>";
        }
        else if ($producto["stock"]<$cantidad) {
            echo "No hay stock suficiente.<br/>";
        }
        else 
        {
            $nuevoStock = $producto["stock"] - $cantidad;
            Helado::ActualizarStockJson($sabor, $tipo, $nuevoStock) ;
            if(Ventas::AgregarVentaEnBd($mail, $producto, $cantidad)) {
                return 1;
            }
        }
        return 0;
    }
    static function AgregarVentaEnBd($mail, $producto, $cantidad) {
        
        $nro_pedido = rand(1,9999);
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `ventas`(`nro_pedido`, `mail`, `tipo`, `sabor`, `cantidad`) VALUES (:nro_pedido, :mail, :tipo, :sabor, :cantidad)");
        $consulta->bindValue(':nro_pedido',$nro_pedido, PDO::PARAM_INT);
        $consulta->bindValue(':mail',$mail, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$producto["tipo"], PDO::PARAM_STR);
        $consulta->bindValue(':sabor',$producto["sabor"], PDO::PARAM_STR);
        $consulta->bindValue(':cantidad',$cantidad, PDO::PARAM_INT);

        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    function GuardarArchivo ($archivo)
    {
        $destino = "ImagenesDeLaVenta/";
        $ext = pathinfo($archivo["name"], PATHINFO_EXTENSION);

        if (!file_exists($destino)) 
        {
            mkdir($destino,0777,true);
        }
        $usuario = explode("@",$this->mail);
        if (move_uploaded_file($archivo["tmp_name"], $destino.$this->tipo."-".$this->sabor."-".$usuario[0]."-".Date("Y-m-d").".".$ext))
        {
            return 1;
        } 
        else 
        {
            return 0;
        }
    }
}
?>
