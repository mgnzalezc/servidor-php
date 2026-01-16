<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva peli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    if(!isset($_SESSION["usuario"])){ // Comprobamos si el cliente ha iniciado sesion
        header("location: index.php");
        exit();
    }
    if(!($_SESSION["admin"])){ // Comprobamos si el cliente es admin
        header("location: index.php");
        exit();
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

        if($_SERVER["REQUEST_METHOD"]=="POST"){
            //Sanitizar y recoger datos
            $titulo = trim($_POST["titulo"]);
            $nombre_estudio = trim($_POST["nombre_estudio"] ?? ""); //como es desplegable si esta vacio no se manda, entonces decimos q se cree cad vacia
            $anno_estreno = trim($_POST["anno_estreno"]);
            $num_temporadas = trim($_POST["num_temporadas"]);
            $duracion = trim($_POST["duracion"]);

            //Validación

            /**
             * Titulo - no vacio, mas de un caracter y menos de 80
             * 
             * Año estreno - no vacio, num entero, entre 1900 y 2100
             * 
             * Numero entrega - no vacio, num entero o decimal, entre 1 y 90
             * 
             * Duracion - no vacio, num entero o decimal, mas de 60 mins
             * 
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

            /*
            if(!$errores){ comentamos para hacer el rollback
                //PREPARAR LA CONSULTA (SQL con placeholders)

                // Envíamos al servidor el SQL con placeholders (?). El sevidor compila la consulta y devuelve un objeto de tipo mysqli_stmt. En esta fase no se mandan todavía los valores, solo una "plantilla".
                
                //El SQL y los datos van separados, por lo que la inyección SQL  ya no se puede hacer (comillas, barras.. etc)

                $consulta = "INSERT INTO peliculas (
                            titulo,
                            nombre_estudio,
                            anno_estreno,
                            num_temporadas,
                            duracion
                            )VALUES(?, ?, ?, ?, ?)"; //esto se llama placeholder
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

                    /*
                     * por qué este método es mejor que query() para hacer insterts
                     * 
                     * $consulta = "INSERT INTO peliculas (...) VALUES ('".$titulo."',...);
                     * si $titulo tuviese comillas u otros caracteres maliciosos, se rompe la consulta. Pero con prepare+bind, los valores no se interpretan omo SQL, sino como datos y por ello, la consulta no se rompe.
                     * 
                     * bind_param fuerza tipos y por tanto evita errores de locales como decimales, null y eso.
                    
                     
                }else{
                    echo "<div class='alert alert-danger'>Liada astronómica</div>";
                }
                $stmt->close();
            } comentamos para hacer el rollback. quitar el comentario de arriba para que funcione
            */
             
            //a partir de aqui todo nuevo, hemos comentado el if de arriba NO BORRAR ESTO:

            if(!$errores){
                /**
                 * Begin transaction, commit y rollback hacemos lo de arriba
                 * 
                 * ACID: 4 claves fundamentales que definen una transaccion
                 * 
                 * Atomicidad - todo o nada (lo llevamos a cabo con commit y rollback)
                 * 
                 * Consistencia - la db no se quede en un estado invalido. eg si tenemos que hacer dos operaciones, que no haga una de ellas solo- o se hacen las dos o ninguna
                 * 
                 * Aislamiento - una transaccion no ve resultados intermedios de otra transaccion
                 * 
                 * Durabilidad - tras el commit los cambios sobreviven a caidas del servicio. 
                 * 
                 * si realizamos varias operaciones como insertar peli y actualizar otra, no habra estados a medias. 
                 * 
                 */
                
                $consulta = "INSERT INTO peliculas (
                            titulo,
                            nombre_estudio,
                            anno_estreno,
                            num_temporadas,
                            duracion
                            ) VALUES(?, ?, ?, ?, ?)"; //esto se llama placeholder

                try{
                    $_conexion->begin_transaction();
                    $stmt = $_conexion->prepare($consulta);
                    $stmt->bind_param("ssddi", $titulo, $nombre_estudio, $anno_estreno, $num_temporadas, $duracion); //enlazamos en la interrogacion de arriba
                    $stmt->execute();

                    $_conexion->commit(); //se manda todo de una, si algo falla se manda todo para atras

                    $stmt->close();
                    //hay q close tb aunque no useamos transactions (mirar nuevo en MGCO)

                }catch(mysqli_sql_exception $e){
                    //rollback aqui, si el try no funciona entonces catch
                    $_conexion->rollback();
                    echo "<div class = 'aler alert-warning'>No se ha podido insertar la peli {$e->getMessage()}</div>";
                }
                //limpiar las variables del formulario 
                $titulo = $nombre_estudio = $anno_estreno = $duracion = $num_temporadas = "";
            }
    

        }

    ?>

    <div class="containter mt-4">
        <h1 class="fs-1">Crear una peli</h1>
        <form action="" method="POST">

            <div class="mb-3">
                <label class="form-label">Título de la peli</label>
                <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($titulo); ?>">
                <?php //if(isset($err_titulo)) echo $err_titulo; ?>
                <?= $err_titulo ?? "" ?>
            </div>

            <div class="mb-3">
                <label for="estudio" class="form-label">Estudio</label>
                <select type="text" name="nombre_estudio" class="form-control">
                    <option value="" disabled selected>-- Elija un estudio --</option>
                    <!--for de estudios, no podemos inventarnos el estudio pq es foreign key-->
                    <?php
                    foreach($estudios as $estudio){ //hemos guardado en el select todos los estudios y ahora lo recorremos para imprimir
                    ?>
                    <option value="<?php echo $estudio?>"> <?php echo $estudio?> </option>
                    <?php
                    }
                    ?>
                </select>
                <?= $err_estudio ?? "" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Año de estreno</label>
                <input type="text" name="anno_estreno" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Numero de entregas</label>
                <input type="text" name="num_temporadas" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Duración (en minutos)</label>
                <input type="text" name="duracion" class="form-control">
            </div>

            <div class="mb-3">
                <input type="submit"value="Crear peli" class="btn btn-success">
            </div>

        </form>
    </div>

    <a href="index.php" class="btn btn-primary"> Volver al index</a>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>