<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors",1);
if(!isset($_SESSION["usuario"])){
    header("location: sesion/login.php");
    exit();
}
require "sesion/conexion.php";
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
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["titulo"])){
        $consulta = "DELETE FROM videojuegos WHERE titulo = '{$_POST["titulo"]}'";
        if($_conexion->query($consulta)){
            echo "<div class='alert alert-success'>Se ha eliminado correctamente el juego {$_POST["titulo"]} </div>";
        }else{
            echo "<div class='alert alert-danger'>CAGADA</div>";
        }
    }
    ?>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>Nombre</th>
                <th>Desarrolladora</th>
                <th>Año</th>
                <th>Reseñas</th>
                <th>Duración</th>
                <?php
                if($_SESSION["admin"]){
                    echo "<th>Editar</th>";
                    echo "<th>Borrar</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $consulta = "SELECT titulo,nombre_desarrolladora,anno_lanzamiento,porcentaje_reseñas,horas_duracion FROM videojuegos";
            //$consulta2 = "SELECT * FROM videojuegos";
            $resultado = $_conexion->query($consulta);

            while($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                foreach($fila as $clave => $juego){
                    //if($clave != "id_juego")
                        echo "<td>$juego</td>";
                }
                if($_SESSION["admin"]){
                    echo "<td><a href='editarJuego.php?titulo={$fila["titulo"]}' class='btn btn-warning'>Editar</a></td>";
                    echo "<td>";
                    ?>
                    <form action="" method="post">
                        <input type="hidden" name="titulo" value="<?= $fila["titulo"] ?>">
                        <input type="submit" value="Borrar <?= $fila["titulo"] ?>" class="btn btn-danger">
                    </form>
                    <?php
                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
        
    </table>
    <a href="index.php">volver al index</a>
</body>
</html>