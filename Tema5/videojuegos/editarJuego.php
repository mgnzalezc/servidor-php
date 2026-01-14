<?php
    session_start();
    //ahora si podemos usar el array $_SESSION
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar juego</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["usuario"])){
        header("location: sesion/login.php"); //manda de vuuelta a login si no se ha logineado, por si alguien copia y pega el url
        exit();
    }
    if(!$_SESSION["admin"]){ //si no eres admin no puedes estar aqui
        header("location: index.php"); //manda de vuuelta a login si no se ha logineado, por si alguien copia y pega el url
        exit();
    }
    require "session/conexion.php";

    $consulta = "SELECT * FROM videojuegos WHERE titulo = '{$_GET["titulo"]}'";
    $res = $_conexion->query($consulta);
    $info_juego = $res->fetch_assoc();

    //print_r($info_juego); para comprobar a ver si los datos estan bien


    // falta back de ale


    ?>
</head>
<body>
    <?php

    if($_SERVER["REQUEST_METHOD"] =="POST"){
        // mirar que las variables estan bien en el html php
        $titulo = trim($_POST["titulo"]);
        $nombre_desarrolladora = trim($_POST["nombre_desarrolladora"] ?? ""); //como es desplegable si esta vacio no se manda, entonces decimos q se cree cad vacia
        $anno_estreno = trim($_POST["anno_estreno"]);
        $resena = trim($_POST["resena"]);
        $duracion = trim($_POST["duracion"]);

        $errores = false;

            if($titulo == ""){
                $err_titulo = "<div class='alert alert-danger'>El título no puede estar vacío</div>";
                $errores = true;
            }

            if($nombre_desarrolladora==""){
                $err_desarrolladora= "<div class='alert alert-danger'>El nombre del estudio no está en la base de datos (sé que has intentado hacer maleante)</div>";
                $errores = true;
            }

            if($anno_estreno == ""){
                $err_anno = "<div class='alert alert-danger'>El año de estreno no puede estar vacío</div>";
                $errores = true;
            }

            if($resena== ""){
                $err_resena = "<div class='alert alert-danger'>El número de temporadas no puede estar vacío</div>";
                $errores = true;
            }

            if($duracion == ""){
                $err_duracion = "<div class='alert alert-danger'>La duración no puede estar vacío</div>";
                $errores = true;
            }

            if(!$errores){
                /**
                 * Begin transaction, commit y rollback hacemos lo de arriba
                 * 
                 * ACID: 4 claves fundamentales que definen una transaccion
                 * 
                 * Atomicidad - todo o nada (lo llevamos a cabo con commit y rollback)
                 * 
                 * Consistencia - la db no se quede en un estado invalido. eg si tenemos que hacer dos operaciones, que no haga una de ellas solo- o se hacen las dos o ninguna
                 * 
                 * Aislamiento - una transaccion no ve resultados intermedios de otra transaccion
                 * 
                 * Durabilidad - tras el commit los cambios sobreviven a caidas del servicio. 
                 * 
                 * si realizamos varias operaciones como insertar peli y actualizar otra, no habra estados a medias. 
                 * 
                 */
                
                $consulta = "UPDATE videojuegos SET
                            titulo = ?,
                            nombre_desarrolladora =?,
                            anno_estreno=?,
                            resena=?,
                            duracion=?
                            WHERE titulo = {$_GET["titulo"]}"; //esto se llama placeholder
                $stmt = $_conexion->prepare($consulta);
                $stmt->bind_param("ssddi", $titulo, $nombre_desarrolladora, $anno_estreno, $resena, $duracion);

                if($stmt->execute()){
                    echo "<div class='alert alert-success'>La peli {$_GET["titulo"]} ha sido modificada</div>";
                } else{
                    echo "<div class='alert alert-danger'>La peli {$_GET["titulo"]} NO ha sido modificada</div>";
                }

                //limpiar las variables del formulario 
                $titulo = $nombre_desarrolladora = $anno_estreno = $duracion = $resena = "";
            }
    

    }

    ?>
    
    <div class="containter mt-4">
        <h1 class="fs-1">Editar juego</h1>
        <form action="" method="POST">

            <div class="mb-3">
                <label class="form-label">Título del juego</label>
                <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($titulo); ?>">
                <?php //if(isset($err_titulo)) echo $err_titulo; ?>
                <?= $err_titulo ?? "" ?>
            </div>

            <div class="mb-3">
                <label for="estudio" class="form-label">Desarrolladora</label>
                <select type="text" name="nombre_desarrolladora" class="form-control">
                    <!--for de estudios, no podemos inventarnos el estudio pq es foreign key-->
                    <?php
                    foreach($desarrolladoras as $desarrolladora){ //hemos guardado en el select todos los estudios y ahora lo recorremos para imprimir
                        // para seleccionar ya la que es
                        if($desarrolladora == $info_juego["nombre_desarrolladora"]){
                            echo "<option value='$desarrolladora' selected> $desarrolladora </option>";
                        } else{
                            echo "<option value='$desarrolladora'> $desarrolladora </option>";
                        }
                    }
                    ?>
                </select>
                <?= $err_estudio ?? "" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Año de estreno</label>
                <input type="text" name="anno_estreno" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Reseña</label>
                <input type="text" name="nresena" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Duración (en minutos)</label>
                <input type="text" name="duracion" class="form-control">
            </div>

            <div class="mb-3">
                <input type="submit"value="Editar" class="btn btn-success">
            </div>

        </form>
    </div>

    <a href="index.php" class="btn btn-primary"> Volver al index</a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>