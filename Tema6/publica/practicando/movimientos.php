<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors",1);
    ?>

</head>
<body>
<?php
    $name = $_GET["pokemon"];
    $apiURL = "https://pokeapi.co/api/v2/pokemon/".$name;

    $curl = curl_init(); // iniciar sesion curl, por que? porque curl necesita una estructura en memoria para almacenar la info
    curl_setopt($curl, CURLOPT_URL, $apiURL); //establecer url que vamos a consultar
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // devuelve resultado en vez de imprimirlo
    $res = curl_exec($curl); // ejecutar peticion y alacenar la respuesta
    curl_close($curl);
    $pokemon = json_decode($res, true);

?>
    <?php
        echo "<h1>Movimientos de $name</h1>";
        echo "<ol>";
        
        for ($i=0; $i <=20; $i++) { 
            echo "<li>".$pokemon["moves"][$i]["move"]["name"]."</li>";
        }
        echo "</ol>";
        echo "<a href=habilidades.php>Volver a habilidades</a>";
    ?>
    


</body>
</html>