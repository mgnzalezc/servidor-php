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
        $consulta1 = "DELETE FROM videojuegos WHERE nombre_desarrolladora = '{$_POST["titulo"]}'";
        $consulta = "DELETE FROM desarrolladoras WHERE nombre_desarrolladora = '{$_POST["titulo"]}'";
        if($_conexion->query($consulta1)){
            echo "<div class='alert alert-success'>Se ha eliminado correctamente el juego asociado a {$_POST["titulo"]} </div>";
            if($_conexion-> query($consulta)){
                echo "<div class='alert alert-success'>Se ha eliminado correctamente la desarolladora {$_POST["titulo"]} </div>";
            }else{
                echo "<div class='alert alert-danger'>Se ha eliminado el juego pero no la desa</div>";
            }
        }else{
            echo "<div class='alert alert-danger'>CAGADA</div>";
        }
    }
    ?>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>Nombre Desarrolladora</th>
                <th>Ciudad</th>
                <th>Año Fundacion</th>
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
            //$consulta = "SELECT titulo,nombre_desarrolladora,anno_lanzamiento,porcentaje_reseñas,horas_duracion FROM videojuegos";
            $consulta = "SELECT * FROM desarrolladoras";
            $resultado = $_conexion->query($consulta);

            while($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                foreach($fila as $clave => $juego){
                    //if($clave != "id_juego")
                        echo "<td>$juego</td>";
                }
                if($_SESSION["admin"]){
                    echo "<td><a href='editarDesarrolladora.php?titulo={$fila["nombre_desarrolladora"]}' class='btn btn-warning'>Editar</a></td>";
                    echo "<td>";
                    ?>
                    <form action="" method="post">
                        <input type="hidden" name="titulo" value="<?= $fila["nombre_desarrolladora"] ?>">
                        <input type="submit" value="Borrar <?= $fila["nombre_desarrolladora"] ?>" class="btn btn-danger">
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