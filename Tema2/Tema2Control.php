<?php
$a = 3;

//primera forma
if ($a > 0) {
    echo "<p> El n es positivo <p>";
}

//segunda forma
if ($a > 0) echo "<p> El n es positivo <p>";

//tercera forma para los de db
if ($a > 0):
    echo "<p> El n es positivo <p>";
endif;

//ESTRUCTURA DE CONTROL IF ELSE
$b = 3;

//primera forma
if ($b < 0) {
    echo "<p> El n es negativo <p>";
} else {
    echo "<p> El n es positivo o 0 <p>";
}

//segunda forma
if ($b < 0) echo "<p> El n es negativo <p>";
else echo "<p> El n es positivo o 0 <p>";

//tercera forma
if ($b < 0):
    echo "<p> El n es negativo <p>";
else:
    echo "<p> El n es positivo o 0 <p>";
endif;

//ELSEIF
//primera forma
if ($b < 0) {
    echo "<p> El n es negativo <p>";
} else if ($b > 0) {
    echo "<p> El n es positivo <p>";
} else {
    echo "<p> El n es 0 <p>";
}

//segunda forma
if ($b < 0) echo "<p> El n es negativo <p>";
else if ($b > 0) echo "<p> El n es positivo <p>";
else echo "El n es 0";

//tercera forma
if ($b < 0):
    echo "<p> El n es negativo <p>";
elseif ($b > 0):
    echo "<p> El n es positivo<p>";
else:
    echo "El n es 0";
endif;

//SWITCH
$numerito = 1;
switch ($numerito) {
    case 1:
        echo "<p>el numerito es uno</p>";
        break;
    case 2:
        echo "<p>el numerito es dos</p>";
        break;
    default:
        echo "<p>el numerito no esta contemplado</p>";
}

$user = "dev";
switch ($user) {
    case "admin":
        echo "<p>Bienvenido $user, tiene accedo a toda la web</p>";
        break;
    case "dev":
        echo "<p>Bienvenido $user, puedes programar en nuestra plataforma</p>";
        break;
    case "client":
        echo "<p>Bienvenido $user, puede acceder a nuestros productos</p>";
        break;
    default:
        echo "<p>Quien eres?</p>";
}

$num1 = rand(1, 150);
$num2 = rand(1, 150);
switch (true) {
    case ($num1 > $num2):
        echo "<p>$num1 es mayor que $num2</p>";
        break;
    case (($num1 == $num2) && ($num1 > 10 && $num2 > 10)):
        echo "<p>$num1 y $num2 son iguales, y son mayores que 10</p>";
        break;
    case ($num1 < 100 || $num2 < 100):
        echo "<p>$num1 o $num2 es menor que 100</p>";
        break;
}


/*
    ESTRUCTURA DEL MATCH:
    $resultado = match(numero){
        1 => "Se ha escogido el primer numero",
        2 => "Se ha escogido el segundo numero",
        3 => "Se ha escogido el tercer numero"
    };

    si el valor de numero es 1, "se ha escogido....." se guarda en resultado
    es un match estricto, compara numero === resultado, entonces tiene que compararse num con num y String con String

    *ejemplos en egOperaciones


*/

/*
    calculadora($op, $x, $y)

    op -> string de suma resta div mult

    calculadora devuelve una variable
*/