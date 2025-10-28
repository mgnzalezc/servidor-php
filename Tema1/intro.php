<?php
    /* todo lo que esta aqui es php
    tenemos que insertar html en .php, NO php en .html
    no hay que declarar tipo de dato */

    echo "Hola Mundo!";

    $nombre = "Jesus";
    $edad = 24;
    $altura = 1.89;

    echo "<br>";
    echo "El nombre de mi compi es $nombre, tiene $edad años y mide $altura metros";

    echo "<br> El nombre de mi compi es ".$nombre.", tiene ".$edad." años...";

    echo "<br> La suma de edad y altura es: ".($edad+$altura);

    echo "<br> Así es dinámico: ".date("d/m/Y H:i:s");

    $num1 = 10;
    $num2 = 20;

    echo"<br> La suma es ".$num1+$num2;
    echo"<br> La resta es ".$num1-$num2;
    echo"<br> La multipl es ".$num1*$num2;
    echo"<br> La divis es ".$num1/$num2;

    $salto = "<br>";

    echo "<br>";
    $num3 = $num1++; //aqui primero se iguala num3, luego se suma a num1
    $num4 = ++$num2; //aqui se guarda en num4 la suma de num2+1 sin modificar num2

    echo "prueba 1 - $num3 $num4";

    $num3 = $num1++; // aqui num1 se cambia a 11, por eso despues num4 es 12
    $num4 = ++$num1; // 

    echo "<br> prueba 2 - $num3 $num4";

    $num1 = 10;
    $num2 = 20;

    echo "<br> solucion = ". $num1+=$num2;

    $num1 = 10;
    $num2 = 20;

    echo "<br> solucion = ". $num1-=$num2;

    $num1 = 10;
    $num2 = 20;

    echo "<br> solucion = ". $num1*=$num2;

    $num1 = 10;
    $num2 = 20;

    echo "<br> solucion = ". $num1/=$num2;

    $num1 = "hola";
    echo "<br>".gettype($num1); 
    //se puede cambiar el tipo porque php lee linea por linea
    
    $num1 = true;
    echo "<br>".gettype($num1); 

    $num1 = 3;
    echo "<br>".gettype($num1); 

    $num1 = 100;
    $num2 = 20;

    $caso1 = !($num1<$num2 || (10<11));
    echo "<br>".$caso1;

    $caso2 = $num1 === $num2;

    echo "<br> Es 21 igual que 13 y es 14 menor o igual que 20?: ".((21==13)&&(14<=20));
    echo "<br> Es 14 mayor o igual que 2 o es 21 menor que 20?: ".((14>=2)||(21<20));

    define("PI", 3.14159);

    echo "<br> Mi constante es ".PI;

    
    $numerito = 1.354;
    // para ver el valor y el tipo dato
    echo "<br>";
    echo "<br> Numerito es: ";
    var_dump($numerito); //muestra el valor y el tipo dato de la variable

    //de int a string 
    
    $newnumerito = strval($numerito); //strval convierte el int a string
    var_dump($newnumerito);

    //de string a int
    echo "<br> De string a int: ";
    $frase = "1256";
    $backaint = intval($frase); //convertir a int
    var_dump($backaint);

    echo "<br>";
    echo "<br> FUNCIONES: <br>";
    

    $globalMal = "holi desde fuera";
    function mostrarMal(){
       // echo $globalMal;
    }

    $globalBien = "holi bien desde fuera";
    function mostrarBien(){
        global $globalBien;
        echo $globalBien."<br>";
    }
    mostrarBien();


    echo "<br> STATIC: <br>";

    function contador (){
        static $local = 10;
        $local++;
        echo $local."<br>";
    }
    
    contador();
    contador();


    $a = 11;
    $b=12;

    function suma($x,$y){
        
        return $x + $y;

        // echo "La suma es : " $solucion;
    }

    suma($a,$b);


    //IF Y ELSE
    echo "<br>";
    echo "IF Y ELSE <br>";

    if($a <= $b){
        $a++;
        $b--;
    } else {
        $a--;
        $b++;
    }

    function igualar($n1,$n2){
        if($n1 < $n2){
            $n1++;
            $n2--;
        } elseif($n2 < $n1){
            $n2++;
            $n1--;
        } 
        $res = $n1." y ".$n2;
        return $res;

    }

    $n1=8;
    $n2=15;
    echo igualar($n1,$n2);



    ?> 