<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <?php
        error_reporting(E_ALL); 
        ini_set("display_errors",1);
    ?>

</head>
<body>

    <h3>Gestion de Estudiantes</h3>
    <form action="" method="POST">
        <label for="opcion">Elige opción de orden de la clase:</label>
        <select name="opcion">
            <option disabled selected>--Selecciona una opción--</option>
            <option value="nombres">Ordena por nombres (A-Z)</option>
            <option value="ciudad">Ordena por ciudad (Z-A)</option>
            <option value="extraer">Extrae nombres y notas</option>
            <option value="calcula">Calcula media de la clase</option>
        </select><br>

        <input type="submit" value="Enviar">
    </form>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $opcion = $_POST["opcion"];
    $estudiantes = [
        [
        "nombre" => "Ana García",
        "edad" => 20,
        "nota" => 8.5,
        "ciudad" => "Madrid",
        "curso" => "2º DAW"
        ],
        [
        "nombre" => "Carlos Pérez",
        "edad" => 22,
        "nota" => 6.8,
        "ciudad" => "Barcelona",
        "curso" => "2º DAW"
        ],
        [
        "nombre" => "Laura Martínez",
        "edad" => 19,
        "nota" => 9.2,
        "ciudad" => "Valencia",
        "curso" => "1º DAW"
        ],
        [
        "nombre" => "David López",
        "edad" => 21,
        "nota" => 7.5,
        "ciudad" => "Sevilla",
        "curso" => "2º DAW"
        ],
        [
        "nombre" => "Elena Rodríguez",
        "edad" => 20,
        "nota" => 8.9,
        "ciudad" => "Madrid",
        "curso" => "1º DAW"
        ],
        [
        "nombre" => "Miguel Sánchez",
        "edad" => 23,
        "nota" => 5.5,
        "ciudad" => "Barcelona",
        "curso" => "2º DAW"
        ],
        [
        "nombre" => "Sara Fernández",
        "edad" => 19,
        "nota" => 9.8,
        "ciudad" => "Valencia",
        "curso" => "1º DAW"
        ],
        [
        "nombre" => "Javier Gómez",
        "edad" => 22,
        "nota" => 7.2,
        "ciudad" => "Madrid",
        "curso" => "2º DAW"
        ]
    ];

    $copiaClase = [];
    

    if(empty($opcion)){
        echo "Selecciona una opción";
    }elseif($opcion == "nombres"){

        $nombres = array_column($estudiantes, "nombre");
        array_multisort(
            $nombres, SORT_ASC, $estudiantes
        );
        

        echo "<table width='100%' cellpading='15' border='2'>";
        echo "<tr> <th> Nombre</th><th> Edad</th> <th>Nota</th><th>Ciudad</th><th>Curso </th></tr>";
        foreach ($estudiantes as $i => $value) {
            echo "<tr>";
            foreach ($value as $key => $datos) {
                echo "<td> $datos </td>";
            }
            echo "</tr>";
        }
        echo "</table>";

        //asi lo queria hacer yo:

        $tmp = [];
        foreach ($estudiantes as $i => $datos) {
            foreach ($datos as $key => $value) {
                if($key == "nombre"){
                    $copiaClase[]=$value;
                }
            }
        }
        sort($copiaClase);

        foreach ($copiaClase as $alumno) {
            foreach ($estudiantes as $i => $datos) {
                if($datos["nombre"]==$alumno){
                    $tmp[] = $datos;
                }
            }
        }
        echo "<br>";
        //tmp es el array con valores ordenados

        echo "<table width='100%' cellpading='15' border='2'>";
        echo "<tr> <th> Nombre</th><th> Edad</th> <th>Nota</th><th>Ciudad</th><th>Curso </th></tr>";
        foreach ($tmp as $i => $value) {
            echo "<tr>";
            foreach ($value as $key => $datos) {
                echo "<td> $datos </td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        

    }elseif($opcion == "ciudad"){

        $ciudad = array_column($estudiantes, "ciudad");
        array_multisort(
            $ciudad, SORT_DESC, $estudiantes
        );

        echo "<table width='100%' cellpading='15' border='2'>";
        echo "<tr> <th> Nombre</th><th> Edad</th> <th>Nota</th><th>Ciudad</th><th>Curso </th></tr>";
        foreach ($estudiantes as $i => $value) {
            echo "<tr>";
            foreach ($value as $key => $datos) {
                echo "<td> $datos </td>";
            }
            echo "</tr>";
        }
        echo "</table>";


    }elseif($opcion == "extraer"){
        echo "<ul>";
        foreach ($estudiantes as $i => $datos) {
            echo "<li>";
            foreach ($datos as $key => $valor) {
                
                if($key == "nombre"){
                    echo "$valor - ";
                } else if($key == "nota"){
                    echo "$valor ";
                }
                
            }
            echo "</li>";
        }

        echo "</ul>";

    }elseif($opcion == "calcula"){
        $media = 0;
        foreach ($estudiantes as $i => $datos) {
            foreach ($datos as $key => $valor) {
                
                if($key == "nota"){
                    $media += $valor;
                }
                
            }
            
        }
        $media /= count($estudiantes);
        $media = round($media, 2);

        echo "<p> La nota media de la clase es: $media </p>";
        

    }


}

?>
    
</body>
</html>