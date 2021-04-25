<?php
require_once("AccesoDatos.php");

class Producto
{
    public $codigo_de_barra;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $id;
    public $fecha_de_modificacion;

    function nuevoProducto($codigo_de_barra, $nombre, $tipo, $stock, $precio, $fecha_de_modificacion)
    {
        $this->codigo_de_barra = $codigo_de_barra;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->fecha_de_modificacion = $fecha_de_modificacion;
    }
    
    static function ValidarProductoBd($codigo_de_barra) 
    {
        if($codigo_de_barra!=NULL)
        {
            $arrayProductos = Producto::RetornarProductos();
            
            if(!is_null($arrayProductos)) 
            {
                foreach($arrayProductos as $producto)
                {
                    if($producto->codigo_de_barra == $codigo_de_barra)
                    {
                        return 1;
                    }
                }
                return -1;
            }
        }
        return 0;
    }

    static function ModificarProductoBd($producto) {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE `producto` SET `nombre`=:nombre,`tipo`=:tipo,
        `stock`=:stock,`precio`=:precio,`fecha_de_modificacion`=:fecha_de_modificacion WHERE `codigo_de_barra`=:codigo_de_barra");
        $consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$producto->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock',$producto->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio',$producto->precio, PDO::PARAM_STR);
        $consulta->bindValue(':fecha_de_modificacion',$producto->fecha_de_modificacion, PDO::PARAM_STR);
        $consulta->bindValue(':codigo_de_barra',$producto->codigo_de_barra, PDO::PARAM_INT);

        return $consulta->execute();
    }
    static function ActualizarStockEnBd($producto, $nuevoStock) {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("UPDATE producto SET stock=:stock WHERE codigo_de_barra=:codigo_de_barra");
        $consulta->bindValue(':codigo_de_barra',$producto->codigo_de_barra, PDO::PARAM_INT);
        $consulta->bindValue(':stock',$nuevoStock, PDO::PARAM_INT);

        return $consulta->execute();
    }
    static function AltaProductoBd($producto) {
        if($producto->codigo_de_barra!=NULL && ($productoEnBd = Producto::TraerProductoDeBd($producto)))
        {
            $nuevoStock = $productoEnBd->stock + $producto->stock;
            if(Producto::AumentarStockEnBd($producto, $nuevoStock)) {
                return -1;
            }
            return 0;
        }
        else {
            $nuevoId = Producto::AgregarProductoEnBd($producto);
            if($nuevoId!=NULL) {
                return $nuevoId;
            }
            return 0;
        }
    }
    static function TraerProductoDeBd($codigo_de_barra) {
        $listado = Producto::RetornarProductos();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]->codigo_de_barra == $codigo_de_barra) 
                {
                    return $listado[$i];
                }
            }
        }
        return false;
    }
    static function AgregarProductoEnBd ($producto) {

        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("INSERT INTO `producto`(`codigo_de_barra`, `nombre`, `tipo`, `stock`, `precio`) VALUES (:codigo_de_barra,:nombre,:tipo,:stock,:precio)");
        $consulta->bindValue(':codigo_de_barra',$producto->codigo_de_barra, PDO::PARAM_INT);
        $consulta->bindValue(':nombre',$producto->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':tipo',$producto->tipo, PDO::PARAM_STR);
        $consulta->bindValue(':stock',$producto->stock, PDO::PARAM_INT);
        $consulta->bindValue(':precio',$producto->precio, PDO::PARAM_STR);

        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    static function RetornarProductos ()
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
        $consulta =$objetoAccesoDato->RetornarConsulta("SELECT * from producto");
        $consulta->execute();			
        $array = $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");	
        return $array;
    }

    static function DibujarListado($listado)
    {
        if(!is_null($listado) && is_array($listado)) 
        {
            echo "<ul>";
            foreach($listado as $producto)
            {
                echo "<li>Id: ".$producto->id."</li>";
                echo "<li>Nro. Serie: ".$producto->codigo_de_barra."</li>";
                echo "<li>Nombre: ".$producto->nombre."</li>";
                echo "<li>Tipo: ".$producto->tipo."</li>";
                echo "<li>Stock: ".$producto->stock."</li>";
                echo "<li>Precio: ".$producto->precio."</li>";
                echo "<br/>";
            }
            echo "</ul>";
        }
    }    

    static function DarDeAlta($producto) {
        if(file_exists("productos.json") && Producto::VerificarSiExiste($producto))
        {
            if(Producto::AumentarStock($producto)) {
                return 1;
            }
            return 0;
        }
        else {
            if(Producto::AgregarProducto($producto)) {
                return 1;
            }
            return 0;
        }
    }
    static function VerificarSiExiste($codigo_de_barra) {
        $listado = Producto::RetornarArrayDelJSON();

        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["codigo_de_barra"] == $codigo_de_barra) 
                {
                    return 1;
                }
            }
        }
        return 0;
    }
    static function AumentarStock($codigo_de_barra) {
        
        $listado = Producto::RetornarArrayDelJSON();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["codigo_de_barra"] == $codigo_de_barra) 
                {
                    $listado[$i]["stock"]++;
                }
            }
            unlink("productos.json");
            for($i=0;$i<sizeof($listado);$i++) 
            {
                Producto::AgregarProducto($listado[$i]);
            }
            return 1;
        }
        else {
            return 0;
        }        
    }
    static function AgregarProducto($producto) {

        if(!file_exists("productos.json") || is_writable("productos.json")) 
        {
            $archivo = fopen("productos.json", "a");
            fwrite($archivo, json_encode($producto)."\n");
            fclose($archivo);
            return 1;
        }
        else {
            return 0;
        }
    }
    static function RetornarArrayDelJSON()
    {
        if(($archivo = fopen("productos.json","r")) !== FALSE) {

            $i = 0;
            while(!feof($archivo))
            {
                $jsonObj = fgets($archivo);
                $producto = json_decode($jsonObj,true);
                if($producto != NULL)
                    $listado[$i] = $producto;
                $i++;                      
            }
            fclose($archivo);
            return $listado;
        }
        else {
            return null;
        }
    }
    static function TraerProducto($codigo_de_barra) {
        
        $listado = Producto::RetornarArrayDelJSON();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["codigo_de_barra"] == $codigo_de_barra) 
                {
                    return $listado[$i];
                }
            }
        }
        else {
            return NULL;
        }
        
    }

    static function DisminuirStock($codigo_de_barra) {
        
        $listado = Producto::RetornarArrayDelJSON();
        if($listado != NULL) {
            for($i=0;$i<sizeof($listado);$i++) 
            {
                if($listado[$i]["codigo_de_barra"] == $codigo_de_barra) 
                {
                    $listado[$i]["stock"]--;
                }
            }
            unlink("productos.json");
            for($i=0;$i<sizeof($listado);$i++) 
            {
                Producto::AgregarProducto($listado[$i]);
            }
            return 1;
        }
        else {
            return 0;
        }        
    }
}

?>
