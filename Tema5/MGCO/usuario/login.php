<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
-->
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    require "conexion.php";
    ?>
</head>
<body>

    <?php
        if($_SERVER["REQUEST_METHOD"] =="POST" && isset($_POST["mandado"])){
            $tmp_nombre = $_POST["nombre"];
            $tmp_contrasena = $_POST["contrasena"];

            // COMPROBAMOS QUE NO HAY CAMPOS VACIOS
        
            if ($tmp_nombre == ""){
                $err_nombre = "Inserta un usuario";
            }else{
                $nombre = $tmp_nombre;
            }

            if ( $tmp_contrasena == ""){
                $err_contrasena = "Inserta una contraseña";
            }else{
                $contrasena = $tmp_contrasena;
            }

            if(isset($nombre) && isset($contrasena)){
                $consulta = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
                $resultado = $_conexion->query($consulta);

                if($resultado->num_rows === 0){
                    echo "<div class = 'alert alert-danger'>El usuario no existe en la base de datos</div>";
                } else {
                    $info_usuario = $resultado->fetch_assoc(); //array asociativo con los datos de esa fila

                    $verificacion_contrasena = (password_verify($contrasena, $info_usuario["contrasena"]));
                    //verificacion es para verificar la contraseña que ha metido con la contraseña HASHEADA de la consulta en la bd

                    if(!$verificacion_contrasena){
                        echo "<div class = 'alert alert-danger'>La contraseña no coincide</div>";
                    }else{
                        
                        session_start(); //esta es la sesion que se manda
                        $_SESSION["nombre"] = $nombre;
                        $_SESSION["rol"] = $info_usuario["rol"];

                        header("location: ../index.php"); 
                        exit();
                        

                    }
                }
            }
        
        
        }

    ?>

    <div class="container mt-5">
        <div class = "row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label" for="">Usuario</label>
                        <input type="text" name="nombre" class="form-control">
                        <?php
                        if (isset($err_nombre)) echo "<div class='alert alert-danger'> $err_nombre </div>";
                        ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control">
                        <?php
                        if (isset($err_contrasena)) echo "<div class='alert alert-danger'> $err_contrasena </div>";
                        ?>
                    </div>

                    <input type="hidden" name="mandado"> <!--para que no pete la primera vez que carga la pagina-->

                    <div class="mb-3">
                        <input type="submit" value="Iniciar sesion" class="btn btn-primary w-100">
                    </div>
                </form>

                <h4 class = "text-center mt-4 mb-3">¿Aún no tienes cuenta? Regístrate!</h4>
                <a href="signup.php" class="btn btn-secondary w-100">Registrarse</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>
