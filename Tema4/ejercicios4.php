<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tema 4 ejercicios</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <?php
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
        print_r($dni);

    ?>
    <table border="1px">
        <tr>
            <th>DNI</th>
            <th>Nombre</th>
        </tr>
        <?php
            foreach ($dni as $current => $valor ){
        ?>
                <tr>
                    <td> <?php echo $current ?> </td>
                    <td> <?php echo $valor ?> </td>
                </tr>
        <?php
            }
            
        ?>
    </table>

    <h2>Ejercicio 2</h2>
    <p>HACER: LISTA DE ALUMNOS CON NOTAS QUE EL FONDO SEA UN COLOR CORRESPONDIENTE A SUSPENSO, APROBADO ETC</p>
    
    <?php
    /*
    <tr php $color>
    y hacer que $color sea "style= "background.color:green";
    */



    //EJERCICIO ARRAY BIDIMENSIONAL:
    ?>
    <hr>
    <h2>Ejercicios bidimensionales</h2>
    <p>Usando array de videojuegos de ejemplo:</p>
    <p>1. Ordena por el precio mas barato al mas caro</p>
    <p>2. Ordena por categoria en orden alfabetico inverso</p>
    <p>3. Ordena por cetagoria, y si son iguales ordenar por precio descendente</p> 

    <?php
        $videojuegos=[
            ["fifa", "deportes", 90],
            ["fifa2", "deportes", 80],
            ["fifa3", "deportes", 180],
            ["fifa3", "deportes", 60],
            ["otro", "guerra", 60],
        ];

        //APARTADO 1. ORDENA POR PRECIO
        $precios = array_column($videojuegos, 2);
        array_multisort(
            $precios, SORT_ASC, $videojuegos
        );

    ?>
    <table border="1px" width=500px>
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

    <?php
    //APARTADO 2. ORDENA POR CATEGORIA
        $categoria = array_column($videojuegos, 1);
        array_multisort(
            $categoria, SORT_DESC, $videojuegos
        );

    ?>
    <table border="1px" width=500px>
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
    <?php

    //APARTADO 3. ORDENA POR CATEGORIA Y DESPUES POR PRECIO
        $precio = array_column($videojuegos, 2);
        $categoria = array_column($videojuegos, 1);
        array_multisort(
            $categoria, SORT_ASC,
            $precio, SORT_DESC, 
            $videojuegos
        );

    ?>
    <table border="1px" width=500px>
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

    <h2>Ejercicio notas</h2>

    <?php
    $clase=[
            "Salva"=> 
                ["Servidor"=> 1,
                "Cliente"=>1,
                "Despliegues"=>2,
                "Diseño"=> 7,
                "Ingles"=>6],
            "Laura"=> 
                ["Servidor"=> 10,
                "Cliente"=>10,
                "Despliegues"=>10,
                "Diseño"=> 10,
                "Ingles"=>10],
            "Maria"=> 
                ["Servidor"=> 10,
                "Cliente"=>10,
                "Despliegues"=>10,
                "Diseño"=> 10,
                "Ingles"=>10],
        ];
        $tam = 0;
        foreach ($clase as $alumno => $current) {
            $tam = count($current);
        }
        echo $tam;
    ?>

    <hr>
    <table border="1px" width="100%">
        <tr>
            <th>Alumno</th>
            <th>Asignatura</th>
            <th>Nota</th>
        </tr>
    <?php
        foreach ($clase as $nombre => $alumno){
    ?>
        <tr>
            <td rowspan="<?php echo $tam?>"> <?php echo $nombre?> </td>
    <?php
            foreach ($alumno as $asig => $nota){
    ?>
                <td><?php echo $asig?></td>
                <td><?php echo $nota?></td>
        </tr>
    <?php
            }
        }
    ?>

    </table>

    <!--crear columna de suspenso/aprobado/etc y colorear nota y calificac-->
    
    <hr>
    <table border="1px" width="100%">
        <tr>
            <th>Alumno</th>
            <th>Asignatura</th>
            <th>Nota</th>
            <th>Calificacion</th>
        </tr>
    <?php
        foreach ($clase as $nombre => $alumno){
            $primera = true;
            foreach ($alumno as $asig => $nota){

                [$notaS, $color] = match (true) {
                ($nota<5) => ["suspenso","#e4dafd"],
                ($nota<=6) => ["bien","#d7e7fd"],
                ($nota<=8) => ["notable","#ffece3"],
                ($nota<=10) =>["sobresaliente","#f9e0e0"]
                };

                if($primera){
    ?>
                <tr>
                    <td rowspan="<?php echo $tam?>"> <?php echo $nombre?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $asig?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $nota?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $notaS?></td>
                </tr>
    <?php
                $primera = false;
                } else {
    ?>
                <tr>     
                    <td bgcolor="<?php echo $color ?>"><?php echo $asig?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $nota?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $notaS?></td>
                </tr>
    <?php
                }
            }
        }

    ?>

    </table>

    
    <h3>Notas ordenadas</h3>
    <?php

    //ORDENA LA TABLA POR NOMBRE ALUMNO Y LUEGO POR NOTA
        ksort($clase);
        foreach ($clase as $nombre => $alumno) {
            //ksort($clase[$nombre]); //ordenar por asig
            asort($clase[$nombre]); //ordenar por nota      
        }
    ?>

    <table border="1px" width="100%">
        <tr>
            <th>Alumno</th>
            <th>Asignatura</th>
            <th>Nota</th>
            <th>Calificacion</th>
        </tr>
    <?php
        foreach ($clase as $nombre => $alumno){
            $primera = true;
            foreach ($alumno as $asig => $nota){

                [$notaS, $color] = match (true) {
                ($nota<5) => ["suspenso","#e4dafd"],
                ($nota<=6) => ["bien","#d7e7fd"],
                ($nota<=8) => ["notable","#ffece3"],
                ($nota<=10) =>["sobresaliente","#f9e0e0"]
                };

                if($primera){
    ?>
                <tr>
                    <td rowspan="<?php echo $tam?>"> <?php echo $nombre?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $asig?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $nota?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $notaS?></td>
                </tr>
    <?php
                $primera = false;
                } else {
    ?>
                <tr>     
                    <td bgcolor="<?php echo $color ?>"><?php echo $asig?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $nota?></td>
                    <td bgcolor="<?php echo $color ?>"><?php echo $notaS?></td>
                </tr>
    <?php
                }
            }
        }

    ?>
    </table>
  

    

</body>
</html>