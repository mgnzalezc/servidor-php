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
    $pagina = isset($_GET["offset"]) ? $_GET["offset"] : 0;
    $limit = 30;

    $apiURL = "https://pokeapi.co/api/v2/ability?".http_build_query([
        "offset" => $pagina,
        "limit" => $limit
    ]);

    $curl = curl_init(); // iniciar sesion curl, por que? porque curl necesita una estructura en memoria para almacenar la info
    curl_setopt($curl, CURLOPT_URL, $apiURL); //establecer url que vamos a consultar
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // devuelve resultado en vez de imprimirlo
    $res = curl_exec($curl); // ejecutar peticion y alacenar la respuesta
    curl_close($curl);

    $datos = json_decode($res, true);
    $habilidades = $datos["results"];


    $actual = htmlspecialchars($_SERVER["PHP_SELF"]);

    echo "<pre>";
    if($datos["previous"] != null){
        echo "<a href='$actual?offset=".($pagina-$limit)."&limit=30'>Ir atrás</a>                   ";
    }
    echo "<a href='$actual?offset=".($pagina+$limit)."&limit=30'>Ir alante</a>";

    echo "</pre>";

?>

        <?php
        echo "<ol>";
            for($i = 0; $i<count($habilidades); $i++){
                echo "<li>";
                echo "<b>".$habilidades[$i]["name"]."</b>";
                
                $habi = "https://pokeapi.co/api/v2/ability/".($i+1);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $habi);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $res = curl_exec($curl);
                curl_close($curl);
                $habilidad = json_decode($res, true);

                echo "<br>";
                echo $habilidad["effect_entries"][2]["short_effect"];
                echo "</li>";

                echo "<a href='pokemonsConHabilidad.php?name=".$habilidades[$i]["name"]."'>Ver habilidad</a>";


            }
        echo "</ol>";
        ?>
 


</body>
</html>