<?php
/******************************************************************************

Lemos Lautaro Lucas
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’ , ‘-’, ‘/’  y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.


*******************************************************************************/

$op1 = 2;
$op2 = 6;
$operador = '*';

switch($operador)
{
    case '+':
        printf("Suma: %.2f", $op1 + $op2);
        break;
    case '-':
        printf("Resta: %.2f", $op1 - $op2);
        break;
    case '/':
        if($op2 != 0)
            printf("División: %.2f", ($op1 / $op2));
        else
            printf("No se puede dividir por cero.");
        break;
    case '*':
        printf("Multiplicación: %.2f", $op1 * $op2);
        break;
}

?>