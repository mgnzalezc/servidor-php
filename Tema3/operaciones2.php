<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones while</title>
</head>
<body>

<h2></h2>

<?php
    // WHILE

    /**
     *  while (condicion) {
     *  }
     * 
     *  do{
     *  } while (condicion);
     * 
     */

    $numeroSecreto = 9;
    $count = 0;

    do {
        $count++;
        $num= rand(4,9);
        echo "Intento numero $count. Numero probado: $num <br>";
    }while($numeroSecreto!=$num);

    echo "Se ha encontrado el numero secreto en $count intentos<br>";

?>

<p><b>Ejemplo con li</b></p>
<ul>
    
        <?php
        $count = 0;
        while($count<=20){
            
            echo "<li>".($count*7)."</li>";
            $count++;
        }
        ?>
    
</ul>

<p><b>Ejemplo feisimo con li</b></p>

<ol>
    <?php
        $count = 0;
        while($count<=20){
        
    ?>

    <li>
        <?php
            echo ($count*7);
            $count++;
        }
        ?>
    </li>
</ol>

<p><b>Ejercicio digitos</b></p>

<?php
    $count = 0;
    $numero = rand(0,1000);
    $sol = $numero;
    while($sol!=0){
        $sol = intval($sol/10);
        $count++;
    }

    echo "El numero es $numero y tiene $count digitos<br>";

?>

<p><b>Ejercicio poder</b></p>
<?php
    $num = 3;
    $poder = 6;
    $count = 0;
    $res= 1;

    do{
        $res = $res * $num;
        $count++;
    }while($count<$poder);

    echo "El resultado es $res <br>";
    echo "el resultado con pow es: ".pow($num,$poder);

?>

<p><b>Ejercicio poder</b></p>
<style>
  table {
    border: 1px solid black;
    border-collapse: collapse;
  }
  td{
    border: 1px solid black;
  }
  th{
    border: 1px solid black;
  }
</style>

<table>

    <?php
        $count = 1;
        $total = 0;

        while($total<100){
            $num = rand(1,10);
            $total += $num;
            $count++;

            echo "<tr>";
            echo "<th colspan="."2".">Intento $count</th>";
            echo "<tr>";
            echo "</tr>";
            echo "<td>Num: $num</td> <td>Acum: $total</td>";
            echo "</tr>";
        }


    ?>


</table>


</body>
</html>