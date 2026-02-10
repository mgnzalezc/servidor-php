<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //paginacion. 

    //1) vamos a leer la página actual desde la url, es decir, en qué página estamos 
    // url?page=1, ?page=2...
    // if(isset($_GET["page"]))
    //     $pagina = $_GET["page"];
    // $pagina = 1;

    $pagina = isset($_GET["page"]) ? $_GET["page"] : 1;

    //2) Cuántos resultados quiero por página
    $maxPorPagina = 15;

    //3) Contruimos la URL con paginación (no todas las las APIS me dejan, jikan en específico si me deja pero hay q tener cuidao porque puede ser que otras no)

    $apiURL = "https://api.jikan.moe/v4/top/anime?". http_build_query([
        "page" => $pagina,
        "limit" => $maxPorPagina
    ]);

    // Qué es cURL? Es un recurso que mantiene la configuración de la petición URL:
    // en la configuración de la URL podemos especificar cosas como métodos GET/POST (para los formularios), headers, timeouts, si te devuelve las respuestas como string.. etc

    

    $curl = curl_init(); // Iniciar una sesión cURL. Por qué? Porque cURL requiere de una estructura en memoria para almacenar la información

    //curl_setopt()
    curl_setopt($curl, CURLOPT_URL, $apiURL); // Establecer la URL que vamos a consultar
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Devuelve el resultado de url en vez de imprimirlo
    $res = curl_exec($curl); // Ejecutar la petición y almacenar la respuesta
    curl_close($curl);

    //var_dump($res);

    // vamos a sacar en una tabla el ranking, el título, titulo en japo, nota, imagen de portada
    $datos = json_decode($res, true);
    $animes = $datos["data"];

    $paginacion = $datos["pagination"];

    $paginaActual = $paginacion["current_page"] ?? $pagina;
    $ultPagina = $paginacion["last_visible_page"] ?? $pagina;
    $tieneSiguiente = $paginacion["has_next_page"] ?? false;

    // para construir un enlace a la misma página usaremos $_SERVER
    $actual = htmlspecialchars($_SERVER["PHP_SELF"]);

    ?>
    <div>
        <?php
            if($paginaActual > 1){
                echo "<a href='$actual?page=".($paginaActual-1)."'>Ir atrás</a>";
            }       
            echo "Página ".$paginaActual." de ".$ultPagina." (".$maxPorPagina." animes por página)";  
            if($tieneSiguiente){
                echo "<a href='$actual?page=".($paginaActual+1)."'>Siguiente</a>";
            }         
        ?>
    </div>
    <table>
        <thead>
            <tr>
                <td>Posicion</td>
                <td>Titulo</td>
                <td>Arigato</td>
                <td>Nota</td>
                <td>Imagen</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($animes as $anime){
            ?>
            <tr>
                <td><?= $anime["rank"] ?></td>
                <td><a href="animeMejorado.php?patapta=<?= $anime["mal_id"]?>"><?= $anime["title"]?></a></td>
                <td><?= $anime["title_japanese"] ?></td>
                <td><?= $anime["score"] ?></td>
                <td>
                    <img src="<?= $anime["images"]["jpg"]["image_url"] ?>" alt="">
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>