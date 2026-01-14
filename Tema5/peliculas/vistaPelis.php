<?php
session_start(); //Recogemos la sesión
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE PELICULAS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    require "sesion/conexion.php";
    if(!isset($_SESSION["usuario"])){
        header("location: sesion/login.php");
        exit;
    }

    $columna = $_GET["order_by"] ?? "id_pelicula"; // orden por defecto
    $direccion = $_GET["direction"] ?? "ASC"; // DIRECCION POR DEFECTO

    
    ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["candidata"])){
        $consulta = "DELETE FROM peliculas WHERE id_pelicula = '{$_POST["candidata"]}'";
        if($_conexion -> query($consulta)){
            echo "<div class='alert alert-succes'> Se ha borrado la pelicula con el ID 
           {$fila['candidata']}";
        }else{
            echo "<div class='alert alert-danger'> No se ha borrado la pelicula con el ID 
           {$fila['candididata']}";
        }
    }
    ?>
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary"> Ir al menu principal</a>
        <!--Esto de abajo es lo mismo que mandar un formulario con get
        Con los campos de order_by y de direction ):-->
        <a href="?order_by=anno_estreno&direction=ASC" class="btn btn-info"> Ordenar por año de estreno (ASC)</a>
        <a href="?order_by=anno_estreno&direction=DESC" class="btn btn-info">Ordenar por año de estreno (DESC) </a>
        <a href="?order_by=id_pelicula&direction=ASC" class="btn btn-warning"> Ordenar por ID (ASC)</a>
        <a href="?order_by=id_pelicula&direction=DESC" class="btn btn-warning"> Ordenar por ID (DESC)</a>
    </div>


    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estudio</th>
                <th>Año de estreno</th>
                <th>Num de entregas</th>
                <th>Duracion</th>
                <?php
                if($_SESSION["admin"])
                    echo "<th>Acciones</th>";
                ?>
            </tr>
        </thead>
        <tbody>
           <?php
            $consulta = "SELECT * FROM peliculas ORDER BY $columna $direccion"; //estas varibales tienen que estar creadas arriba del todo
            $resultado = $_conexion->query($consulta);
            while($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                foreach($fila as $peli){
                    echo "<td>$peli</td>";
                }
                if($_SESSION["admin"]){
                   echo "<td>"; 
                   echo "<a href='editarPelis.php?titulo=<?=".$fila["$titulo"]."'?> class='btn btn-warning w-100 mb-1'> Editar </a>"; 
                   //titulo se recoge en editarPeli como $titulo = $_GET["titulo"]
                   echo "<form action='' method='post'> 
                   <input type='hidden' value='{$fila["id_pelicula"]} name='candidata''>
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