<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
require "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["mandado"])){
            $usuario = $_GET["usuario"];
            $contrasena = $_GET["contrasena"];
            $errores = false;

            if($usuario == ""){
                $err_usuario = "Introduzca un nombre de usuario";
                $errores = true;
            }

            if($contrasena == ""){
                $err_contrasena = "Introduzca una contrasena";
                $errores = true;
            }

            if(!$errores){
                $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

                $resultado = $_conexion->query($consulta);

                if($resultado->num_rows === 0){
                    echo "<div class='alert alert-danger'>El usuario no existe</div>";
                }else{
                    $info_usuario = $resultado->fetch_assoc();

                    $verificacion_contrasena = password_verify($contrasena, $info_usuario["contrasena"]);
                    if(!$verificacion_contrasena){
                        echo "<div class='alert alert-danger'>Contraseña incorrecta</div>";
                    }else{
                        session_start();
                        $_SESSION["usuario"] = $usuario;
                        $_SESSION["admin"] = $info_usuario["admin"];

                        header("Location: ../index.php");
                        exit;
                    }   
                }
            }
        }
    ?>
    <div class="container mt-5"> 
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form action="" method="get">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="usuario" class="form-control">
                        <?php 
                            if(isset($err_usuario)) echo "<div class= 'alert alert-danger'>$err_usuario</div>";
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control">
                        <?php 
                            if(isset($err_contrasena)) echo "<div class= 'alert alert-danger'>$err_contrasena</div>";
                        ?>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Iniciar sesión" class="btn btn-primary w-100">
                    </div>
                    <input type="hidden" name="mandado">
                </form>
                <h3 class="text-center mt-4 mb-3">Si no tienes cuenta, regístrate</h3>
                <a href="signup.php" class="btn btn-secondary w-100">Registrarse</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>