<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 15 (Figuras geométricas)
La clase FiguraGeometrica posee: todos sus atributos protegidos, un constructor por defecto,
un método getter y setter para el atributo _color, un método virtual (__toString) y dos
métodos abstractos: Dibujar (público) y CalcularDatos (protegido).
CalcularDatos será invocado en el constructor de la clase derivada que corresponda, su
funcionalidad será la de inicializar los atributos _superficie y _perimetro.
Dibujar, retornará un string (con el color que corresponda) formando la figura geométrica del
objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
Utilizar el método __toString para obtener toda la información completa del objeto, y luego
dibujarlo por pantalla.

*******************************************************************************/



abstract class FiguraGeometrica
{
	//Atributos.
	protected $_color;
	protected $_perimetro;
	protected $_superficie;

	//Métodos.
    public function __construct(){
        $this->_color = "black";
        $this->_perimetro = 0;
        $this->_superficie = 0;
    }
	public function GetColor(){
		return $this->_color;
	}
	public function SetColor(string $color){
		$this->_color = $color;
	}

	public abstract function Dibujar();
	protected abstract function CalcularDatos();

	public function __toString(){
		return "Color: ".$this->GetColor()."<br>
				Perimetro: ".$this->_perimetro."<br>
				Superficie: ".$this->_superficie."<br>";
	}
}

class Rectangulo extends FiguraGeometrica
{
	private $_ladoUno;
	private $_ladoDos;

	public function __construct ($l1, $l2){
		parent::__construct();
		$this->_ladoUno = $l1;
		$this->_ladoDos = $l2;
		$this->CalcularDatos();
	}
	protected function CalcularDatos() {
		//inicializar los atributos _superficie y _perimetro
		$this->_perimetro = $this->_ladoUno*2 + $this->_ladoDos*2;
        $this->_superficie = $this->_ladoUno*$this->_ladoDos;
	}
	public function Dibujar(){
		//retornará un string (con el color que corresponda) formando la figura geométrica del
		//objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
		$color = $this->GetColor();
        $retorno = "<p style=color:$color;>";

		for($fila=0; $fila<$this->_ladoDos; $fila++)
		{
			for($columna=0; $columna<$this->_ladoUno; $columna++)
				$retorno .= "*";
			$retorno .= "<br/>";	
		}
		$retorno.= "</p>";
		return $retorno;
	}
	public function __toString(){
		//obtiene la info del objeto y la muestra por pantalla
		return parent::__toString()."Ancho: ".$this->_ladoUno."<br/>Alto: ".$this->_ladoDos."<br/>".$this->Dibujar();
	}
}

class Triangulo extends FiguraGeometrica
{
	private $_altura;
	private $_base;
	public function __construct ($b, $h){
        parent::__construct();
		$this->_base = $b;
		$this->_altura = $h;
        $this->CalcularDatos();
	}
	protected function CalcularDatos() {
		//inicializar los atributos _superficie y _perimetro
		$this->_perimetro = $this->_base + $this->_altura*2;
        $this->_superficie = $this->_base * $this->_altura/2;
	}
	public function Dibujar(){
		//retornará un string (con el color que corresponda) formando la figura geométrica del
		//objeto que lo invoque (retornar una serie de asteriscos que modele el objeto).
        $color = $this->GetColor();
        $retorno = "<p style=color:$color;>";
		$incremento = round($this->_base / ($this->_altura - 1));

		//Construyo la primer linea con un sólo "*" a la mitad
		for($columna=0; $columna<round($this->_base/2); $columna++)
		{
			if($columna==round($this->_base/2)-1)
				$retorno .="*";
			else
				$retorno .="&nbsp&nbsp";
		}
		$retorno .= "<br/>";


		for($fila=1; $fila<$this->_altura; $fila++)
		{
			//(Base - incremento*fila)/2 me da la cantidad de espacios q tengo que meter ADELANTE.
			$espaciosAdelante = (round($this->_base - $incremento*$fila)/2);
			for($i=0;$i<$espaciosAdelante;$i++)
				$retorno .="&nbsp&nbsp";

			for($columna=0; $columna<$this->_base; $columna++)
			{
				if($columna<$incremento*$fila 
				|| ($fila==$this->_altura-1)) //última linea siempre con igual cantidad de "*" como indica la base.
					$retorno .="*";
			}
			$retorno .= "<br/>";	
		}
		$retorno .= "</p>";
		return $retorno;
	}
	public function __toString(){
		//obtiene la info del objeto y la muestra por pantalla
		return parent::__toString()."Altura: ".$this->_altura."<br/>Base: ".$this->_base."<br/>".$this->Dibujar();
	}
}

$triangulo = new Triangulo(5, 3);
$triangulo->SetColor("red");
echo($triangulo);

$triangulo = new Triangulo(60, 8);
$triangulo->SetColor("green");
echo($triangulo);

$triangulo = new Triangulo(5, 6);
$triangulo->SetColor("rgb(3,15,252)");
echo($triangulo);

$rectangulo = new Rectangulo(9, 9);
$rectangulo->SetColor("#db03fc");
echo($rectangulo);

$rectangulo = new Rectangulo(40, 10);
echo($rectangulo);

?>