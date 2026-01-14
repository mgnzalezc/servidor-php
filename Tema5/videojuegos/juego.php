<?php
    session_start();
    //ahora si podemos usar el array $_SESSION
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con todos los juegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["usuario"])){ //esto solo usar haciendo session start arriab del todo
        header("location: sesion/login.php"); //manda de vuuelta a login si no se ha logineado, por si alguien copia y pega el url
        exit();
    }
    require "sesion/conexion.php";

    ?>
</head>
<body>
    <?php
        // codigo de borrar con if post && isset(titulo)
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
                <th>Titulo</th>
                <th>Desarrolladora</th>
                <th>Año de lanzamiento</th>
                <th>Reseñas</th>
                <th>Duracion</th>
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
            $consulta = "SELECT * FROM videojuegos";
            $resultado = $_conexion->query($consulta);
            while($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                foreach($fila as $juego){
                    //para no imprimir el if usamos este if, sino echo juego y punto
                    if($juego != $fila["id_videojuego"]){
                        echo "<td>$juego</td>";
                    }
                    
                }
                if($_SESSION["admin"]){
                   echo "<td>"; 
                   echo "<a href='editarJuego.php?titulo='{$fila["titulo"]}' class='btn btn-warning w-100 mb-1'> Editar </a>"; 
                   echo "</td>";
                   echo "<td>";
                   echo "<form action='' method='post'> 
                   <input type='hidden' name='titulo' value='{$fila["titulo"]}'> 
                   <input type='submit' value='Borrar {$fila["titulo"]}' class='btn btn-danger'>
                   </form>"; 
                   echo "</td>";
                }
                echo "</tr>";
            } 
           ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Volver al menú principal</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>