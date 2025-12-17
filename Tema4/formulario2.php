<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario 2</title>
</head>
<body>
    <ul>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $msj = $_POST["msj"];
            $n = $_POST["veces"];
            
            for ($i=0; $i < $n; $i++) { 
               echo "<li> $msj </li>";
            }
        }

    ?>
    </ul>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tabla = $_POST["tabla"];
            for ($i=1; $i <= $tabla; $i++) { 
                for ($j=1; $j <= 10; $j++) { 
                    echo " $i*$j=> ".($i*$j)."<br>" ;
                }
            }

        } 
        else if ($_SERVER["REQUEST_METHOD"] == "GET"){
            $tabla = $_GET["tabla"];
            for ($i=1; $i <= $tabla; $i++) { 
                for ($j=1; $j <= 10; $j++) { 
                    echo " $i x $j= ".($i*$j)."<br>" ;
                }
            }
        }

    ?>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $temp = $_POST["temp"];
            $og = $_POST["og"];
            $fnl = $_POST["fnl"];
            echo "Temperatura inicial: $temp $og<br>";
            if($og == "c"){
                if($fnl == "k"){ //c to k
                    $temp += 273.15;
                } else  if ($fnl == "f"){ //c to f.
                    $temp = ($temp * 9/5) + 32;
                }

            } else if ($og == "k"){
                if($fnl == "c"){ //k to c
                    $temp -= 273.15;
                } else if ($fnl == "f"){ //k to f
                    $temp = ($temp-273) * (9/5) + 32;
                }

            } else if($og = "f"){
                if($fnl == "k"){ //f to k
                    $temp = ($temp - 273.15)* 9/5 + 32;
                } else if($fnl == "c"){ //f to c
                    $temp = ($temp - 32) * 5/9 + 273.15;
                }
            }

            echo "Temperatura final: ".$temp.$fnl;

        }
    ?>

    

</body>
</html>