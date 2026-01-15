<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
-->
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["nombre"])){
        header("location: usuario/login.php"); //manda de vuelta a login si no se ha logineado, por si alguien copia y pega el url
        exit();
    }
    if(($_SESSION["rol"]=="cliente")){ //si eres cliente no puedes estar aqui
        header("location: index.php");
        exit();
    }
    require "usuario/conexion.php";


    $consulta = "SELECT * FROM productos WHERE nombre = '{$_GET["nombre"]}'";
    $res = $_conexion->query($consulta);
    $info_produ = $res->fetch_assoc();


    // lista desplegable de proveedores
    $proveedores = [];
    $consulta_lista = "SELECT nombre_proveedor FROM proveedores";
    $res = $_conexion->query($consulta_lista);
    while($fila = $res->fetch_assoc()){
        array_push($proveedores, $fila["nombre_proveedor"]);
    }
    //print_r($proveedores);

    ?>
</head>
<body>
    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = trim($_POST["nombre"]);
        $nombre_proveedor = trim($_POST["nombre_proveedor"] ?? ""); //si vacio, cadena vacia
        $categoria= trim($_POST["categoria"]);
        $precio = trim($_POST["precio"]);
        $stock = trim($_POST["stock"]);

        $errores = false;

        if($nombre == ""){
            $err_nombre = "<div class='alert alert-danger'> El nombre no puede estar vacío </div>";
            $errores = true;
        }
        if($nombre_proveedor==""){
            $err_prov= "<div class='alert alert-danger'>El nombre del proveedor no existe</div>";
            $errores = true;
        }
        if($categoria == ""){
            $err_categ = "<div class='alert alert-danger'>La categoría no puede estar vacío</div>";
            $errores = true;
        }
        if($precio== ""){
            $err_precio = "<div class='alert alert-danger'>El precio no puede estar vacío</div>";
            $errores = true;
        }elseif(!filter_var($precio, FILTER_VALIDATE_FLOAT)){ 
            $err_precio = "<div class='alert alert-danger'>El precio debe ser un entero o decimal</div>";
            $errores = true;
        }
        if($stock == ""){
            $err_stock = "<div class='alert alert-danger'>El stock no puede estar vacío</div>";
            $errores = true;
        }elseif(!filter_var($stock, FILTER_VALIDATE_INT)){ 
                $err_stock = "<div class='alert alert-danger'>El stock tiene que ser un número</div>";
                $errores = true;
        }

        if(!$errores){
            
            $consulta = "UPDATE productos SET
                        nombre = ?,
                        categoria = ?,
                        precio = ?,
                        stock = ? ,
                        nombre_proveedor = ?
                        WHERE nombre = {$_GET["nombre"]}";
            $stmt = $_conexion->prepare($consulta);
            $stmt->bind_param("ssdis", $nombre, $categoria, $precio, $stock, $nombre_proveedor);
            if($stmt->execute()){
                echo "<div class='alert alert-success'>El producto {$_GET["nombre"]} ha sido modificado</div>";
            } else{
                echo "<div class='alert alert-danger'>El producto {$_GET["nombre"]} NO ha podido modificarse</div>";
            }
            $nombre = $nombre_proveedor = $categoria = $precio = $stock = "";
        }
    }

    ?> 

    <div class="containter mt-4">
        <h1 class="fs-1">Editar producto <?= $info_produ["nombre"] ?></h1>
        <form action="" method="POST">

            <div class="mb-3">
                <label class="form-label">Nombre del producto</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($info_produ["nombre"]); ?>">
                <?= $err_nombre ?? "" ?>
            </div>

            <div class="mb-3">
                <label for="estudio" class="form-label">Proveedor</label>
                <select type="text" name="nombre_proveedor" class="form-control">
                    <?php
                    foreach($proveedores as $prove){ //hemos guardado en el select todos los estudios y ahora lo recorremos para imprimir
                        // para seleccionar ya la que es
                        if($prove == $info_produ["nombre_proveedor"]){
                            echo "<option value='$prove' selected> $prove </option>";
                        } else{
                            echo "<option value='$prove'> $prove </option>";
                        }
                    }
                    ?>
                </select>
                <?= $err_prov ?? "" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input type="text" name="categoria" class="form-control" value="<?= htmlspecialchars($info_produ["categoria"])?>">
                <?= $err_categ ?? "" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="text" name="precio" class="form-control" value="<?= $info_produ["precio"] ?>">
                <?= $err_precio ?? "" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="text" name="stock" class="form-control" value="<?= $info_produ["stock"] //esto es lo que busco en la bd asiq no son los nombres de las variables, sino de los campos de la bd?>">
                <?= $err_stock ?? "" ?>
            </div>

            <div class="mb-3">
                <input type="submit"value="Editar" class="btn btn-success">
            </div>

        </form>
    </div>

    <a href="productos.php" class="btn btn-primary"> Volver a productos</a>


    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    -->

</body>
</html>