<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bingo</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>
    <?php
    
    $cartulina = [];
    for ($i=0; $i < 9; $i++) { 
        for ($j=0; $j < 3; $j++) { 
            if($i==0){
                $cartulina[$i][$j] = rand(1,9);
            }else if ($i==8){
                $cartulina[$i][$j] = rand(81,90);
            }else{
                $cartulina[$i][$j] = rand(($i*10),(($i*10)+9));
            }
        }
        sort($cartulina[$i]);
    }

    print_r($cartulina);

    ?>

</body>
</html>
