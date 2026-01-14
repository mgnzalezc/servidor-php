<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            $tmp_usuario = $_POST["usuario"];
            $tmp_contrasena = $_POST["contrasena"];
        
            if ($tmp_usuario == ""){
                $err_usuario = "Inserta un usuario";
            }else{
                $usuario = $tmp_usuario;
            }

            if ( $tmp_contrasena == ""){
                $err_contrasena = "Inserta una contraseña";
            }else{
                $contrasena = $tmp_contrasena;
            }

            if(isset($usuario) && isset($contrasena)){
                $consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
                $resultado = $_conexion->query($consulta);
                //este pre no hace falta, es solo para ver los resultados
                echo "<pre>";
                var_dump($resultado);
                echo "</pre>";

                if($resultado->num_rows === 0){
                    echo "<div class = 'alert alert-danger'>El usuario no existe en la base de datos</div>";
                } else {
                    $info_usuario = $resultado->fetch_assoc(); //array asociativo con los datos de esa fila

                    //echo "Contraseña ingresada: $contrasena";
                    //echo"<br>Hash almacenado".$info_usuario['contrasena'];
                    $verificacion_contrasena = (password_verify($contrasena, $info_usuario["contrasena"]));
                    //verificacion es para verificar la contraseña que ha metido con la contrasña HASHEADA de la consulta en la bd

                    if(!$verificacion_contrasena){
                        echo "<div class = 'alert alert-danger'>La contraseña no coincide</div>";
                    }else{
                        // SESSION START - inicia nueva sesion o recupera una antigua.
                        // crea/lee una cookie llamada PHPSESSID en el navegador del usuario
                        // carga los datos de la sesion desde el seridor en el array $_SESSION

                        // este session_start() lo usaremos al inicio de CADA pagina que necesite acceder a datos de la sesion

                        // llamaremos a la funcion antes de enviar cualquier salida HTML (antes del DOCTYPE)

                        // $_SESSION - array asociativo que guarda datos en el servidor, es persistente entre diff ficheros mientras la sesion este activa

                        session_start(); //esta es la sesion que se manda
                        $_SESSION["usuario"] = $usuario;
                        $_SESSION["admin"] = $info_usuario["admin"];

                        header("location: ../index.php"); //se redirige al usuario porque ya ha login, se va al index fuera de la carpeta sesion y cerramos ya el login.
                        exit();
                        /**
                         * Que es header?
                         * 
                         * cuando tu navegador pide una pagina, el servidor responde con algo asi HTTP/1.1 200 OK
                         * content-type: text/html; charset=UTF-8....
                         * <html></html>
                         * 
                         * estos son metadatos que se mandan, el mas imp es location que es para redirigir al usuario al fichero que yo quiera
                         * por eso yo mando el header y asi se redirige la sesion abierta y se puede viajar con la sesion iniciada
                         * 
                         */

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
                        <input type="text" name="usuario" class="form-control">
                        <?php
                        if (isset($err_usuario)) echo "<div class='alert alert-danger'> $err_usuario </div>";
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
            </div>
        </div>
    </div>
</body>
</html>
