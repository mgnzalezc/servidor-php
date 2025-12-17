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

    if(isset($_GET["orden"])){
        $orden = $_GET["orden"];    
        $tablaOrden = explode("-", $orden); # Esto te separa la cadena, es gilipollez, oficialmente ale deja hacer dos select con options uno para cada cosa
    }
    

    $columna = $tablaOrden[0] ?? "nombre_estudio"; // orden por defecto
    $direccion = $tablaOrden[1] ?? "ASC"; // DIRECCION POR DEFECTO
    

    if(!isset($_SESSION["usuario"])){
        header("location: sesion/login.php");
        exit;
    }
    ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $consulta1 = "DELETE FROM peliculas WHERE nombre_estudio = '{$_POST['nombre_estudio']}'";
        $consulta = "DELETE FROM estudios WHERE nombre_estudio = '{$_POST['nombre_estudio']}'";
        if($_conexion -> query($consulta1)){
            echo "<div class='alert alert-succes'> Se ha borrado las peliculas del estudio
            {$_POST['nombre_estudio']}";
            $_conexion -> query($consulta);
        }else{
            echo "<div class='alert alert-danger'> No se ha borrado la pelicula con el ID 
            {$fila['id_pelicula']}";
        }

        


    }
    ?>
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary"> Ir al menu principal</a>
        <!--Esto de abajo es lo mismo que mandar un formulario con get
        Con los campos de order_by y de direction ):-->
        <form action="" method="get">
            <select name="orden" class="form-select mb-4 mt-4">
                <option disabled selected>-------------Elige una----------------</option>
                <option value="anno_fundacion-ASC">Ordenar por año de estreno (ASC)</option>
                <option value="anno_fundacion-DESC">Ordenar por año de estreno (DESC)</option>
                <option value="nombre_estudio-ASC">Ordenar por nombre (ASC)</option>
                <option value="nombre_estudio-DESC">Ordenar por nombre (DESC)</option>
                <input type="submit" value="ORDENAR" class="btn btn-primary mb-2">
            </select>
        </form>

    </div>


    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>Nombre Estudio</th>
                <th>Ciudad</th>
                <th>Año de Fundacion</th>
                <?php
                if($_SESSION["admin"])
                    echo "<th>Acciones</th>";
                ?>
            </tr>
        </thead>
        <tbody>
           <?php
            $consulta = "SELECT * FROM estudios ORDER BY $columna $direccion";
            $resultado = $_conexion->query($consulta);
            while($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                foreach($fila as $peli){
                    echo "<td>$peli</td>";
                }
                // AQUI METER UN TD CON EL NUMERO DE PELIS POR CADA ESTUDIO IINER JOIN
                if($_SESSION["admin"]){
                   echo "<td>"; 
                   echo "<a href='editarEstudio.php' class='btn btn-warning mb-1'> Editar </a>"; 
                   echo "<form action='' method='post'> 
                   <input type='hidden' name='{$fila["nombre_estudio"]}'> 
                   <input type='submit' value='Borrar' class='btn btn-danger '>
                   </form>"; 
                   echo "</td>";
                }
                echo "</tr>";
            } 
           ?>
        </tbody>
    </table>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>