<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Ejercicios:</p>
    <br>
    <p><b>Crea un programa que muestre "Hola {aquí tu nombre}" usando una variable donde recojas tu nombre </b></p>

    <?php
        function mostrarNombre (){
            $nombre = "Maria";
            echo $nombre."<br>";
        }

        mostrarNombre();
    ?>
    
    <br>

    <p><b>Declara dos variables numéricas e imprime su suma, resta, multiplicación, división y módulo (%). Además, el mensaje deberá de ser el siguiente: "El resultado de la suma entre {valor variable 1} y {valor variable 2} es: {solucion}"</b></p>
    
    <?php 
        $num1 = 50;
        $num2 = 20;
        echo"La suma de $num1 y $num2 es ".$num1+$num2; //asi se puede tb
        echo "<br>";
        echo"La resta de ".$num1." y ".$num2." es ".$num1-$num2;
        echo "<br>";
        
    ?>

    <br>        

    <p><b>Declara una variable con el valor 5. Imprime su valor antes y después de aplicar el incremento y el decremento</b></p>
    
    <?php

        $vari = 5;

        $vari++;
        echo $vari;

        echo "<br>";

        --$vari;
        echo --$vari;

        echo "<br>";
    ?>

    <br> 

    <p><b>Declara dos variables numéricas y comprueba si:</p>
    <p>1- el primero es mayor que el segundo </p> 
    <p>2- ambos son iguales y mayores que 10</p> 
    <p>3- al menos uno es menor que 100</b></p>
    
    <?php

        $num1 = 40;
        $num2 = 30;

        echo "1- ".($num1>$num2)."<br>";

        echo "2 -".(($num1==$num2) && ($num1>10 && $num2>10))."<br>"; //podemos quitar num2>10 porque si llega hasta ahi es porque num1 == num2 entonces comparamos solo uno

        echo "3- ".($num1<100 || $num2<100)."<br>";

        echo "<br>";
    ?>
    
    <br> 


    <p><b>Crea una variable fuera de una función e intenta imprimirla dentro de la función sin usar "global". En caso de no conseguirlo, corrige la llamada a la variable.</b></p>
    
    <?php

        $cadena = "hola";

        function mostrar($cadena){
            echo $cadena;
        }

        function mostrar2(){
            global $cadena;
            return $cadena;
        } 
        echo mostrar2();

        echo "<br>";
    ?>
    
    <br> 
        
    <p><b>Crea una función con una variable estática llamada "numerito" inicializada a 2.5, la función deberá de multiplicar por dos el valor de la variable estática y mostrarlo en el navegador. ¿Cambia el resultado de la multiplicación si llamamos a la función varias veces?</b></p>
    
    <?php
        function multi(){
            static $numerito = 2.5;
            return $numerito *=2; //sino hacemos aqui el echo
        }
    
        echo multi(); //y si lo hacemos dentro d la funcion o hace falta aqui echo
        echo "<br>";
    ?>
    
    <br> 
 

    <p><b>Crea una función con una variable local llamada "numerito2" inicializada a 3.5, la función deberá de dividir por cuatro el valor de la variable local y mostrarlo en el navegador. ¿Cambia el resultado de la división si llamamos a la función varias veces?</b></p>
    
    <?php

        echo "<br>";
    ?>
    
    <br> 

    <p><b>Define una constante llamada PHP con el valor "este lenguaje es precioso". Además, impríme el resultado de la constante dentro de una etiqueta h2</b></p>
    
    <?php
        define("PHP","este leng es precioso");
        echo "El valor de mi const es ".PHP;
        echo "<br>";
    ?>
    
    <br> 

    <p><b>Crea variables con un numero entero, un decimal, un booleano y un string. Ahora muestra cada variable haciendo uso de la función var_dump()</b></p>
    
    <?php
        $grande = 9.1e9;
        $grande = intval($grande);
        echo "<br>";
    ?>
    
    <br> 
        
    <p><b>Declara una variable llamada hobby que contendrá un string con tu pasatiempos favorito, muestra esta cadena dentro de una etiqueta h1 haciendo uso de una etiqueta PHP diferente al del resto de ejercicios</b></p>
    
    <?php
        
        echo "<br>";
    ?>
    
    <br> 
         
         
    
</body>
</html>