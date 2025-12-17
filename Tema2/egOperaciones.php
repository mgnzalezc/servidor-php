<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones</title>
</head>
<body>
    <h3><b>Ejercicio 1</b></h3>
    
    <?php
    
        function operaciones($num1,$num2){
            $res = " ";

            if($num1 < $num2){
                $swap = $num1;
                $num1 = $num2;
                $num2 = $swap;
            }
            
            $suma = $num1 + $num2;
            $resta = $num1 + $num2;
            $mult = $num1*$num2;
            $res.="La suma de $num1 y $num2 es $suma <br>";
            $res.="La resta de $num1 y $num2 es $resta <br>";
            $res.="La multiplicación es $mult <br>";

            if($num1==$num2){
                $res.="El numero es el mismo, su división es 1 y su mod es 0<br>";
            } else {
                $div = $num1/$num2;
                $mod = $num1%$num2;
                $res .= "La divisón es $div y su mod es $mod <br>";
            }
            return $res;
        
        } 
        
        echo "UNO: <br>";
        echo operaciones(20,20);
        echo "<br> DOS: <br>";
        echo operaciones(50,20);
        echo "<br> TRES: <br>";
        echo operaciones(20,50);
        
    ?>

    <h3><b>Ejercicio 2</b></h3>

    <?php

        function esMayor($num1,$num2){
            switch(true){
                case($num1<$num2):
                    echo "El num $num2 es mayor que el numero $num1 <br>";
                    break;
                case($num2<$num1):
                    echo "El num $num1 es mayor que el numero $num2 <br>";
                    break;
                default:
                    echo "Los numeros $num1 y $num2 son iguales <br>";

            }
        }

        
        esMayor(rand(1, 60),rand(1, 60));
        
    ?>

    <h3><b>Ejercicio 3</b></h3>
    <?php
    
        function esPar($num1){
            switch(true){
                case($num1==0):
                    echo "El $num1 es 0 <br>";
                    break;
                case($num1%2==0):
                    echo "El $num1 es par <br>";
                    break;
                case(!($num1%2==0)):
                    echo "El $num1 es par <br>";
            }
        }

        esPar(rand(0, 60));

    ?>

    <h3><b>Ejercicio 4</b></h3>

    <?php
    
        function enRango($n,$min,$max){
            if($min<$max && $n<$max && $min<$n){ //corregido abajo
                $rango = ceil(($max+$min)/2);

                if($n<$rango){
                    echo "El num $n está en el rango inferior <br>";
                } elseif($n>$rango){
                    echo "El num $n está en el rango superior <br>";
                } elseif($n==$rango){
                    echo "El num $n es justo la mitad del rango <br>";
                } elseif($n==$min){
                    echo "El num $n es el mínimo <br>";
                } elseif($n==$max){
                    echo "El num $n es el máximo <br>";
                } else {
                    echo "error<br>";
                }
                
            } else {
                echo "?????<br>";
            }

            echo "Num es $n, min es $min, max es $max <br>";
        }

        function enRango2($n,$min,$max){
            if($min>$max){
                echo "Min ($min) es mayor que max ($max)<br>";
            }else if($n>$max){
                echo "n ($n) es mayor que max ($max)<br>";
            }else if($min>$n){
                echo "n ($n) es menor que min ($min)<br>";
            } else {
                $rango = ceil(($max+$min)/2);

                if($n<$rango){
                    echo "El num $n está en el rango inferior <br>";
                } elseif($n>$rango){
                    echo "El num $n está en el rango superior <br>";
                } elseif($n==$rango){
                    echo "El num $n es justo la mitad del rango <br>";
                } elseif($n==$min){
                    echo "El num $n es el mínimo <br>";
                } elseif($n==$max){
                    echo "El num $n es el máximo <br>";
                } else {
                    echo "error<br>";
                }
            }

            echo "Num es $n, min es $min, max es $max <br>";
        }

        $a = rand(1, 100);
        $b = rand(1, 60);
        $c = rand(50, 100);
        echo "UNO:<br>";
        enRango($a,$b,$c);
        echo "DOS:<br>";
        enRango2($a,$b,$c);
        
    ?>

    <h3><b>Ejercicio 5</b></h3>

    <?php
        function esMultiplo($num1,$num2){
            if($num1 < $num2){
                $swap = $num1;
                $num1 = $num2;
                $num2 = $swap;
            } //num1 es mayor

            if($num1%$num2==0){
                echo "$num1 es multiplo de $num2 <br>";
            } else{
                echo "$num1 no es multiplo de $num2";
            }

        }

        esMultiplo(rand(1, 100),rand(1, 100));

    ?>


    <h3><b>Ejercicio 6. Match</b></h3>
    
    <?php
        $dia = "lunes";
        $clases = match($dia){
            "lunes" => "No tenemos Servidor",
            "martes" => "No tenemos Servidor",
            "miercoles","jueves","viernes" => "Tenemos Servidor",
            default => "Finde"
        };

        echo $clases."<br>";
    
    ?>
    <br>
    <?php
        $numerito = rand(0, 50);
        $check = $numerito%2;

        $sol = match($check){
            0 => "par",
            1 => "impar"
        };

        echo "El num $numerito es ".$sol."<br>";

        //segunda y mejor forma de hacerlo
        $resultado = match(true){
            ($numerito == 0) => "cero",
            ($numerito%2 == 0) => "par",
            default => "impar"
        };
        echo "El num $numerito es ".$resultado."<br>";

    ?>
    
    <br>
    <?php
        $numerito = rand(0, 10);

        echo match(true){
            ($numerito <= 4) => "Suspenso", //tambien puedes 1,2,3,4
            ($numerito <= 6) => "Aprobado",
            ($numerito <= 8) => "Sobresaliente",
            ($numerito <= 10) => "Genia",
            default => "Error"
        };


    ?>
    <br>

    <h3><b>Ejercicio 6. Match</b></h3>
    <?php
        function calculadora($op, $x, $y){
           
            /*
            $result = match(true){
                ($op == "suma") => $x+$y,
                ($op == "resta") => $x-$y,
                ($op == "mult") => $x*$y,
                ($op == "div") => $x/$y
            };
            */
            //asi mejor:
            $result = match($op){
                "suma" => $x+$y,
                "resta" => $x-$y,
                "mult" => $x*$y,
                "div" => $x/$y,
                default => "Error"
            };

            return $result;
        }

        $rdm = rand(1, 4);
        
        switch($rdm){
            case 1:
                $op = "suma";
                break;
            case 2:
                $op = "resta";
                break;
            case 3:
                $op = "div";
                break;
            case 4:
                $op = "mult";
                break;
            default:
                $op = "error";
        }

        $num1 = rand(5, 10);
        $num2 = rand(1, 5);
        echo calculadora($op,$num1,$num2);

        echo "<br>";

        echo "$op de num1 $num1 y num2 $num2";

    ?>



    <h3><b>Ejercicio 7.</b></h3>
    <?php
        function comparador($a,$b,$c){
            if($a==$b && $b==$c){
                return "Todos los numeros son iguales<br>";
            } else if ($a==$b || $a==$c || $b==$c){
                return "Al menos dos numeros son iguales<br>";
            } else {
                return "Ningun numero es igual<br>"; 
            }
        }

    ?>

    <h3><b>Ejercicio 8.</b></h3>
    <?php
        function login($user,$pwd){
            $usuario1 = "admin";
            $password1 = "1234m";
            $usuario2 = "cliente";
            $password2 = "cliente1234";

            if($user=="" || $pwd==""){
                return "Faltan credenciales <br<";
            }
            if(($user == $usuario1 && $pwd == $password1)){
                return "Welcome $usuario1 <br>";
            } else if ($user == $usuario2 && $pwd == $password2){
                return "Welcome $usuario2 <br>";
            } else {
                return "Usuario o contraseña incorrectos <br>";
            }


        }


    ?>

    <h3><b>Ejercicio 9. Descuentos</b></h3>
    <?php 
        function calcularSusc(string $plan, bool $estudiante, bool $anual){
            
            if($plan != "basic" || $plan != "pro" || $plan != "enterprise"){
                return "Plan no disponible";
            } else if ($plan == "basic"){
                $total = 20;
            } else if ($plan == "pro"){
                $total = 40;
            } else if ($plan == "enterprise"){
                $total = 50;
            
            $res = "Plan $plan - Total ";
            if($estudiante && $anual){
                $total -= (($total*0.15)*0.20);
                $res += "$total. Desc E. Desc A.";
            } else if($estudiante){
                $total /= 1.15;
                $res += "$total. Desc E";
            }else if($anual){
                $total /=1.20;
                $res .= "$total. Desc A";
            } else {
                $res .= "$total";
            }

        }

        return $res;
    }

    ?>



    <h3><b>Ejercicio 10. Bucle for</b></h3>
    <?php 
    
        echo "<pre>";
        for($i = 1; $i<=10; $i++){
            for($j = 1; $j<=$i; $j++){
                echo "  ";
            }
            echo $i."<br>";
        }
        echo "</pre>";
        
    ?> 

    <h3><b>Ejercicio 11. Tabla multiplicar</b></h3>
    <?php 
    
        $num = "100";
        for($i = 1; $i<=10; $i++){
            echo "$num * $i = ".($num*$i)."<br>";
        }

    ?>

    <h3><b>Ejercicio 12. Cuadrado hueco</b></h3>
    <?php
    echo "<pre>";
        function cuadradoHueco($size){
            $cuadrado = "";
            for($i=0; $i<$size; $i++){
                for($j=0; $j<$size; $j++){
                    if($i==0 || $i==($size-1) || $j == 0 || $j==($size-1)){
                        $cuadrado .= "*";
                    } else {
                        $cuadrado .= " ";
                    }
                }
                $cuadrado .= "<br>";
            }

            return $cuadrado;
        } 

        echo (cuadradoHueco(20));

        echo "</pre>"
    ?>

    <h3><b>Ejercicio 13. Matriz * - +</b></h3>
    <?php
    echo "<pre>";
        function matrizRara($size){
            $cuadrado="";

            for($i=0; $i<$size; $i++){
                for($j=0; $j<$size; $j++){
                    if($i==$j || ($i+$j)==($size-1)){
                        $cuadrado .= "* ";
                    } else if(($i+$j)%2==0){
                        $cuadrado .= "+ ";
                    } else {
                        $cuadrado .= "- ";
                    }
                }
                $cuadrado .= "<br>";
            }
        return $cuadrado;
        }

        echo (matrizRara(15));
    echo "</pre>"
    ?>

    <h3><b>Ejercicio 14. Cruz</b></h3>
    <?php
    echo "<pre>";
        function matrizCruz($size){
            $cuadrado="";

            for($i=0; $i<$size; $i++){
                for($j=0; $j<$size; $j++){
                    if($size%2!=0 && $i==(intval($size/2)) && $j==(intval($size/2))){
                        $cuadrado .= "X";
                    } 
                    else if($i==$j){
                        $cuadrado .= "\\";
                    } else if(($i+$j)==($size-1)){
                        $cuadrado .= "/";
                    } 
                    else {
                        $cuadrado .= " ";
                    }
                }
                $cuadrado .= "<br>";
            }
        return $cuadrado;
        }

        echo (matrizCruz(15));
    echo "</pre>"
    ?>

    <h3><b>Ejercicio 14.1 Cruz extendido</b></h3>
    <?php
    echo "<pre>";
        function cruzExtendido($size){
            $cuadrado="";


            for($i=0; $i<$size; $i++){
                for($j=0; $j<$size; $j++){
                    
                    if ($size%2!=0 && $i==(intval($size/2)) && $j==(intval($size/2))){
                        $cuadrado .= "X";
                    } else if($i==$j){
                            $cuadrado .= "\\";
                    } else if(($i+$j)==($size-1)){
                            $cuadrado .= "/";
                    } else {

                        if($i<=($size/2) && $i<$j && ($i+$j)<($size-1)) {
                        $cuadrado .= "+";
                        } else if ($i>($size/2) && $i>$j && ($i+$j)>($size-1)){
                            $cuadrado .= "-";
                        } else if($j<=($size/2) && $j<$i && ($j+$i)<($size-1)) {
                        $cuadrado .= "*";
                        } else if ($j>($size/2) && $j>$i && ($i+$j)>($size-1)){
                            $cuadrado .= "%";
                        } 

                    }
                
                }
                $cuadrado .= "\n"; //solo funciona la \n con el pre, si usas <br> no hace falta
                
            }
            return $cuadrado;
        }

        echo (cruzExtendido(15));
    echo "</pre>"
    ?>



</body>
</html>