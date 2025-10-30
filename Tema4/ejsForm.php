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

<!-- post los datos van por http, get va por la url -->

    <h3>Ejercicio 1</h3>
    <form action="formulario2.php" method="POST">
        <label for="msj">Mensaje:</label>
        <input type="text" name="msj"><br>

        <label for="veces">Veces:</label>
        <input type="number" name="veces"><br>

        <input type="submit" value="ENVIAR"><br>
    </form>


    <h3>Ejercicio 2</h3>
    <p>Formulario 1</p>
    <form action="formulario2.php" method="POST">
        <label for="tabla">Tabla:</label>
        <input type="number" name="tabla"><br>

        <input type="submit" value="ENVIAR"><br>
    </form>

    <p>Formulario 1</p>
    <form action="formulario2.php" method="GET">
        <label for="tabla">Tabla:</label>
        <input type="number" name="tabla"><br>

        <input type="submit" value="ENVIAR"><br>
    </form>

    <h3>Ejercicio conversion temperatura</h3>
    <form action="formulario2.php" method="POST">
        <label for="temp">Numero:</label>
        <input type="number" name="temp"><br>
        <select name="og">
            <option value="c">Celsius</option>
            <option value="k">Kelvin</option>
            <option value="f">Farenheit</option>
        </select><br>
        <select name="fnl">
            <option value="c">Celsius</option>
            <option value="k">Kelvin</option>
            <option value="f">Farenheit</option>
        </select><br>

        <input type="submit" value="ENVIAR"><br>
    </form>

    
    
</body>
</html>