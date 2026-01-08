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
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>Titulo</th>
                <th>Desarrolladora</th>
                <th>Año de lanzamiento</th>
                <th>% reseñas</th>
                <th>H duracion</th>
                <?php
                if($_SESSION["admin"])
                    echo "<th>Acciones</th>";
                ?>
            </tr>
        </thead>
        <tbody>
           <?php
            $consulta = "SELECT * FROM videojuegos";
            $resultado = $_conexion->query($consulta);
            while($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                foreach($fila as $peli){
                    if($peli != $fila["id_videojuego"]){
                        echo "<td>$peli</td>";
                    }
                    
                }
                if($_SESSION["admin"]){
                   echo "<td>"; 
                   echo "<a href='editarPelis.php' class='btn btn-warning w-100 mb-1'> Editar </a>"; 
                   echo "<form action='' method='post'> 
                   <input type='hidden' name='{$fila["id_videojuego"]}'> 
                   <input type='submit' value='Borrar' class='btn btn-danger '>
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