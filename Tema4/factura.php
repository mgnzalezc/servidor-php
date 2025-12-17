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
    <p>SIN TERMINAR ESTA ESTO
    </p>
    <form method="POST" action="">

        Pan<input type="number" name="pan" value="0">
        Mazana<input type="number" name="manzana" value="0">
        Leche<input type="number" name="leche" value="0">
        Cerveza<input type="number" name="cerveza" value="0">
        Refresco<input type="number" name="refresco" value="0">
        USB<input type="number" name="usb" value="0">

        <input type="submit" value="ENVIAR">

    </form>


    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            
        }
    ?>






</body>
</html>