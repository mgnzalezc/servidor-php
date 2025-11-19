<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>

</head>
<body>
    <?php
    // SANITIZACION EMAIL ---------------------------------------------------------------------------

        if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["form"] == "correo"){
            
            $email = $_POST["correo"];//aqui habria que validarlo todo primero
            $email_sanitizado = filter_var($email, FILTER_SANITIZE_EMAIL);
            //si en email metes <> por ejemplo, html lo coge como etiqueta pero sanitizado lo imprime
            //quita caracteres que nunca deberian estar en correo, /

        }
        
    ?>
    <form action="" method="POST">
        <input type="hidden" name="form" value="correo"> <!--esto para elegir form, le pones valor y lo buscas-->
        <label for="correo">Mete un correo</label>
        <input type="email" name="correo"></input>
        <?php 
            if(isset($email, $email_sanitizado)){
                echo "Email original $email <br>";
                echo "Email sanitizado $email_sanitizado <br>";
            }
        ?>
        <input type="submit" value="ENVIAR">
        
    </form>

    <?php
    // SANITIZACION STRING ---------------------------------------------------------------------------

        if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["form"] == "cadena"){
            
            $cadena = $_POST["cadena"];//aqui habria que validarlo todo primero
            $cadena_sanitizada = filter_var($cadena, FILTER_SANITIZE_ENCODED);
            //un espacio es %20

        }
        
    ?>
    <form action="" method="POST">
        <input type="hidden" name="form" value="cadena">
        <label for="cadena">Mete un string</label>
        <input type="text" name="cadena"></input>
        <?php 
            if(isset($cadena, $cadena_sanitizada)){
                echo "Cadena original $cadena <br>";
                echo "Cadena sanitizado $cadena_sanitizada <br>";
            }
        ?>
        <input type="submit" value="ENVIAR">
        
    </form>

    <?php
    // SANITIZACION DECIMAL ---------------------------------------------------------------------------

        if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["form"] == "decimal"){
            
            $decimal = $_POST["decimal"];//aqui habria que validarlo todo primero
            $decimal_sanitizado = filter_var($decimal, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            //quita las letras, no corrige que hayan 2 puntos pq eso lo corrige la validacion

        }
        
    ?>
    <form action="" method="POST">
        <input type="hidden" name="form" value="decimal">
        <label for="decimal">Mete un string</label>
        <input type="text" name="decimal"></input>
        <?php 
            if(isset($decimal, $decimal_sanitizado)){
                echo "decimal original $decimal <br>";
                echo "decimal sanitizado $decimal_sanitizado <br>";
            }
        ?>
        <input type="submit" value="ENVIAR">
        
    </form>

    <?php
    // SANITIZACION NUMBER ---------------------------------------------------------------------------

        if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["form"] == "int"){
            
            $int = $_POST["int"]; //aqui habria que validarlo todo primero
            $int_sanitizado = filter_var($int, FILTER_SANITIZE_NUMBER_INT);
            //

        }
        
    ?>
    <form action="" method="POST">
        <input type="hidden" name="form" value="int">
        <label for="int">Mete un string</label>
        <input type="text" name="int"></input>
        <?php 
            if(isset($int, $int_sanitizado)){
                echo "int original $int <br>";
                echo "int sanitizado $int_sanitizado <br>";
            }
        ?>
        <input type="submit" value="ENVIAR">
        
    </form>

    
</body>
</html>