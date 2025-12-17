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
$conexion = new mysqli("localhost", "root", "MARIALAURA", "starwarsdb");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$contrasena'";
    $registro = mysqli_query($conexion, $consulta);
    
    if ($registro->num_rows > 0) {
        // Si encuentra una fila, el usuario existe -> Alert de bienvenida
        echo "<script>alert('¡Bienvenido a la estrella de la muerte');</script>";
    } else {
        // Si no encuentra nada -> Alert de error
        echo "<script>alert('Accesoo denegado. Que la fuerza te ayude a recrdar tu contraseña');</script>";
    }

    $conn->close();
}
?>

</body>
</html>
