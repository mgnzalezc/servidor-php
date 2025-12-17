<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios validacion</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
        //require(ruta relativa de clase con funcion que quiero);
    ?>
</head>
<body>
    
    <h3>EJERCICIO 1.</h3>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            //si no se escoge opcion en select se manda vacio
            //usar isset() para los select
            print_r($_POST);
            var_dump($_POST["edad"]);
            $tmp_nombre = $_POST["nombre"];
            $tmp_edad = $_POST["edad"];

            if(!isset($_POST["genero"])){
                $err_genero = "<p style='background-color:red'>Insterta un genero</p>";
            }

            if($tmp_nombre == "" || $tmp_nombre == 0 || $tmp_nombre == [] || $tmp_nombre == NULL){
                $err_nombre = "<p>Inserta un nombre</p>";
            } else{
                $nombre = $tmp_nombre;
            }
            if($tmp_edad == ""){
                $err_edad = "<p>Inserta una edad</p>";
            } elseif($tmp_edad < 0){
                $err_edad = "<p>Inserta una edad mayor a 0</p>";
            }
            else {
                $edad = $tmp_edad;
            }

        }
        //PONEMOS EL PHP ANTES DEL FORM, LA PRIMERA VEZ NO ENTRA PORQUE NO HAY POST Y NO ENTRA EN EL IF

    ?>

    <form action="" method="POST">
        <input type="text" name="nombre">Nombre<br>
        <?php  // SI EXISTE VARIABLE ERR_NOMBRE, ES PORQUE EXISTE UN ERROR
        if(!isset($err_nombre)) echo $err_nombre;?> 
        <input type="number" name="edad">Edad<br>
        <?php   // SI EXISTE VARIABLE ERR_EDAD, ES PORQUE EXISTE UN ERROR
        if(!isset($err_edad)) echo $err_edad;?>
        <select name="genero">
            <option disabled selected>ELIGE UNA OPCION</option>
            <option value="m">Mujer</option>
            <option value="h">Hombre</option>
            <option value="o">Otro</option>
        </select>
        <?php   // SI EXISTE VARIABLE ERR_GENERO, ES PORQUE EXISTE UN ERROR
        if(!isset($err_genero)) echo $err_genero;?>
        <input type="submit" value="ENVIAR">
    </form> 

    <h3>EJERCICIO 2. </h3>
    <?php
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            
        }
        

    ?>

    <form method="POST" action="">
        <label for ="precio">Precio</label>
        <input type="number" name="precio">
        <label for="iva">Tipo IVA</label>
        <select name="iva">
            <option disabled selected>ELIGE OPCION</option>
            <option value="0.21">General</option>
            <option value="0.10">Reducido</option>
            <option value="0.4">Superreducido</option>
        </select>
        <input type="submit" value="ENVIAR">
    </form>



</body>
</html>