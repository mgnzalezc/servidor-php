<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    require "conexion.php";
    ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = trim($_POST["usuario"]);
        $contrasena = trim($_POST["contrasena"]);
        $admin = isset($_POST["admin"]) ? 1 : 0;
        $correcto = true;

        if($usuario == ""){
            $err_usuario = "Inserta un usuario";
            $correcto = false;
        }elseif(strlen($usuario)<3){
            $err_usuario = "El usuario tiene que tener al menos 3 caracteres";
            $correcto = false;
        }
        
        if($contrasena == ""){
            $err_contrasena = "Inserta una contraseña";
            $correcto = false;
        }elseif(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[&%@!])[A-Za-z\d%&@!]{8,16}$/",$contrasena)){
            // La contraseña tiene q tener entre 8 y 16 caracteres, al menos una mayuscula, al menos una minúscula y al menos un carácter especial (&%@!)
            $err_contrasena = "Introduce una contraseña con el formato que se te pide";
            $correcto = false;
        }

        if($correcto){
            $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
            $consulta = "INSERT INTO usuarios (usuario, contrasena, admin) VALUES ('$usuario', '$contrasena_cifrada','$admin')";
            if($_conexion->query($consulta)){
                echo "<div class='alert alert-success'>Usuario registrado correctamente</div>";
            }else{
                echo "<div class='alert alert-danger'>No se ha podido registrar el usuario</div>";
            }
        }
    }
    ?>
    <div class="container mt-5"> 
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="usuario" class="form-control">
                        <?php
                            if(isset($err_usuario)) echo "<div class='alert alert-danger'>$err_usuario</div>";
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control">
                        <?php
                            if(isset($err_contrasena)) echo "<div class='alert alert-danger'>$err_contrasena</div>";
                        ?>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="admin" class="form-check-input">
                        <label class="form-check-label">¿Eres admin?</label>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Registrarse" class="btn btn-primary w-100">
                    </div>
                </form>
                <h3 class="text-center mt-4 mb-3">Si ya tienes cuenta, inicia sesión</h3>
                <a href="login.php" class="btn btn-secondary w-100">Iniciar sesión</a>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>