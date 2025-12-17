<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <?php
        error_reporting(E_ALL); 
        ini_set("display_errors",1);
    ?>
</head>
<body>
    <h3>Inventario de la Tienda</h3>
    <form action="" method="POST">
        <label for="opcion">Formato de visualizacion:</label>
        <input type="text" name="opcion" placeholder="tabla, listaO, listaN">

        <input type="submit" value="Mostrar">
    </form>

    <?php

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $opcion = $_POST["opcion"];
   
        $productos = [
            [
                "nombre" => "Camiseta",
                "precio" => 15.99,
                "cantidad" => 10
            ],
            [
                "nombre" => "Pantalón",
                "precio" => 29.99,
                "cantidad" => 5
            ],
            [
                "nombre" => "Zapatos",
                "precio" => 49.99,
                "cantidad" => 8
            ],
            [
                "nombre" => "Gorra",
                "precio" => 12.50,
                "cantidad" => 15
            ],
            [
                "nombre" => "Chaqueta",
                "precio" => 59.99,
                "cantidad" => 3
            ]
        ];

        if($opcion == "listaO"){
            $totalProductos = 0;
            $valorTotal = 0;
            echo "<br>";
            echo "<hr>";

            echo "<ol>";
                foreach ($productos as $producto) {
                    
                    echo "<li>";
                    foreach ($producto as $key => $valor) {
                        if($key == "precio"){
                            echo "$key - $valor € - ";
                        
                        } else{
                            echo "$key - $valor - ";
                        }
                    }
                    $subtotal = $producto["precio"]*$producto["cantidad"];
                    $totalProductos += $producto["cantidad"];
                    $valorTotal += $subtotal;
                    echo "Subtotal - $subtotal €";
                    echo "</li>";
                }
                
            echo "</ol>";

            echo "<b>Total productos: $totalProductos </b><br>";
            echo "<b>Valor total: $valorTotal </b>";

        }else if($opcion == "listaN"){
            $totalProductos = 0;
            $valorTotal = 0;
            echo "<br>";
            echo "<hr>";
            echo "<ul>";
                foreach ($productos as $producto) {
                    
                    echo "<li>";
                    foreach ($producto as $key => $valor) {
                        if($key == "precio"){
                            echo "$key - $valor € - ";
                        
                        } else{
                            echo "$key - $valor - ";
                        }
                    }
                    $subtotal = $producto["precio"]*$producto["cantidad"];
                    $totalProductos += $producto["cantidad"];
                    $valorTotal += $subtotal;
                    echo "Subtotal - $subtotal €";
                    echo "</li>";
                }
                
            echo "</ul>";

            echo "<b>Total productos: $totalProductos </b><br>";
            echo "<b>Valor total: $valorTotal </b>";

        }else if ($opcion == "tabla"){
            $valorTotal = 0;
            $totalProductos = 0;
            echo "<br>";
            echo "<hr>";

            echo "<table border='1px' width='600px'>";
            echo "<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>";
            foreach ($productos as $i => $producto) {
                echo "<tr>";
                foreach ($producto as $caracteristica => $valor) {
                    echo "<td> $valor </td>";
                    if($caracteristica=="cantidad"){
                        
                        echo "<td> $subtotal €</td>";
                    } else {
                        $subtotal = $producto["precio"]*$producto["cantidad"];
                    }
                   
                }
                $totalProductos += $producto["cantidad"];
                $valorTotal += $subtotal;
                    

                echo "</tr>";
            }
            
            echo "<tr> <td colspan='2'> <b>TOTALES</b></td> <td><b> $totalProductos </b></td> <td><b> $valorTotal €</b></td></tr>";

            echo "</table>";



        }else{
            echo "Por favor, escribe bien tu opción";
        }

    }
    ?>

</body>
</html>