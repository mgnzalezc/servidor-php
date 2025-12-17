<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DNI</title>
    <?php
        error_reporting(E_ALL); //recoge errores, E_ALL son todos
        ini_set("display_errors", 1); //modificar valor error variable PHP
    ?>
</head>
<body>

    <?php
    print_r($_POST);
        if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["form"]=="validDNI"){

            $tmp_script = $_POST["script"];
            $tmp_scriptO = $tmp_script; //para imprimir desps
            if($tmp_script == ""){ //si esto fuese un select, hacer isset porque si esta vacia ni se manda
                $err_script = "Introduzca un mensaje";
            } else { //sanitizar
                $tmp_script = trim($tmp_script); //quitar espacios en blanco a los lados
                //$tmp_script = htmlspecialchars($tmp_script);
                $tmp_script = filter_var($tmp_script, FILTER_SANITIZE_SPECIAL_CHARS); //transforma algunos caract especiales en formato que no se ejecute: < en &lt;
                if(strlen($tmp_script)<5 || strlen($tmp_script)>70){
                    $err_script = "Entre 5 y 70 caracteres porfavo";
                } else {
                    $script = $tmp_script;
                }
            }

        }
    ?> 

    <form action="" method="POST">
        <input type="hidden" name="form" value="validDNI"> <!--asi o con name en submit. si es asi, name form tiene q estar en todos los forms-->
        
        <input type="text" name="script">
        <?php
        if(isset($err_script)) echo $err_script;
        ?>
        <input type="submit" name="ej1" value="enviar">
        <?php
        if(isset($script)) {
            echo "Mensaje original: $tmp_scriptO Mensaje sanitizado $script <br>";
            echo "Numero chars original".strlen($tmp_scriptO)."<br>";
            echo "Numero chars sanitizado".strlen($script)."<br>";

        }
        ?>
    </form>


</body>
</html>