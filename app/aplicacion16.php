<?php
/******************************************************************************
Lemos Lautaro Lucas

Aplicación No 16 (Rectangulo - Punto)
Codificar las clases Punto y Rectangulo.

La clase Punto ha de tener dos atributos privados con acceso de sólo lectura (sólo con
getters), que serán las coordenadas del punto. Su constructor recibirá las coordenadas del
punto.
La clase Rectangulo tiene los atributos privados de tipo Punto _vertice1, _vertice2, _vertice3
y _vertice4 (que corresponden a los cuatro vértices del rectángulo).
La base de todos los rectángulos de esta clase será siempre horizontal. Por lo tanto, debe tener
un constructor para construir el rectángulo por medio de los vértices 1 y 3.
Los atributos ladoUno, ladoDos, área y perímetro se deberán inicializar una vez construido el
rectángulo.
Desarrollar una aplicación que muestre todos los datos del rectángulo y lo dibuje en la página.

*******************************************************************************/
echo "Aplicación No 16 (Rectangulo - Punto)<br/>";

class Punto
{
    private $_coordenadaX;
    private $_coordenadaY;

    function __construct($coordX,$coordY)
    {
        $this->_coordenadaX = $coordX;
        $this->_coordenadaY = $coordY;
    }
    public function _getCoordenadaX() {
        return $this->_coordenadaX;
    }
    public function _getCoordenadaY() {
        return $this->_coordenadaY;
    }

}

class Rectangulo
{
    private Punto $_vertice1;
    private Punto $_vertice2;
    private Punto $_vertice3;
    private Punto $_vertice4;
    public $ladoUno;
    public $ladoDos;
    public $area;
    public $perimetro;

    //constructor para construir el rectángulo por medio de los vértices 1 y 3
    function __construct($vertice1, $vertice3)
    {
        $this->_vertice1 = $vertice1;
        $this->_vertice3 = $vertice3;
        if($vertice1->_getCoordenadaX()>$vertice3->_getCoordenadaX()) {
            $this->_vertice2 = new Punto($vertice1->_getCoordenadaX(),$vertice3->_getCoordenadaY());
            $this->_vertice4 = new Punto($vertice3->_getCoordenadaX(),$vertice1->_getCoordenadaY());
        }
        else {
            $this->_vertice2 = new Punto($vertice3->_getCoordenadaX(),$vertice1->_getCoordenadaY());
            $this->_vertice4 = new Punto($vertice1->_getCoordenadaX(),$vertice3->_getCoordenadaY());
        }
        $this->calcularDatos();
    }

    function calcularDatos()
    {
        if($this->_vertice2->_getCoordenadaX() == $this->_vertice1->_getCoordenadaX())
        {
            $this->ladoUno = abs($this->_vertice2->_getCoordenadaX() - $this->_vertice3->_getCoordenadaX());
            $this->ladoDos = abs($this->_vertice3->_getCoordenadaY() - $this->_vertice4->_getCoordenadaY());
        }
        else
        {
            $this->ladoUno = abs($this->_vertice2->_getCoordenadaX() - $this->_vertice1->_getCoordenadaX());
            $this->ladoDos = abs($this->_vertice1->_getCoordenadaY() - $this->_vertice4->_getCoordenadaY());
        }
        $this->area = $this->ladoUno * $this->ladoDos;
        $this->perimetro =  ($this->ladoUno + $this->ladoDos) * 2;
    }

    function mostrarDatos()
    {
        if($this->ladoUno == 0 || $this->ladoDos == 0) {
            return "<br/>-- No se puede formar un rectángulo con los puntos dados --";
        }
        return "<br/>Lado Uno: ".$this->ladoUno."<br/>Lado Dos: ".$this->ladoDos."<br/>Área: ".$this->area."<br/>Perímetro: ".$this->perimetro;
    }

    function dibujarRectangulo()
    {
        $retorno = "<br/><br/>";
        for($i=0;$i<$this->ladoDos;$i++)
        {
            for($j=0;$j<$this->ladoUno;$j++)
            {
                if($i == 0 || $i == $this->ladoDos-1 || $j == 0 || $j == $this->ladoUno-1) {
                    $retorno .= "*";
                }
                else {
                    $retorno .= "&nbsp&nbsp";
                }
            }
            $retorno .= "<br/>";
        }
        return $retorno;
    }

}

$rectangulo = new Rectangulo(new Punto(1,2), new Punto(5,8));
echo $rectangulo->mostrarDatos();
echo $rectangulo->dibujarRectangulo();

$rectangulo2 = new Rectangulo(new Punto(3,4), new Punto(1,2));
echo $rectangulo2->mostrarDatos();
echo $rectangulo2->dibujarRectangulo();

$rectangulo2 = new Rectangulo(new Punto(-1,4), new Punto(3,2));
echo $rectangulo2->mostrarDatos();
echo $rectangulo2->dibujarRectangulo();

$rectangulo3 = new Rectangulo(new Punto(2,2), new Punto(2,2)); //Error
echo $rectangulo3->mostrarDatos();
echo $rectangulo3->dibujarRectangulo();

$rectangulo4 = new Rectangulo(new Punto(-1,2), new Punto(-6,-5));
echo $rectangulo4->mostrarDatos();
echo $rectangulo4->dibujarRectangulo();

?>