<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validacion y Sanitizacion</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
        //require(ruta relativa de clase con funcion que quiero);
        require("../Tema3/operaciones2.php"); //por ejemplo.
    ?>

</head>
<body>
    <?php
    //VALIDACION controla lo que mete el usuario por pantalla
    //SANITIZACION cambia lo que el usuario a metido

    //isset() te devuelve un bool diciendote si esta creada o no, y si es null te sale false

    //empty() devuelve TRUE si la variable no esta definida, tiene valor 0, es null o es un array vacio


    // CASO 1, definida y vacia
    echo "<h3>Caso 0.1: isset() devuelve true y empty() devuelve true</h3>"; //esta definida y vacia
    echo "<p>Valor 0</p>";
    $valor = 0;
    if(isset($valor)) echo "<p>La variable \$valor esta definida</p>";
    else echo "<p>La variable \$valor no esta definida o es NULL</p>";

    if(empty($valor)) echo "<p>La variable \$valor esta vacia o es null</p>";
    else echo "<p>La variable \$valor NO esta vacia</p>";


    // CASO 2, no definida therefore vacia
    echo "<h3>Caso 0.2: isset() devuelve false y empty() devuelve true</h3>";
    echo "<p>Valor undefined</p>";
    unset($valor); //nos cargamos la variable
    if(isset($valor)) echo "<p>La variable \$valor esta definida</p>";
    else echo "<p>La variable \$valor no esta definida o es NULL</p>";

    if(empty($valor)) echo "<p>La variable \$valor esta vacia o es null</p>";
    else echo "<p>La variable \$valor NO esta vacia</p>";


    // CASO 3, definida y llena
    echo "<h3>Caso 1: isset() devuelve true y empty() devuelve true</h3>";
    echo "<p>Mi variable pone 'juan'</p>";
    $nombre = "juan";
    
    if(isset($valor)) echo "<p>La variable \$nombre esta definida</p>";
    else echo "<p>La variable \$nombre no esta definida o es NULL</p>";

    if(empty($valor)) echo "<p>La variable \$nombre esta vacia o es null</p>";
    else echo "<p>La variable \$nombre NO esta vacia</p>";

    ?>


    <?php

    // COMPROBAL EL TIPO DE DATO QUE METE EL USUARIO
        if($_SERVER["REQUEST_METHOD"]=="POST"){

            //INTEGER
            if(filter_var($_POST["entero"],FILTER_VALIDATE_INT)){
                $entero = "<span class='success'>El valor ingresado es un numero entero</span>";
            } else{
                $entero = "<span class='error'>El valor ingresado NO es un numero entero</span>";
            }

            //DECIMAL
            if(filter_var($_POST["decimal"],FILTER_VALIDATE_FLOAT)){
                $decimal = "<span class='success'>El valor ingresado es un numero decimal</span>";
            } else{
                $decimal = "<span class='error'>El valor ingresado NO es un numero decimal</span>";
            }

            //EMAIL
            // estilo correcto --> caracter@caracter.letranumero (despues del punto no puede empezar por letra)
            if(filter_var($_POST["correo"],FILTER_VALIDATE_EMAIL)){
                $email = "<span class='success'>El valor ingresado es un email</span>";
            } else{
                $email = "<span class='error'>El valor ingresado NO es un email</span>";
            }

            //URL
            // estilo correcto --> http:// o https://
            if(filter_var($_POST["url"],FILTER_VALIDATE_URL)){
                $url = "<span class='success'>El valor ingresado es un url</span>";
            } else{
                $url = "<span class='error'>El valor ingresado NO es un url</span>";
            }

            //URL
            // estilo correcto --> http:// o https://
            if(filter_var($_POST["ip"],FILTER_VALIDATE_IP)){
                $ip = "<span class='success'>El valor ingresado es una IP</span>";
            } else{
                $ip = "<span class='error'>El valor ingresado NO es una IP</span>";
            }

        }
    ?>

    <form action="" method="POST"> 
        <label for="numero">Mete num entero</label>
        <input type="text" name="numero"></input>

        <label for="decimal">Mete num decimal</label>
        <input type="text" name="decimal"></input>

        <label for="correo">Mete correo</label>
        <input type="text" name="correo"></input>

        <label for="url">Mete URL</label>
        <input type="text" name="url"></input>

        <label for="ip">Mete IP</label>
        <input type="text" name="ip"></input>
    </form>

</body>
</html>