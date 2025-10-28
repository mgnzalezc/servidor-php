<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>que bonita la vida es preciosa</h1>
    <?php 
        $num1 = 90;
        $num2 = 89.3;

        $suma = $num1 + $num2;

        $resta = $num1-$num2;

        //echo $suma;
    ?>

    <p>La suma de nuestras variables sería <?php echo $suma?></p>

    <p>Tambien se puede hacer así:</p>
    <p> <?php echo "La suma de las variables es ".$suma; ?> </p>

    


</body>
</html>