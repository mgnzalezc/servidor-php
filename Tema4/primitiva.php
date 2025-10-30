<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primitiva</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>
    <h3>Primitiva</h3>
    <p>Introduce 6 numeros distintos del 1-20.</p>
    <form action="" method="POST">
        <input type="number" name="n0" min="1" max="20">
        <input type="number" name="n1" min="1" max="20">
        <input type="number" name="n2" min="1" max="20">
        <input type="number" name="n3" min="1" max="20">
        <input type="number" name="n4" min="1" max="20">
        <input type="number" name="n5" min="1" max="20">

        <input type="submit" value="ENVIAR"><br>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $intentos = [];
            for ($i=0; $i < 6; $i++) { 
                $intentos[] = $_POST["n$i"];
            }
            
            $count= 0;
            $repe = false;
            do{
                for ($i=0; $i < 6; $i++) { 
                    if ($count != $i){
                        if($intentos[$count]==$intentos[$i]){
                            $repe = true;
                            
                        }
                    }
                }
                $count++;
            }while((!$repe) || $count<6);

            if($repe){
                echo "Error. Hay un numero repetido <br>";
            }
            else {
                
                $primi=[];
                $repe = false;
                for ($i=0; $i < 6; $i++) { 
                    $count = 0;
                    do { 
                        $rdm = rand(1,20);

                        if ($count != $i){
                            if($intentos[$count]==$intentos[$i]){
                                $repe = true;
                                
                            }
                        }
                        

                    }while(!$repe);
                }
                

            
            }

        }
    ?>

    <p>Acabar arriba y hacer dados:</p>
    <p>primer turno:</p>
    <p>7 o 11 -> ganamos, 2 o 12 -> perdemos, cualquier otro num -> ese num se llama "punto"</p>
    <p>"punto" se mantiene fijo como el numero para ganar el resto del juego</p>
    <p>segundo turno:</p>
    <p>7 pierdo, punto gano</p>
    <p>do while hasta que gane</p>


</body>
</html>