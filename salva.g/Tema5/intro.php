<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    require "sesion/conexion.php"; //run este codigo en cuanto lo llamas, es como si lo copy pastearas
    //aqui ya puedo llamar a $_conexion porque esta creada
    ?>

</head>
<body>
    <?php
        $consulta = "SELECT * FROM peliculas";
        $resultado = $_conexion->query($consulta);
        // en resultado guardaremos un objeto mysqli_result. es decir, el conjunto de resultados de la consulta. incluye todas las filas devueltas por el SELECT y mantiene un puntero interno a la siguiente fila por leer
        var_dump($resultado);

        while($fila = $resultado->fetch_assoc()){ //mientras que dentro de fila yo pueda seguir metiendo cosas, entro, si en fila no puedo añadir o es nulo, no entro
            echo "<pre>";
            print_r($fila);
            echo "</pre>";
        }
        //assoc saca datos en array asociativo y pone el puntero en sig fila, cuando llego a ult fila, saca datos y apunta a fila inexistente entonces ya no entra en while

        var_dump($fila); //nulo porque no existe (fila esta apuntando fuera del array)

        //hay que volver a resetear la conexion porque el puntero esta apuntando fuera de la tabla, entonces hay que subirlo al principio
        $consulta = "SELECT * FROM peliculas";
        $resultado = $_conexion->query($consulta);

    ?>

    <h3>Tabla con resultados usando fetch_assoc </h3>
    <table border="1px">
    <?php
        echo "<tr>";
        $cabecera = $resultado->fetch_assoc(); //apunto solo al primero para ver las claves e imprimirlasno se usa otra vez
        foreach ($cabecera as $key => $current) {
            if($key != "num_temporadas" && $key != "id_pelicula"){
                echo "<th>";
                print_r($key);
                echo "</th>";
            }
        }
        echo "</tr>";

        $resultado = $_conexion->query($consulta); //sino no sale el primer dato pa el puntero esta en el segundo (al haber imprimido la cabecera)

        //ahora imprimimos resultados con while
        while($fila = $resultado->fetch_assoc()){
            echo "<tr>";
            foreach ($fila as $key => $current) {
                if($key != "num_temporadas" && $key != "id_pelicula"){
                    echo "<td>";
                    print_r($current);
                    echo "</td>";
                }              
            }
            echo "</tr>";
        }
    ?>
    </table>

    <h3>Tabla con fetch_all</h3>

    <table border="1px">
    <?php

    $resultado = $_conexion->query($consulta);
    
     echo "<pre>";
     print_r($resultado->fetch_all());
     echo "</pre>";
    
    $resultado = $_conexion->query($consulta);
    $tabla = $resultado->fetch_all();

    for ($i=0; $i < count($tabla); $i++) { 
        //if($key != "num_temporadas" && $key != "id_pelicula"){
            echo "<tr>";
            for ($j=0; $j < count($tabla[$i]); $j++) { 
                if($j != 0 && $j != 5){
                    echo "<td>";
                    echo $tabla[$i][$j];
                    echo "</td>";
                }
            }
            echo "</tr>";
        //}
    }
        
    ?>
    </table>
</body>
</html>