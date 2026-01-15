<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        p{
            text-align: center;
        }
    </style>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["usuario"])){ //Comprobamos si el cliente ha iniciado sesión
        header("location: sesion/login.php");
        exit;
    }
    if(!$_SESSION["admin"]){ // Comprobamos si el cliente es admin
        header("location: index.php");
        exit;
    }
    require "sesion/conexion.php";


    ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST["titulo"];
        $ciudad = $_POST["ciudad"];
        $anno = $_POST["anno"];


        $errores = false;

        if($nombre == ""){
            $errores = true;
            $err_titulo = "<p class='bg-danger mt-1'>Introduce un titulo</p>";
        }


        if(!$errores){
            $consulta = "INSERT INTO desarrolladoras 
                            (nombre_desarrolladora,
                            ciudad,
                            anno_fundacion)
                            VALUES
                            (? , ? , ?)"; 
            $stmt = $_conexion->prepare($consulta);

            $stmt->bind_param("ssd", $nombre , $ciudad , $anno);

            if($stmt->execute()){
                echo "<div class='alert alert-success'>La desarrolladora ha sido añadida</div>";
            }else{
                echo "<div class='alert alert-danger'>La desarrolladora NO ha sido añadida</div>";
            }
        }
    }
    ?>
    <div class="container mt-4">
        <h1 class="fs-1">Crear Desarrolladora </h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Nombre Desarrolladora</label>
                <input type="text" name="titulo" class="form-control">
                <?php //if(isset($err_titulo)) echo $err_titulo; ?>
                <?= $err_titulo ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Ciudad</label>
                <input type="text" name="ciudad" class="form-control">
                <?= $err_anno ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Año Fundacion</label>
                <input type="text" name="anno" class="form-control">
                <?= $err_temporadas ?? "" ?>
            </div>
            <div class="mb-3">
                <input type="submit" value="Crear Desarrolladora" class="btn btn-success">
            </div>
        </form>
        <a href="index.php" class="btn btn-secondary">Volver al menú principal</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>