<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APIS probando</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

    <form method="POST">

    Elige metodo a mandar:
    <select name="metodo">
        <option value="GET">GET</option>
        <option value="POST">POST</option>
        <option value="PUT">PUT</option>
        <option value="DELETE">DELETE</option>
    </select>


    <!-- esto para GET -->
    <label for="">Ciudad para el get</label>
    <input type="text" name="ciudad_filtro" placeholder="Tokio, LA, NY...">
    <small>Si lo dejas vacío, se muestran todas las desas</small>
    <br><br>

    <!-- esto para PUT Y POST -->
    <label for="">Nombre des PUT Y POST</label>
    <input type="text" name="nombre_desarrolladora">
    <label for="">Nombre ciudad PUT Y POST</label>
    <input type="text" name="ciudad">
    <label for="">Nombre año PUT Y POST</label>
    <input type="text" name="anno_fundacion">
    <br><br>
    

    <!-- esto para DELETE -->
    <label for="">Nombre des DELETE</label>
    <input type="text" name="nombre_desarrolladora_borrar">

    <input type="submit" value="COSITAS API" name="api">
    </form>

    <?php
        /**
         * QUE VA A HACER ESTE FORM
         * 
         * desde donde accedemos a API
         * enviaremos info junto con el metodo que sea y la api me respondera
         * sacamos info en formato JSON y si es necesario la transformaremos en otras cosas
         * 
         */

        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["api"])){
            echo "<div class='alert alert-seccess'>";
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
                 * file_get_contents()
                 * 
                 * normalmente sirve para leer archivos, pero tambien puede hacer peticiones http si le pasamos una url
                 * 
                 * es el mismo funcionamiento que el del navegador, nosotros le pasamos una url y el navegador te devuelve el contenido de la pagina
                 */
                try{
                    $respuesta = file_get_contents($url_completa);
                    echo "Respuesta de api: <br><pre>$respuesta</pre>";
                } catch(Exception $e){
                    echo $e->getMessage();
                }

            } elseif ($metodo == "POST" || $metodo == "PUT" || $metodo == "DELETE"){
                // en este punto, sabemos que tenemos que pasar datos a traves del cuerpo de la peticion

                // primero difernciamos el metodo segun los parametros
                $datos = [];
                if($metodo != "DELETE"){
                    $datos = [
                        "nombre_desarrolladora" => $_POST["nombre_desarrolladora"],
                        "ciudad" => $_POST["ciudad"],
                        "anno_fundacion" => $_POST["anno_fundacion"]
                    ];
                } else {
                    $datos = [
                        "nombre_desarrolladora" => $_POST["nombre_desarrolladora_borrar"]
                    ];
                }

                // imprimimos con special chars por si hay errores que los imprima bien
                echo "Datos que enviamos:<br><pre>".htmlspecialchars(json_encode($datos, JSON_PRETTY_PRINT))."</pre>";

                /**
                 * stream_content_create() --< configurar la peticion html
                 * 
                 * para enviar datos a traves del metodo post put o delete, me hace falta mas opciones que para enviar en un get
                 * 
                 * a esas opciones las llamaremos el contexto.
                 * 
                 * el contexto es una "hora de instrucciones" que le dice a PHP
                 * - que metodo http vamos a usar
                 * - que tipo de datos le pasamos
                 * - cual es el contenido o cuerpo de la peticion
                 * 
                 * en resumen -> estamos preparando el paquete con toda la info para pasarlo a la api
                 * 
                 */

                $opciones = [
                    "http" => [
                        "header" => "Content-Type: application/json",
                        "method" => $metodo,
                        "content" => json_encode($datos)
                    ]
                ];

                // con esta funcion creamos el contecto con las opciones que nosotros le hemos especificado
                $contexto = stream_context_create($opciones);

                var_dump($contexto);

                /**
                 * volvemos usar file get contents  pero ahora le añadimos el contexto
                 * como tenemos mas datos, tenemos que pasarle mas parametros
                 * 
                 */
                try{
                    $respuesta = file_get_contents($url, false, $contexto);

                    echo "Respuesta de la API <br><pre>".$respuesta."</pre>";
                }catch(Exception $e){
                    echo $e->getMessage();
                }

            }

            echo "</div>";
        }
        
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
        
</body>
</html>