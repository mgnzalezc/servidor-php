<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    
</head>
<body>
<?php
//paginacion:
// 1) leer pagina actual desde la url, es decir, en q pag estamos
// se recoge siempre al principio para ir navegando para alante y para atras
    $pagina = isset($GET["page"]) ? $_GET["page"] : 1; //si es true guarda eso, el ? lo separa, si es false mete 1

// 2) cuantos resultados quiero por pagina
    $maxpp = 30;

// 3) construimos la url con paginacion, no  todas nos dejan asiq comprobar primero si hay datos de paginacion. jikan si deja
    $apiURL = "https://api.jikan.moe/v4/top/anime?". http_build_query(
        ["page" => $pagina,
        "limit" => $maxpp]
    );

    /**
     * que es cURL? recurso que mantiene la config de la peticion URL
     * 
     * en la config podemos especificar coasa como metodos GET/POST (para formus), header, timeout, si te dvuelve las respuestas como string.. etc
     * 
     * basicamente, una peticion que le podemos añadir mas cosas
     */

    $apiURL = "https://api.jikan.moe/v4/top/anime";

    $curl = curl_init(); // iniciar sesion curl, por que? porque curl necesita una estructura en memoria para almacenar la info

    curl_setopt($curl, CURLOPT_URL, $apiURL); //establecer url que vamos a consultar
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // devuelve resultado en vez de imprimirlo
    
    $res = curl_exec($curl); // ejecutar peticion y alacenar la respuesta

    curl_close($curl);

    // vamos a sacar una tabla la posicion, el titulo, titulo en japo, nota, img portada

    $datos = json_decode($res, true);
    $animes = $datos["data"];


    $paginacion = $datos["pagination"];
    $paginaActual = $paginacion["current_page"] ?? $pagina;
    $ultPagina = $paginacion["last_visible_page"] ?? $pagina;
    $sig = $paginacion["has_next_page"] ?? $pagina; //si tienes siguiente, osea si es la ultima

    //para enlace a la misma pag
    $actual = htmlspecialchars($_SERVER["PHP_SELF"]);

?>
<div>
    <?php
        if($paginaActual>1){ //si es mayor a uno, pongo flecha palante y patras
            echo "<a href='$actual?page={($paginaActual-1)}'>Ir atrás</a>";
            
        }
        echo "Página $paginaActual de $ultPagina ($maxpp por pagina)"; 
        if($sig) {
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
            <td>Portada</td>
        </tr>
        
    </thead>
    <tbody>
        <tr>
            <td>
                <?php 
                    foreach($animes as $anime){
                        echo "<tr>";
                            echo "<td>{$anime['rank']}</td>";
                            echo "<td><a href='animeMejorado.php?patapta=?{$anime['mal_id']}'>{$anime['title']}</a></td>";
                            echo "<td>{$anime['title_japanese']}</td>";
                            echo "<td>{$anime['score']}</td>";
                            echo "<td> <img src='{$anime['images']['jpg']['image_url']}' alt=''> </td>";
                        echo "</tr>";
                    }
                ?>
            </td>
        </tr>
    </tbody>
</table>

</body></html>