<?php
    /**
     * Que es una API? 
     * Conjunto d reglas que permiten que un programa se comunique con otro sin conocer su implementacion interna
     * 
     * En la practica hay que especificar tres cosas:
     * 
     *  - Que se puede pedir?
     *  - Como se pide
     *  - Que se devuelve
     * 
     * 
     * Que es API REST?
     * Un tipo de API que sigue la arquitectura REST, su caracteristica principal es que el protocolo HTTP como estandar de comunicacion
     * 
     * Caracteristicsa clase API REST:
     *  - Stateless (sin estado): cada èticion es independiente a la anterior
     *  - Formato JSON
     *  - Separacion del front y el back
     *  - Uso de verbos HTTP y su correspondiente codigo de estado
     * 
     */

    error_reporting(E_ALL);
    ini_set("display_errors",1);

    /**
     * header -> funcion para enviar info invisible al navegador
     * con el valor content type: application/json le decimos al cliente qye ko que le va a llegar esta en formato JSON
     * esto es importante sobre todo si estamos trabajando con JS
     */
    header("Content Type: application/json");

    /**
     * include() -> cargar el archivo de conexion a la db pero si falla se muestra un warning en vez de que se pare la ejecucion del script
     */
    include "conexion_pdo.php";

    /**
     * SERVER es un array asociativ con indo del servidor
     * REQUEST METHOD es lo que nos dice que metodo HTTPS se ha usado
     */
    $metodo = $_SERVER["REQUEST_METHOD"]; //recogemos el metodo q sea

    /**
     * file_get_contents("php://input") -> lee el cuerpo de la peticion
     * 
     * cuando alguien envia datos al nucleo de la API estos datos viajan en el cuerpo de la peticion HTTP
     * 
     * con "php://input" podemos leer el contenido crudo raw del cuerpo de la peticion
     */
    $entrada = file_get_contents("php://input");
    
    /**
     * json_decode() -> convertir el json en un array de php
     * 
     * tiene dos parametros, el primero sera la entrada o el json a decodificar y la segunda IMPORTANTE - true o false, true para convertir el json en array asociativo y false para objeto. nosotros SIEMPRE TRUE
     */
    $entrada = json_decode($entrada,true);

    // DECIDIMOS QUE HACER SEGUN EL METODO HTTP QUE ME HA LLEGADO

    switch($metodo){
        case "GET":
            controlGet($_conexion);
            break;

        case "POST":
            controlPost($_conexion, $entrada);
            break;

        case "PUT":
            controlPut($_conexion, $entrada);
            break;

        case "DELETE":
            controlDelete($_conexion, $entrada);
            break;
        default:
            echo json_encode(
                ["estado" => "error", 
                "mensaje" => "Error"]
            );
            break;
    }

    /**
    * control get -> leemos datos, buscamos en la db filtrando por ciudad. cliente envia nombre ciudad y yo respond con nombre de desarrolladoras
    * 
    * si cliente no mete ninguna ciudad, devuelvo todas las desarrolladoras
    */
    function controlGet($_conexion){
        try {
            if(isset($_GET["ciudad"]) && $_GET["ciudad"] != ""){
                $consulta = "SELECT * FROM desarrolladoras WHERE ciudad = :ciu";
                $res = $_conexion->prepare($consulta);
                $res->bindValue("ciu", $_GET["ciudad"], PDO::PARAM_STR);
                $res->execute();
            } else {
                // el cliente no ha mandado ni una ciudad
                $consulta = "SELECT * FROM desarrolladoras";
                $res = $_conexion->prepare($consulta);
                $res->execute();
            }

            //res ya tiene el resultado de mi consulta, sea la que sea, asiq lo saco por aqui

            //reescribo en formato array bidimensional asociativo
            $res = $res->fetchAll();

            //enviar de vuelta al cliente del tiron. en api se hace directamente echo para devolver datos
            //el header no se manda hasta el primer echo
            echo json_encode($res);


        } catch (PDOException $e) {
            echo json_encode([
                "error" => "error consulta",
                "detalles" => "otro mensaje"
          ]);
        }
    }

    function controlPost($_conexion, $entrada){
        if(!isset($entrada["nombre_desarrolladora"]) || ($entrada["nombre_desarrolladora"]) === ""){
            echo json_encode(
                ["estado" => "error", 
                "mensaje" => "Falta la primary key"]
            );
            return;
        }
        $des = $entrada["nombre_desarrolladora"];
        $ciudad = $entrada["ciudad"] ?? "";
        $anno = $entrada["anno_fundacion"] ?? 0;

        try{
            $consulta = "INSERT INTO desarrolladoras (nombre_desarrolladora, ciudad, anno_fundacion) 
            VALUES (:viento, :lluvia, :muerte)";
            $consulta = $_conexion->prepare($consulta);

            $consulta->bindValue("viento", $des, PDO::PARAM_STR);
            $consulta->bindValue("lluvia", $ciudad, PDO::PARAM_STR);
            $consulta->bindValue("muerte", $anno, PDO::PARAM_INT);

            $consulta->execute();

            echo json_encode(
                ["estado" => "exito", 
                "mensaje" => "todo good"]
            );

        }catch(PDOException $e){
            echo json_encode(
                ["estado" => "error", 
                "mensaje" => "todo mal"]
            );
        }

    }

    function controlDelete($_conexion){
        if(!isset($entrada["nombre_desarrolladora"]) || ($entrada["nombre_desarrolladora"]) === ""){
            echo json_encode(
                ["estado" => "error", 
                "mensaje" => "Falta la primary key"]
            );
            return;
        }

        $consulta = $_conexion->prepare("DELETE FROM desarrolladoras WHERE nombre_desarrolladora = :des");
        $consulta->bindValue("des", $entrada["nombre_desarrolladora"], PDO::PARAM_STR);

        $bien = $consulta->execute();
        if($bien && $consulta->rowCount() === 1){
            echo json_encode(
                ["estado" => "exito", 
                "mensaje" => "desa borrada"]
            );
        } else {
            echo json_encode(
                ["estado" => "error", 
                "mensaje" => "desa no borrada"]
            );
        }

    }

    function controlPut($_conexion, $entrada){
        // como nombre desarrolladora es la primary key, no podemos actualizar este campo, solo ciudad y año de fundacion
        if(!isset($entrada["nombre_desarrolladora"]) || ($entrada["nombre_desarrolladora"]) === ""){
            echo json_encode(
                ["estado" => "error", 
                "mensaje" => "Falta la primary key"]
            );
            return;
        }
        $des = $entrada["nombre_desarrolladora"];
        $ciudad = $entrada["ciudad"] ?? "";
        $anno = $entrada["anno_fundacion"] ?? 0;

        $consulta = $_conexion->prepare("UPDATE desarrolladoras SET (ciudad = :ciud, anno_fundacion = :ano) WHERE nombre_desarrolladora = :des");

        $consulta->bindValue("ciud", $ciudad, PDO::PARAM_STR);
        $consulta->bindValue("ano", $anno, PDO::PARAM_INT);
        $consulta->bindValue("des", $des, PDO::PARAM_STR);
        
        $bien = $consulta->execute();
        if($bien && $consulta->rowCount() === 1){
            echo json_encode(
                ["estado" => "exito", 
                "mensaje" => "desa actualizada"]
            );
        } else {
            echo json_encode(
                ["estado" => "error", 
                "mensaje" => "desa no actualizada"]
            );
        }


    }




?>