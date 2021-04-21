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

    function nuevoProducto($codigo_de_barra, $nombre, $tipo, $stock, $precio, $id)
    {
        $this->codigo_de_barra = $codigo_de_barra;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->id = $id;
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
