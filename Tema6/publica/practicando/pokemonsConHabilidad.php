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
    $name = $_GET["name"];
    $apiURL = "https://pokeapi.co/api/v2/ability/".$name;

    $curl = curl_init(); // iniciar sesion curl, por que? porque curl necesita una estructura en memoria para almacenar la info
    curl_setopt($curl, CURLOPT_URL, $apiURL); //establecer url que vamos a consultar
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // devuelve resultado en vez de imprimirlo
    $res = curl_exec($curl); // ejecutar peticion y alacenar la respuesta
    curl_close($curl);
    $habilidad = json_decode($res, true);


?>
    <?php
        echo "<h1>$name</h1>";
        echo '<p>'.$habilidad["effect_entries"][2]["effect"].'</p>';
        echo "<ul>";
        if(count($habilidad["pokemon"])<10){
            for ($i=0; $i < count($habilidad["pokemon"]); $i++) { 
                echo "<li>".$habilidad["pokemon"][$i]["pokemon"]["name"];
                //coger datos poke
                $urlPoke = $habilidad["pokemon"][$i]["pokemon"]["url"];
                $curl = curl_init(); // iniciar sesion curl, por que? porque curl necesita una estructura en memoria para almacenar la info
                curl_setopt($curl, CURLOPT_URL, $urlPoke); //establecer url que vamos a consultar
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // devuelve resultado en vez de imprimirlo
                $res = curl_exec($curl); // ejecutar peticion y alacenar la respuesta
                curl_close($curl);

                $poke = json_decode($res, true);
                $foto = $poke["sprites"]["front_default"];
                echo "<br><img src='$foto' alt='foto pokemon'>";
                echo "<br>height: ".$poke["height"];
                echo "<br>weight: ".$poke["weight"];
                echo "<br><a href='movimientos.php?pokemon={$poke["name"]}'>Ver movimientos</a>";
                echo "</li>";
            }
        }
        else{
            for ($i=0; $i < 10; $i++) { 
                echo "<li>".$habilidad["pokemon"][$i]["pokemon"]["name"];
                //coger datos poke
                $urlPoke = $habilidad["pokemon"][$i]["pokemon"]["url"];
                $curl = curl_init(); // iniciar sesion curl, por que? porque curl necesita una estructura en memoria para almacenar la info
                curl_setopt($curl, CURLOPT_URL, $urlPoke); //establecer url que vamos a consultar
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // devuelve resultado en vez de imprimirlo
                $res = curl_exec($curl); // ejecutar peticion y alacenar la respuesta
                curl_close($curl);

                $poke = json_decode($res, true);
                $foto = $poke["sprites"]["front_default"];
                echo "<br><img src='$foto' alt='foto pokemon'>";
                echo "<br>height: ".$poke["height"];
                echo "<br>weight: ".$poke["weight"];
                echo "<br><a href='movimientos.php?pokemon={$poke["name"]}'>Ver movimientos</a>";
                echo "</li>";
            }
        }
        
        echo "</ul>";
    ?>
    


</body>
</html>