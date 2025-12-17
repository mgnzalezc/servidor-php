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
    <form action="" method="get">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br>

        <label for="edad">Edad:</label>
        <input type="number" name="edad"><br>

        <input type="submit" value="ENVIAR"><br>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            print_r($_GET);
        } //para imprimir los datos que hemos recogido



        //y ahora con post:
    ?>


    <form action="" method="post">
        <label for="nombre">Nombre post:</label>
        <input type="text" name="nombre"><br>

        <label for="edad">Edad post:</label>
        <input type="number" name="edad"><br>

        <input type="submit" value="ENVIAR"><br>
    </form>

    <?php

    //Se pueden hacer ya muchas cosas con los datos recogidos:
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            foreach($_POST as $elementos){
                echo $elementos.", ";

            }
            $nombre = $_POST["nombre"];
            $edad = $_POST["edad"];
            echo "<p>Nombre: $nombre, Edad: $edad</p>";

        }

    ?>


</body>
</html>
