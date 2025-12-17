<?php
session_start(); //Recogemos la sesión
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    require "sesion/conexion.php";

   

    if(!isset($_SESSION["usuario"])){
        header("location: sesion/login.php");
        exit;
    }
    ?>
</head>
<body>
    <?php
    /*
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $consulta = "DELETE FROM peliculas WHERE id_pelicula = '{$_POST["id_pelicula"]}'";
        if($_conexion -> query($consulta)){
            echo "<div class='alert alert-succes'> Se ha borrado la pelicula con el ID 
            {$fila['id_pelicula']}";
        }else{
            echo "<div class='alert alert-danger'> No se ha borrado la pelicula con el ID 
            {$fila['id_pelicula']}";
        }




    }
        */
        $tabla = [];
        $consulta = "SELECT * FROM peliculas";
        $resultado = $_conexion->query($consulta);

        while($fila = $resultado -> fetch_assoc()){
            array_push($tabla, $fila);
        }

    if($_SERVER["REQUEST_METHOD"] == "POST"  and $_POST["orden"] == "ordenar"){
        

        if($_POST["accion"] == "Ordenar año ASC"){
            $columna = array_column($tabla, "anno_estreno");
            array_multisort($columna, SORT_ASC, $tabla);
        }elseif ($_POST["accion"] == "Ordenar año DESC") {
            $columna = array_column($tabla, "anno_estreno");
            array_multisort($columna, SORT_DESC, $tabla);
        }elseif ($_POST["accion"] == "Ordenar id ASC") {
            $columna = array_column($tabla, "id_pelicula");
            array_multisort($columna, SORT_ASC, $tabla);
        }else {
            $columna = array_column($tabla, "id_pelicula");
            array_multisort($columna, SORT_DESC, $tabla);
        }


    }




    ?>
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary"> Ir al menu principal</a>
        <!--Esto de abajo es lo mismo que mandar un formulario con get
        Con los campos de order_by y de direction ):-->
        <form action="" method="POST">
            <input type="hidden" value="ordenar" name="orden">
            <input type="submit" class="btn btn-warning" value="Ordenar año ASC" name="accion">
            <input type="submit" class="btn btn-warning" value="Ordenar año DESC" name="accion">
            <input type="submit" class="btn btn-primary" value="Ordenar id ASC" name="accion">
            <input type="submit" class="btn btn-primary" value="Ordenar id DESC" name="accion">
        </form>
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
            for ($i=0; $i < count($tabla); $i++) { 
                
                echo "<tr>";
                foreach($tabla[$i] as $peli){
                    echo "<td>$peli</td>";
                }
                if($_SESSION["admin"]){
                   echo "<td>"; 
                   echo "<a href='editarPelis.php' class='btn btn-warning w-100 mb-1'> Editar </a>"; 
                   echo "<form action='' method='post'> 
                   <input type='hidden' name='{$tabla[$i]["id_pelicula"]}'> 
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