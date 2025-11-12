<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejer2</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>

    <form action="" method="POST">
        <label for="inception"> Inception. Ciencia ficcion. 3.5e <br>
         Días de alquiler:</label>
        <input type="number" name="inception"><br>
        <label for="parasite"> Parasite. Thriller. 3e <br>
         Días de alquiler:</label>
        <input type="number" name="parasite"><br>
        <label for="interstellar"> Interstellar. Ciencia ficcion. 3.5e <br>
         Días de alquiler:</label>
        <input type="number" name="interstellar"><br>
        <label for="joker"> Joker. Ciencia ficcion. 2.5e <br>
         Días de alquiler:</label>
        <input type="number" name="joker"><br>
        <label for="avengers"> Avengers. Ciencia ficcion. 4e <br>
         Días de alquiler:</label>
        <input type="number" name="avengers"><br>
        <input type="submit" value="ENVIAR">
    </form>


<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $peliculas = [
            "inception" => [
                "titulo" => "Inception", 
                "genero" => "Ciencia Ficción", 
                "precio_dia" => 3.50
            ],
            "parasite" => [
                "titulo" => "Parasite", 
                "genero" => "Thriller", 
                "precio_dia" => 3.00
            ],
            "interstellar" => [
                "titulo" => "Interstellar", 
                "genero" => "Ciencia Ficción", 
                "precio_dia" => 3.50
            ],
            "joker" => [
                "titulo" => "Joker", 
                "genero" => "Drama", 
                "precio_dia" => 2.50
            ],
            "avengers" => [
                "titulo" => "Avengers: Endgame", 
                "genero" => "Acción", 
                "precio_dia" => 4.00
            ] 
        ];

        $inception = $_POST["inception"];
        $parasite = $_POST["parasite"];
        $interstellar = $_POST["interstellar"];
        $joker = $_POST["joker"];
        $avengers = $_POST["avengers"];

        foreach ($peliculas as $titulo => &$datos) {
            if($titulo == "inception"){
                $total = $datos["precio_dia"] * $inception;
                $datos["dias"] = $inception;
                $datos["total"] = $total;
            } else if ($titulo == "parasite"){
                $total = $datos["precio_dia"] * $parasite;
                $datos["dias"] = $parasite;
                $datos["total"] = $total;
            } else if ($titulo == "interstellar"){
                $total = $datos["precio_dia"] * $interstellar;
                $datos["dias"] = $interstellar;
                $datos["total"] = $total;
            } else if ($titulo == "joker"){
                $total = $datos["precio_dia"] * $joker;
                $datos["dias"] = $joker;
                $datos["total"] = $total;
            } else if ($titulo == "avengers"){
                $total = $datos["precio_dia"] * $avengers;
                $datos["dias"] = $avengers;
                $datos["total"] = $total;
            }
        }

        print_r($peliculas);

    }

?>

    <table border="1px">
        <tr>
            <th>Pelicula</th>
            <th>Genero</th>
            <th>Precio/dia</th>
            <th>Dias</th>
            <th>Subtotal</th>
        </tr>
        <?php
            foreach ($peliculas as $titulo => $datos) {
                echo "<tr>";
                if($datos["dias"] != 0){
                    foreach ($datos as $descripc => $valor) {
                    
                        echo "<td>";
                        echo $valor;
                        echo "</td>";
                    }
                }
                echo "</tr>";
            }

        ?>
        

    </table>


</body>
</html>