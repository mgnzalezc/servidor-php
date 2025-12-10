<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crear user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    require "conexion.php";
    ?>
</head>
<?php
    if($_SERVER["REQUEST_METHOD"] =="POST"){

            $tmp_email = $_POST["email"];
            $tmp_contrasena = $_POST["contrasena"];
            //en checkbox, si se ha mandado algo existe y si no pues no (no hay cadena vacia)
            $admin = isset($_POST["admin"]) ? 1 : 0; //si es true, guardo 1, si es false guardo 0

            // VALIDACION USUARIO

            $tmp_email = htmlspecialchars($tmp_email);
            $tmp_email = trim($tmp_email);
            $tmp_email = preg_replace("/\s+/", "_", $tmp_email); //esto que es?

            if ( $tmp_email == ""){ //obligatorio siempre
                $err_email = "Inserta un usuario";
            }elseif(strlen($tmp_email)<3){ //tiene que tener texto, luego @ texto y luego .
                $err_email = "Email incorrecto";
            } else{
                $email = $tmp_email;
            }

            // VALIDACION CONTRASEÑA

            $tmp_contrasena = htmlspecialchars($tmp_contrasena);
            $tmp_contrasena = trim($tmp_contrasena);

            if ( $tmp_contrasena == ""){
                $err_contrasena = "Inserta una contraseña";
            }elseif(strlen($tmp_contrasena)<3){
                $err_contrasena = "la contraseña tiene que tener al menos 3 chars";
            } else{
                $contrasena = $tmp_contrasena;
            }

            if(isset($contrasena)&&isset($usuario)){
                $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                $consulta = "INSERT INTO usuarios (usuario, contrasena, admin) VALUES ('$usuario', '$contrasena_cifrada', '$admin')";
                if($resultado = $_conexion->query($consulta)){
                    echo "<div class='alert alert-success'> Usuario registrado correctamente </div>";
                } else{
                    echo "<div class='alert alert-danger'> No se ha podido registrar </div>";
                }

            }

        }
?>
<body>
    <div class="container mt-5">
        <div class = "row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="">Email</label>
                        <input type="text" name="email" class="form-control">
                        <?php
                        if (isset($err_email)) echo "<div class='alert alert-danger'> $err_email </div>";
                        ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control">
                        <?php
                        if (isset($err_contrasena)) echo "<div class='alert alert-danger'> $err_contrasena </div>";
                        ?>
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" name="admin" class="form-check-input">
                        <label class="form-check-label" for="">Eres admin?</label> <!--asi pq le gusta mas a alejandro-->
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Registrarse" class="btn btn-primary w-100">
                    </div>
                </form>

                <h4 class = "text-center mt-4 mb-3">Si ya tienes cuenta, inicia sesion</h4>
                <a href="login.php" class="btn btn-secondary w-100">Iniciar sesion</a>
            </div>
        </div>
    </div>
    
        
</body>
</html>