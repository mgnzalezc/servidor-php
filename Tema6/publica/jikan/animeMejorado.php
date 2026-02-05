<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mejorado</title>
</head>
<body>
    <?php


    $curl = curl_init(); // iniciar sesion curl, por que? porque curl necesita una estructura en memoria para almacenar la info

    curl_setopt($curl, CURLOPT_URL, $apiURL); //establecer url que vamos a consultar
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // devuelve resultado en vez de imprimirlo
    
    $res = curl_exec($curl); // ejecutar peticion y alacenar la respuesta

    curl_close($curl);

    // vamos a sacar una tabla la posicion, el titulo, titulo en japo, nota, img portada

    $datos = json_decode($res, true);
    $anime = $datos["data"];

    ?>

    <h1><?= $anime["title"];?></h1>
    <h1><?= $anime["title_japanese"];?></h1>
    <p><?= "" ?></p>

</body>
</html>