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

</body>
</html>