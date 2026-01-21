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
        // pongo una desarrolladora que no tenga juegos no entra por aqui, simplemente da 0 resuoltados
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
    // PARA METER COSAS
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
        



    /***
     * Borrar datitos -> crea un formulario con un campo de texto que segun el numero que entre por el formulario
     * se borran el mismo numero de juegos ....... -> si pongo 4 se borran 4 numeros 
     * 
     * ver cual es el primer id si ya he borrado
     * 
     */




?>