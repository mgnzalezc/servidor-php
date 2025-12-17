<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva peli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    session_start();
    if(!isset($_SESSION["usuario"])){ // Comprobamos si el cliente ha iniciado sesion
        header("location: index.php");
        exit();
    }
    if(!($_SESSION["admin"])){ // Comprobamos si el cliente es admin
        header("location: index.php");
        exit();
    }
    require "sesion/conexion.php";
    ?>

</head>
<body>
    <?php
        $consulta = "SELECT nombre_estudio FROM estudios";
        $resultado = $_conexion->query($consulta);
        $estudios = [];

        while($fila = $resultado->fetch_assoc()){
            $estudios[] = $fila["nombre_estudio"];
        }

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            //Sanitizar y recoger datos
            $titulo = trim($_POST["titulo"]);
            $nombre_estudio = trim($_POST["nombre_estudio"] ?? ""); //como es desplegable si esta vacio no se manda, entonces decimos q se cree cad vacia
            $anno_estreno = trim($_POST["anno_estreno"]);
            $num_temporadas = trim($_POST["num_temporadas"]);
            $duracion = trim($_POST["duracion"]);

            //Validación

            /**
             * Titulo - no vacio, mas de un caracter y menos de 80
             * 
             * Año estreno - no vacio, num entero, entre 1900 y 2100
             * 
             * Numero entrega - no vacio, num entero o decimal, entre 1 y 90
             * 
             * Duracion - no vacio, num entero o decimal, mas de 60 mins
             * 
             */


            //RELLENAR CON LO QUE VA A MANDAR ALE

            

        }

    ?>

    <div class="containter mt-4">
        <h1 class="fs-1">Crear una peli</h1>
        <form action="" method="POST">

            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo de la peli</label>
                <input type="text" name="titulo" class="form-control">
            </div>

            <div class="mb-3">
                <label for="estudio" class="form-label">Estudio</label>
                <select type="text" name="nombre_estudio" class="form-control">
                    <option value="" disabled selected>-- Elija un estudio --</option>
                    <!--for de estudios, no podemos inventarnos el estudio pq es foreign key-->
                    <?php
                    foreach($estudios as $estudio){ //hemos guardado en el select todos los estudios y ahora lo recorremos para imprimir
                    ?>
                    <option value="<?php echo $estudio?>"> <?php echo $estudio?> </option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Año de estreno</label>
                <input type="text" name="anno_estreno" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Numero de entregas</label>
                <input type="text" name="num_temporadas" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Duración (en minutos)</label>
                <input type="text" name="duracion" class="form-control">
            </div>

            <div class="mb-3">
                <input type="submit"value="Crear peli" class="btn btn-success">
            </div>

        </form>
    </div>

    <a href="index.php" class="btn btn-primary"> Volver al index</a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>