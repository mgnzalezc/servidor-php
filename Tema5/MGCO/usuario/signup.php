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
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] =="POST"){
            $tmp_nombre = $_POST["nombre"];
            $tmp_contrasena = $_POST["contrasena"];
            $tmp_rol = $_POST["rol"] ?? ""; //si vacio, cadena vacia
            
            $correcto = true; //hacemos semaforo para errores

            // VALIDACION USUARIO

            $tmp_nombre = htmlspecialchars($tmp_nombre);
            $tmp_nombre = trim($tmp_nombre);
            $tmp_nombre = preg_replace("/\s+/", "_", $tmp_nombre);

            if ($tmp_nombre == ""){ //obligatorio siempre
                $err_nombre = "Inserta un usuario";
                $correcto = false;
            } else {
                $nombre = $tmp_nombre;
            }            

            // VALIDACION CONTRASEÑA

            $tmp_contrasena = htmlspecialchars($tmp_contrasena);
            $tmp_contrasena = trim($tmp_contrasena);

            if ( $tmp_contrasena == ""){ //obligatorio siempre
                $err_contrasena = "Inserta una contraseña";
                $correcto = false;
            } else {
                $contrasena = $tmp_contrasena;
            }

            // VALIDACION TIPO USUARIO
            if ( $tmp_rol == ""){ //obligatorio siempre
                $err_rol= "Inserta un tipo de usuario";
                $correcto = false;
            } else {
                $rol = $tmp_rol;
            }

            if($correcto){
                $contrasena_cifrada = password_hash($contrasena, PASSWORD_DEFAULT);
                $consulta = "INSERT INTO usuarios (nombre, contrasena, rol) VALUES ('$nombre', '$contrasena_cifrada', '$rol')";
                if($_conexion->query($consulta)){ //si se ha podido hacer la query o no
                    echo "<div class='alert alert-success'> Usuario registrado correctamente </div>";
                } else{
                    echo "<div class='alert alert-danger'> No se ha podido registrar </div>";
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
                        if (isset($tmp_nombre)) echo "<div class='alert alert-danger'> $tmp_nombre </div>";
                        ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="">Contraseña</label>
                        <input type="password" name="contrasena" class="form-control">
                        <?php
                        if (isset($err_contrasena)) echo "<div class='alert alert-danger'> $err_contrasena </div>";
                        ?>
                    </div>

                    <div class="mb-3 form-check">
                        <label class="form-label" for="">¿Que tipo de usuario eres?</label>
                        <select type="checkbox" name="rol" class="form-check-input">
                            <option value="" disabled selected>-- Elija un tipo de usuario --</option>
                            <option value="cliente">Cliente</option>
                            <option value="admin">Administrador</option>
                            <option value="editor">Editor</option>
                        </select>
                        <?php
                        if (isset($err_rol)) echo "<div class='alert alert-danger'> $err_rol</div>";
                        ?>
                        
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>