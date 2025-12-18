<?php
session_start();
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
    if(!isset($_SESSION["usuario"])){ //Comprobamos si el cliente ha iniciado sesión
        header("location: index.php");
        exit;
    }
    if(!$_SESSION["admin"]){ // Comprobamos si el cliente es admin
        header("location: index.php");
        exit;
    }
    require "sesion/conexion.php";
    ?>
</head>
<body>
    <?php
    $consulta = "SELECT nombre_estudio FROM estudios";
    $resultado = $_conexion->query($consulta);
    $estudios = [];
    while($fila = $resultado->fetch_assoc()){
        $estudios[] = $fila["nombre_estudio"];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        print_r($_POST);
        // Sanitizar y recoger los datitos
        $titulo = trim($_POST["titulo"]);
        $nombre_estudio = trim($_POST["nombre_estudio"] ?? "");
        $anno_estreno = trim($_POST["anno_estreno"]);
        $num_temporadas = trim($_POST["num_temporadas"]);
        $duracion = trim($_POST["duracion"]);

        //Validacion

        /**
         * Titulo: 
         * Que no esté vacío "" // que tenga más de un carácter y menos de 80
         * 
         * Año de estreno:
         * Que no esté vacío // que sea un número entero // que esté entre 1900 y 2100
         * 
         * Numero de entregas (o número de temporadas):
         * Que no esté vacío // que sea un numero entero o decimal // que tenga 1 o más temporadas y que tenga menos de 90
         * 
         * Duración:
         * 
         * Que no esté vacío // que sea entero o decimal // que tenga más de 60 
         */

        $errores = false;

        if($titulo == ""){
            $err_titulo = "<div class='alert alert-danger'>El título no puede estar vacío</div>";
            $errores = true;
        }elseif(strlen($titulo)<1 || strlen($titulo)>80){
            $err_titulo = "<div class='alert alert-danger'>El título tiene que tener de 1 a 80 caracteres</div>";
            $errores = true;
        }

        if(!in_array($nombre_estudio, $estudios)){
            $err_estudio = "<div class='alert alert-danger'>El nombre del estudio no está en la base de datos (sé que has intentado hacer maleante)</div>";
            $errores = true;
        }

        if($anno_estreno == ""){
            $err_anno = "<div class='alert alert-danger'>El año de estreno no puede estar vacío</div>";
            $errores = true;
        }elseif(!filter_var($anno_estreno, FILTER_VALIDATE_INT)){ //is_numeric() o is_int()
            $err_anno = "<div class='alert alert-danger'>El año de estreno tiene que ser un número</div>";
            $errores = true;
        }elseif($anno_estreno<1900 || $anno_estreno>2100){
            $err_anno = "<div class='alert alert-danger'>El año de estreno tiene que estar entre el 1900 y 2100</div>";
            $errores = true;
        }

        if($num_temporadas== ""){
            $err_temporadas = "<div class='alert alert-danger'>El número de temporadas no puede estar vacío</div>";
            $errores = true;
        }elseif(!filter_var($num_temporadas, FILTER_VALIDATE_FLOAT)){ 
            $err_temporadas = "<div class='alert alert-danger'>El número de temporadas debe ser un entero o decimal</div>";
            $errores = true;
        }elseif($num_temporadas<1 || $num_temporadas>90){
            $err_temporadas = "<div class='alert alert-danger'>El número de temporadas debe estar entre uno y noventa</div>";
            $errores = true;
        }

        if($duracion == ""){
            $err_duracion = "<div class='alert alert-danger'>La duración no puede estar vacío</div>";
            $errores = true;
        }elseif(!filter_var($duracion, FILTER_VALIDATE_FLOAT)){ 
            $err_duracion = "<div class='alert alert-danger'>La duración debe ser un entero o decimal</div>";
            $errores = true;
        }elseif($duracion<60){
            $err_duracion = "<div class='alert alert-danger'>La duración debe ser mayor a una hora</div>";
            $errores = true;
        }

        // Si no hay errores, insertamos en la bbdd las cositis
        if(!$errores){
            //PREPARAR LA CONSULTA (SQL con placeholders)

            // Envíamos al servidor el SQL con placeholders (?). El sevidor compila la consulta y devuelve un objeto de tipo mysqli_stmt. En esta fase no se mandan todavía los valores, solo una "plantilla".
            
            //El SQL y los datos van separados, por lo que la inyección SQL  ya no se puede hacer (comillas, barras.. etc)

            $consulta = "INSERT INTO peliculas (
                        titulo,
                        nombre_estudio,
                        anno_estreno,
                        num_temporadas,
                        duracion
                        )VALUES(?, ?, ?, ?, ?)";
            $stmt = $_conexion->prepare($consulta);

            //Bindeo (enlazamiento)

            // Enlaza por referencia las variables a los ? e indica el tipo de dato de cada una.

            // s=>string, i=>integer, d=>double, b=>blob (binary large object)

            $stmt->bind_param("ssidd",$titulo,$nombre_estudio, $anno_estreno, $num_temporadas, $duracion);

            //Ejecución

            //execute() envía los valores al servidor y ejecuta la sentencia preparada

            // si todo va bien, podemos consultar cositas como $stmt->insert_id

            // en caso de error, se puede imprimir cosas como $stmt->error (más aconsejable que $_conexion->error)

            if($stmt->execute()){
                echo "<div class='alert alert-success'>Película creada correctamente (olee)</div>";
                //limpiar las variables del formulario 
                $titulo = $nombre_estudio = $anno_estreno = $duracion = $num_temporadas = "";

                /**
                 * por qué este método es mejor que query() para hacer insterts
                 * 
                 * $consulta = "INSERT INTO peliculas (...) VALUES ('".$titulo."',...);
                 * si $titulo tuviese comillas u otros caracteres maliciosos, se rompe la consulta. Pero con prepare+bind, los valores no se interpretan omo SQL, sino como datos y por ello, la consulta no se rompe.
                 * 
                 * bind_param fuerza tipos y por tanto evita errores de locales como decimales, null y eso.
                 * 
                 */
            }else{
                echo "<div class='alert alert-danger'>Liada astronómica</div>";
            }
            $stmt->close();
        }
    }
    ?>

    <div class="container mt-4">
        <h1 class="fs-1">Crear una peli</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Título de la peli</label>
                <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($titulo); ?>">
                <?php //if(isset($err_titulo)) echo $err_titulo; ?>
                <?= $err_titulo ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Estudio</label>
                <select name="nombre_estudio" class="form-select">
                    <option value="" disabled selected>-- Elija un estudio --</option>
                    <?php
                    foreach($estudios as $estudio){
                    ?>
                    <option value="<?= $estudio?>">
                        <?= $estudio ?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
                <?= $err_estudio ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Año de estreno</label>
                <input type="text" name="anno_estreno" class="form-control">
                <?= $err_anno ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Número de entregas</label>
                <input type="text" name="num_temporadas" class="form-control">
                <?= $err_temporadas ?? "" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Duración (en minutos)</label>
                <input type="text" name="duracion" class="form-control">
                <?= $err_duracion ?? "" ?>
            </div>
            <div class="mb-3">
                <input type="submit" value="Crear peli :D" class="btn btn-success">
            </div>
        </form>
        <a href="index.php" class="btn btn-secondary">Volver al menú principal</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>