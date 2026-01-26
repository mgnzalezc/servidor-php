<?php
    require "conexion_pdo.php";
    
    # Primera forma: consultas con querys sencillas

    try {
        $res = $_conexion -> query("SELECT * FROM desarrolladoras");
        

        while ($fila = $res->fetch()) {
            echo "Desarrolladora: {$fila["nombre_desarrolladora"]} || Ciudad: {$fila["ciudad"]} || Año de fundacion: {$fila["anno_fundacion"]} <br>";
        }

    } catch (PDOException $e) {
        echo "Error en la consulta: {$e-> getMessage()}";
    }


    # Segunda forma: Con prepare y execute pero con consultas preparada

    try {
        $res = $_conexion->prepare("SELECT * FROM videojuegos WHERE nombre_desarrolladora = :nombre");
        // : nombre es un parametro dinamico 
        
        $res->execute(["nombre" => "FromSoftware"]);
        //$fila = $res->fetch();
        var_dump($res);
        echo "<br>";
        if($fila = $res->fetch()){
            echo $fila["titulo"] . "<br>";
            while ($fila = $res->fetch()) {
                echo $fila["titulo"] . "<br>";
            }
        }else{
            echo "No hay na... <br>";
        }
        

    } catch (PDOException $e) {
        // aqui solo entra si la consulta esta mal hecho no si el resultado es vacio
        // por ejemplo linea 27 si cambio nombre da error crucial y entra por el catch y si 
        // pongo una desarrolladora que no tenga juegos no entra por aqui, simplemente da 0 resultados
        echo "estoy exceptuado";
    }


    # TERCERA FORMA con prepare y execute y usando fetchAll();
    echo "<br>";
    try {
        $res = $_conexion->prepare("SELECT * FROM desarrolladoras");

        $res->execute();

        $desarrolladoras = $res->fetchAll();
        print_r($desarrolladoras);
    } catch (PDOException $e) {
        echo "fallaste";
    }


    // Insertar un juego con una consulta preparada
    /* PARA METER COSAS:

    COMENTO PORQUE ESTA YA METIDO Y NO QUIERO QUE ME DE ERROR TODO EL RATO

    try {
        $consulta = $_conexion->prepare("INSERT INTO videojuegos (
            titulo,
            nombre_desarrolladora,
            anno_lanzamiento,
            porcentaje_reseñas,
            horas_duracion
        ) VALUES (:nombre, :desarrolladora, :c, :d, :e)");
        
        $consulta->execute([
            "nombre" => "MariaMedebe",
            "desarrolladora" => "Nintendo",
            "c" => 1996,
            "d" => 98,
            "e" => 1
        ]);

        echo "Ej juego dentro <br>";

    } catch (PDOException $e) {
        echo "no se ha podido meter el juego loco" . $e->getMessage();
    }
    */ 



    /***
     * Borrar datitos -> crea un formulario con un campo de texto que segun el numero que entre por el formulario
     * se borran el mismo numero de juegos ....... -> si pongo 4 se borran 4 numeros 
     * 
     * ver cual es el primer id si ya he borrado
     * 
    */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    ?>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["borra"])){
        $borrar = $_POST["borra"];
        $consulta = $_conexion->query("SELECT MIN(id_videojuego) AS buscarID FROM videojuegos");
        echo "<br>BORRANDO:<br>";
        $numeroArray = $consulta->fetch();
        $primer = $numeroArray["buscarID"];

        //subconsulta de id asi sabes cual es el mas bajo
        //volcar en array, mirar el TITULO de los x primeros y borrarlo en la tabla por titulo
        //si intento borrar un id que no existe, con ->query no da error, lo que hace es preguntar si se puede borrar? no, pues no lo hagas (mirar ejemplo en screenshot que hizo gabi en extras)

        //para que borre aunque hayas borrado uno en mitad. ie borro el 3, luego auiero borrar dos (el 2 y el 4)
        $num = $_POST["borra"];
        try{
            $consulta = "DELETE FROM videojuegos ORDER BY id_videojuego ASC LIMIT :limite";
            $consulta = $_conexion->prepare($consulta);

            $consulta->bindValue("limite", $num, PDO::PARAM_INT);

            $consulta->execute();

            $borrados = $consulta->rowCount(); //es el numero de filas que se han visto afectadas por mi consulta (la q sea)

        } catch(PDOException $e) {
            echo "fallaste";
        }

    }
    ?>
    <p>Elige un numero de juegos a borrar</p>
    <form method="POST">
        <input type="number" name="borra">
        <input type="submit" value="BORRAR">
    </form>
</body>
</html>

<?php
    try{
        $_conexion->beginTransaction();
        $consulta = $_conexion->prepare("INSERT INTO desarrolladoras (
            nombre_desarrolladora,
            ciudad,
            anno_lanzamiento
        ) VALUES (:a, :b, :c)");

        $consulta->execute([
            "a" => "DawDes1",
            "b" => "DawCity",
            "c" => 1
        ]);
        $consulta->execute([
            "a" => "DawDes2",
            "b" => "DawCity",
            "c" => 1
        ]);
        $consulta->execute([
            "a" => "DawDes3",
            "b" => "DawCity",
            "c" => 1
        ]);

    } catch(PDOException $e) {
        $_conexion->rollBack();
        echo "<br>Error al insertar desarrolladoras ".$e->getMessage();
    }
?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insertar"])){
        //cogemos variables
        $titulo = $_POST["titulo"];
        $nombre_desarrolladora = $_POST["nombre_desarrolladora"];
        $anno_lanzamiento = $_POST["anno_lanzamiento"];
        $porcentaje_reseñas = $_POST["porcentaje_reseñas"];
        $horas_duracion = $_POST["horas_duracion"];

        try {

            /**
             * todas las querys q vas a necesitar en tu código
             */
            $buscarDes = $_conexion->prepare("SELECT * FROM desarrolladoras WHERE nombre_desarrolladora = $nombre_desarrolladora");

            $buscarVid = $_conexion->prepare("SELECT * FROM videojuegos WHERE titulo = $titulo");

            $crearVid = $_conexion->prepare("INSERT INTO videojuegos (
                        titulo,
                        nombre_desarrolladora,
                        anno_lanzamiento,
                        porcentaje_reseñas,
                        horas_duracion
                    ) VALUES (:nombre, :desarrolladora, :c, :d, :e)");

            $creaDes = $_conexion->prepare("INSERT INTO desarrolladoras ... ");

            
            $buscarVid->execute();
            if($buscarVid->rowCount() > 0){//titulo existe
                // ERROR insertando, titulo existe
            }
            else {
                $buscarDes->execute();
                if($buscarDes->rowCount() === 0){ //desarrolladoras not found
                    

                }
                else {
                    
                    $crearVid->execute([
                        "nombre" => $titulo,
                        "desarrolladora" => $nombre_desarrolladora,
                        "c" => $anno_lanzamiento,
                        "d" => $porcentaje_reseñas,
                        "e" => $horas_duracion
                    ]);

                    echo "Ej juego dentro <br>";
                }
            }

        } catch (PDOException $e) {
            echo "no se ha podido meter el juego loco" . $e->getMessage();
        }
    }
?>
 <p>Inserta juego</p>
    <form method="POST">
        <input type="hidden" name="insertar">
        <input type="text" name="titulo">
        <input type="text" name="nombre_desarrolladora">
        <input type="text" name="anno_lanzamiento">
        <input type="text" name="porcentaje_reseñas">
        <input type="text" name="horas_duracion">
        <input type="submit" value="INSERTAR">
    </form>