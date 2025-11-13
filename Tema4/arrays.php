<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>
    <?php

    //ARRAYS NO ASOCIATIVOS
    $array = array(1,2,3,"5",TRUE);
    $array = [1,2,3,"5",true,"hola"];
    echo $array[0];
    var_dump($array);
    echo "<br>";
    print_r($array);


    // ARRAYS ASOCIATIVOS
    // se itera con foreach
    $verduras = array(
        "mercadona" => "pimientos",
        "lidl"=>"lechuga",
        "supercor"=>"nabo",
        "chino" => "calabacin"
    );
    $verduras = [
        1 => "pimientos",
        "lidl"=>"lechuga",
        true=>"nabo",
        "chino" => "calabacin"
    ];
    print_r($verduras); //usar como depuracion pq es mas feo
    echo "<br>";

        $dni = array(
            "48725375J" => "Maria Gonzalez-Carrascosa",
            "53704164S"=>"Laura Gonzalez Parra",
            "48725376A" => "Paula Gonzalez-Carrascosa",
            "29575489V" => "Lucia Gallar",
            "58623145M" => "Javier Guerrero Escagedo",
            "48755375J" => "Maria Gonzalez-Carrascosa",
            "53707164S"=>"Laura Gonzalez Parra",
            "48725396A" => "Paula Gonzalez-Carrascosa",
            "295755489V" => "Lucia Gallar",
            "58723145M" => "Javier Guerrero Escagedo",
        );

        $dni["29575543V"]="Louders";
        $dni[]="Kika";
        $dni[]="Queque";
        $dni[]="Kico"; //añade en orden
        print_r($dni);
        echo "<br>";
        unset($dni["295755489V"]);
        print_r($dni);
        echo "<br>";
        //$dni = array_values($dni); //ordena i, ya no es array asociativo
        print_r($dni);
        echo "<br>";
        echo "<hr>";
        echo "<b> FORMAS DE ORDENAR ARRAY: </b> <br>";

        // ESTOS ORDENAN CAMBIANDO LA i:
        //sort($dni); //ordena por valor y ordena i
        //rsort($dni); //ordena invertidamente por valor y ordena i
        
        // ESTOS ORDENAN POR VALOR
        asort($dni); //ordena por valor ascendiente y NO ordena i
        arsort($dni); //ordena por valor descendiente y NO ordena i

        // ESTOS ORDENAN POR KEY
        ksort($dni); //ordena por i ascendiente
        krsort($dni); //ordena por i descendiente
       
        echo "<br>";
    ?>
    <table border="1px">
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
        </tr>
        <?php
            foreach ($dni as $current => $valor){
        ?>
                <tr>
                    <td> <?php echo $current ?> </td>
                    <td> <?php echo $valor ?> </td>
                </tr>
        <?php
            }
            
        ?>
    </table>

    <?php
        // ARRAY BIDIMENSIONAL
        $videojuegos=[
            ["fifa", "deportes", 90],
            ["fifa2", "deportes2", 80],
            ["otro", "guerra", 60],
        ];

        foreach ($videojuegos as $juego) {
            echo "<p>";
            foreach ($juego as $elemento){
                echo "$elemento || "; //se imprime esto al final, con for se puede corregir
            }
            echo "</p>";
        }

        foreach ($videojuegos as $juego) {
            list($nombre, $categoria, $precio)= $juego;

            echo "<p>Nombre: $nombre, Categoria: $categoria, Precio: $precio";

        }

        $nombres = array_column($videojuegos, 0);
        // ORDENAR ARRAYS MULTIDIMENSIONALES
        // array_multisort();

    ?>
    <ul>
    <?php
        foreach($nombres as $current){
    ?>
        <li> <?php echo $current ?> </li>
    <?php
        }
    ?>
    </ul>

    <table border="1px">
        <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Precio</th>
        </tr>
    <?php
        foreach ($videojuegos as $juego){
            echo "<tr>";
            foreach ($juego as $current){
    ?>
            <td> <?php echo $current ?> </td>
    <?php
            }
            echo "</tr>";
        }
            
    ?>
    </table>    


    
</body>
</html>