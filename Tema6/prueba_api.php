<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APIS probando</title>
</head>
<body>

    <form method="POST">

    Elige metodo a mandar:
    <select name="method">
        <option value="GET">GET</option>
        <option value="POST">POST</option>
        <option value="PUT">PUT</option>
        <option value="DELETE">DELETE</option>
    </select>

    <!-- esto para PUT Y POST -->
    <label for="">Nombre des PUT Y POST</label>
    <input type="text" name="nombre_desarrolladora">
    <label for="">Nombre ciudad PUT Y POST</label>
    <input type="text" name="ciudad">
    <label for="">Nombre año PUT Y POST</label>
    <input type="text" name="anno_fundacion">
    <br><br>

    <!-- esto para GET -->
    <label for="">Ciudad para el get</label>
    <input type="text" name="ciudad_filtro" placeholder="Tokio, LA, NY...">
    <small>Si lo dejas vacío, se muestran todas las desas</small>
    <br><br>

    <!-- esto para DELETE -->
    <label for="">Nombre des DELETE</label>
    <input type="text" name="nombre_desarrolladora">

    <input type="submit" value="COSITAS API">
    </form>

    <?php
        /**
         * QUE VA A HACER ESTE FORM
         * 
         * desde donde accedemos a API
         * enviaremos indo junto con el metodo que sea y la api me respondera
         * sacamos info en formato JSON y si es necesario la transformaremos en otras cosas
         * 
         */

        if($_SERVER["REQUEST_METHOD"] == "POST" ){
            $metodo = $_POST["metodo"];

            $url = "html://localhost/servidor/Tema6/nucleo_api.php";
            if($metodo == "GET"){
                $parametros_url = "";
                if(isset($_POST["ciudad_filtro"]) && !empty($_POST["ciudad_filtro"])){
                    $parametros_url = "?ciudad=". urlencode($_POST["ciudad_filtro"]);
                    
                }
            }

        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){

        }


        
    ?>


</body>
</html>