<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arrays php</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $opcion = $_POST["operacion"];
        $esta = false;

        $enNum1 = [];
        $todos = [];
        $repes=[];

        $tmp_num1 = [];
        $tmp_num2 = [];
            for ($i=0; $i < strlen($num1); $i++) { 
                for ($j=0; $j < count($tmp_num1); $j++) { 
                    if($num1[$i]==$tmp_num1[$j]){ //ya esta metido en array
                        $esta = true;
                    }
                }
                if(!$esta){
                    $tmp_num1[] = $num1[$i];
                } else {
                    $esta = false;
                }
                
            }
            

            for ($i=0; $i < strlen($num2); $i++) { 
                for ($j=0; $j < count($tmp_num2); $j++) { 
                    if($num2[$i]==$tmp_num2[$j]){ //ya esta metido en array
                        $esta = true;
                    }
                }
                if(!$esta){
                    $tmp_num2[] = $num2[$i];
                } else {
                    $esta = false;
                }
                
            }

            echo "num1 es $num1 <br>";
            echo "num2 es $num2 <br>";
            sort($tmp_num1);
            sort($tmp_num2);
            print_r($tmp_num1);
            print_r($tmp_num2);
            $esta = false;

        if($num1 == $num2){
            echo "los numeros son iguales";
        }
        else if($opcion=="1"){
            $resultado = [];
            for ($i=0; $i < count($tmp_num1); $i++) { 
                for ($j=0; $j < count($tmp_num2); $j++) { 
                    if($tmp_num1[$i]==$tmp_num2[$j]){
                        $esta = true;
                    }
                }
                if($esta){
                    $resultado[]=$tmp_num1[$i];
                    $esta = false;
                }
            }
            
            sort($resultado);
            print_r($resultado);
            
        } else if($opcion == "2"){
            $resultado = $tmp_num1;


        }









/*

        if($num1 == $num2){
            echo "Los numers son iguales";
        } else if($opcion == "3"){ //LOS QUE APARECEN SOLO EN NUM1
            for ($i = 0; $i < strlen($num1); $i++) {
                for ($j=0; $j < strlen($num2); $j++) { 
                    if($num1[$i]==$num2[$j]){
                        $esta = true;
                    }
                }
                if(!($esta)){
                    $enNum1[]=$num1[$i];
                }else{
                    $esta=false;
                }
            } //recorro el num1 y miro si esta en el 2

            for ($i=0; $i < count($enNum1); $i++) { 
                for ($j=0; $j < count($enNum1); $j++) { 
                    if($i!=$j){
                        if($enNum1[$i] == $enNum1[$j]){
                            unset($enNum1[$j]);
                            
                        }
                    }
                    sort($enNum1);
                }
                
            } //elimina repetidos del array final


        
        echo "LOS DEL 1 QUE NO ESTAN EN EL 2<br>";
        print_r($enNum1);
        echo "<br>num1---->$num1 | num2---->$num2";

        } else if ($opcion == "2"){ //OPCION2, NUMEROS REPE
            for ($i = 0; $i < strlen($num1); $i++) {
                for ($j=0; $j < strlen($num2); $j++) { 
                    if($num1[$i]==$num2[$j]){
                        $esta = true;
                    }
                }
                if(($esta)){
                    $repes[]=$num1[$i];
                }else{
                    $esta=false;
                }
            }

            for ($i=0; $i < count($repes); $i++) { 
                for ($j=0; $j < count($repes); $j++) { 
                    if($i!=$j){
                        if($repes[$i] == $repes[$j]){
                            unset($repes[$i]);
                        }
                    }
                }
                sort($repes);
            } //elimina repetidos del array final

            echo "LOS REPES<br>";
            print_r($repes);

            echo "<br>num1---->$num1 | num2---->$num2";
        } else if ($opcion == "1"){
            $esta = false;
            $todos_tmp = [];
            for ($i=0; $i < strlen($num1); $i++) { 
                $todos_tmp[]=$num1[$i];
            }
            for ($i=0; $i < strlen($num2); $i++) { 
                $todos_tmp[]=$num2[$i];
            }
            sort($todos_tmp);
            print_r($todos_tmp);

            $todos[0]=$todos_tmp[0];

            for ($i=1; $i < count($todos_tmp); $i++) { 
                for ($j=0; $j < count($todos); $j++) { 
                    if($todos_tmp[$i]==$todos[$j]){
                        $esta = true;
                    }
                }
                if(!$esta){
                    $todos[] = $todos_tmp[$i];
                } else {
                    $esta = false;
                }
                
            }
            print_r($todos_tmp);
            print_r($todos);
        }
        */
    }
        
    echo "<br><a href='practicando1.html'>Volver a form</a>";
?>

   
</body>
</html>
