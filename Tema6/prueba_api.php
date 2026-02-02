<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<form action="" method="post">
    <label>Método HTTP que vamos a mandar</label>
    <select name="metodo" id="">
        <option value="GET">GET</option>
        <option value="POST">POST</option>
        <option value="PUT">PUT</option>
        <option value="DELETE">DELETE</option>
    </select>

    <!-- ESTE CAMPO SOLO PARA SI EL MÉTODO ES GET -->
    <label for="">Ciudad (PARA EL GET)</label>
    <input type="text" name="ciudad_filtro" placeholder="Tokio, Los Angeles, Nueva York...">
    <small>Si lo dejas vacío este campo, se muestran todas las desarrolladoras</small>
    <br><br>
    <!-- ESTOS CAMPOS PARA POST Y PUT -->
    <label for="">Nombre desarrolladora (POST//PUT)</label>
    <input type="text" name="nombre_desarrolladora" id="">
    <label for="">Ciudad (POST//PUT)</label>
    <input type="text" name="ciudad" id="">
    <label for="">Año de fundación (POST//PUT)</label>
    <input type="text" name="anno_fundacion" id="">
    <br><br>
    <!-- CAMPOS PARA EL DELETE -->
    <label for="">Nombre desarrolladora (DELETE)</label>
    <input type="text" name="nombre_desarrolladora_borrar" id="">
    <br><br>
    <input type="submit" value="Cositas API" name="api">
</form>    

<?php

    /**
     * QUÉ VA A HACER ESTE FICHERITO
     * 
     * Aquí es desde donde vamos a acceder a la API, le enviaremos la información junto
     * con el método que sea y la API me responderá. Sacaremos la información en formato JSON
     * y si es necesario, la transformaremos en otras cosas.
     * 
     */

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["api"])){
        echo "<div class='alert alert-success'>";
        $metodo = $_POST["metodo"];

        $url = "http://localhost/servidor/Tema6/nuclaor_ap.php";

        if($metodo == "GET"){
            $parametros_url = "";
            if(!empty($_POST["ciudad_filtro"])){
                $parametros_url = "?ciudad=". urlencode($_POST["ciudad_filtro"]);
            }
            $url_completa = $url . $parametros_url;

            echo "URL que vamos a consultar: <br>$url_completa";
            /**
             * file_get_contents() => hacer la petición HTTP
             * 
             * Esta función generalmente sirve para leer archivos, pero también puede hacer peticiones HTTP (si le pasamos una URL)
             * 
             * Es el mismo funcionamiento que el del navegador, nosotros le pasamos una URL y el  navegador te devuelve el contenido de la página
             * 
             */

            try{
                $respuesta = file_get_contents($url_completa);

                echo "Respuesta de la api: <br><pre>$respuesta</pre>";
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }elseif($metodo == "POST" || $metodo == "PUT" || $metodo == "DELETE"){

            //Habiendo entrado aquí sabemos que tenemos que pasar datos a través del cuerpo de la petición

            //ahora vamos a diferenciar cada método según qué parámetros tengo que pasar para cada método
            $datos = [];
            if($metodo != "DELETE"){
                $datos = [
                    "nombre_desarrolladora" => $_POST["nombre_desarrolladora"],
                    "ciudad" => $_POST["ciudad"],
                    "anno_fundacion" => $_POST["anno_fundacion"]
                ];
            }else{
                $datos = [
                    "nombre_desarrolladora" => $_POST["nombre_desarrolladora_borrar"]
                ];
            }

            echo "Datos que enviamos:<br><pre>".htmlspecialchars(json_encode($datos,JSON_PRETTY_PRINT))."</pre>";

            /**
             * stream_context_create() => configurar la petición HTTP
             * 
             * como ya sabemos, para enviar datos a través del método POST, PUT o DELETE, me hace falta más opciones que para enviarlos desde un simple GET.
             * 
             * A esas opciones las llamaremos el contexto
             * 
             * El contexto es una "hoja de instrucciones" que le dice a PHP:
             * - Qué método HTTP vamos a usar
             * - Qué tipo de datos le pasamos
             * - Cuál es el contenido o cuerpo de la petición HTTP
             * 
             * En resumen, estamos preparando el paquete con todas las opciones antes de mandarlo a la API
             */

            $opciones = [
                "http" => [
                    "header" => "Content-Type: application/json",
                    "method" => $metodo,
                    "content" => json_encode($datos)
                ] 
            ];
            // con esta funcion creamos el contexto con las opciones que nosotros le hemos especificado
            $contexto = stream_context_create($opciones);

            //var_dump($contexto);

            /**
             * volvemos usar file_get_contents() pero ahora le añadimos también el contexto que hemos creado. Como tenemos más datos (u opciones) que pasarle a la petición, necesitamos añadir más parámetros a esta función
             * 
             * - la url
             * - false
             * - el contexto
             */

            try{
                $respuesta = file_get_contents($url, false, $contexto);

                echo "Respuesta de la API:<br><pre>$respuesta</pre>";
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        echo "</div>";
    }
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>