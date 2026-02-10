<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $id = $_GET["patapta"];
    $apiURL = "https://api.jikan.moe/v4/anime/$id/full";

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
    $anime = $datos["data"];
    ?>

    <h1><?= $anime["title"] ?></h1>
    <h1><?= $anime["title_japanese"] ?></h1>
    <p><?= "Puntuación: ".$anime["score"]. " Episodios: ".$anime["episodes"] ?></p>
    <img src="<?= $anime["images"]["jpg"]["large_image_url"] ?>" alt="">
    <h3>Sinopsis</h3>
    <p><?= $anime["synopsis"] ?></p>

    <h4>Productores</h4>
    <ul>
        <?php
        foreach($anime["producers"] as $productoras){
        ?>
        <li>
            <a href="<?= $productoras["url"] ?>"><?= $productoras["name"]?></a>
        </li>
        <?php
        }
        ?>
    </ul>
</body>
</html>