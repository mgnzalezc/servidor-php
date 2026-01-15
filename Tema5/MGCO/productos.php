<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla con todos los productos</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
-->
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["nombre"])){ 
        header("location: usuario/login.php"); //manda de vuuelta a login si no se ha logineado, por si alguien copia y pega el url
        exit();
    }
    require "usuario/conexion.php";


    $columna = $_GET["order_by"] ?? "precio"; 
    $direccion = $_GET["direction"] ?? "DESC";


    ?>
</head>
<body>
    <?php
        // codigo de borrar con if post && isset(titulo). si no se ha creado isset titulo es porque no tienes permisos para borrar el producto
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_producto"])){
        $consulta = "DELETE FROM productos WHERE id_producto = '{$_POST["id_producto"]}'";
            if($_conexion->query($consulta)){
                echo "<div class='alert alert-success'>Se ha eliminado correctamente el producto </div>";
            }else{
                echo "<div class='alert alert-danger'>No se ha podido eliminar el producto</div>";
            }
        }
    ?>

    <a href="?order_by=precio&direction=DESC" class="btn btn-info"> Ordenar por precio (DES)</a>

    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Nombre del proveedor</th>
                <?php
                if($_SESSION["rol"]=="admin"){
                    echo "<th>Editar</th>";
                    echo "<th>Borrar</th>";
                } else if($_SESSION["rol"]=="editor"){
                    echo "<th>Editar</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>
           <?php
            $consulta = "SELECT * FROM productos ORDER BY $columna $direccion";
            $resultado = $_conexion->query($consulta);
            while($fila = $resultado->fetch_assoc()){
                echo "<tr>";
                foreach($fila as $produ){
                    //para no imprimir el id
                    if($produ != $fila["id_producto"]){
                        echo "<td>$produ</td>";
                    }
                    
                }
                if($_SESSION["rol"]=="admin"){
                   echo "<td><a href='editar.php?nombre={$fila["nombre"]}' class='btn btn-warning'>Editar</a></td>";
                   echo "<td>";
                   echo "<form action='' method='post'> 
                   <input type='hidden' name='id_producto' value='{$fila["id_producto"]}'> 
                   <input type='submit' value='Borrar {$fila["nombre"]}' class='btn btn-danger'>
                   </form>"; 
                   echo "</td>";

                }else if($_SESSION["rol"]=="editor"){
                   echo "<td><a href='editar.php?nombre={$fila["nombre"]}' class='btn btn-warning'>Editar</a></td>";
                }
                echo "</tr>";
            } 
           ?>
        </tbody>
    </table>


<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
-->

</body>
</html>