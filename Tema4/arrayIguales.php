<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema 4 ejercicios</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>

    <form action="" method="POST">
        <input type="number" name="num1"><br>
        <input type="number" name="num2"><br>


        <input type="submit" value="ENVIAR"><br>
    </form>


    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $array1 = extraerArray($num1);
        print_r($array1);

        $array2 = extraerArray($num2);
        print_r($array2);

        if($array1 == $array2){
            echo "<br>Los numeros son inguales<br>";
        }
    }

    function extraerArray($num1){
        $separar = [];
        while($num1 > 0){
            $separar[] = $num1%10;
            $num1 = intval($num1/10);
        }

        sort($separar);
        $separar = array_values($separar);
        return $separar;
    }



    ?>
</body>
</html>