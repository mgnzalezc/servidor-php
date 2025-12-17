<!DOCTYPE html>
<html>
<head>
    <title>Login Star Wars</title>
    <meta charset="UTF-8">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h2>Entrar al lado oscuro:</h2>
    <form action="" method="POST">
        Usuario: <input type="text" name="usuario">
        <br>
        Password: <input type="password" name="contrasena">
        <br> <br>
        <input type="submit" value="Entrar">
    </form>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    
    if ($usuario == "luke" || $usuario == "leia" || $usuario == "han" || $usuario == "yoda" || $usuario == "vader") {
        if($contrasena == "Skywalker123!" || $contrasena == "Organa2024#!" || $contrasena == "Solo123!" ||$contrasena == "MasterYoda1!"||$contrasena == "DarkSide2024$"){
        echo "<script>alert('¡Bienvenido a la estrella de la muerte');</script>";
        } else {
        echo "<script>alert('Acceso denegado. Que la fuerza te ayude a recordar tu contraseña');</script>";
    }
    } else {
        echo "<script>alert('Acceso denegado. Que la fuerza te ayude a recordar tu contraseña');</script>";
    }

}
?>

</body>
</html>
